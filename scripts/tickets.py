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
'''


def create_ticket(match_id, status, updates):
    # this function takes in the Match_ID, status, and updates and creates
    # a new ticket when a "potential" match has been identified or when someone hits the claim button
    ticket_number = id_generator(size=11)
    agent = 'unassigned'
    date_created = datetime.datetime.now()

    is_ticket = db_get_ticket(match_id)
    print "create_ticket: is_ticket returns: " + is_ticket
    if is_ticket == '':
        try:
            cnx = mysql.connector.connect(user=appollo.dbusername, password=appollo.dbpassword,
                                          host=appollo.dbhostname, database=appollo.dbname)
            cursor = cnx.cursor()
            query = ("INSERT INTO tickets (TicketNumber, Match_ID, Agent, DateCreated, Status, Updates) VALUES('" + ticket_number + "', '" + match_id + "', '" + agent + "', '" + str(date_created) + "', '" + status + "', '" + updates + "') ON DUPLICATE KEY UPDATE Status='" + status + "'")
            print "my create ticket query is: " + query
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
    print "this is the ticket number: " + ticket_number
    return ticket_number
