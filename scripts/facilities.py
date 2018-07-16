from db_manipulate import id_generator
import mysql.connector
from mysql.connector import errorcode
import datetime
import appollo
'''
MariaDB [reunite]> describe facilities;
+----------------+--------------+------+-----+---------------------+-------------------------------+
| Field          | Type         | Null | Key | Default             | Extra                         |
+----------------+--------------+------+-----+---------------------+-------------------------------+
| FacilityNumber | varchar(100) | NO   | PRI | NULL                |                               |
| Address        | varchar(200) | YES  |     | NULL                |                               |
| POC            | varchar(100) | YES  |     | NULL                |                               |
| Status         | varchar(30)  | YES  |     | NULL                |                               |
| last_updated   | timestamp    | NO   |     | current_timestamp() | on update current_timestamp() |
| FacilityName   | varchar(100) | YES  |     | NULL                |                               |
| city           | varchar(100) | YES  |     | NULL                |                               |
| state          | varchar(2)   | YES  |     | NULL                |                               |
| zip            | varchar(5)   | YES  |     | NULL                |                               |
+----------------+--------------+------+-----+---------------------+-------------------------------+
9 rows in set (0.00 sec)

'''


def create_facility(facility_name, address, city, state, zip, poc, user_id):
    # this function takes in the facility string and breaks it up and inputs it into the db
    # the string should be formatted in this manner: 'FacilityName,address,city,state,zip,poc'
    facility_number = id_generator(size=8)
    status = 'active'

    updates = ("Facility Created. Facility Data: FacilityName=" + facility_name +
               ", Address=" + address + ", city=" + city + ", state=" + state + ", zip=" + str(zip) +
               ", POC=" + poc)
    try:
        cnx = mysql.connector.connect(user=appollo.dbusername, password=appollo.dbpassword,
                                      host=appollo.dbhostname, database=appollo.dbname)
        cursor = cnx.cursor()
        query = ("INSERT INTO facilities (FacilityNumber, FacilityName, Address, city, state, zip, Status, POC) "
                 "VALUES('" + facility_number + "', '" + facility_name + "', '" + address + "', '" + city +
                 "', '" + state + "', '" + str(zip) + "', '" + status + "', '" + poc +
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

    insert_facility_event(facility_number, updates, user_id)


def db_remove_facility(facility_number):
    # this function completely deletes a facility from the db keyed off the Match_ID
    try:
        cnx = mysql.connector.connect(user=appollo.dbusername, password=appollo.dbpassword,
                                      host=appollo.dbhostname, database=appollo.dbname)
        cursor = cnx.cursor()
        query = ("DELETE FROM facilities WHERE FacilityNumber='" + facility_number + "'")
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


def db_get_facility_info(facility_number):
    # this function gets the entire record for the facility keyed off the FacilityNumber and returns a match list object
    facility = []
    try:
        cnx = mysql.connector.connect(user=appollo.dbusername, password=appollo.dbpassword,
                                      host=appollo.dbhostname, database=appollo.dbname)
        cursor = cnx.cursor()
        query1 = ("SELECT * FROM facilities WHERE FacilityNumber='" + facility_number + "'")
        cursor.execute(query1)
        for FacilityNumber, FacilityName, Address, city, state, zip, POC, Status in cursor:
            facility = [FacilityNumber, FacilityName, Address, city, state, zip, POC, Status]
    except mysql.connector.Error as err:
        if err.errno == errorcode.ER_ACCESS_DENIED_ERROR:
            print("Something is wrong with your user name or password")
        elif err.errno == errorcode.ER_BAD_DB_ERROR:
            print("Database does not exist")
        else:
            print(err)
    else:
        cnx.close()
    return facility


def update_facility(facility_name, address, city, state, zip, poc, facility_number, user_id):
    # this function takes in the facility string and breaks it up and inputs it into the db
    # the string should be formatted in this manner: 'FacilityName,address,city,state,zip,poc'
    updates = ("update executed for facility. New Facility Data: FacilityName=" + facility_name +
               ", Address=" + address + ", city=" + city + ", state=" + state + ", zip=" + str(zip) +
               ", POC=" + poc)
    try:
        cnx = mysql.connector.connect(user=appollo.dbusername, password=appollo.dbpassword,
                                      host=appollo.dbhostname, database=appollo.dbname)
        cursor = cnx.cursor()
        query = ("INSERT INTO facilities (FacilityNumber, FacilityName, Address, city, state, zip, POC) VALUES('" + facility_number + "', '" + facility_name + "', '" + address + "', '" + city + "', '" + state + "', '" + str(zip) + "', '" + poc + "') ON DUPLICATE KEY UPDATE FacilityName='" + facility_name + "', Address='" + address + "', city='" + city + "', state='" + state + "', zip='" + str(zip) + "', POC='" + poc + "'")
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

    insert_facility_event(facility_number, updates, user_id)


def insert_facility_event(facility_number, updates_pre, user_id):
    # this function inserts an event in the facility_history table
    # the event_str should be "TicketNumber,Updates,userid"
    date_updated = datetime.datetime.now()
    updates = "facility " + facility_number + " was modified by @" + user_id + ": " + updates_pre

    try:
        cnx = mysql.connector.connect(user=appollo.dbusername, password=appollo.dbpassword,
                                      host=appollo.dbhostname, database=appollo.dbname)
        cursor = cnx.cursor()
        query = ("INSERT INTO facility_history (FacilityNumber, userid, Updates, DateUpdated) "
                 "VALUES('" + facility_number + "', '" + user_id + "', '" + updates + "', '" + str(date_updated) +
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
