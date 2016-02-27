<?php

include_once("connectdb.php");

$query = "select * from site_infomation";
$result = mysql_query($query);
while($row = mysql_fetch_array($result))
{
    //$site_info['name']=$row['site_name'];
    //$site_info['company']=$row['site_company'];
    $site_info['picture']=$row['site_image'];
}
echo $site_info['picture'];
mysql_close();
?>
