<?php
	require 'vendor/autoload.php';

	use Elasticsearch\ClientBuilder;

	$client = ClientBuilder::create()->build();
	$params = [
    'index' => 'person',
    'type' => 'person',
    'body' => [
        'query' => [
            'match' => [
                'firstname' => 'jose'
            	]
        	]
    	]
	];


	$response = $client->search($params);
	print_r($response);
?>