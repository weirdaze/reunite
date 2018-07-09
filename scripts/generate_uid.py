from db_manipulate import generate_uid
import sys

current_facility = sys.argv[1]
admin_username = sys.argv[2]

print generate_uid(current_facility, admin_username)
