import db_manipulate

uid = db_manipulate.generate_uid('1233', 'ecastill')
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
relatives = ''
date_detained = '2018-05-05'
status = 'matched'
claiming = ''
typed = ''
video = '../media/video/SampleVideo_1280x720_5mb.mp4'
photo = '../media/photo/Boy1.png'
facility_uid = '8675308'
person = [uid, first_name, middle_name, last_name, dob, maternal_last_name, sex, entry_point, country, last_facility,
          current_facility, relatives, date_detained, status, claiming, typed, video, photo, facility_uid]
db_manipulate.db_add_update_profile(person, True)