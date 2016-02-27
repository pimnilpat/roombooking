<?php
include_once("../connectdb.php");
                  
                  
$query = "select * from reserved_room where transaction_id='{$_GET['transaction']}'";
$result = mysql_query($query);
$arrbooking = array();
while($row = mysql_fetch_array($result))
{
    $arrbooking['topic'] = $row['topic'];
    $arrbooking['caption'] = $row['caption'];
    $arrbooking['seat'] = $row['seat'];
    $arrbooking['price'] = $row['price'];
    $arrbooking['action_date'] = $row['action_date'];
    $arrbooking['transaction_id'] = $row['transaction_id'];
    $arrbooking['name'] = $row['name'];
    $arrbooking['type'] = $row['type'];
    $arrbooking['booking_date'] = $row['booking_date'];
    $arrbooking['booking_end_date'] = $row['booking_end_date'];
    $arrbooking['username'] = $row['username'];
    $arrbooking['usersurname'] = $row['usersurname'];
    $arrbooking['idcard'] = $row['id_card'];
    $arrbooking['tel'] = $row['tel'];
    $arrbooking['mobile'] = $row['mobile'];
    $arrbooking['email'] = $row['email'];
    $arrbooking['status'] = $row['status'];
    $arrbooking['start_time'] = $row['begin_time'];
    $arrbooking['end_time'] = $row['end_time'];
}
$sql_typeroom = mysql_query("select * from roomtype where name='{$arrbooking['type']}'");
$roomtype=array();
while($rtype=  mysql_fetch_array($sql_typeroom))
{
    $roomtype['name']=$rtype['name'];
    $roomtype['price']=$rtype['price'];
    $roomtype['coffeebreak']=$rtype['coffeebreak'];
    $roomtype['accessories']=$rtype['accessories'];
    $roomtype['seat']=$rtype['seat'];
    $roomtype['description']=$rtype['description'];
}

// calculate amount of date booking room
$cal_date = "SELECT booking_date,booking_end_date, DAY(booking_end_date) - DAY(booking_date) AS count_date from reserved_room where transaction_id='{$_GET['transaction']}'";
$result_cal_date = mysql_query($cal_date);
while($cal = mysql_fetch_array($result_cal_date))
{
    $amount_date = $cal['count_date'];
}
$amount_date +=1;

$net_price = $amount_date * $roomtype['price'];

$query_time = mysql_query("select expire_time_approve from reserve_time");
while($t = mysql_fetch_array($query_time))
{
                      $approvetime=$t['expire_time_approve'];
}
$time_finish = strtotime("+$approvetime hours {$arrbooking['action_date']}");
 $currtime=date("Y-m-d H:i:s");     
    $netcurrtime = strtotime($currtime."-2 hours");
   // echo $currtime;
   // echo date("d-m-Y H:i:s",$netcurrtime);
    $difftime=abs($time_finish-$netcurrtime)/3600; 
    //echo $approvetime."<br>";
   // echo $difftime."<br>";
    if($arrbooking['status']=='waiting')
    {
        if($difftime>$approvetime)
        {
                
                $updatestatus = mysql_query("update reserved_room set status='cancel' where transaction_id='{$_GET['transaction']}'");
                echo "รายการจองนี้หมดเวลาชำระเงินแล้ว<br>";
                //echo "รหัสจอง {$arrbooking['transaction_id']}<br>";
                //echo "วันที่ทำรายการ {$arrbooking['action_date']}<br>";
                
        } 
    }
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <style>
            .tbreserve
            {
                width:100%
            }
            .tbreserve td:first-child
            {
                width: 20%;
                text-align: right;
                padding-right: 20px;
            }
            .tbreserve td:last-child
            {
                width: 75%;
            }
            .mark{
                
            }
            .block_title
            {                
                font-weight: bold;               
            }
            .tbreserve input[type=text]
            {
                
            }
            .tbreserve textarea
            {
                
            }
        </style>        
            <script src="../js/jquery.js" type="text/javascritp" ></script>
        <script>
             $(document).ready(function(){                 
                 $('input[type="text"], textarea').attr('readonly','readonly');
             }); 
             function confirmpayin(id)
             {
                 //alert(id);
                 jQuery.get("confirmpayin.php",{value:id},function(data){
                       
                       if(data=='1')  
                       {
                           $("#paystatus").html("ชำระเงินแล้ว");
                            $("#paystatus").css("color","blue");

                            $("#btn_comfirm_payin").attr("disabled",true);  
                            $(".newstatus").remove();
                       }
                 });
                 
             }
        </script>
    </head>
    
