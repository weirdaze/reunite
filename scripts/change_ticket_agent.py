from tickets import assign_ticket
import sys

ticket_number = sys.argv[1]
userid = sys.argv[2]

assign_ticket(ticket_number, userid, userid)
