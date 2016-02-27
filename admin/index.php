<?php
  session_start(); 
  include_once('../connectdb.php');
  if(isset($_POST['submitlogin']))
  {
      if($_POST['username']=='' || $_POST['userpassword']=='')
      {
          echo "<script>";
          echo "alert('Enter your username or password')";
          echo "</script>";
      }
      else
      {
          $user = trim($_POST['username']);
          $password = trim($_POST['userpassword']);
          $check_user = mysql_query("select * from user where username='$user' and password='$password'") or die(mysql_error());
          if(mysql_num_rows($check_user)<=0)
          {
              exit("<meta http-equiv=refresh content=0;url=login.php>");
          }
          else
          {
              $_SESSION['sess'] = session_id();
              while($row= mysql_fetch_array($check_user))
              {
                    $_SESSION['priviledge']=$row['priviledge'];
                    $_SESSION['user']=$row['username'];
                    $_SESSION['password']=$row['password'];
                    $_SESSION['icon']=$row['icon'];
              }
              
          }
          
      }
  }
 else {
     if(isset($_SESSION['sess']))
     {
         if($_SESSION['sess']!= session_id() || $_SESSION['priviledge']  != '0')
         {
             exit("<meta http-equiv=refresh content=0;url=login.php>");
         } 
     }
     else
     {
         exit("<meta http-equiv=refresh content=0;url=login.php>");
     }
          
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Room Booking | Control Panel</title>
<link href="styles/layout.css" rel="stylesheet" type="text/css" />
<link href="styles/wysiwyg.css" rel="stylesheet" type="text/css" />
<!-- Theme Start -->
<link href="themes/blue/styles.css" rel="stylesheet" type="text/css" />
<!-- Theme End -->
<script src="../js/jquery.js" type="text/javascript" ></script>
<script src="../js/jquery-ui-1.8.13.custom.min.js"  type="text/javascript"></script>
<script src="../js/jquery.min.js"  type="text/javascript"></script>
<script src="../js/jquery.miniColors.js"  type="text/javascript"></script>
<script src="../js/jquery.wysiwyg.js"  type="text/javascript"></script>
<script src="../js/custom.js"  type="text/javascript"></script>
<script src="callserver.js"  type="text/javascript"></script>

<script>    
    function over(id)
    {
         jQuery("#"+id+"").addClass("selected");
    }
    function mouseout(id)
    {
        jQuery("#"+id+"").removeClass("selected");
    }
    function addcurrent(id)
    {
        var li = document.getElementById("nav2").getElementsByTagName("li");
        for(i=0;i<li.length;i++)
        {
            var name = li[i].getAttribute("id"); 
            
            jQuery("#"+name+" a").removeClass("selected");
            
        }var li = document.getElementById("nav3").getElementsByTagName("li");
        for(i=0;i<li.length;i++)
        {
            var name = li[i].getAttribute("id"); 
            
            jQuery("#"+name+" a").removeClass("selected");
            
        }
        
        var menu = document.getElementById(id).getElementsByTagName("a")[0].firstChild.nodeValue;          
           document.getElementById("current_menu").innerHTML=menu;
           
           jQuery("#heading_menu h2").html(menu);
           jQuery("#heading_menu").addClass("headings");
           jQuery("#heading_menu").addClass("altheading");
           
        var li = document.getElementById("nav1").getElementsByTagName("li");
        for(i=0;i<li.length;i++)
        {
            var name = li[i].getAttribute("id"); 
            if(name ==id)
            {
                    jQuery("#"+id+" a").addClass("selected");
            }
            else
            {
                    jQuery("#"+name+" a").removeClass("selected");
            }
        }
        
        if(id=='li_booking')
        {
            jQuery.get("roombooking.php", {value:""}, function(data){
                    jQuery("#title_content").html(data);                  
            });
        }
        else if(id=='li_daily')
        { 
            jQuery.get("getbookinglist.php",{value:''},function(data){
                jQuery("#title_content").html(data);
                jQuery("#search_room").click();
            });
        }
        else if(id=='li_payin')
        { 
            jQuery.get("getpayin.php",{value:''},function(data){
                jQuery("#title_content").html(data);                
            });
        }
        else if(id=='li_cancel')
        {
            jQuery.get("getcancelbooking.php",{value:''},function(data){
                jQuery("#title_content").html(data);                
            });
        }
        else if(id=='li_paid')
        {
             jQuery.get("getpaidlist.php",{value:''},function(data){
                jQuery("#title_content").html(data); 
                jQuery("#search_room").click();
            });   
        }
    }
    function addcurrent2(id)
    {
        var li = document.getElementById("nav1").getElementsByTagName("li");
        for(i=0;i<li.length;i++)
        {
            var name = li[i].getAttribute("id"); 
            
            jQuery("#"+name+" a").removeClass("selected");
            
        }
        var li = document.getElementById("nav3").getElementsByTagName("li");
        for(i=0;i<li.length;i++)
        {
            var name = li[i].getAttribute("id"); 
            
            jQuery("#"+name+" a").removeClass("selected");
            
        }
        
        var subheading = jQuery("#heading1").text();
        var menu = document.getElementById(id).getElementsByTagName("a")[0].firstChild.nodeValue;          
        document.getElementById("current_menu").innerHTML=subheading+" / "+menu;
        
        jQuery("#heading_menu h2").html(menu);
        jQuery("#heading_menu").addClass("headings");
        jQuery("#heading_menu").addClass("altheading");
        
        var li = document.getElementById("nav2").getElementsByTagName("li");
        for(i=0;i<li.length;i++)
        {
            var name = li[i].getAttribute("id");  
            if(name ==id)
            {
                    jQuery("#"+id+" a").addClass("selected"); 
            }
            else
            {
                    jQuery("#"+name+" a").removeClass("selected");
            }
        }
        if(id=='typeroomsetting')
        {
             jQuery.get("roomtype.php", {value:""}, function(data){
                    jQuery("#title_content").html(data);        
            });   
        }
        else if(id=='roomsetting')
        {
             jQuery.get("roomsetting.php", {value:""}, function(data){
                    jQuery("#title_content").html(data);
                    jQuery("#search_room").click();
            });
        }
        else if(id=='setapprove')
        {
            jQuery.get("approvesetting.php", {value:""}, function(data){
                    jQuery("#title_content").html(data);                  
            });
        }
        else if(id=='setpreday')
        {
            jQuery.get("setpretime.php", {value:""}, function(data){
                    jQuery("#title_content").html(data);                  
            });
        }
        else if(id=='setpayment')
        {
            jQuery.get("setpayment.php",{value:''},function(data){
                jQuery("#title_content").html(data);
            });
        }
        
    }
    function addcurrent3(id)
    {
        var li = document.getElementById("nav1").getElementsByTagName("li");
        for(i=0;i<li.length;i++)
        {
            var name = li[i].getAttribute("id"); 
            
            jQuery("#"+name+" a").removeClass("selected");
            
        }
        var li = document.getElementById("nav2").getElementsByTagName("li");
        for(i=0;i<li.length;i++)
        {
            var name = li[i].getAttribute("id"); 
            
            jQuery("#"+name+" a").removeClass("selected");
            
        }
        
        var subheading = jQuery("#heading2").text();
        var menu = document.getElementById(id).getElementsByTagName("a")[0].firstChild.nodeValue;           
        document.getElementById("current_menu").innerHTML=subheading+" / "+menu;
        
        var li = document.getElementById("nav3").getElementsByTagName("li");
        for(i=0;i<li.length;i++)
        {
            var name = li[i].getAttribute("id"); 
            if(name ==id)
            {
                    jQuery("#"+id+" a").addClass("selected");
            }
            else
            {
                    jQuery("#"+name+" a").removeClass("selected");
            }
        } 
        if(menu=='ข้อมูลทั่วไป')
        {
              call_setsiteinfo();  
        }
        else if(menu=='ผู้ใช้งานระบบ')
        {
            call_setuser();
        }
       else if(menu=='ข้อมูลการติดต่อ')
       {
             call_contactinfo();  
       }
       else if(menu=='เกี่ยวกับบริษัท')
       {
            call_aboutcompany();   
       }
    }
    function account(user)
    {
        jQuery.ajax({
            type:"POST",
            url: "account.php",
            data: "user="+user,
            success: function(data){
                jQuery("#title_content").html(data);
            }
        });
    }
</script>

</head>
<body id="homepage">
	<div id="header">
    	<a href="" title=""><img src="img/cp_logo.png" alt="Control Panel" class="logo" /></a>
    	
    </div>
        
    <!-- Top Breadcrumb Start -->
    <div id="breadcrumb">
    	<ul>	
        	<li><img src="img/icons/icon_breadcrumb.png" alt="Location" /></li>
        	<li><strong>Location:</strong></li>
            <li class="current">Control Panel</li>
            <li>/</li>
            <li class="current" id="current_menu"></li>
        </ul>
    </div>
    <!-- Top Breadcrumb End -->
     
    <!-- Right Side/Main Content Start -->
    <div id="rightside">
    
    	
        
        <!-- Alternative Content Box Start -->
         <div class="contentcontainer">
            <div class="headings altheading" id="heading_menu">
                <h2>Title</h2>
            </div>
            <div class="contentbox" id="title_content">
            	
                
                <div style="clear: both;"></div>
            </div>
            
        </div>
        <!-- Alternative Content Box End -->
        
        
        
        <div style="clear:both;"></div>

        <!-- Content Box Start -->
        
        <?php include("compose/footer.php"); ?>
          
    </div>
    <!-- Right Side/Main Content End -->
    
        <!-- Left Dark Bar Start -->
    <div id="leftside">
    	<div class="user">
        	<img src="<?php echo $_SESSION['icon']; ?>" width="44" height="44" class="hoverimg" alt="Avatar" />            
            <p class="username"><?php echo $_SESSION['user'];?></p>
            <p class="userbtn"><a href="javascript:account('<?php echo $_SESSION['user'];?>')" title="">account</a></p>  
            <p class="userbtn"><a href="logout.php" title="">Log out</a></p>
        </div>
       
        <ul id="nav">
        	<li>
                <ul class="navigation" id="nav1">
                    <li id="li_paid" onclick="addcurrent(this.id)" ><a>ข้อมูลการโอนเงิน</a></li>
                    <li id="li_booking" onclick="addcurrent(this.id)" ><a>จองห้องประชุม</a></li>
                    <li id="li_payin" onclick="addcurrent(this.id)" ><a>แจ้งการชำระเงิน</a></li>
                   <li id="li_daily" onclick="addcurrent(this.id)" ><a>ข้อมูลการจอง</a></li>
                   <li id="li_cancel" onclick="addcurrent(this.id)" ><a>ยกเลิกการจอง</a></li>
                   <!--<li id="li_income" onclick="addcurrent(this.id)" ><a>ข้อมูลรายรับ</a></li> -->                   
                </ul>
            </li>
            <li>
                <a class="collapsed heading" id="heading1">จัดการข้อมูลห้องประชุม</a>
                 <ul class="navigation" id="nav2">
                     <li id="typeroomsetting" onclick="addcurrent2(this.id)" ><a>กำหนดประเภทห้องประชุม</a></li>
                    <li id="roomsetting" onclick="addcurrent2(this.id)" ><a>กำหนดห้องประชุม</a></li>
                    
                   <!-- <li id="periodtime" onclick="addcurrent2(this.id)" ><a>กำหนดช่วงเวลา</a></li>  -->
                   
                    <li id="setapprove" onclick="addcurrent2(this.id)" ><a>กำหนดการอนุมัติ</a></li>                    
                    <li id="setpreday" onclick="addcurrent2(this.id)" ><a>กำหนดวันจองล่วงหน้า</a></li>
                    <li id="setpayment" onclick="addcurrent2(this.id)" ><a>กำหนดข้อมูลชำระเงิน</a></li> 
                </ul>
            </li>
            <li><a class="expanded heading" id="heading2">จัดการเว็บไซต์</a>
                <ul class="navigation" id="nav3">
                    <li id="geninfo" onclick="addcurrent3(this.id)"><a>ข้อมูลทั่วไป</a></li>
                 <!--   <li id="connectdb" onclick="addcurrent3(this.id)"><a>การเชื่อมต่อฐานข้อมูล</a></li>  -->
                     <li id="setcontactus" onclick="addcurrent3(this.id)"><a>ข้อมูลการติดต่อ</a></li>
                    <li id="setaboutus" onclick="addcurrent3(this.id)"><a>เกี่ยวกับบริษัท</a></li>
                    <li id="setuser" onclick="addcurrent3(this.id)"><a>ผู้ใช้งานระบบ</a></li>
                </ul>
            </li>            
        </ul>
    </div>
    <!-- Left Dark Bar End --> 
    
    <!-- Notifications Box/Pop-Up Start --> 
    
    
    <script type="text/javascript" src="http://dwpe.googlecode.com/svn/trunk/_shared/EnhanceJS/enhance.js"></script>	
    <script type='text/javascript' src='http://dwpe.googlecode.com/svn/trunk/charting/js/excanvas.js'></script>
	<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js'></script>
    <script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.6/jquery-ui.min.js'></script>
	<script type='text/javascript' src='scripts/jquery.wysiwyg.js'></script>
    <script type='text/javascript' src='scripts/visualize.jQuery.js'></script>
    <script type="text/javascript" src='scripts/functions.js'></script>
    
    <!--[if IE 6]>
    <script type='text/javascript' src='scripts/png_fix.js'></script>
    <script type='text/javascript'>
      DD_belatedPNG.fix('img, .notifycount, .selected');
    </script>
    <![endif]--> 
</body>
</html>
<?php  mysql_close($link); ?>