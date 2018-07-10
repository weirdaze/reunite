import mysql.connector
from mysql.connector import errorcode
import random
import datetime
import appollo
import os
import string
from db_manipulate import id_generator
import tickets

'''
MariaDB [reunite]> describe matches;
+-------------+--------------+------+-----+---------+-------+
| Field       | Type         | Null | Key | Default | Extra |
+-------------+--------------+------+-----+---------+-------+
| UID_A       | varchar(100) | NO   | PRI | NULL    |       |
| UID_B       | varchar(100) | NO   | PRI | NULL    |       |
| Status      | varchar(30)  | YES  |     | NULL    |       |
| DateMatched | varchar(30)  | YES  |     | NULL    |       |
| Match_ID    | varchar(200) | NO   | PRI | NULL    |       |
+-------------+--------------+------+-----+---------+-------+
4 rows in set (0.00 sec)

'''


def db_add_update_match(match_str):
    # this function connects to the db and inserts a match or updates the status of a match.
    match = match_str.split(',')
    uid_a = match[0]
    uid_b = match[1]
    status = match[2]
    date_matched = datetime.datetime.now()
    match_id = match[3]

    try:
        cnx = mysql.connector.connect(user=appollo.dbusername, password=appollo.dbpassword,
                                      host=appollo.dbhostname, database=appollo.dbname)
        cursor = cnx.cursor()
        query = ("INSERT INTO matches (UID_A, UID_B, Status, DateMatched, Match_ID) "
                 "VALUES('" + uid_a + "', '" + uid_b + "', '" + status + "', '" + str(date_matched) + "', '" + match_id +
                 "') ON DUPLICATE KEY UPDATE Status='" + status + "'")
        print(query)
        cursor.execute(query)
        cnx.commit()
        cursor.close()
    except mysql.connector.Error as err:
        if err.errno == errorcode.ER_ACCESS_DENIED_ERROR:
            print("Something is wrong with your user name or password")
        elif err.errno == errorcode.ER_BAD_DB_ERROR:
            print("Database does not exist")
        else:
            print(err)
    else:
        cnx.close()


def db_remove_match(match_id):
    # this function completely deletes a match from the db keyed off the 2 UID's
    try:
        cnx = mysql.connector.connect(user=appollo.dbusername, password=appollo.dbpassword,
                                      host=appollo.dbhostname, database=appollo.dbname)
        cursor = cnx.cursor()
        query = ("DELETE FROM matches WHERE Match_ID='" + match_id + "'")
        cursor.execute(query)
        cnx.commit()
        cursor.close()
    except mysql.connector.Error as err:
        if err.errno == errorcode.ER_ACCESS_DENIED_ERROR:
            print("Something is wrong with your user name or password")
        elif err.errno == errorcode.ER_BAD_DB_ERROR:
            print("Database does not exist")
        else:
            print(err)
    else:
        cnx.close()


def db_get_match(match_id):
    # this function gets the entire record for the match keyed off the Match_ID and returns a match list object
    match = []
    try:
        cnx = mysql.connector.connect(user=appollo.dbusername, password=appollo.dbpassword,
                                      host=appollo.dbhostname, database=appollo.dbname)
        cursor = cnx.cursor()
        query1 = ("SELECT * FROM matches WHERE Match_ID='" + match_id + "'")
        cursor.execute(query1)
        for UID_A, UID_B, Status, DateMatched, Match_ID in cursor:
            match = [UID_A, UID_B, Status, DateMatched, Match_ID]
    except mysql.connector.Error as err:
        if err.errno == errorcode.ER_ACCESS_DENIED_ERROR:
            print("Something is wrong with your user name or password")
        elif err.errno == errorcode.ER_BAD_DB_ERROR:
            print("Database does not exist")
        else:
            print(err)
    else:
        cnx.close()
    return match


def db_get_match_id(uid_a, uid_b):
    # this function gets the entire record for the match keyed off the Match_ID and returns a match list object
    match_id = "match"
    try:
        cnx = mysql.connector.connect(user=appollo.dbusername, password=appollo.dbpassword,
                                      host=appollo.dbhostname, database=appollo.dbname)
        cursor = cnx.cursor()
        query1 = ("SELECT Match_ID FROM matches WHERE UID_A='" + uid_a + "' AND UID_B='" + uid_b + "'")
        cursor.execute(query1)
        for Match_ID in cursor:
            match_id = Match_ID
    except mysql.connector.Error as err:
        if err.errno == errorcode.ER_ACCESS_DENIED_ERROR:
            print("Something is wrong with your user name or password")
        elif err.errno == errorcode.ER_BAD_DB_ERROR:
            print("Database does not exist")
        else:
            print(err)
    else:
        cnx.close()
    print "db_get_match_id returns :" + str(match_id)
    return str(match_id)


def submit_claim(uid_a, uid_b, status='claimed'):
    # this function gets kicked of in the sequence of events where someone clicks the claim button
    # first generate the match_id
    there_is_match = db_get_match_id(uid_a, uid_b)
    there_is_inverse_match = db_get_match_id(uid_b, uid_a)
    print "there is a match: " + there_is_match
    print "there is inverse match: " + there_is_inverse_match

    if there_is_match == 'match' and there_is_inverse_match == 'match':

        match_id = id_generator(size=10)
        print "creating new match_id: " + match_id
        # construct the match list object
        match = uid_a + "," + uid_b + "," + status + "," + match_id
        print "constructing match object: " + match
        print "entering the match into the matches db"
        db_add_update_match(match)
        updates = "created by " + uid_a + " on the app"
        print "match entered creating the update: " + updates
        print "creating ticket with match_id " + match_id + " and updates"
        tickets.create_ticket(match_id, "new", updates)
        match_var = uid_a + "," + uid_b
        update_claiming(match_var)
        return db_get_match_id(uid_a, uid_b)
    else:
        return "already-matched"


