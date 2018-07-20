<?php
	include ("header.php");
	$search_string = "";
	$search_term = "";
	$gender = "*";
	require 'vendor/autoload.php';

	use Elasticsearch\ClientBuilder;

	$page = 0;
	if(isset($_GET['page'])){
		$page = $_GET['page'];
	}
	$limit = 12;
	$start = $page*$limit;

	if(isset($_GET['gender'])){
		$gender = $_GET['gender'];
	}
	if(isset($_GET['search_term'])){
		$search_term = TRIM($_GET['search_term']);
	}

	$client = ClientBuilder::create()->build();
	
	$params = array();
	$params['index'] = 'person';
	$params['type'] = 'person';
	$params['from'] = $start;
	$params['size'] = $limit;
	//$params['sort']['firstname']['order'] = 'asc';
	$params['body']['query']['query_string']['default_field'] = "*";
	$params['body']['query']['query_string']['query'] = "(".$search_term.") AND (adult) AND (sex:".$gender.")";
	//$params['body']['sort'] = [['firstname' => ['order' => 'asc']],];

	$response = $client->search($params);
	$hits = count($response['hits']['hits']);
	$result = null;
	$i = 0;
	
	$count_params = array();
	$count_params['index'] = 'person';
	$count_params['type'] = 'person';
	$count_params['body']['query']['query_string']['default_field'] = "*";
	$count_params['body']['query']['query_string']['query'] = "(".$search_term.") AND (adult) AND (sex:".$gender.")";
	$counter = $client->count($count_params);

	$total_count = $counter['count'];
	$pages = ceil($final_count/$limit);
	echo "this is the number of total hits: ".$total_count."<br>";
	echo "this is how many pages we would get: ".$pages."<br>";

	
	while ($i < $hits) {
		$result[$i] = $response['hits']['hits'][$i]['_source'];
		$i++;
	}

?>
<div class="container">

	<h2 class="text-center my-3"><a id="goBack" href="who_are_you.php" data-toggle="tooltip" data-title="Return to Form"><i class="fa fa-arrow-circle-left"></i></a> Encuéntrate en las imágenes</h2>
	<div id="results" class="d-flex align-items-center justify-content-center flex-wrap">
	<?php
		foreach ($result as $key => $value) {
			$firstname = $value['firstname'];
			$lastname = $value['lastname'];
			$sex = $value['sex'];
			$uid = $value['uid'];
			$photo = $value['photo'];
		
	?>
			<div class="child d-flex align-items-center flex-column justify-content-center" data-uid="<?php echo $uid; ?>" data-gender="<?php echo $sex; ?>" data-fullname="<?php echo $firstname . ' ' . $lastname; ?>">
				<div class="personImg" style="background-image: url('media/photo/<?php echo $photo; ?>');"></div>
				<div class="caption"><?php echo $lastname . ", " . $firstname; ?></div>
			</div>	
	<?php
		}
	?>
		<button id="loadMore1" class="btn btn-primary" data-page="<?php echo $page + 1; ?>">Load More Results</button>
	</div>
</div>
<script>
	$("#goBack").tooltip();
</script>
<?php include("footer.php"); ?>
