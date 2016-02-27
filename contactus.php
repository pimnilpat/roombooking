<?php     
    include_once("connectdb.php");
    
    $result = mysql_query("select * from contactus");
    $contact = array(); 
    while($row = mysql_fetch_array($result))
    {
        $contact['address'] = $row['address']; 
        $contact['phone']=$row['phone'];
        $contact['email']=$row['email'];
        $contact['fax']=$row['fax'];
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
<script type="text/javascript">
    function getinfo()
    {
        jQuery.get("site_image.php",{value:''}, function(data){ 
            jQuery("#banner").css("background-image","url("+data+")");
        })
    }
</script>
<style>
    .contactus
    {
        width:60%;
        margin: 0px auto;
    }
    .contactus td:first-child
    {
        width:15%;
        text-align: right;
        padding-right: 40px;
        font-weight: bolder;
    }
    .contactus td:last-child
    {
        width: 85%;
    }
    
</style>
</head>
<body  onload="getinfo()">
    
<?php include("compose/header_menu.php");?>


<div id="page-wrapper-2">

</div>
<div id="footer-wrapper">
	<div id="footer-content">
            	<table class="contactus" cellspacing="20">
                <tr>
                    <td valign="top">โทรศัพท์</td>
                    <td valign="top">
                       <?php echo $contact['phone']; ?> 
                    </td>
                </tr>
                <tr>
                    <td valign="top">แฟกซ์</td>
                    <td valign="top">
                       <?php echo $contact['fax']; ?> 
                    </td>
                </tr>
                    <tr>
                    <td valign="top">อีเมล์</td>
                    <td valign="top">
                       <?php echo $contact['email']; ?> 
                    </td>
                </tr>
                    <tr>
                    <td valign="top">ที่อยู่</td>
                    <td valign="top">
                       <?php echo $contact['address']; ?> 
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
