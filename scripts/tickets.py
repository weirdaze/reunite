import mysql.connector
from mysql.connector import errorcode
import random
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

