<?php
	$search_string = $_POST['search_string'];
	require 'vendor/autoload.php';

	use Elasticsearch\ClientBuilder;

	$client = ClientBuilder::create()->build();
	$params = array();
	$params['index'] = 'person';
	$params['type'] = 'person';
	$params['from'] = 1;
	$params['size'] = 12;
	$params['body']['sort']['firstname']['order'] = "asc";
	$params['body']['query']['query_string']['default_field'] = "*";
	$params['body']['query']['query_string']['query'] = "(".$search_string.") AND (adult)";

	$response = $client->search($params);
	$hits = count($response['hits']['hits']);
	$result = null;
	$i = 0;
	 
	while ($i < $hits) {
		$result[$i] = $response['hits']['hits'][$i]['_source'];
		$i++;
	}
	foreach ($result as $key => $value) {
		echo $value['firstname'] . " " . $value['lastname'] . " " . $value['type'] . "<br>";
	}
?>