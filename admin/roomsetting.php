<?php
include_once("../connectdb.php");

$result = mysql_query("select * from list_room order by name");
$room = array();
$i=0;
while($row=mysql_fetch_array($result))
{
    $room[$i]['name']=$row['name'];
    $room[$i]['pic']=$row['picture'];
    $room[$i]['type']=$row['type'];
    $i++;
}

?>
<html>
    <head>
        <script src="../js/jquery.js" type="text/javascritp" ></script>
        <script src="../js/jquery-ui-1.8.13.custom.min.js"  type="text/javascript"></script>
        <script src="../js/jquery.min.js"  type="text/javascript"></script>
   
    <script type="text/javascript">
        
        function searchroom()
        {
            var type=jQuery("#select_typeroom").val();
            var room=jQuery("#select_room").val();
            
            jQuery.ajax({        
                type: "POST",
                url: "searchroom.php",
                data: "type="+type+"&room="+room,
                success: function(data) {
                     jQuery("#display").html(data);
                }
             }); 
        }
        function addroom()
        {
            jQuery.ajax({
                type:"POST",
                url:"addroom.php",
                success:function(data){
                    jQuery("#title_content").html(data);
                }
            });
        }
    </script>
     </head>

<form name="frm_search_room">
    ค้นหา&nbsp;&nbsp;<select name="select_typeroom" id="select_typeroom">
        <option value="0">เลือกประเภทห้องประชุม</option>
        <?php
        $query_type = mysql_query("select * from roomtype order by name");
        while($t=  mysql_fetch_array($query_type))
        {
         ?>
        <option value="<?php echo $t['name'];?>"><?php echo $t['name'];?></option>
        <?php
        }
        ?>
    </select>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <?php
         $query_name = mysql_query("select * from list_room  order by name");
    ?>
    <select name="select_room" id="select_room">
        
        <option value="0">เลือกห้องประชุม</option>
    <?php 
    while($room= mysql_fetch_array($query_name))
    { echo "romm=".$room['name'];
       ?>
        <option value="<?php echo $room['name'];?>"><?php echo $room['name'];?></option>
        <?php
    }
    ?>
    </select>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <a href="javascript:searchroom()"><button type="button" name="search_room" id="search_room"><img src="img/search-icon.png" width="23" height="23">ค้นหา</button></a>
    
</form>
     <div  style="float: right;">
     <span><a href="javascript:addroom()"><button type="button" name="btn_addroom" id="btn_addroom" ><img src="img/plus.png" width="23" height="23"/>เพิ่มรายชื่อห้อง</button></a></span>
     </div>
     <div id="display" style="margin-top: 50px;">
     </div>
</html>