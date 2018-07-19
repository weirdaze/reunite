<?php
	$search_string = $_POST['search_string'];
	require 'vendor/autoload.php';

	use Elasticsearch\ClientBuilder;

	$client = ClientBuilder::create()->build();
	$params = array();
	$params['index'] = 'person';
	$params['type'] = 'person';
	//$params['body']['query']['match']['firstname'] = $search_string;
	//$params['body']['query']['bool']['should'][]['match']['firstname'] = $search_string;
	//$params['body']['query']['bool']['filter']['and'][]['term']['firstname'] = $search_string;
	//$params['body']['query']['bool']['filter']['and'][]['term']['type'] = 'adult';
	$params['body']['query']['bool']['filter'][]['term']['firstname'] = $search_string;

	$response = $client->search($params);
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