<?php     
    include_once("connectdb.php");
    
    $sql= "select * from list_room order by name";
    $result = mysql_query($sql);
    $i=0;
    $list = array();
    while($row=  mysql_fetch_array($result))
    {
        $list[$i]['name']=$row['name'];        
        $list[$i]['picture']=$row['picture'];
        $list[$i]['type']=$row['type'];
        $gettype = mysql_query("select * from roomtype where name='{$row['type']}'");
        while($type=  mysql_fetch_array($gettype))
        {
            $list[$i]['description'] = $type['description']; 
            $list[$i]['price'] = $type['price'];
            $list[$i]['breaking'] = $type['coffeebreak'];
            $list[$i]['series'] = $type['accessories'];
            $list[$i]['seat'] = $type['seat'];
            $list[$i]['type'] = $type['name'];
        }
        $i++;
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
</head>
<body  onload="getinfo()">
    
<?php include("compose/header_menu.php");?>


<div id="page-wrapper-2">

</div>
<div id="footer-wrapper">
	<div id="footer-content">
             <?php 
             for($j=0;$j<count($list);$j++)
             {
                 ?>
            
                        <div class="boxname">                        
			<p><img src="<?php echo$list[$j]['picture'];?>" width="320" height="150" alt="" /></p>			
                        </div>
                        <div class="boxdescription">                    
                           <p><span class="caption">ชื่อห้อง: <?php echo $list[$j]['name'];?></span></p>
                           <p><span class="caption">ประเภทห้อง: <?php echo $list[$j]['type'];?></p>
                           <p><span class="caption">จำนวนที่นั่ง: </span>&nbsp;&nbsp;<?php echo $list[$j]['seat'];?>&nbsp;&nbsp;ที่นั่ง</p>
                           <p><span class="caption">ราคา: </span>&nbsp;&nbsp;<?php echo $list[$j]['price'];;?>&nbsp;&nbsp;/รอบ</p>
                           <p><span class="caption">อุปกรณ์เสริม: </span>&nbsp;&nbsp;<?php echo $list[$j]['series'];?></p>
                           <p><span class="caption">ชุดเบรค: </span>&nbsp;&nbsp;<?php echo $list[$j]['breaking'];?></p>
                           <p><span class="caption">เกี่ยวกับห้อง: </span>&nbsp;&nbsp;<?php echo $list[$j]['description'];?></p>
                           <p>&nbsp;</p><p>&nbsp;</p>
                        </div>
                        <div class="boxreserve">
                            <p class="button-style"><a href="about_room.php?roomname=<?php echo $list[$j]['name'];?>">ดูรายละเอียด</a></p>
                            <p>&nbsp;</p>
                        </div>
            
            <?php
                 
             }
             ?>
			
	</div>
</div>
<?php 
    include("compose/footer.php");
?>
</body>
</html>
