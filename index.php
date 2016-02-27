<?php
    include("getsite_info.php");
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
            jQuery('#banner').css({
                    'background-size': '100% 100%' 
            });
        })
    }
</script>
</head>
<body  onload="getinfo()">
    
<?php include("compose/header_menu.php"); ?>
<div id="banner-wrapper">
	<div id="banner"></div>
</div>
<div id="page-wrapper">
	<div id="page">
		<div id="content">
			<div>
				<h2 id="topic_wellcome" ><?php echo $site_info['wellcome']; ?></h2>
				<p class="subtitle" id="topic_wellcome_capture"><?php echo $site_info['wellcome_capture']; ?></p>
				<p id="topic_wellcome_detail"><?php echo $site_info['wellcome_detail']; ?>
                                </p>
				<p class="button-style"><a href="room_list.php">ดูรายการห้องประชุม</a></p>
			</div>
		</div>
		<div id="sidebar">
			<h2 id="title_sidebar"><?php echo $site_info['sitebar_menu'];?></h2>
                        
			<ul class="style1">
                            <?php
                            for($i=0;$i<count($vote_room);$i++)
                            {
                               ?>
                                <li class="first">
					<p><a href="about_room.php?roomname=<?php echo $vote_room[$i]['vote_name'];?>">ห้อง<?php echo $vote_room[$i]['vote_name'];?> <?php echo $vote_room[$i]['vote_caption'];?></a></p>
				</li>
                            <?php
                            }
                            ?>
								
			</ul>
		</div>
	</div>
</div>
<div id="footer-wrapper">
	<div id="footer-content">
		<div id="fbox1">
                    <?php
                    if(isset($suggest[0]['suggest_name']))
                    {
                    ?>
			<h2 id="roomname_show1"><span>ห้อง</span><?php echo $suggest[0]['suggest_name'];?></h2>
			<p><img src="<?php echo$suggest[0]['suggest_image'];?>" width="320" height="150" alt="" /></p>
			<p><?php echo $suggest[0]['suggest_caption'];?></p>
			<p class="button-style"><a href="about_room.php?roomname=<?php echo $suggest[0]['suggest_name'];?>">ดูรายละเอียด</a></p>
                     <?php
                    }
                     ?>
		</div>
		<div id="fbox2">
                    <?php
                    if(isset($suggest[1]['suggest_name']))
                    {
                    ?>
			<h2 id="roomname_show2"><span>ห้อง</span><?php echo $suggest[1]['suggest_name'];?></h2>
			<p><img src="<?php echo$suggest[1]['suggest_image'];?>" width="320" height="150" alt="" /></p>
			<p><?php echo $suggest[1]['suggest_caption'];?></p>
			<p class="button-style"><a href="about_room.php?roomname=<?php echo $suggest[1]['suggest_name'];?>">ดูรายละเอียด</a></p>
                     <?php
                    }
                     ?>
		</div>
		<div id="fbox3">
                    <?php
                    if(isset($suggest[2]['suggest_name']))
                    {
                    ?>
			<h2 id="roomname_show3"><span>ห้อง</span><?php echo $suggest[2]['suggest_name'];?></h2>
			<p><img src="<?php echo$suggest[2]['suggest_image'];?>" width="320" height="150" alt="" /></p>
			<p><?php echo $suggest[2]['suggest_caption'];?></p>
			<p class="button-style"><a href="about_room.php?roomname=<?php echo $suggest[2]['suggest_name'];?>">ดูรายละเอียด</a></p>
                    <?php 
                    
                    }?>
		</div>
	</div>
</div>
<?php  include("compose/footer.php"); ?>
</body>
</html>
