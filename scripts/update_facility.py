import sys
from facilities import update_facility

facility_name = sys.argv[1]
address = sys.argv[2]
city = sys.argv[3]
state = sys.argv[4]
zip = sys.argv[5]
poc = sys.argv[6]
facility_number = sys.argv[7]
user_id = sys.argv[8]

update_facility(facility_name, address, city, state, zip, poc, facility_number, user_id)
print "done"