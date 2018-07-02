<?php
$execStr = 'python /var/www/html/reunite/scripts/search.py';
echo $execStr;
$result = exec($execStr);
echo "
";
echo $result;
?>
