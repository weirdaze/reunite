<?php
	$search_string = $_POST['search_string'];
	require 'vendor/autoload.php';

	use Elasticsearch\ClientBuilder;

	$client = ClientBuilder::create()->build();
	$params = [
    'index' => 'person',
    'type' => 'person',
    'body' => [
        'query' => [
            'match' => [
                'firstname' => "'". $search_string . "'"
            	]
        	]
    	]
	];


	$response = $client->search($params);
	print_r($response);
?>