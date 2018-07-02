<?php

$options = array
(
    'hostname' => 'localhost',
    'login'    => 'root',
    'password' => 'R3unite123',
    'port'     => '8983',
);

$client = new SolrClient($options);

$query = new SolrQuery();

$query->setQuery('myCol1');

$query->setStart(0);

$query->setRows(50);

$query->addField('FirstName')->addField('LastName')->addField('UID')->addField('Country');

$query_response = $client->query($query);

$response = $query_response->getResponse();

print_r($response);

?>