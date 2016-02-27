<?php
//print_r($_POST);
include_once("../connectdb.php");
$query = "update reserve_time set period_day = '{$_POST['select_period_day']}',
                              expire_time_approve = '{$_POST['select_expire_time']}'
                          ";
$result = mysql_query($query) or die(mysql_error());
if($result)
{
    echo "<script>";
    echo "alert('save completed');";
    echo "</script>";
}
?>
