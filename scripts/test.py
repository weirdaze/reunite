import db_manipulate
import db_matches

uid = db_manipulate.generate_uid('1233', 'ecastill')
#uid = '1233959D7NA60ecastill'
first_name = 'Daniel'
middle_name = 'Aaron'
last_name = 'Mendoza'
dob = '2013-06-14'
maternal_last_name = 'Suarez'
sex = 'M'
entry_point = 'Nogales'
country = 'Honduras'
last_facility = '122345'
current_facility = '12345'
relatives = 'mama,papa'
date_detained = '2018-03-01'
status = 'unmatched'
claiming = 'Mary'
typed = ''
video = 'SampleVideo_1280x720_5mb.mp4'
photo = 'Boy1.png'
facility_uid = '867512312308'
person = [uid, first_name, middle_name, last_name, dob, maternal_last_name, sex, entry_point, country, last_facility,
          current_facility, relatives, date_detained, status, claiming, typed, video, photo, facility_uid]
db_manipulate.db_add_update_profile(person, True)

#print db_manipulate.db_get_person_info('1233959D7NA60ecastill')

#db_manipulate.db_remove_profile('1233959D7NA60ecastill')

#newid = "jesus"

#print db_matches.append_to_claiming(claiming, newid)
