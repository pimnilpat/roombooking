<?php
include_once("../connectdb.php");

if(isset($_POST['transactid']))
{
      $query = "select * from reserved_room where transaction_id='{$_POST['transactid']}'";
}
else
{
        
        $status=$_POST['status']; 
        $time1=  strtotime($_POST['date1']);
        $time2=  strtotime($_POST['date2']);
        $date1=date("Y-m-d H:i:s",$time1);
        $date2=date("Y-m-d H:i:s",$time2); 
        
    
        if($_POST['type']=='0' && $_POST['room']=='0'){ 
            switch($status)
            {
                case 'all': $query = "select * from reserved_room 
                                               where date(action_date) between '$date1' and '$date2'
                                               order by status,action_date desc";
                    break;
                case 'approved': $query = "select * from reserved_room 
                                               where date(action_date) between '$date1' and '$date2'
                                               and status='approved'
                                               order by status,action_date desc";
                    break;
                case 'waiting': $query = "select * from reserved_room 
                                               where date(action_date) between '$date1' and '$date2'
                                               and status='waiting'
                                               order by status,action_date desc";
                    break;
                default:break;
            }
            
        }
        else if($_POST['type']!='0' && $_POST['room']=='0')
        {
            switch($status)
            {
                case 'all': $query = "select * from reserved_room 
                                               where type='{$_POST['type']}' 
                                               and date(action_date) between '$date1' and '$date2'
                                               order by status,action_date desc";
                    break;
                case 'approved': $query = "select * from reserved_room 
                                               where type='{$_POST['type']}' 
                                               and date(action_date) between '$date1' and '$date2'
                                               and status='approved'
                                               order by status,action_date desc";
                    break;
                case 'waiting': $query = "select * from reserved_room 
                                               where type='{$_POST['type']}' 
                                               and date(action_date) between '$date1' and '$date2'
                                               and status='waiting'
                                               order by status,action_date desc";
                    break;
                default:break;
            }
            //$query = "select * from reserved_room where type='{$_POST['type']}' order by action_date desc";
        }
        else if($_POST['type']=='0' && $_POST['room']!='0')
        { 
            switch($status)
            {
                case 'all': $query = "select * from reserved_room 
                                               where name='{$_POST['room']}'
                                               and date(action_date) between '$date1' and '$date2'
                                               order by status,action_date desc";
                    break;
                case 'approved': $query = "select * from reserved_room 
                                               where name='{$_POST['room']}'
                                               and date(action_date) between '$date1' and '$date2'
                                               and status='approved'
                                               order by status,action_date desc";
                    break;
                case 'waiting': $query = "select * from reserved_room 
                                               where name='{$_POST['room']}'
                                               and date(action_date) between '$date1' and '$date2'
                                               and status='waiting'
                                               order by status,action_date desc";
                    break;
                default:break;
            }
           // $query = "select * from reserved_room where name='{$_POST['room']}' order by action_date desc";
        }
        else if($_POST['type']!='0' && $_POST['room']!='0')
        {
            switch($status)
            {
                case 'all': $query = "select * from reserved_room 
                                                 where type='{$_POST['type']}'
                                                 and name='{$_POST['room']}'
                                                 and and date(action_date) between '$date1' and '$date2'
                                                 order by status,action_date desc";
                    break;
                case 'approved': $query = "select * from reserved_room 
                                                 where type='{$_POST['type']}'
                                                 and name='{$_POST['room']}'
                                                 and date(action_date) between '$date1' and '$date2'
                                                 and status='approved'
                                                 order by status,action_date desc";
                    break;
                case 'waiting': $query = "select * from reserved_room 
                                                 where type='{$_POST['type']}'
                                                 and name='{$_POST['room']}'
                                                 and date(action_date) between '$date1' and '$date2'
                                                 and status='waiting'
                                                 order by status,action_date desc";
                    break;
                default:break;
            }
            //$query = "select * from reserved_room where type='{$_POST['type']}'
                                                // and name='{$_POST['room']}'
                                                // order by action_date desc";
        }
}
$result = mysql_query($query) or die(mysql_error());
$i=0;
$arrbooking = array();
while($row = mysql_fetch_array($result))
{
    $arrbooking[$i]['topic'] = $row['topic'];
    $arrbooking[$i]['caption'] = $row['caption'];
    $arrbooking[$i]['seat'] = $row['seat'];
    $arrbooking[$i]['price'] = $row['price'];
    $arrbooking[$i]['action_date'] = $row['action_date'];
    $arrbooking[$i]['transaction_id'] = $row['transaction_id'];
    $arrbooking[$i]['name'] = $row['name'];
    $arrbooking[$i]['type'] = $row['type'];
    $arrbooking[$i]['booking_date'] = $row['booking_date'];
    $arrbooking[$i]['booking_end_date'] = $row['booking_end_date'];
    $arrbooking[$i]['username'] = $row['username'];
    $arrbooking[$i]['usersurname'] = $row['usersurname'];
    $arrbooking[$i]['idcard'] = $row['id_card'];
    $arrbooking[$i]['tel'] = $row['tel'];
    $arrbooking[$i]['mobile'] = $row['mobile'];
    $arrbooking[$i]['email'] = $row['email'];
    $arrbooking[$i]['status'] = $row['status'];
    $i++;
}
if(empty($arrbooking))
{
    echo "Not found data";   
}

