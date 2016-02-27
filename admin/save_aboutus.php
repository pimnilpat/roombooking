<?php
include_once '../connectdb.php';

$des = trim($_POST['text_aboutus']);

$query = "update aboutus set description='$des'
                       where no='1'
                       
                ";
$result = mysql_query($query);
if($result)
{
        echo "<script>";
        echo "alert('updated complete');";
        echo "</script>";
}
?>
