<?php
include_once '../connectdb.php';
$result = mysql_query("delete from roomtype where name='{$_GET['value']}'");
$updated = mysql_query("update list_room set type='' where type='{$_GET['value']}'");
if($result && $updated)
{
    echo "Update completed";
}
?>
