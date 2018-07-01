import db_manipulate
import db_matches

#uid = db_manipulate.generate_uid('1233', 'ecastill')
uid = '1233959D7NA60ecastill'
first_name = 'Juan'
middle_name = 'Hector'
last_name = 'Doe'
dob = '1983-05-05'
maternal_last_name = 'Juarez'
sex = 'm'
entry_point = 'tijuana'
country = 'honduras'
last_facility = '1233'
current_facility = '1233'
relatives = 'blank'
date_detained = '2018-05-05'
status = 'matched'
claiming = 'jesus,mary,joseph'
typed = 'blank'
video = '../media/video/SampleVideo_1280x720_5mb.mp4'
photo = '../media/photo/Boy1.png'
facility_uid = '8675308'
person = [uid, first_name, middle_name, last_name, dob, maternal_last_name, sex, entry_point, country, last_facility,
          current_facility, relatives, date_detained, status, claiming, typed, video, photo, facility_uid]
#db_manipulate.db_add_update_profile(person, False)

#print db_manipulate.db_get_person_info('1233959D7NA60ecastill')

#db_manipulate.db_remove_profile('1233959D7NA60ecastill')

newid = "jesus"

#print db_matches.append_to_claiming(claiming, newid)
