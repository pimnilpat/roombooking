<?php
    include_once("getsite_info.php");
?>
<div id="header">
	<div id="logo">
		<h1><a href="#"><?php echo $site_info['name'];?></a></h1><h3><span id="companyname"><?php echo $site_info['company'];?></span></h3>
	</div>
	<div id="menu">
		<ul>
			<li><a href="index.php" accesskey="1" title="">หน้าแรก</a></li>
                        <li><a href="room_list.php" accesskey="1" title="">ห้องประชุม</a></li>
			<li><a href="booking.php" accesskey="2" title="">จองห้องประชุม</a></li>
                        <li><a href="payindetail.php" accesskey="2" title="">แจ้งการชำระเงิน</a></li>
                        <li><a href="paymentdetail.php" accesskey="2" title="">วิธีการชำระเงิน</a></li>                         
			<li><a href="aboutus.php" accesskey="3" title="">เกี่ยวกับเรา</a></li>			
			<li><a href="contactus.php" accesskey="5" title="">ติดต่อเรา</a></li>
		</ul>
	</div>
</div>