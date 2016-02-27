<?php
include_once("../connectdb.php");

if(isset($_POST['transactid']))
{
      $query = "select * from payinslip where transactionid='{$_POST['transactid']}'";
}
else
{
        
         
        $time1=  strtotime($_POST['date1']);
        $time2=  strtotime($_POST['date2']);
        $date1=date("Y-m-d H:i:s",$time1);
        $date2=date("Y-m-d H:i:s",$time2); 
        
    
        $query = "select * from payinslip where date(paydate) between '$date1' and '$date2'";
        
       
       
}
$result = mysql_query($query) or die(mysql_error());
$i=0;
$arrbooking = array();
while($row = mysql_fetch_array($result))
{
    $arrbooking[$i]['transactionid'] = $row['transactionid'];
    $arrbooking[$i]['paydate'] = $row['paydate'];
    $arrbooking[$i]['payinslip'] = $row['payinslip'];
    
    $i++;
}
if(empty($arrbooking))
{
    echo "Not found data";   
}

?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script src="../js/jquery.js" type="text/javascritp" ></script>
    <script>
        function view_booking_detail(id)
        {
            $.get("view_paid_detail.php", {transaction:id}, function(data){
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
    ผลการค้นหา พบ <?php echo count($arrbooking); ?> จาก <?php echo mysql_num_rows(mysql_query("select transactionid from payinslip"));?>
    <table class="tboutput">
        <tr>
            <th>No.</th>
            <th>วันที่ชำระเงิน</th> 
            <th>รหัสจอง</th>
            <th>สลิปการโอนเงิน</th>           
            
        </tr>
        <?php
        $no=1;
        for($j=0;$j<count($arrbooking);$j++)
        {
        ?>
        <tr>
            <td valign="top"><?php echo $no++; ?></td>
            <td valign="top"><?php echo date("d/m/Y H:i:s",strtotime($arrbooking[$j]['paydate']));?></td>             
            <td valign="top"><a href="javascript:view_booking_detail('<?php echo $arrbooking[$j]['transactionid']; ?>')"><?php echo $arrbooking[$j]['transactionid']; ?></a></td>
            <td valign="top">
                <img src="../<?php echo $arrbooking[$j]['payinslip'];?>" width="29" height="23"/>
            </td>
        </tr>
        <?php
        }
        ?>
    </table>
</form>