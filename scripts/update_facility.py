import sys
from facilities import update_facility

facility = sys.argv[1]
print facility
update_facility(facility)
print "done"