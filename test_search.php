<?php
	$search_string = $_POST['search_string'];
	require 'vendor/autoload.php';

	use Elasticsearch\ClientBuilder;

	$client = ClientBuilder::create()->build();
	$response = $client->search([
		'body' => [
		    'query' => [
		        'bool' => [
			    'should' => [
			        'match' => ['firstname' => $search_string],
					'match' => ['lastname' => $search_string]
		        ]
		    ]
                ]
	    ]
	]);


	//$response = $client->search($quy);
	$hits = count($response['hits']['hits']);
	$result = null;
	$i = 0;
	 
	while ($i < $hits) {
		$result[$i] = $response['hits']['hits'][$i]['_source'];
		$i++;
	}
	foreach ($result as $key => $value) {
		echo $value['firstname'] . "<br>";
	}

	/*$myData = json_decode($response);
	foreach ($myData->hits->hits as $result) {
		echo $result->_source->firstname;
	}*/
	// print_r($response);
?>