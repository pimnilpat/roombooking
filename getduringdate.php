<?php
include_once("connectdb.php");
$sql = mysql_query("select period_day from reserve_time");
while($row = mysql_fetch_array($sql))
{
    $period = $row['period_day'];
}
echo $period;
?>
