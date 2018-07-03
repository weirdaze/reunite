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


def create_facility(facility):
    # this function takes in the facility string and breaks it up and inputs it into the db
    # the string should be formatted in this manner: 'FacilityName,address,city,state,zip,poc'
    facility_number = id_generator(size=8)
    features = facility.split(',')

    facility_name = features[0]
    address = features[1]
    city = features[2]
    state = features[3]
    zip = features[4]
    status = 'active'
    poc = features[5]

    try:
        cnx = mysql.connector.connect(user=appollo.dbusername, password=appollo.dbpassword,
                                      host=appollo.dbhostname, database=appollo.dbname)
        cursor = cnx.cursor()
        query = ("INSERT INTO facilities (FacilityNumber, FacilityName, Address, city, state, zip, Status, POC) "
                 "VALUES('" + facility_number + "', '" + facility_name + "', '" + address + "', '" + city +
                 "', '" + state + "', '" + zip + "', '" + status + "', '" + poc +
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
