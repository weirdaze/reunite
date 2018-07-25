import sys
from db_matches import update_status

uid_a = sys.argv[1]
uid_b = sys.argv[2]
status = sys.argv[2]

update_status(uid_a, uid_b, status)

