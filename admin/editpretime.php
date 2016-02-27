<?php
include_once("../connectdb.php");

$result=mysql_query("select * from reserve_time");
$pretime=array();
while($row=  mysql_fetch_array($result))
{
   $pretime['period_day'] = $row['period_day'];
   $pretime['expire_time_approve']=$row['expire_time_approve'];
}
?>
<html>
    <head>
        <style type="text/css">
            .tbpretime{
                width: 70%;
            }
        </style>
    </head>
<form name="frm_pretime" method="post" action="save_pretime_edit.php" target="iframe_pretime">
    <table class="tbpretime">
        <tr>
        <td style="width: 25%">วันจองล่วงหน้า</td>
        <td style="width: 75%">
            <select name="select_period_day" style="width:100px;">
                <?php
                for($i=1;$i<=60;$i++)
                {
                    if($pretime['period_day']==$i)
                    {
                        ?>
                          <option value="<?php echo $i; ?>" selected="selected"><?php echo $i;?></option> 
                        <?php 
                    }
                    else
                    {
                ?>
                      <option value="<?php echo $i; ?>"><?php echo $i;?></option> 
                <?php
                    }
                }
                ?>
            </select> &nbsp;&nbsp;วัน
        </td>
        </tr>
        <tr>
        <td style="width: 25%">กำหนดเวลาชำระเงิน</td>
        <td style="width: 75%">
            <select name="select_expire_time" style="width:100px;">
                <?php
                for($j=12;$j<=24;$j+=12)
                {
                    if($pretime['expire_time_approve']==$j)
                    {
                     ?>
                       <option value="<?php echo $j;?>" selected="selected"><?php echo $j; ?></option> 
                     <?php
                    }
                    else
                    {
                    ?>
                          <option value="<?php echo $j;?>"><?php echo $j; ?></option> 
                    <?php
                    }
                }
                ?>
            </select> &nbsp;&nbsp;ชั่วโมง
        </td>
        </tr>
        <tr>
            <td style="widht:25%;"></td>
            <td style="width:75%">
                <button type="submit" name="submit_pretime"><img src="img/button_ok.png" />บันทึก</button>
            </td>
        </tr>
    </table>
</form>
<iframe name="iframe_pretime" style="width: 0px; height: 0px; border: none;"></iframe>

</html>