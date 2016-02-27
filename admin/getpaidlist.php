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
        <link href="../css/datePicker.css" rel="stylesheet" type="text/css" />
        <link href="../css/smoothness/jquery-ui-1.8.13.custom.css" rel="stylesheet" type="text/css" />
        <script src="../js/jquery.js" type="text/javascritp" ></script>
        <script src="../js/jquery-ui-1.8.13.custom.min.js"  type="text/javascript"></script>
        <script src="../js/jquery.min.js"  type="text/javascript"></script> 
        <script src="../js/datepicker/jquery.ui.core.js" type="text/javascript"></script>
        <script src="../js/datepicker/jquery.ui.datepicker.js" type="text/javascript"></script>
    <script type="text/javascript">
        
        $(document).ready(function(){
             $(".datepic").datepicker();
             
             $("#rdroom").click(function(){
                 $("#rdtransac").attr("checked",false);
                 $("#transacid").attr("disabled",true);
                 $("#select_room").attr("disabled",false);
                 $("#select_typeroom").attr("disabled",false);
                 $("#select_status").attr("disabled",false);
                 $("#search_date1").attr("disabled",false);
                 $("#search_date2").attr("disabled",false);
             });
             $("#rdtransac").click(function(){
                 $("#rdroom").attr("checked",false);
                 $("#transacid").attr("disabled",false);
                 $("#select_room").attr("disabled",true);
                 $("#select_typeroom").attr("disabled",true);
                 $("#select_status").attr("disabled",true);
                 $("#search_date1").attr("disabled",true);
                 $("#search_date2").attr("disabled",true);
             });
           
        });
    
        function searchbooking()
        {
            var search2 = $("#transacid").is(":disabled");
            if(search2)
            {
                 
                 var date1=jQuery("#search_date1").val();
                 var date2=jQuery("#search_date2").val();

                jQuery.ajax({        
                    type: "POST",
                    url: "searchpaid.php",
                    data: "date1="+date1+"&date2="+date2,
                    success: function(data) {
                         jQuery("#display2").html(data);
                    }
                 });    
            }
            else
            {
                   var transactid = $("#transacid").val();
                   if($.trim(transactid)=='')
                   {
                       alert("กรุณาใส่รหัสจองก่อนค่ะ");
                   }
                   else
                   {
                       jQuery.ajax({        
                        type: "POST",
                        url: "searchpaid.php",
                        data: "transactid="+transactid,
                        success: function(data) {
                             jQuery("#display2").html(data);
                        }
                     });  
                   }
                   
            }
            
        }
        
    </script>
     </head>

<form name="frm_search_room">
    <input type="radio" name="rdroom" id="rdroom" checked="checked"/>
    ค้นหาจาก  
  
    
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;วันที่&nbsp; 
    <input type="text" name="search_date1" id="search_date1" value="<?php echo date("m/d/Y",strtotime(date("Y-m-d H:i:s")));?>" readonly="readonly" class="datepic" size="10"/>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ถึงวันที่&nbsp;
    <input type="text" name="search_date2" id="search_date2" value="<?php echo date("m/d/Y",strtotime(date("Y-m-d H:i:s")));?>" readonly="readonly" class="datepic" size="10"/>
       
    <div>&nbsp;</div>
    <div>
        <input type="radio" name="rdtransac" id="rdtransac" />
        ค้นหาจากรหัสการจอง&nbsp;&nbsp;<input type="text" placeholder="ป้อนรหัสการจองที่นี่" size="20" maxlength="22" id="transacid" name="transacid" disabled="disabled"/>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="javascript:searchbooking()"><button type="button" name="search_room" id="search_room"><img src="img/search-icon.png" width="23" height="23">ค้นหา</button></a>
    
    </div>
    
</form>
     
     <div id="display2" style="margin-top: 50px;">
     </div>
</html>