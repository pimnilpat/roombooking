<?php     
    include_once("connectdb.php");
    
   
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--

developer Info
Name       : Phimpika Nangam
E-mail     : Phim_n@hotmail.com
Version    : 1.0
Released   : 15/102012

-->
<html>
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Room Booking</title>
<link href='http://fonts.googleapis.com/css?family=Oswald:400,300' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Abel' rel='stylesheet' type='text/css' />
<link href="default.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/ui-slider.css" rel="stylesheet" type="text/css"  />
<link href="css/datePicker.css" rel="stylesheet" type="text/css"  />
<link href="css/ui-slider.css" rel="stylesheet" type="text/css" />
        <link href="css/wysiwyg.css" rel="stylesheet" type="text/css" />
        <link href="css/fullcalendar.css" rel="stylesheet" type="text/css" />
        <link href="css/custom.css" rel="stylesheet" type="text/css" />
        <link href="css/elfinder.css" rel="stylesheet" type="text/css" />        
        <link href="css/jquery.fancybox.css" rel="stylesheet" type="text/css" />
        <link href="css/jquery.miniColors.css" rel="stylesheet" type="text/css" />
        <link href="js/timepicker/jquery.ui.timepicker.css" rel="stylesheet" type="text/css" />
         <link href="css/custom.css" rel="stylesheet" type="text/css" />
         <link href="css/data-table.css" rel="stylesheet" type="text/css" />
         <link href="css/smoothness/jquery-ui-1.8.13.custom.css" rel="stylesheet" type="text/css"  />
<!--[if IE 6]>
<link href="default_ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.13.custom.min.js"></script>
<script type="text/javascript" src="js/fullcalendar.min.js"></script>
<script type="text/javascript" src="js/miniColors.js"></script>
<script type="text/javascript" src="js/slidernav.js"></script>
<script type="text/javascript" src="js/jquery.fancybox.js"></script>
<script type="text/javascript" src="js/jquery.wysiwyg.js"></script>
<script type="text/javascript" src="js/StickyScroller.min.js"></script>
<script type="text/javascript" src="js/jquery.simplemodal.js"></script>

