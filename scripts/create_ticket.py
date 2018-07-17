from tickets import create_ticket
import sys

match_id = sys.argv[1]
user_id = sys.argv[2]

create_ticket(match_id, "new", "testing", )
