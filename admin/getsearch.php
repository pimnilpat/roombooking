<?php
//print_r($_POST); exit();
header ("content-type: text/xml");
include_once("../connectdb.php");

$time1=strtotime($_POST['date1']);
$date1=date("Y-m-d H:i:s",$time1); 

$time2=strtotime($_POST['date2']);
$date2=date("Y-m-d H:i:s",$time2);

echo"<root>";
if(!isset($_POST['type']))
{
    $query = "select * from roomtype where seat>='{$_POST['attendee']}' order by name";
    $result = mysql_query($query);
    echo"<type>";
    while($row=  mysql_fetch_array($result))
    {
        echo"<name>";
        echo $row['name'];
        echo"</name>";
    }
    echo "</type>";
}
if(isset($_POST['type']))
{
    $query = "SELECT *
                  FROM list_room
                  WHERE TYPE = '{$_POST['type']}'
                  AND name NOT IN (
                               SELECT name
                               FROM reserved_room
                               WHERE (date(booking_date) between '$date1' and '$date2'
                               OR date(booking_end_date) between '$date1' and '$date2')
                               AND  status != 'cancel'
               )";
    $result = mysql_query($query) or die(mysql_error());
    echo "<room>";
    while($room = mysql_fetch_array($result))
    {
        echo"<name>";
        echo $room['name'];
        echo"</name>";
    }
    echo "</room>";
    
}

echo"</root>"
?>
