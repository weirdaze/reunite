import sys
import facilities

facility = sys.argv[1]
print facility
facilities.create_facility(facility)
print "done"
