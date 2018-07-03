from urllib2 import *

connection = urlopen('http://localhost:8983/solr/mycol1/select?q=LastName:Doe&wt=json')
response = eval(connection.read())
print response['response']['numFound'], "documents found."
for document in response['response']['docs']:
<<<<<<< HEAD
  print " Last Name =", document['LastName']
  print " First Name =", document['FirstName']
=======
    print " Last Name =", document['LastName']
>>>>>>> c88e102473e72ced9dea31573bd45faa948aa8da

