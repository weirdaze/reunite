<?php
$execStr = 'python /var/www/html/scripts/search.py';
echo $execStr;
$result = exec($execStr);
echo "
";
echo $result;
?>