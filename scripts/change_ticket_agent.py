import tickets
import sys

ticket_number = sys.argv[1]
userid = sys.argv[2]
#update = sys.argv[3]

# tickets.insert_history_event(ticket_number + "," + update + "," + userid)

# tickets.change_status(ticket_number, update, userid)

tickets.assign_ticket(ticket_number, userid, userid)