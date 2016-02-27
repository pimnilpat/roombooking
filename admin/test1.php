<?php
//header ("content-type: text/xml");
include_once("../connectdb.php");
$query = "SELECT *
                  FROM list_room
                  WHERE TYPE = 'superior'
                  AND name NOT IN (
                               SELECT name
                               FROM reserved_room
                               WHERE date(booking_date) >= '2012-10-22'
                               OR date(booking_end_date) <='2012-10-24'
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
    $d = "10/24/2012";
    $time=strtotime($d);
    $date1=date("Y-m-d H:i:s",$time); 
    echo "time = ".$date1;
?>
