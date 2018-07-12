from tickets import change_status
import sys

ticket_number = sys.argv[1]
userid = sys.argv[2]
update = sys.argv[3]

change_status(ticket_number, update, userid)
