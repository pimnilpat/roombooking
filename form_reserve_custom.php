<?php
include_once("connectdb.php");
//print_r($_POST);
$time1=$_POST['fromdate'];
$time2=$_POST['todate'];

$attendee= $_POST['attendee']; 
?>
<html>
    <head>
        <style>
            .tbreserve
            {
                width:70%
            }
            .tbreserve td:first-child
            {
                width: 25%;
                text-align: right;
                padding-right: 20px;
            }
            .tbreserve td:last-child
            {
                width: 75%;
            }
            .mark{
                color: red;
            }
            .block_title
            {                
                font-weight: bold;               
            }
        </style>        
            <script src="../js/jquery.js" type="text/javascritp" ></script>
        <script>
              function callreserve()
              {
                  var date1=jQuery("#date1").val();
                  var date2=jQuery("#date2").val();
                  var type=jQuery("#get_type").val();
                  var room = jQuery("#get_room").val();
                  
                  var meeting_title = jQuery("#meeting_title").val();
                  var meeting_descrip = jQuery("#meeting_descrip").val();
                  var meeting_seat = jQuery("#attendee").val();
                  
                  var cus_firstname = jQuery("#cus_firstname").val();
                  var cus_lastname = jQuery("#cus_lastname").val();
                  var cus_idcard = jQuery("#cus_idcard").val();
                  var cus_phone = jQuery("#cus_phone").val();
                  var cus_mobile = jQuery("#cus_mobile").val();
                  var cus_email = jQuery("#cus_email").val();
                  var time1=$("#time1").val();
                  var time2=$("#time2").val();
                  
                  if(meeting_title.length<=0 || meeting_seat.length<=0 || cus_firstname.length<=0 || cus_lastname.length<=0 || cus_idcard.length<=0 || cus_mobile<=0 || cus_email.length<=0)
                  {
                          alert("Must enter require field");
                  }
                  else
                  {
                      jQuery.ajax({
                                 type: "POST",
                                 url:"insert_reserved_custom.php",
                                 data:"date1="+date1+"&date2="+date2+"&type="+type+"&room="+room
                                     +"&meeting_title="+meeting_title+"&meeting_descrip="+meeting_descrip+"&meeting_seat="+meeting_seat
                                     +"&cus_firstname="+cus_firstname+"&cus_lastname="+cus_lastname+"&cus_idcard="+cus_idcard
                                     +"&cus_phone="+cus_phone+"&cus_mobile="+cus_mobile+"&cus_email="+cus_email+"&time1="+time1+"&time2="+time2,
                                 success:function(data){ 
                                     var has_string=$('*:contains("success")').length
                                     if(data=='1')
                                     {
                                        alert("ID Card not correct"); 
                                     }
                                     else if(data=='2')
                                     {
                                        alert("mobile is only number"); 
                                     }
                                     else if(data=='3')
                                     {
                                           alert("E-mail is not correct");  
                                     }
                                     else if(data=='0')
                                     {
                                           //alert("ready");  
                                     }                                     
                                     else if(has_string>0) 
                                     { 
                                           var str = data.split("/");
                                           
                                           $("#footer-content").html("<div><span style='font-weight: bold;'>บันทึกการจองเรียบร้อย&nbsp;&nbsp;&nbsp;&nbsp;</span><span>ระบบได้ทำการส่งรายละเอียดการจองห้องระชุมทาง E-mail ของคุณแล้ว </span></div><br />");
                                           $("#footer-content").append("<table class='tbreserve'>\n\
                                                           <tr><td>รหัสจอง</td>\n\
                                                           <td>"+str[1]+"</td></tr>\n\
                                                    </table>");
                                                               
                                            $.get("view_booking_detail_custom.php",{transaction:str[1]},function(data){
                                                  $("#footer-content").append(data);
                                            });
                                     }
                                     else if(data=='error')
                                     {
                                             alert(data);
                                     }
                                     //alert(data);
                                 }
                          });
                  }
              }
        </script>
    </head>
    
<form  name="frm_savereserved" method="post" action="save_reserved.php"  target="iframe_savereserved">
    <table class="tbreserve">
        <tr>
            <th>รายละเอียดการจอง</th>
            <th></th>
        </tr>
        <tr>
            <td>หัวข้อการประชุม</td>
            <td><input type="text" maxlength="100" name="meeting_title" id="meeting_title" size="60"/><span class="mark">*</span></td>
        </tr>
        <tr>
            <td>คำบรรยายพอสังเขป</td>
        <td><textarea name="meeting_descrip" id="meeting_descrip" cols="50" rows="3"></textarea></td>
        </tr>       
        <tr><td>&nbsp;</td><td></td></tr>
        <tr><td class="block_title">ข้อมูลลูกค้า</td><td></td></tr>
        <tr>
            <td>ชื่อ</td>
            <td><input type="text" maxlength="50" name="cus_firstname" id="cus_firstname" size="40"/><span class="mark">*</span></td>               
        </tr>
        <tr>
            <td>นามสกุล</td>
            <td><input type="text" maxlength="50" name="cus_lastname" id="cus_lastname" size="40"/><span class="mark">*</span></td>               
        </tr>
        <tr>
            <td>รหัสบัตรประชาชน</td>
            <td><input type="text" maxlength="13" name="cus_idcard" id="cus_idcard" size="40"/><span class="mark">*</span></td>               
        </tr>
        <tr>
            <td>โทรศัพท์</td>
            <td><input type="text" maxlength="20" name="cus_phone" id="cus_phone" size="40"/></td>               
        </tr>
        <tr>
            <td>มือถือ</td>
            <td><input type="text" maxlength="10" name="cus_mobile" id="cus_mobile" size="40"/><span class="mark">*</span></td>               
        </tr>
        <tr>
            <td>อีเมล์</td>
            <td><input type="text" maxlength=50" name="cus_email" id="cus_email" size="40"/><span class="mark">*</span></td>               
        </tr>
        <tr><td>&nbsp;</td>
            <td><input type="hidden" id="attendee" name="attendee" value="<?php echo $attendee;?>"/></td>
        </tr>
        <tr>
            <td></td>
            <td><button type="button" name="btnreserve" id="btnreserve" onclick="callreserve()"><img src="img/button_ok.png" />บันทึกการจอง</button></td>
        </tr>
    </table>  
</form>
<iframe name="iframe" style="width:0px; height: 0px; border: none;">
</iframe>
</html>