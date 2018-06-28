import string
import random
import appollo
import mysql.connector
from mysql.connector import errorcode

'''
this is a collection of functions that interact with the database 
we will use these for adding, editing, removing, and updating records
for reference, this is the structure of the mysqldb

MariaDB [reunite]> describe person;
+------------------+--------------+------+-----+---------+-------+----------------------------------------------------+
| Field            | Type         | Null | Key | Default | Extra | Description                                        |
+------------------+--------------+------+-----+---------+-------+----------------------------------------------------+
| UID              | double       | NO   | PRI | NULL    |       | unique identifier of a person                      |
| FirstName        | varchar(100) | NO   | PRI | NULL    |       | first name                                         |
| MiddleName       | varchar(100) | YES  |     | NULL    |       | middle name                                        |
| LastName         | varchar(100) | NO   | PRI | NULL    |       | last name                                          |
| DOB              | date         | NO   | PRI | NULL    |       | date of birth                                      |
| MaternalLastName | varchar(100) | YES  |     | NULL    |       | latinos usually have 2 last names                  |
| Sex              | varchar(10)  | YES  |     | NULL    |       | sex                                                |
| EntryPoint       | varchar(100) | YES  |     | NULL    |       | where they came into US or were caught             |
| Country          | varchar(100) | YES  |     | NULL    |       | country of origin                                  |
| LastFacility     | varchar(100) | YES  |     | NULL    |       | last facility where contact was made               |
| CurrentFacility  | varchar(100) | YES  |     | NULL    |       | facility where they currently are                  |
| Relatives        | varchar(500) | YES  |     | NULL    |       | a list of relatives                                |
| DateDetained     | date         | YES  |     | NULL    |       | date they were detained                            |
| Status           | varchar(100) | YES  |     | NULL    |       | status of their record - matched, reunited, etc    |
| Claiming         | varchar(500) | YES  |     | NULL    |       | list of people they are claiming - parents & kids  |
| Type             | varchar(20)  | YES  |     | NULL    |       | this one is here for later use                     |
| photo            | varchar(500) | YES  |     | NULL    |       | the reference to path of the picture file          |
| video            | varchar(500) | YES  |     | NULL    |       | the reference to path of the video file            |
+------------------+--------------+------+-----+---------+-------+----------------------------------------------------+
18 rows in set (0.00 sec)

'''


def update_vpn_status(person):
    # this function connects to the db and inserts a person's record
    # it takes in a list 'person' and inserts the attributes into the db
    # first break the person apart
    uid = person[0]
    first_name = person[1]
    middle_name = person[21]
    last_name = person[3]
    dob = person[4]
    maternal_last_name = person[5]
    sex = person[6]
    entry_point = person[7]
    country = person[8]
    last_facility = person[9]
    current_facility = person[10]
    relatives = person[11]
    date_detained = person[12]
    status = person[13]
    claiming = person[14]
    type = person[15]
    video = person[16]
    photo = person[17]

    # insert into the database. if the record exists then update everything except for the unique identifier
    try:
        cnx = mysql.connector.connect(user=appollo.dbusername, password=appollo.dbpassword,
                                      host=appollo.dbhostname, database=appollo.dbname)
        cursor = cnx.cursor()
        query = ("INSERT INTO person (UID, FirstName, MiddleName, LastName, DOB, MaternalLastName, "
                 "Sex, EntryPoint, Country, LastFacility, CurrentFacility, Relatives, DateDetained, "
                 "Status, Claiming, Type, photo, video ) "
                 "VALUES('" + uid + "', '" + first_name + "', '" + middle_name + "', '" + last_name + "', '" + dob +
                 "', '" + maternal_last_name + "', '" + sex + "', '" + entry_point + "', '" + country +
                 "', '" + last_facility + "', '" + current_facility + "', '" + relatives + "', '" + date_detained +
                 "', '" + status + "', '" + claiming + "', '" + type + "', '" + video + "', '" + photo +
                 "') ON DUPLICATE KEY UPDATE "
                 "FirstName='" + first_name + "', MiddleName='" + middle_name + "', LastName='" + last_name +
                 "', DOB='" + dob + "', MaternalLastName='" + maternal_last_name + "', Sex='" + sex +
                 "', EntryPoint='" + entry_point + "', Country='" + country + "', LastFacility='" + last_facility +
                 "', CurrentFacility='" + current_facility + "', Relatives='" + relatives +
                 "', DateDetained='" + date_detained + "', Status='" + status + "', Claiming='" + claiming +
                 "', Type='" + type + "', video='" + video + "', photo='" + photo + "'")
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
