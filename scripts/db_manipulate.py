import mysql.connector
from mysql.connector import errorcode
import random
import datetime
import appollo
import os
import string

'''
this is a collection of functions that interact with the database 
we will use these for adding, editing, removing, and updating records
for reference, this is the structure of the mysqldb

MariaDB [reunite]> describe person;
+------------------+--------------+------+-----+---------+-------+----------------------------------------------------+
| Field            | Type         | Null | Key | Default | Extra | Description                                        |
+------------------+--------------+------+-----+---------+-------+----------------------------------------------------+
| UID              | varchar(100) | NO   | PRI | NULL    |       | unique identifier of a person                      |
| FirstName        | varchar(100) | NO   | PRI | NULL    |       | first name                                         |
| MiddleName       | varchar(100) | YES  |     | NULL    |       | middle name                                        |
| LastName         | varchar(100) | NO   | PRI | NULL    |       | last name                                          |
| DOB              | varchar(30)  | NO   | PRI | NULL    |       | date of birth                                      |
| MaternalLastName | varchar(100) | YES  |     | NULL    |       | latinos usually have 2 last names                  |
| Sex              | varchar(10)  | YES  |     | NULL    |       | sex                                                |
| EntryPoint       | varchar(100) | YES  |     | NULL    |       | where they came into US or were caught             |
| Country          | varchar(100) | YES  |     | NULL    |       | country of origin                                  |
| LastFacility     | varchar(100) | YES  |     | NULL    |       | last facility where contact was made               |
| CurrentFacility  | varchar(100) | YES  |     | NULL    |       | facility where they currently are                  |
| Relatives        | varchar(500) | YES  |     | NULL    |       | a list of relatives                                |
| DateDetained     | varchar(30)  | YES  |     | NULL    |       | date they were detained                            |
| Status           | varchar(100) | YES  |     | NULL    |       | status of their record - matched, reunited, etc    |
| Claiming         | varchar(500) | YES  |     | NULL    |       | list of people they are claiming - parents & kids  |
| Type             | varchar(20)  | YES  |     | NULL    |       | this one is here for later use                     |
| photo            | varchar(500) | YES  |     | NULL    |       | the reference to path of the picture file          |
| video            | varchar(500) | YES  |     | NULL    |       | the reference to path of the video file            |
| FacilityUID      | varchar(100) | YES  |     | NULL    |       | the reference to the person inside facility        |
| InitDate         | varchar(30)  | YES  |     | NULL    |       | the date this record was created                   |
+------------------+--------------+------+-----+---------+-------+----------------------------------------------------+
20 rows in set (0.00 sec)

Here is the admin table:

MariaDB [reunite]> describe admin;
+-------------+--------------+------+-----+---------+-------+----------------------------------------------------+
| Field       | Type         | Null | Key | Default | Extra |  Description                                       |
+-------------+--------------+------+-----+---------+-------+----------------------------------------------------+
| UserID      | varchar(20)  | NO   | PRI | NULL    |       |  The username of the admin of the app              |
| FirstName   | varchar(100) | NO   | PRI | NULL    |       |  First name of the admin                           |
| MiddleName  | varchar(100) | YES  |     | NULL    |       |  Middle name of the admin                          |
| LastName    | varchar(100) | NO   | PRI | NULL    |       |  Last name of the admin                            |
| Registrants | longtext     | YES  |     | NULL    |       |  list of people that registered under the admin    |
+-------------+--------------+------+-----+---------+-------+----------------------------------------------------+
5 rows in set (0.00 sec)


MariaDB [reunite]> describe matches;
+-------------+--------------+------+-----+---------+-------+
| Field       | Type         | Null | Key | Default | Extra |
+-------------+--------------+------+-----+---------+-------+
| UID_A       | varchar(100) | NO   | PRI | NULL    |       |
| UID_B       | varchar(100) | NO   | PRI | NULL    |       |
| Status      | varchar(30)  | YES  |     | NULL    |       |
| DateMatched | varchar(30)  | YES  |     | NULL    |       |
+-------------+--------------+------+-----+---------+-------+
4 rows in set (0.00 sec)


'''