def potential_match():
    # this function goes through the entire list of "claimed" state matches and looks to see if there are inverted
    # matches meaning that it looks to see if people claimed each other and then changes the status of those matches
    # to "potential-match"

    # first get all the matches that are in 'claimed' state
    matches = []
    matches_copy = []
    potential_matches = []
    potential_matches_copy = []
    dedup_matches = []

    try:
        cnx = mysql.connector.connect(user=appollo.dbusername, password=appollo.dbpassword,
                                      host=appollo.dbhostname, database=appollo.dbname)
        cursor = cnx.cursor()
        query1 = ("SELECT UID_A, UID_B, Match_ID FROM matches WHERE Status='claimed'")
        cursor.execute(query1)
        for UID_A, UID_B, Match_ID in cursor:
            match = [UID_A, UID_B, Match_ID]
            matches.append(match)
    except mysql.connector.Error as err:
        if err.errno == errorcode.ER_ACCESS_DENIED_ERROR:
            print("Something is wrong with your user name or password")
        elif err.errno == errorcode.ER_BAD_DB_ERROR:
            print("Database does not exist")
        else:
            print(err)
    else:
        cnx.close()

    # now go through and compare each match to all other matches and if you find an match or inverted match then
    # update the status and create a list of potential-matches
    matches_copy = matches
    # created a copy to iterate against

    for match in matches:
        tmp_uid_a = match[0]
        tmp_uid_b = match[1]
        tmp_match_id = match[2]

        for match_c in matches_copy:
            tmp2_uid_a = match_c[0]
            tmp2_uid_b = match_c[1]
            tmp2_match_id = match_c[2]

            # only check if it's not the same match_id... otherwise you're looking at your own record
            if tmp_match_id != tmp2_match_id:
                # if uid a and uid b of both records are mirror images of each other, then they claimed each other
                if tmp_uid_b == tmp2_uid_a and tmp_uid_a == tmp2_uid_b:
                    potential_matches.append(match)
                    potential_matches.append(match_c)
                    break

    potential_matches_copy = potential_matches

    # now we deduplicate
    for p_match in potential_matches:
        tmp_match_id = p_match[2]
        for p_match_c in potential_matches_copy:
            tmp2_match_id = p_match_c[2]
            if tmp_match_id == tmp2_match_id:
                potential_matches.remove(p_match)

    # now we update all of their status' to "potential-match"
    for match in potential_matches:
        uid_a = match[0]
        uid_b = match[1]
        match_id = match[2]
        status = "potential-match"

        match_var = uid_a + "," + uid_b + "," + status + "," + match_id
        db_add_update_match(match_var)
        update_claiming(match_var)
        tickets.create_ticket(match_id, "new", "created by potential-match algorithm")


def update_claiming(match_str):
    # this function will go and update the "claiming" column of the person table and add the new UID
    match = match_str.split(',')
    uid_a = match[0]
    uid_b = match[1]

    # first we get the "claiming" that belongs to uid_a and and then uid_b
    # for each of them, we look at the List and if it's not already there, we add it to the list
    claiming = get_claiming(uid_a)

    # now we append to claiming and update the filed in the db
    new_claiming = append_to_claiming(claiming)
    update_claiming_field(new_claiming, uid_a)

    # now we do the same for UID_B
    claiming = get_claiming(uid_b)
    new_claiming = append_to_claiming(claiming)
    update_claiming_field(new_claiming, uid_b)


def append_to_claiming(claiming, uid):
    # this function takes the claiming string, splits it out and then sees if there's a duplicate of the UID it's tryin
    # to append. then it appends it if it's not there and reconstructs the string

    claims = claiming.split(',')
    new_claims = ""
    if uid not in claims:
        claims.append(uid)

    count = 0
    for item in claims:
        if count == 0:
            new_claims += item
            count += 1
        else:
            new_claims += "," + item
    return new_claims


def get_claiming(uid):
    # this function returns the claiming field of a record
    claiming = ''
    try:
        cnx = mysql.connector.connect(user=appollo.dbusername, password=appollo.dbpassword,
                                      host=appollo.dbhostname, database=appollo.dbname)
        cursor = cnx.cursor()
        query1 = ("SELECT Claiming FROM person WHERE UID='" + uid + "'")
        cursor.execute(query1)
        for Claiming in cursor:
            claiming = Claiming
    except mysql.connector.Error as err:
        if err.errno == errorcode.ER_ACCESS_DENIED_ERROR:
            print("Something is wrong with your user name or password")
        elif err.errno == errorcode.ER_BAD_DB_ERROR:
            print("Database does not exist")
        else:
            print(err)
    else:
        cnx.close()
    return claiming


def update_claiming_field(claiming, uid):
    # this function updates the claiming field for a record
    try:
        cnx = mysql.connector.connect(user=appollo.dbusername, password=appollo.dbpassword,
                                      host=appollo.dbhostname, database=appollo.dbname)
        cursor = cnx.cursor()
        query = ("UPDATE person SET Claiming='" + claiming + "' WHERE UID='" + uid + "')")
        cursor.execute(query)
        cnx.commit()
        cursor.close()
    except mysql.connector.Error as err:
        if err.errno == errorcode.ER_ACCESS_DENIED_ERROR:
            print("Something is wrong with your user name or password")
        elif err.errno == errorcode.ER_BAD_DB_ERROR:
            print("Database does not exist")
        else:
            print(err)
    else:
        cnx.close()

