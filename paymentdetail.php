<?php     
  
include_once("connectdb.php");
$acc = mysql_query("select * from payment order by bank_name") or die(mysql_error());

$query_time = mysql_query("select expire_time_approve from reserve_time");
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
<script type="text/javascript">
    
</script>
</head>
<body>
    
<?php include("compose/header_menu.php");?>


<div id="page-wrapper-2">

</div>
<div id="footer-wrapper">
	<div id="footer-content">
            <table style="width:100%">
                <tr>
                  <td style="width:20%">วิธีการชำระเงิน</td>
                  <td><span>โอนเงินผ่านธนาคาร</span></td>
              </tr>
              <tr>
                  <td valign="top" style="width:20%">รายชื่อบัญชีสำหรับการโอน</td>
                  <td valign="top">
                      <?php 
                            
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
              <tr><td></td><td>&nbsp;</td></tr>
              <tr>
                  <td></td>
                  <td style="color: orange;">แจ้งการชำระเงินภายใน  
                  <?php
                  
                  while($t = mysql_fetch_array($query_time))
                  {
                      $approvetime=$t['expire_time_approve'];
                  }
                  
                  echo $approvetime                  
                  ?>
                   &nbsp;ชั่วโมง หลังจากทำการจอง
                  </td>
              </tr>
            </table>	
	</div>
</div>
<?php 
    include("compose/footer.php");
?>
</body>
</html>
