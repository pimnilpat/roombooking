<?php
include_once '../connectdb.php';
$result = mysql_query("delete from user where username='{$_GET['value']}'");
if($result)
{
    echo "delete complete";
}
?>
