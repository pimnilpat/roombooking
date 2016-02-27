<?php
include_once("connectdb.php");
include_once("admin/anyfunction.php");

//print_r($_POST);

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
