<?php     
    include_once("connectdb.php");
    
    $result = mysql_query("select * from contactus");
    $contact = array(); 
    while($row = mysql_fetch_array($result))
    {
        
        $fax=$row['fax'];
    }
    
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
Design by Free CSS Templates
http://www.freecsstemplates.org
Released for free under a Creative Commons Attribution 2.5 License

developer Info
Name       : Phimpika Nangam
E-mail     : Phim_n@hotmail.com
Version    : 1.0
Released   : 15/102012

-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Room Booking</title>
<link href='http://fonts.googleapis.com/css?family=Oswald:400,300' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Abel' rel='stylesheet' type='text/css' />
<link href="default.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/smoothness/jquery-ui-1.8.13.custom.css" rel="stylesheet" type="text/css" media="all" />
<!--[if IE 6]>
<link href="default_ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.13.custom.min.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
<script type="text/javascript" src="js/min.js"></script>
<script>
            
</script>
</head>
<body>
    
<?php include("compose/header_menu.php");?>


<div id="page-wrapper-2">

</div>
<div id="footer-wrapper">
	<div id="footer-content">
           <p>คุณสามารถแจ้งการชำระเงินโดยแฟกซ์สลิปการโอนเงิน มาที่หมายเลข <?php echo $fax; ?> และเขียนรหัสการจองกำกับมาในสลิปเพื่อเป็นประโยชน์ในการตรวจสอบข้อมูลด้วยค่ะ</p>
           <p>
               หรือแจ้งการโอนผ่านหน้าเว็บ
           </p>
           <form action="save_payin.php" method="post" Enctype="multipart/form-data" target="iframe_payin" />
           <table style="width:60%;">
            <tr>
                <td>รหัสการจอง</td>
                <td>
                    <input type="text" name="txt_transac" id="txt_transac" maxlength="30" size="30"/>
                    
                </td>

            </tr>
               <tr>
                   <td>รูปภาพสลิปการโอนเงิน</td>
                   <td>
                       <input type="file" name="filepayin" id="filepayin" size="30"/>
                       <input type="hidden" name="MAX_FILE_SIZE" value="1048576" /><div>ภาพมีขนาดไม่เกิน 1 MB</div>
                   </td>
               </tr>
               <tr>
                   <td></td>
                   <td><button type="submit" name="btnpayin" id="btnpayin" >แจ้งการชำระเงิน</button></td>
               </tr>
        </table>
           <br />
           <iframe name="iframe_payin" id="iframe_payin" style="width:100%; height: 1800px; border:none" ></iframe>
	</div>
</div>
<?php 
    include("compose/footer.php");
?>
</body>
</html>