<script type="text/javascript" src="js/datepicker/jquery.ui.core.js"></script>
<script type="text/javascript" src="js/datepicker/jquery.ui.datepicker.js"></script>
<script type="text/javascript" src="js/timepicker/jquery.ui.timepicker.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
<script type="text/javascript">
  
            $(document).ready(function() { 
                 var dateToday = new Date();
                var dateNext = new Date();
                dateToday.setDate(dateToday.getDate() + 1);
                dateNext.setDate(dateNext.getDate()+60);
                jQuery(".timepicker").datepicker({                    
                    showButtonPanel: true,                    
                    minDate: dateToday,
                    maxDate: dateNext
                    
                });
                
            $(".smalltimepicker").timepicker({});
                
                $("#getemptyroom").click(function(){
                    var date1=$("#date1").val();
                    var date2=$("#date2").val();
                    var attendee = $("#meeting_seat").val();
                    if(date1.length<=0)
                     {
                           alert("select begin date"); 
                     }
                     if(date2.length<=0)
                     {
                            alert("select end date"); 
                     }
                     if(date1.length>0 && date2.length > 0)
                     {
                         var intRegex = /[0-9 -()+]+$/;
                         var isnumber = attendee.match(intRegex);

                         if(attendee.length<=0 || isnumber==null)
                         {
                                   alert("Enter number of attendee at a meeting");               
                         }
                         else
                         {
                            $.ajax({
                                type:"POST",
                                url: "admin/getsearch.php",
                                data: "date1="+date1+"&date2="+date2+"&attendee="+attendee,
                                success:function(data){
                                    var arrtype=data.getElementsByTagName("type")[0].getElementsByTagName("name");
                                    var name=new Array();
                                    for(i=0;i<arrtype.length;i++)
                                    {
                                          name[i]=arrtype[i].firstChild.nodeValue; 
                                    }                                 

                                    var hasoption= $("#get_type").val();
                                    if(hasoption)
                                    {
                                           $('#get_type').empty(); 
                                           for(j=0;j<name.length;j++)
                                           {
                                                $("#get_type").append($("<option value="+name[j]+">"+name[j]+"</option>"));
                                           }

                                           var type=$("#get_type").val();
                                           $.ajax({
                                               type: "POST",
                                               url:  "admin/getsearch.php",
                                               data: "type="+type+"&date1="+date1+"&date2="+date2,
                                               success:function(data){
                                                   var room = data.getElementsByTagName("room")[0].getElementsByTagName("name");
                                                   var name=new Array()
                                                   for(r=0;r<room.length;r++)
                                                   {
                                                         name[r] = room[r].firstChild.nodeValue;  
                                                   } 
                                                   var hasoption= $("#get_room").val();
                                                   if(hasoption)
                                                   {
                                                              $('#get_room').empty(); 
                                                              for(j=0;j<name.length;j++)
                                                              {
                                                                  $("#get_room").append($("<option value="+name[j]+">"+name[j]+"</option>"));
                                                              }                                 

                                                   }
                                                    else
                                                     {
                                                          for(j=0;j<name.length;j++)
                                                           {
                                                                  $("#get_room").append($("<option value="+name[j]+">"+name[j]+"</option>"));
                                                           }                                 

                                                       }
                                               }
                                           }
                                           );
                                    }
                                    else
                                    {
                                         for(j=0;j<name.length;j++)
                                         {
                                             $("#get_type").append($("<option value="+name[j]+">"+name[j]+"</option>"));
                                         } 

                                         var type=$("#get_type").val();
                                         $.ajax({
                                               type: "POST",
                                               url:  "admin/getsearch.php",
                                               data: "type="+type+"&date1="+date1+"&date2="+date2,
                                               success:function(data){
                                                   var room = data.getElementsByTagName("room")[0].getElementsByTagName("name");
                                                   var name=new Array()
                                                   for(r=0;r<room.length;r++)
                                                   {
                                                         name[r] = room[r].firstChild.nodeValue;  
                                                   } 
                                                   var hasoption= $("#get_room").val();
                                                   if(hasoption)
                                                   {
                                                              $('#get_room').empty(); 
                                                              for(j=0;j<name.length;j++)
                                                              {
                                                                  $("#get_room").append($("<option value="+name[j]+">"+name[j]+"</option>"));
                                                              }                                 

                                                   }
                                                    else
                                                     {
                                                          for(j=0;j<name.length;j++)
                                                           {
                                                                  $("#get_room").append($("<option value="+name[j]+">"+name[j]+"</option>"));
                                                           }                                 

                                                       }
                                               }
                                           }
                                           );

                                    }

                                }

                            });
                         }
                     }
                });
                
                $("#get_type").change(function(){
                     var type=$("#get_type").val();
                     var date1=$("#date1").val();
                     var date2=$("#date2").val();
                     $.ajax({
                         type: "POST",
                         url:  "admin/getsearch.php",
                         data: "type="+type+"&date1="+date1+"&date2="+date2,
                         success:function(data){
                             var room = data.getElementsByTagName("room")[0].getElementsByTagName("name");
                             var name=new Array()
                             for(r=0;r<room.length;r++)
                             {
                                   name[r] = room[r].firstChild.nodeValue;  
                             } 
                             var hasoption= $("#get_room").val();
                             if(hasoption)
                             {
                                        $('#get_room').empty(); 
                                        for(j=0;j<name.length;j++)
                                        {
                                            $("#get_room").append($("<option value="+name[j]+">"+name[j]+"</option>"));
                                        }                                 

                             }
                              else
                               {
                                    for(j=0;j<name.length;j++)
                                     {
                                            $("#get_room").append($("<option value="+name[j]+">"+name[j]+"</option>"));
                                     }                                 

                                 }
                         }
                     }
                     );
                }                      
                );
                
                $("#getlistroom").click(function(){ 
                    var roomname = $("#get_room").val(); 
                    if(roomname==null)
                    {
                          alert("select room");
                    }
                    else
                    {
                          //alert(roomname);  
                          var fromdate=$("#date1").val();
                          var todate=$("#date2").val();
                          var roomtype=$('#get_type').val();
                          var attendee = $('#meeting_seat').val();
                          var time1=$("#time1").val();
                          var time2=$("#time2").val();
                          
                    $.ajax({
                        type:"POST",
                        url:"form_reserve_custom.php",
                        data:"fromdate="+fromdate+"&todate="+todate+"&roomtype="+roomtype+"&roomname="+roomname+"&attendee="+attendee+"&time1="+time1+"&time2="+time2,
                        success:function(data){
                            //alert(data);
                            $("#reserve_form").html(data);
                        }
                    });
                    }
                });
            });
            
           
