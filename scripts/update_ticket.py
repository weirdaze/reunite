from tickets import insert_history_event
import sys

ticket_number = sys.argv[1]
userid = sys.argv[2]
update = sys.argv[3]

insert_history_event(ticket_number + "," + update + "," + userid)
