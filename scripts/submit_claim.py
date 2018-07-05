import sys
import db_matches
from tickets import db_get_ticket

query_string = sys.argv[1]
split_string = query_string.split(',')
uid_a = split_string[0]
uid_b = split_string[1]

match_id = db_matches.submit_claim(uid_a, uid_b)

print "success," + db_get_ticket(match_id)

