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
+------------------+--------------+------+-----+---------+-------+----------------------------------------------------+
16 rows in set (0.00 sec)


'''