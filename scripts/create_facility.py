import sys
import facilities

facility_name = sys.argv[1]
address = sys.argv[2]
city = sys.argv[3]
state = sys.argv[4]
zip = sys.argv[5]
poc = sys.argv[6]
user_id = sys.argv[7]

facilities.create_facility(facility_name, address, city, state, zip, poc, user_id)

