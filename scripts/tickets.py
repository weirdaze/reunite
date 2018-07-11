import mysql.connector
from mysql.connector import errorcode
import datetime
import appollo
import os
import string
from db_manipulate import id_generator


'''
MariaDB [reunite]> describe tickets;
+--------------+--------------+------+-----+---------------------+-------------------------------+
| Field        | Type         | Null | Key | Default             | Extra                         |
+--------------+--------------+------+-----+---------------------+-------------------------------+
| TicketNumber | varchar(100) | NO   | PRI | NULL                |                               |
| Match_ID     | varchar(100) | NO   | PRI | NULL                |                               |
| Agent        | varchar(100) | YES  |     | NULL                |                               |
| DateCreated  | varchar(100) | YES  |     | NULL                |                               |
| Status       | varchar(30)  | YES  |     | NULL                |                               |
| Updates      | varchar(500) | YES  |     | NULL                |                               |
| last_updated | timestamp    | NO   |     | current_timestamp() | on update current_timestamp() |
+--------------+--------------+------+-----+---------------------+-------------------------------+
7 rows in set (0.00 sec)

MariaDB [reunite]> describe ticket_history;
+--------------+--------------+------+-----+---------------------+-------------------------------+
| Field        | Type         | Null | Key | Default             | Extra                         |
+--------------+--------------+------+-----+---------------------+-------------------------------+
| TicketNumber | varchar(100) | NO   | PRI | NULL                |                               |
| Updates      | longtext     | YES  |     | NULL                |                               |
| DateUpdated  | datetime     | YES  |     | NULL                |                               |
| last_updated | timestamp    | NO   |     | current_timestamp() | on update current_timestamp() |
| userid       | varchar(100) | YES  |     | NULL                |                               |
+--------------+--------------+------+-----+---------------------+-------------------------------+
5 rows in set (0.00 sec)

'''


def create_ticket(match_id, status, updates):
    # this function takes in the Match_ID, status, and updates and creates
    # a new ticket when a "potential" match has been identified or when someone hits the claim button
    ticket_number = id_generator(size=11)
    agent = 'unassigned'
    date_created = datetime.datetime.now()

    is_ticket = db_get_ticket(match_id)
    if is_ticket == '':
        try:
            cnx = mysql.connector.connect(user=appollo.dbusername, password=appollo.dbpassword,
                                          host=appollo.dbhostname, database=appollo.dbname)
            cursor = cnx.cursor()
            query = ("INSERT INTO tickets (TicketNumber, Match_ID, Agent, DateCreated, Status, Updates) VALUES('" + ticket_number + "', '" + match_id + "', '" + agent + "', '" + str(date_created) + "', '" + status + "', '" + updates + "') ON DUPLICATE KEY UPDATE Status='" + status + "'")
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


def db_get_ticket(match_id):
    # this function returns the ticket number based on the match_id
    ticket_number = ""
    try:
        cnx = mysql.connector.connect(user=appollo.dbusername, password=appollo.dbpassword,
                                      host=appollo.dbhostname, database=appollo.dbname)
        cursor = cnx.cursor()
        query1 = ("SELECT TicketNumber FROM tickets WHERE Match_ID='" + match_id + "'")
        cursor.execute(query1)
        for TicketNumber in cursor:
            ticket_number = TicketNumber
    except mysql.connector.Error as err:
        if err.errno == errorcode.ER_ACCESS_DENIED_ERROR:
            print("Something is wrong with your user name or password")
        elif err.errno == errorcode.ER_BAD_DB_ERROR:
            print("Database does not exist")
        else:
            print(err)
    else:
        cnx.close()
    print "this is the ticket number: " + str(ticket_number)
    return str(ticket_number)


def assign_ticket(ticket_number, admin_username, userid):
    # this takes the userId of the person that's signed in and updates it in the ticket Agent column

    try:
        cnx = mysql.connector.connect(user=appollo.dbusername, password=appollo.dbpassword,
                                      host=appollo.dbhostname, database=appollo.dbname)
        cursor = cnx.cursor()
        query = ("UPDATE tickets SET Agent='" + admin_username + "' WHERE TicketNumber='" + ticket_number + "'")
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
    update = "@" + userid + "assigned the ticket to " + admin_username
    insert_history_event(ticket_number + "," + update + "," + userid)


def change_status(ticket_number, status, userid):
    # this changes the ticket status and enters the event

    try:
        cnx = mysql.connector.connect(user=appollo.dbusername, password=appollo.dbpassword,
                                      host=appollo.dbhostname, database=appollo.dbname)
        cursor = cnx.cursor()
        query = ("UPDATE tickets SET Status='" + status + "' WHERE TicketNumber='" + ticket_number + "'")
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
    update = "@" + userid + "changed status to " + status
    insert_history_event(ticket_number + "," + update + "," + userid)


def insert_history_event(event_str):
    # this function inserts an event in the ticket_history table
    # the event_str should be "TicketNumber,Updates,userid"
    event = event_str.split(',')
    ticket_number = event[0]
    updates = event[1]
    username = event[2]
    date_updated = datetime.datetime.now()

    try:
        cnx = mysql.connector.connect(user=appollo.dbusername, password=appollo.dbpassword,
                                      host=appollo.dbhostname, database=appollo.dbname)
        cursor = cnx.cursor()
        query = ("INSERT INTO ticket_history (TicketNumber, userid, Updates, DateUpdted) "
                 "VALUES('" + ticket_number + "', '" + username + "', '" + updates + "', '" + str(date_updated) +
                 "')")
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
