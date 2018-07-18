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
	$myArray = json_decode($response, false);
	print_r($myArray);
	print ($myArray['hits']['hits'][0]['firstname']);
	print("hello");
	print_r($response);
?>