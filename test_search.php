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
                'country' => "'". $search_string . "'"
            	]
        	]
    	]
	];


	$response = $client->search($params);
	$myData = json_decode($response);
	foreach ($myData->hits->hits as $result) {
		echo $result->_source->firstname;
	}
	print_r($response);
?>