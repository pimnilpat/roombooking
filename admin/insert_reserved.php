<?php
header("content='text/html; charset=utf-8'" );
include_once("../connectdb.php");
include_once("anyfunction.php");

//print_r($_POST);
$message= "";

if(!validNumber($_POST['cus_idcard']))
{
    $data = "1";
    echo $data;
}
else
{
    if(!validNumber($_POST['cus_mobile']))
    {
        $data = "2";
        echo $data;
    } 
    else
    {
        if(!filter_var($_POST['cus_email'], FILTER_VALIDATE_EMAIL))
        {
            $data = "3";
            echo $data;
        }
        else{
            $data = "0";
        }
    }
}
if($data=='0')
{
       $temp_price = mysql_query("select * from roomtype where name='{$_POST['type']}'") or die(mysql_error());
       while($row=mysql_fetch_array($temp_price))
       {
           $price = $row['price'];
       }
       
       $action_time = date("Y-m-d H:i:s");
       $tempd = date("Y-m-d H:i:s");
       $temptrans = strtotime($tempd);
       $transactionid = $temptrans.$_POST['cus_idcard'];
       $nameroom = '';
       $time1=  strtotime($_POST['date1']);
       $time2=  strtotime($_POST['date2']);
       $date1=date("Y-m-d H:i:s",$time1);
       $date2=date("Y-m-d H:i:s",$time2); 
       $status ='waiting';
       $time_begin = date("H:i:s",  strtotime($_POST['time1']));
       $time_end = date("H:i:s",  strtotime($_POST['time2']));
       
      
                    
                $query = "insert into reserved_room(name,type,booking_date,booking_end_date,username,usersurname,id_card,tel,mobile,email,transaction_id,action_date,topic,caption,seat,name_room,price,status,begin_time,end_time)
                                    values('{$_POST['room']}','{$_POST['type']}','$date1','$date2','{$_POST['cus_firstname']}',
                                           '{$_POST['cus_lastname']}','{$_POST['cus_idcard']}','{$_POST['cus_phone']}','{$_POST['cus_mobile']}','{$_POST['cus_email']}',
                                           '$transactionid','$action_time','{$_POST['meeting_title']}','{$_POST['meeting_descrip']}','{$_POST['meeting_seat']}',
                                           '$nameroom','$price','$status','$time_begin','$time_end')           
                         ";
                $result = mysql_query($query) or die(mysql_error());
                if($result)
                {
                    $get_company = mysql_query("select site_company,site_name from site_infomation");
                    while($getcompany = mysql_fetch_array($get_company))
                    {
                        $company_name = $getcompany['site_company'];
                        $site_name = $getcompany['site_name'];
                    }
                    $get_contact = mysql_query("select * from contactus");
                    while($getcontact=  mysql_fetch_array($get_contact))
                    {
                        $company_email = $getcontact['email'];
                    }
                    
                    $to = $_POST['cus_email'];
                    $subject = "ข้อมูลการจองห้องประชุมออนไลน์ ".$company_name;                     
                    $message .= "\n";
                    
                    
                    $query_booking = "select * from reserved_room where transaction_id='".$transactionid."'";
                    $result_booking = mysql_query($query_booking);
                    $arrbooking = array();
                    while($rowbooking = mysql_fetch_array($result_booking))
                    {
                        $arrbooking['topic'] = $rowbooking['topic'];
                        $arrbooking['caption'] = $rowbooking['caption'];
                        $arrbooking['seat'] = $rowbooking['seat'];
                        $arrbooking['price'] = $rowbooking['price'];
                        $arrbooking['action_date'] = $rowbooking['action_date'];
                        $arrbooking['transaction_id'] = $rowbooking['transaction_id'];
                        $arrbooking['name'] = $rowbooking['name'];
                        $arrbooking['type'] = $rowbooking['type'];
                        $arrbooking['booking_date'] = $rowbooking['booking_date'];
                        $arrbooking['booking_end_date'] = $rowbooking['booking_end_date'];
                        $arrbooking['username'] = $rowbooking['username'];
                        $arrbooking['usersurname'] = $rowbooking['usersurname'];
                        $arrbooking['idcard'] = $rowbooking['id_card'];
                        $arrbooking['tel'] = $rowbooking['tel'];
                        $arrbooking['mobile'] = $rowbooking['mobile'];
                        $arrbooking['email'] = $rowbooking['email'];
                        $arrbooking['status'] = $rowbooking['status'];
                        $arrbooking['start_time'] = $rowbooking['begin_time'];
                        $arrbooking['end_time'] = $rowbooking['end_time'];
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
                    $cal_date = "SELECT booking_date,booking_end_date, DAY(booking_end_date) - DAY(booking_date) AS count_date from reserved_room where transaction_id='{$transactionid}'";
                    $result_cal_date = mysql_query($cal_date);
                    while($cal = mysql_fetch_array($result_cal_date))
                    {
                        $amount_date = $cal['count_date'];
                    }
                    $amount_date +=1;
                    $net_price = $amount_date * $roomtype['price'];
                    
                    $acc = mysql_query("select * from payment order by bank_name");
                    $ic=0;
                    while($_racc=  mysql_fetch_array($acc))
                    {
                         $racc[$ic]['bank_name']= $_racc['bank_name'];
                         $racc[$ic]['bank_branch']=$_racc['bank_branch'];
                         $racc[$ic]['accountname']=$_racc['accountname'];
                         $racc[$ic]['bank_no']=$_racc['bank_no'];
                         $racc[$ic]['accounttype']=$_racc['accounttype'];
                         $ic++;
                    }
                    
                    $message = "<html>";
                    $message .= "<head><meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\" /></head>";                   
                    $message .= "<body>";
                    $message .= "<form>";                    
                    $message .= "<table>
                                <tr>
                                    <th colspan=\"2\">รายละเอียดของรายการจองที่  {$arrbooking['transaction_id']}></th>
                                </tr>
                                <tr>
                                    <td>วันที่ทำรายการ</td>
                                    <td><input type=\"text\" name=\"transactime\" id=\"transactime\" value=\"".date("d-m-Y H:i:s",strtotime($arrbooking['action_date']))."\"/></td>
                                </tr>
                                <tr>
                                    <td>รหัสการจอง</td>
                                    <td><input type=\"text\" name=\"transacid\" id=\"transacid\" value=\" {$arrbooking['transaction_id']}\"/></td>
                                </tr>
                                <tr>
                                    <td>หัวข้อการประชุม</td>
                                    <td><input type=\"text\" maxlength=\"100\" name=\"meeting_title\" id=\"meeting_title\" size=\"60\" value=\"{$arrbooking['topic']}\"/><span>*</span></td>
                                </tr>
                                <tr>
                                <td valign=\"top\">คำบรรยายพอสังเขป</td>
                                <td valign=\"top\"><textarea name=\"meeting_descrip\" id=\"meeting_descrip\" cols=\"50\" rows=\"3\" >{$arrbooking['caption']}</textarea></td>
                                </tr> 
                                <tr>
                                    <td>จำนวนผู้เข้าประชุม</td>
                                    <td>
                                        <input type=\"text\" size=\"10\" maxlength=\"4\" name=\"attendee\" id=\"attendee\" value=\"{$arrbooking['seat']}\"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>วันที่เริ่มต้น</td>
                                    <td>
                                        <input type=\"text\" size=\"20\"  name=\"begindate\" id=\"begindate\" value=\"".date("d-m-Y",strtotime($arrbooking['booking_date']))."\"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>วันที่สิ้นสุด</td>
                                    <td>
                                        <input type=\"text\" size=\"20\"  name=\"enddate\" id=\"enddate\" value=\"".date("d-m-Y",strtotime($arrbooking['booking_end_date']))."\"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>ช่วงเวลา
                                         </td>
                                    <td>จาก&nbsp;
                                        <input type=\"text\" id=\"starttime\" name=\"starttime\" size=\"7\" readonly=\"readonly\" value=\"{$arrbooking['start_time']}\" />
                                    น.&nbsp;&nbsp;&nbsp;&nbsp;ถึง
                                        <input type=\"text\" id=\"endtime\" name=\"endtime\" size=\"7\" readonly=\"readonly\" value=\"{$arrbooking['end_time']}\" />
                                        น.
                                    </td>
                                </tr>
                                <tr><td>&nbsp;</td><td></td></tr>
                                <tr><td>ข้อมูลลูกค้า</td><td></td></tr>
                                <tr>
                                    <td>ชื่อ</td>
                                    <td><input type=\"text\" maxlength=\"50\" name=\"cus_firstname\" id=\"cus_firstname\" size=\"40\" value=\"{$arrbooking['username']}\"/><span>*</span></td>               
                                </tr>
                                <tr>
                                    <td>นามสกุล</td>
                                    <td><input type=\"text\" maxlength=\"50\" name=\"cus_lastname\" id=\"cus_lastname\" size=\"40\" value=\"{$arrbooking['usersurname']}\"/><span>*</span></td>               
                                </tr>
                                <tr>
                                    <td>รหัสบัตรประชาชน</td>
                                    <td><input type=\"text\" maxlength=\"13\" name=\"cus_idcard\" id=\"cus_idcard\" size=\"40\" value=\"{$arrbooking['idcard']}\"/><span>*</span></td>               
                                </tr>
                                <tr>
                                    <td>โทรศัพท์</td>
                                    <td><input type=\"text\" maxlength=\"20\" name=\"cus_phone\" id=\"cus_phone\" size=\"40\" value=\"{$arrbooking['tel']} \"/></td>               
                                </tr>
                                <tr>
                                    <td>มือถือ</td>
                                    <td><input type=\"text\" maxlength=\"10\" name=\"cus_mobile\" id=\"cus_mobile\" size=\"40\" value=\"{$arrbooking['mobile']}\"/><span>*</span></td>               
                                </tr>
                                <tr>
                                    <td>อีเมล์</td>
                                    <td><input type=\"text\" maxlength=\"50\" name=\"cus_email\" id=\"cus_email\" size=\"40\" value=\"{$arrbooking['email']}\"/><span>*</span></td>               
                                </tr>
                                <tr><td>&nbsp;</td>
                                    <td><input type=\"hidden\" id=\"attendee\" name=\"attendee\" value=\"{$arrbooking['seat']}\"/></td>
                                </tr>

                                <tr><td>ข้อมูลห้องประชุม</td><td></td></tr>
                                <tr>
                                    <td>ชื่อห้องประชุม</td>
                                    <td>
                                        <input type=\"text\" name=\"roomname\" id=\"roomnamae\" size=\"40\" value=\"{$arrbooking['name']}\"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>ประเภทห้องประชุม</td>
                                    <td>
                                        <input type=\"text\" name=\"roomtype\" id=\"roomtype\" size=\"40\" value=\"{$arrbooking['type']}\"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>ราคาต่อรอบ</td>
                                    <td>
                                        <input type=\"text\" name=\"typeprice\" id=\"typeprice\" size=\"15\" value=\"{$roomtype['price']}\"/> บาท
                                    </td>
                                </tr>
                                <tr>
                                    <td>จำนวนที่นั่ง</td>
                                    <td>
                                        <input type=\"text\" name=\"maxseat\" id=\"maxseat\" size=\"15\" value=\"{$roomtype['seat']}\"/> ที่
                                    </td>
                                </tr>
                                <tr>
                                    <td valign=\"top\">คำอธิบาย</td>
                                    <td valign=\"top\">
                                        <textarea cols=\"40\" rows=\"5\" name=\"typedescript\" id=\"typedescript\">".$roomtype['description']                      
                                        ."</textarea>"."
                                    </td>
                                </tr>
                                <tr>
                                    <td valign=\"top\">คอฟฟี่เบรค</td>
                                    <td valign=\"top\">
                                         <textarea cols=\"40\" rows=\"5\" name=\"typecoffeebreak\" id=\"typecoffeebreak\">{$roomtype['coffeebreak']}           
                                        </textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td valign=\"top\">อุปกรณ์ประกอบ</td>
                                    <td valign=\"top\"> 
                                         <textarea cols=\"40\" rows=\"5\" name=\"typdeaccessories\" id=\"typdeaccessories\">{$roomtype['accessories']}                      
                                        </textarea>
                                    </td>
                                </tr>
                                <tr><td>&nbsp;</td><td></td></tr>
                                <tr><td>คำนวณราคา</td><td></td></tr>
                                <tr>
                                    <td>จำนวนวันที่จอง</td>
                                    <td>
                                        <input type=\"text\" name=\"dayamount\" id=\"dayamount\" size=\"10\" value=\"$amount_date\"/> วัน
                                    </td>
                                </tr>
                                <tr>
                                    <td>ราคาต่อวัน</td>
                                    <td>
                                        <input type=\"text\" name=\"rateperday\" id=\"rateperdate\" size=\"15\" value=\"".number_format($roomtype['price'],2)."\"/> บาท
                                    </td>
                                </tr>
                                <tr>
                                    <td>ราคาสุทธิ</td>
                                    <td>
                                        <input type=\"text\" name=\"netprice\" id=\"netprice\" size=\"15\" value=\"".number_format($net_price,2)."\"/> บาท
                                    </td>
                                </tr>
                                <tr>
                                    <td>สถานะการชำระเงิน</td>
                                    <td>       
                                          <span style='font-weight:bold;color:red;' id='paystatus'>ยังไม่ชำระเงิน</span>                                       
                                    </td>
                                </tr>
                               
                                      <tr><td>&nbsp;</td>
                                          <td>&nbsp;</td></tr>
                                      <tr><td>ข้อมูลสำหรับการชำระเงิน</td><td></td></tr>
                                      <tr>
                                          <td>วิธีการชำระเงิน</td>
                                          <td><span>โอนเงินผ่านธนาคาร</span></td>
                                      </tr>
                                      <tr>
                                          <td valign=\"top\">รายชื่อบัญชีสำหรับการโอน</td>
                                          <td valign=\"top\">";
                                           for($icc=0;$icc<count($racc);$icc++)
                                           {
                                                $message .="ธนาคาร {$racc[$icc]['bank_name']}&nbsp;&nbsp;&nbsp;
                                                        สาขา {$racc[$icc]['bank_branch']}&nbsp;&nbsp;&nbsp;
                                                        ชื่อบัญชี {$racc[$icc]['accountname']}&nbsp;&nbsp;&nbsp;
                                                        เลขที่บัญชี {$racc[$icc]['bank_no']}&nbsp;&nbsp;&nbsp;
                                                        ประเภท {$racc[$icc]['accounttype']}<br />";
                                           }
                                                                         
                                        $message .="</td>
                                      </tr>
                                      <tr><td></td><td>&nbsp;</td></tr>
                                      <tr>
                                          <td></td>
                                          <td style=\"color: orange;\">*ชำระเงินภายในวันที่ ";
                                          
                                          $query_time = mysql_query("select expire_time_approve from reserve_time");
                                          while($t = mysql_fetch_array($query_time))
                                          {
                                              $approvetime=$t['expire_time_approve'];
                                          }
                                          $time_finish = strtotime("+$approvetime hours {$arrbooking['action_date']}");
                                          
                                          $message .= date("d-m-Y",$time_finish);                  
                                         
                                          $message .= "&nbsp;&nbsp; เวลา ".date("H:i:s",$time_finish);
                                          $message .="</td>
                                      </tr>    
                                                             
                            </table>
                        ";
                    $message .= "</form>";
                    $message .= "</body>";
                    $message .="</html>";
                    
                    $from = $company_email;
                    $headers = "";
                    $headers .= "From: ".$from."\r\n";                    
                    $headers  .= "MIME-Version: 1.0\r\n";  
                    $headers .= "Content-type: text/html; charset=UTF-8\r\n";                   
                    
                    mail($to, $subject, $message, $headers);
                    
                    $data='success/'.$transactionid;
                    echo $data;
                }
                else
                {
                    $data = "error";
                    echo $data;
                }  
       
       
}
?>