def db_add_update_profile(person, new):
    # this function connects to the db and inserts a person's record
    # it takes in a list 'person' and inserts the attributes into the db
    # new is a boolean value to see if this is an add operation vs an update
    # first break the person apart

    uid = person[0]
    first_name = person[1]
    middle_name = person[2]
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
    typed = person[15]
    video = person[16]
    photo = person[17]
    facility_uid = person[18]

    if new:
        # if the person is just being added, add the time they were added. This value will never get modified
        init_date = datetime.datetime.now()
        try:
            cnx = mysql.connector.connect(user=appollo.dbusername, password=appollo.dbpassword,
                                          host=appollo.dbhostname, database=appollo.dbname)
            cursor = cnx.cursor()
            query = ("INSERT INTO person (UID, FirstName, MiddleName, LastName, DOB, MaternalLastName, "
                     "Sex, EntryPoint, Country, LastFacility, CurrentFacility, Relatives, DateDetained, "
                     "Status, Claiming, Type, photo, video, FacilityUID, InitDate ) "
                     "VALUES('" + uid + "', '" + first_name + "', '" + middle_name + "', '" + last_name + "', '" + dob +
                     "', '" + maternal_last_name + "', '" + sex + "', '" + entry_point + "', '" + country +
                     "', '" + last_facility + "', '" + current_facility + "', '" + relatives + "', '" + date_detained +
                     "', '" + status + "', '" + claiming + "', '" + typed + "', '" + photo + "', '" + video +
                     "', '" + facility_uid + "', '" + str(init_date) + "')")
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
    else:
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
                     "', '" + status + "', '" + claiming + "', '" + typed + "', '" + video + "', '" + photo +
                     "') ON DUPLICATE KEY UPDATE "
                     "FirstName='" + first_name + "', MiddleName='" + middle_name + "', LastName='" + last_name +
                     "', DOB='" + dob + "', MaternalLastName='" + maternal_last_name + "', Sex='" + sex +
                     "', EntryPoint='" + entry_point + "', Country='" + country + "', LastFacility='" + last_facility +
                     "', CurrentFacility='" + current_facility + "', Relatives='" + relatives +
                     "', DateDetained='" + date_detained + "', Status='" + status + "', Claiming='" + claiming +
                     "', Type='" + typed + "', video='" + video + "', photo='" + photo +
                     "', FacilityUID='" + facility_uid + "'")
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


def db_remove_profile(uid):
    # this function completely deletes the person's profile from the database keyed off the UID which is unique
    try:
        cnx = mysql.connector.connect(user=appollo.dbusername, password=appollo.dbpassword,
                                      host=appollo.dbhostname, database=appollo.dbname)
        cursor = cnx.cursor()
        query = ("DELETE FROM person WHERE UID='" + uid + "'")
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


def db_get_person_info(uid):
    # this function gets the entire record for the person keyed off the UID and returns a person list object
    person = []
    try:
        cnx = mysql.connector.connect(user=appollo.dbusername, password=appollo.dbpassword,
                                      host=appollo.dbhostname, database=appollo.dbname)
        cursor = cnx.cursor()
        query1 = ("SELECT * FROM person WHERE UID='" + uid + "'")
        cursor.execute(query1)
        for UID, FirstName, MiddleName, LastName, DOB, MaternalLastName, Sex, EntryPoint, Country, LastFacility, CurrentFacility, Relatives, DateDetained, Status, Claiming, Type, video, photo, FacilityUID, InitDate in cursor:
            person = [UID, FirstName, MiddleName, LastName, DOB, MaternalLastName, Sex, EntryPoint, Country, LastFacility, CurrentFacility, Relatives, DateDetained, Status, Claiming, Type, video, photo, FacilityUID, InitDate]
    except mysql.connector.Error as err:
        if err.errno == errorcode.ER_ACCESS_DENIED_ERROR:
            print("Something is wrong with your user name or password")
        elif err.errno == errorcode.ER_BAD_DB_ERROR:
            print("Database does not exist")
        else:
            print(err)
    else:
        cnx.close()
    return person


def id_generator(size=9, chars=string.ascii_uppercase + string.digits):
    return ''.join(random.choice(chars) for _ in range(size))


def uid_is_there(uid):
    try:
        cnx = mysql.connector.connect(user = appollo.dbusername, password = appollo.dbpassword,
                                      host = appollo.dbhostname, database = appollo.dbname)
        cursor = cnx.cursor()
        query = ("SELECT COUNT(*) FROM person WHERE UID='" + uid + "'")
        cursor.execute(query)
        for COUNT in cursor:
            my_result = COUNT[0]
        if my_result > 0:
            return True
        else:
            return False
        cnx.close()
    except mysql.connector.Error as err:
        if err.errno == errorcode.ER_ACCESS_DENIED_ERROR:
            print("Something is wrong with your user name or password")
        elif err.errno == errorcode.ER_BAD_DB_ERROR:
            print("Database does not exist")
        else:
            print(err)


def generate_uid(facility_number, user_id):
    # format for the UID: facility_number (4-digits) + person_id (6-digits) + userID
    # of person registering them (5-digits)
    person_id = id_generator()
    uid = facility_number + person_id + user_id
    while uid_is_there(uid):
        person_id = id_generator()
        uid = facility_number + person_id + user_id
    return uid


def rename_media(filename, uid, media_type):
    # this function takes the filename of the file, and changes it to something uniform. checks for duplicates.
    # first we split up the filename
    name_split = filename.split('.')
    name = name_split[0]
    index = name_split.__len__()
    index2 = index - 1
    extension = name_split[index2]
    offset = 1
    media_name = uid + "-" + str(offset) + "." + extension

    while True:
        offset += 1
        if media_type == 'video':
            fname = appollo.video_path + media_name
        else:
            fname = appollo.photo_path + media_name

        if os.path.isfile(fname):
            media_name = uid + "-" + str(offset) + "." + extension
        else:
            break
    return media_name


