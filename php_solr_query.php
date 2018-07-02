<?php
$response = http_get("http://localhost:8983/solr/mycol1/select?q=LastName:Doe&wt=json", array("timeout"=>1), $info);
print_r($info);
?>