<form  name="frm_savereserved" method="post" action="save_reserved.php"  target="iframe_savereserved">
    <table class="tbreserve">
        <tr>
            <th colspan="2">รายละเอียดของรายการจองที่ <?php echo $arrbooking['transaction_id'];?></th>
        </tr>
        <tr>
            <td>วันที่ทำรายการ</td>
            <td><input type="text" name="transactime" id="transactime" value="<?php echo date("d-m-Y H:i:s",strtotime($arrbooking['action_date']));?>"/></td>
        </tr>
        <tr>
            <td>รหัสการจอง</td>
            <td><input type="text" name="transacid" id="transacid" value="<?php echo $arrbooking['transaction_id'];?>"/></td>
        </tr>
        <tr>
            <td>หัวข้อการประชุม</td>
            <td><input type="text" maxlength="100" name="meeting_title" id="meeting_title" size="60" value="<?php echo $arrbooking['topic'];?>"/><span class="mark">*</span></td>
        </tr>
        <tr>
        <td valign="top">คำบรรยายพอสังเขป</td>
        <td valign="top"><textarea name="meeting_descrip" id="meeting_descrip" cols="50" rows="3" ><?php echo $arrbooking['caption']; ?></textarea></td>
        </tr> 
        <tr>
            <td>จำนวนผู้เข้าประชุม</td>
            <td>
                <input type="text" size="10" maxlength="4" name="attendee" id="attendee" value="<?php echo $arrbooking['seat'];?>"/>
            </td>
        </tr>
        <tr>
            <td>วันที่เริ่มต้น</td>
            <td>
                <input type="text" size="20"  name="begindate" id="begindate" value="<?php echo date("d-m-Y",strtotime($arrbooking['booking_date']));?>"/>
            </td>
        </tr>
        <tr>
            <td>วันที่สิ้นสุด</td>
            <td>
                <input type="text" size="20"  name="enddate" id="enddate" value="<?php echo date("d-m-Y",strtotime($arrbooking['booking_end_date']));?>"/>
            </td>
        </tr>
        <tr>
            <td>ช่วงเวลา
                 </td>
            <td>จาก&nbsp;
                <input type="text" id="starttime" name="starttime" size="7" readonly="readonly" value="<?php echo $arrbooking['start_time'] ?>" />
            น.&nbsp;&nbsp;&nbsp;&nbsp;ถึง
                <input type="text" id="endtime" name="endtime" size="7" readonly="readonly" value="<?php echo $arrbooking['end_time'] ?>" />
                น.
            </td>
        </tr>
        <tr><td>&nbsp;</td><td></td></tr>
        <tr><td class="block_title">ข้อมูลลูกค้า</td><td></td></tr>
        <tr>
            <td>ชื่อ</td>
            <td><input type="text" maxlength="50" name="cus_firstname" id="cus_firstname" size="40" value="<?php echo $arrbooking['username']; ?>"/><span class="mark">*</span></td>               
        </tr>
        <tr>
            <td>นามสกุล</td>
            <td><input type="text" maxlength="50" name="cus_lastname" id="cus_lastname" size="40" value="<?php echo $arrbooking['usersurname']; ?>"/><span class="mark">*</span></td>               
        </tr>
        <tr>
            <td>รหัสบัตรประชาชน</td>
            <td><input type="text" maxlength="13" name="cus_idcard" id="cus_idcard" size="40" value="<?php echo $arrbooking['idcard']; ?>"/><span class="mark">*</span></td>               
        </tr>
        <tr>
            <td>โทรศัพท์</td>
            <td><input type="text" maxlength="20" name="cus_phone" id="cus_phone" size="40" value="<?php echo $arrbooking['tel']; ?>"/></td>               
        </tr>
        <tr>
            <td>มือถือ</td>
            <td><input type="text" maxlength="10" name="cus_mobile" id="cus_mobile" size="40" value="<?php echo $arrbooking['mobile']; ?>"/><span class="mark">*</span></td>               
        </tr>
        <tr>
            <td>อีเมล์</td>
            <td><input type="text" maxlength=50" name="cus_email" id="cus_email" size="40" value="<?php echo $arrbooking['email']; ?>"/><span class="mark">*</span></td>               
        </tr>
        <tr><td>&nbsp;</td>
            <td><input type="hidden" id="attendee" name="attendee" value="<?php echo $arrbooking['seat'];?>"/></td>
        </tr>
        
        <tr><td class="block_title">ข้อมูลห้องประชุม</td><td></td></tr>
        <tr>
            <td>ชื่อห้องประชุม</td>
            <td>
                <input type="text" name="roomname" id="roomnamae" size="40" value="<?php echo $arrbooking['name'];?>"/>
            </td>
        </tr>
        <tr>
            <td>ประเภทห้องประชุม</td>
            <td>
                <input type="text" name="roomtype" id="roomtype" size="40" value="<?php echo $arrbooking['type'];?>"/>
            </td>
        </tr>
        <tr>
            <td>ราคาต่อรอบ</td>
            <td>
                <input type="text" name="typeprice" id="typeprice" size="15" value="<?php echo $roomtype['price']; ?>"/> บาท
            </td>
        </tr>
        <tr>
            <td>จำนวนที่นั่ง</td>
            <td>
                <input type="text" name="maxseat" id="maxseat" size="15" value="<?php echo $roomtype['seat']; ?>"/> ที่
            </td>
        </tr>
        <tr>
            <td valign="top">คำอธิบาย</td>
            <td valign="top">
                <textarea cols="40" rows="5" name="typedescript" id="typedescript"><?php echo $roomtype['description']; ?>                      
                </textarea>
            </td>
        </tr>
        <tr>
            <td valign="top">คอฟฟี่เบรค</td>
            <td valign="top">
                 <textarea cols="40" rows="5" name="typecoffeebreak" id="typecoffeebreak"><?php echo $roomtype['coffeebreak']; ?>           
                </textarea>
            </td>
        </tr>
        <tr>
            <td valign="top">อุปกรณ์ประกอบ</td>
            <td valign="top"> 
                 <textarea cols="40" rows="5" name="typdeaccessories" id="typdeaccessories"><?php echo $roomtype['accessories']; ?>                      
                </textarea>
            </td>
        </tr>
        <tr><td class="block_title">&nbsp;</td><td></td></tr>
        <tr><td class="block_title">คำนวณราคา</td><td></td></tr>
        <tr>
            <td>จำนวนวันที่จอง</td>
            <td>
                <input type="text" name="dayamount" id="dayamount" size="10" value="<?php echo $amount_date;?>"/> วัน
            </td>
        </tr>
        <tr>
            <td>ราคาต่อวัน</td>
            <td>
                <input type="text" name="rateperday" id="rateperdate" size="15" value="<?php echo number_format($roomtype['price'],2); ?>"/> บาท
            </td>
        </tr>
        <tr>
            <td>ราคาสุทธิ</td>
            <td>
                <input type="text" name="netprice" id="netprice" size="15" value="<?php echo number_format($net_price,2);?>"/> บาท
            </td>
        </tr>
        
        <tr><td class="block_title">&nbsp;</td><td></td></tr>
        <tr><td class="block_title">ข้อมูลการโอนเงิน</td><td></td></tr>
        <?php
            $sql_paiddetail = mysql_query("select * from payinslip where transactionid='{$_GET['transaction']}'");
            $paiddetail = array();
            while($getpaid = mysql_fetch_array($sql_paiddetail))
            {
                $paiddetail['slip'] = $getpaid['payinslip'];
                $paiddetail['paydate'] = $getpaid['paydate'];
            }
            ?>
        <tr>
            <td>วันที่แจ้งการโอนเงิน</td>
            <td>
                <input type ="text" name="paydate" id="paydate" value="<?php echo $paiddetail['paydate']; ?>" />
            </td>
        </tr>
        <tr>            
            <td>สลิปโอนเงิน</td>
            <td valign="top">
                <img src="../<?php echo $paiddetail['slip']; ?>" style="border:none; " width="550" height="300"/>
            </td>
        </tr>
        <tr>
            <td>สถานะการชำระเงิน</td>
            <td>
                <?php
                    switch($arrbooking['status'])
                    {
                        case 'approved': echo "<span style='font-weight:bold;color:blue;' id='paystatus'>ชำระเงินแล้ว</span>";
                            break;
                        case 'waiting' : echo "<span style='font-weight:bold;color:red;' id='paystatus'>ยังไม่ชำระเงิน</span>";
                            break;
                         case 'cancel' : echo "<span id='paystatus' style='font-weight:bold;color:gray;'>ยกเลิกรายการนี้</span>";
                            break;
                        default:
                            break;
                    }
                ?>
            </td>
        </tr>
        <?php
        if($arrbooking['status']=='waiting')
        {
         ?>
              <tr><td class="block_title">&nbsp;</td>
                  <td><button type="button" name="btn_comfirm_payin" id="btn_comfirm_payin" onclick="confirmpayin('<?php echo $arrbooking['transaction_id'];?>')">ยืนยันการชำระเงิน</button>
                  </td></tr>
              <tr class="newstatus"><td class="block_title">ข้อมูลสำหรับการชำระเงิน</td><td></td></tr>
              <tr class="newstatus">
                  <td>วิธีการชำระเงิน</td>
                  <td><span>โอนเงินผ่านธนาคาร</span></td>
              </tr>
              <tr class="newstatus">
                  <td valign="top">รายชื่อบัญชีสำหรับการโอน</td>
                  <td valign="top">
                      <?php 
                            $acc = mysql_query("select * from payment order by bank_name");
                       ?>
                      
                          <?php
                             while($racc=  mysql_fetch_array($acc))
                             {
                               ?>
                               
                                ธนาคาร<?php echo $racc['bank_name'];?>&nbsp;&nbsp;&nbsp;
                                สาขา<?php echo $racc['bank_branch'];?>&nbsp;&nbsp;&nbsp;
                                ชื่อบัญชี<?php echo $racc['accountname'];?>&nbsp;&nbsp;&nbsp;
                                เลขที่บัญชี <?php echo $racc['bank_no'];?>&nbsp;&nbsp;&nbsp;
                                ประเภท<?php echo $racc['accounttype'];?><br />                                
                               <?php
                             }
                          ?>
                      
                  </td>
              </tr>
              <tr class="newstatus"><td></td><td>&nbsp;</td></tr>
              <tr class="newstatus">
                  <td></td>
                  <td style="color: orange;">*ชำระเงินภายในวันที่ 
                  <?php
                  $query_time = mysql_query("select expire_time_approve from reserve_time");
                  while($t = mysql_fetch_array($query_time))
                  {
                      $approvetime=$t['expire_time_approve'];
                  }
                  $time_finish = strtotime("+$approvetime hours {$arrbooking['action_date']}");
                  echo date("d-m-Y",$time_finish);                  
                  ?>
                   &nbsp;&nbsp; เวลา <?php echo date("H:i:s",$time_finish);?>
                  </td>
              </tr>    
         <?php
        }
        ?>
    </table>  
</form>
<iframe name="iframe" style="width:0px; height: 0px; border: none;">
</iframe>
</html>