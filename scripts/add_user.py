import sys
from db_manipulate import db_add_update_profile, generate_uid

query_string = sys.argv[1]
split_string = query_string.split(',')

'''
this  is the string we're parsing
first_name,middle_name,last_name,dob,maternal_last_name,sex,entry_point,country,last_facility,current_facility,
relatives,date_detained,status,claiming,type,video,photo,facility_uid,admin_username

'''

first_name = split_string[0]
middle_name = split_string[1]
last_name = split_string[2]
dob = split_string[3]
maternal_last_name = split_string[4]
sex = split_string[5]
entry_point = split_string[6]
country = split_string[7]
last_facility = split_string[8]
current_facility = split_string[9]
relatives = split_string[10]
date_detained = split_string[11]
status = split_string[12]
claiming = split_string[13]
typed = split_string[14]
video = split_string[15]
photo = split_string[16]
facility_uid = split_string[17]
admin_username = split_string[18]
uid = split_string[19]

person = [uid, first_name, middle_name, last_name, dob, maternal_last_name, sex, entry_point, country, last_facility,
          current_facility, relatives, date_detained, status, claiming, typed, video, photo, facility_uid]

db_add_update_profile(person, True)

print "success," + uid