?>
<head>
    <script src="../js/jquery.js" type="text/javascritp" ></script>
    <script>
        function view_booking_detail(id)
        {
            $.get("view_booking_detail.php", {transaction:id}, function(data){
                $("#title_content").html(data);
            })
        }
    </script>
<style>
    .tboutput
    {
        width:100%;
    }
    .tboutput th:first-child{
        width:6%;
        text-align: right;
        padding-right: 20px;
    }
    .tboutput td:first-child{
        width:6%;
        text-align: right;
        padding-right: 20px;
    }
    
</style>
</head>
<form>
    ผลการค้นหา พบ <?php echo count($arrbooking); ?> จาก <?php echo mysql_num_rows(mysql_query("select transaction_id from reserved_room"));?>
    <table class="tboutput">
        <tr>
            <th>No.</th>
            <th>วันที่จอง</th> 
            <th>รหัสจอง</th>
            <th>ชื่อผู้จอง</th>            
            <th>หัวข้อการประชุม</th>            
            <th>จำนวนผู้เข้าร่วมประชุม</th>
            <th>วันที่เริ่มต้น</th>
            <th>วันที่สิ้นสุด</th>
            <th>ชื่อห้อง</th> 
            <th>สถานะ</th>
        </tr>
        <?php
        $no=1;
        for($j=0;$j<count($arrbooking);$j++)
        {
        ?>
        <tr>
            <td valign="top"><?php echo $no++; ?></td>
            <td valign="top"><?php echo date("d/m/Y H:i:s",strtotime($arrbooking[$j]['action_date']));?></td> 
            <td valign="top"><a href="javascript:view_booking_detail('<?php echo $arrbooking[$j]['transaction_id']; ?>')"><?php echo $arrbooking[$j]['transaction_id']; ?></a></td>
            <td valign="top"><?php echo $arrbooking[$j]['username']; ?>&nbsp;&nbsp;&nbsp;<?php echo $arrbooking[$j]['usersurname']; ?></td>
            <td valign="top"><?php echo $arrbooking[$j]['topic']; ?></td>
            <td valign="top"><?php echo $arrbooking[$j]['seat']; ?></td>
            <td valign="top"><?php echo date("d/m/Y",  strtotime($arrbooking[$j]['booking_date']));?></td>
            <td valign="top"><?php echo date("d/m/Y",  strtotime($arrbooking[$j]['booking_end_date'])); ?></td>
            <td valign="top"><?php echo $arrbooking[$j]['name']; ?></td>
            <td valign="top"><?php echo $arrbooking[$j]['status']; ?></td>            
        </tr>
        <?php
        }
        ?>
    </table>
</form>