from db_manipulate import rename_media
import sys

filename = sys.argv[1]
uid = sys.argv[2]
media_type = sys.argv[3]

print rename_media(filename, uid, media_type)
