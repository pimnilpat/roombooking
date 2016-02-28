<?php
$server = 'localhost';
$user = 'adminPFfmv8s';
$password='4L6CCL1EKnfj';
$dbname='roombooking';
$link=mysql_connect($server, $user, $password) or die(mysql_error());
mysql_select_db($dbname) or die(mysql_error());
mysql_query("SET character_set_results=utf8");
mysql_query("SET character_set_client=utf8");
mysql_query("SET character_set_connection=utf8");
?>
