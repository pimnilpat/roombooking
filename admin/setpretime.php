<?php
include_once("../connectdb.php");

$result = mysql_query("select * from reserve_time");

$time=array();
while($row=  mysql_fetch_array($result))
{
    $time['period_day']=$row['period_day'];
    $time['expire_time_approve']=$row['expire_time_approve'];
}
//print_r($time);
?>
<html>
    <head>
        <script src="../js/jquery.js" type="text/javascritp" ></script>
        <script type="text/javascript">
            function editpretime()
            { 
                jQuery.get("editpretime.php",{value:''},function(data){
                    jQuery("#title_content").html(data);
                });
            }
        </script>
        <style type="text/css">
            .tbtime{
                width:70%;
            }
            .tbtime th,td{
                text-align: center;
            }
        </style>
    </head>
</html>
<table class="tbtime">
    <tr>
        <th>วันจองล่วงหน้า (วัน)</th>
         <th>กำหนดเวลาชำระเงิน (ชม.)</th>
          <th>กำหนดค่าใหม่</th>
    </tr>
    <tr>
        <td style="width:40%"><?php echo $time['period_day'];?></td>
        <td style="width:40%"><?php echo $time['expire_time_approve']; ?></td>
        <td style="width:20%"><a href="javascript:editpretime()">แก้ไข</a></td>
    </tr>
</table>