</script>
<style type="text/css">
            .tbselect{
                width: 70%;
            }
            .tbselect td:first-child{
                width: 25%;
                
            }
            .tbselect td:last-child{
                width: 45%;
            }
            .selectbox{
                width: 220px;
            }
</style>
</head>
<body>
    
<?php include("compose/header_menu.php");?>


<div id="page-wrapper-2">

</div>
<div id="footer-wrapper">
	<div id="footer-content">
            <div style="font-weight: bold;">ข้อมูลสำหรับการจอง</div>
            
             <form frm="frm_search_room"> 
        
        <table class="tbselect">
            <tr>
                <td>จำนวนผู้เข้าร่วมประชุม</td>
                <td><input type="text" name="meeting_seat" id="meeting_seat" maxlength="5" size="10"/> คน</td>
                <td>&nbsp;&nbsp;1. ระบุจำนวนผู้เข้าประชุม</td>
            </tr>
             <tr>
                <td>วันที่ต้องการจอง</td>
                <td><input type="text" id="date1" name="date1" class="timepicker" readonly="readonly" size="30"/></td>
                <td>&nbsp;&nbsp;2. ระบุวันที่ต้องการใช้หอ้งประชุม</td>
            </tr>
             <tr>
                <td>ถึงวันที่</td>
                <td><input type="text" id="date2" name="date2" class="timepicker" readonly="readonly" size="30"/></td>
                <td><img src="admin/img/ok_icon.png" width="25" height="25" id="getemptyroom" name="getemptyroom" />&nbsp; 3. คลิกปุ่มนี้เพื่อเรียกดูรายการห้องที่ว่าง</td>
            </tr>
            
            <tr>
                <td>ประเภทห้องประชุม</td>
                <td>
                    <select name="get_type" id="get_type" class="selectbox">
                        
                    </select>
                </td>
                <td>&nbsp;&nbsp;4. เลือกประเภทห้องประชุมที่คุณต้องการ</td>
            </tr>
            <tr>
                <td>รายชื่อห้องประชุม</td>
                <td>
                    <select name="get_room" id="get_room" class="selectbox">
                        
                    </select>
                </td>
                <td>&nbsp;&nbsp;5. เลือกห้องประชุมที่ต้องการจอง</td>
            </tr>
            <tr>
                <td>เวลา</td>
                <td><input type="text" id="time1" name="time1" class="smalltimepicker" readonly="readonly" size="30"/>
                
                </td>
                <td>&nbsp;&nbsp;6. ระบุเวลาเริ่มต้นที่ต้องการใช้ห้องประชุม</td>
            </tr>
            <tr>
                <td>ถึงเวลา</td>
                <td><input type="text" id="time2" name="time2" class="smalltimepicker" readonly="readonly" size="30"/>
                
                </td>
                <td>&nbsp;&nbsp;7. ระบุเวลาสิ้นสุดในการใช้ห้องประชุม</td>
            </tr>
            <tr>
                <td></td>
                <td>
                   <button type="button" id="getlistroom" name="getlistroom" onclick="getlistroom()"><img src="admin/img/appointment.png" width="27" height="25" /> ทำรายการจอง</button> 
                </td>
                <td></td>
            </tr>
        </table>
    </form>
    <br/>
    <div id="reserve_form">
        
    </div>
             </div>
</div>
<?php 
    include("compose/footer.php");
?>
</body>
</html>
