from urllib2 import *

connection = urlopen('http://localhost:8983/solr/mycol1/select?q=LastName:Doe&wt=json')
response = eval(connection.read())
print response['response']['numFound'], "documents found."
for document in response['response']['docs']:
  print " Last Name =", document['LastName']

