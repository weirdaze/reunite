import db_manipulate
import db_matches

uid = db_manipulate.generate_uid('1233', 'ecastill')
#uid = '1233959D7NA60ecastill'
first_name = 'Josy'
middle_name = 'Eugenia'
last_name = 'Morales'
dob = '2008-10-01'
maternal_last_name = 'Almendro'
sex = 'F'
entry_point = 'Juarez'
country = 'Guatemala'
last_facility = '12243445'
current_facility = '12243445'
relatives = 'Julian,Ester'
date_detained = '2018-04-15'
status = 'unmatched'
claiming = 'Claudia'
typed = 'child'
video = 'SampleVideo_1280x720_5mb.mp4'
photo = 'Boy1.png'
facility_uid = '855252312308'
person = [uid, first_name, middle_name, last_name, dob, maternal_last_name, sex, entry_point, country, last_facility,
          current_facility, relatives, date_detained, status, claiming, typed, video, photo, facility_uid]
#db_manipulate.db_add_update_profile(person, True)

#print db_manipulate.db_get_person_info('1233959D7NA60ecastill')

#db_manipulate.db_remove_profile('1233959D7NA60ecastill')

#newid = "jesus"

#print db_matches.append_to_claiming(claiming, newid)


myString = 'Screen Shot 2018-06-20 at 1.21.11 PM.png'
my_split = myString.split(".")
print my_split
print my_split.__len__()
index = my_split.__len__() - 1
print index
print my_split[index]
