
<html>
    <head>        
        <link href="../css/style.css" rel="stylesheet" type="text/css" />
        <link href="../css/datePicker.css" rel="stylesheet" type="text/css" />
        <link href="../css/ui-slider.css" rel="stylesheet" type="text/css" />
        <link href="../css/wysiwyg.css" rel="stylesheet" type="text/css" />
        <link href="../css/fullcalendar.css" rel="stylesheet" type="text/css" />
        <link href="../css/custom.css" rel="stylesheet" type="text/css" />
        <link href="../css/elfinder.css" rel="stylesheet" type="text/css" />        
        <link href="../css/jquery.fancybox.css" rel="stylesheet" type="text/css" />
        <link href="../css/jquery.miniColors.css" rel="stylesheet" type="text/css" />
        <link href="../css/smoothness/jquery-ui-1.8.13.custom.css" rel="stylesheet" type="text/css" />        
        
        <script src="../js/jquery.js" type="text/javascritp" ></script>
        <script src="../js/jquery-ui-1.8.13.custom.min.js" type="text/javascript"></script>
        <script src="../js/jquery.min.js" type="text/javascritp" ></script>
        <script src="../js/datepicker/jquery.ui.core.js" type="text/javascript"></script>
        <script src="../js/datepicker/jquery.ui.datepicker.js" type="text/javascript"></script>
        <script src="../js/timepicker/jquery.ui.timepicker.js" type="text/javascript"></script>
        
        <script>
            $(document).ready(function(){
                var duringdate ;
                jQuery.get("getduringdate.php", function(data){
                    
                });
                
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
                
            });
            
            $(document).ready(function() {
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
                                url: "getsearch.php",
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
                                               url:  "getsearch.php",
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
                                               url:  "getsearch.php",
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
                         url:  "getsearch.php",
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
                        url:"form_reserve.php",
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
                width: 60%;
            }
            .tbselect td:first-child{
                width: 25%;
                
            }
            .tbselect td:last-child{
                width: 35%;
            }
            .selectbox{
                width: 220px;
            }
        </style>
    </head>
    
    <form frm="frm_search_room"> 
        
        <table class="tbselect">
            <tr>
                <td>จำนวนผู้เข้าร่วมประชุม</td>
                <td><input type="text" name="meeting_seat" id="meeting_seat" maxlength="5" size="10"/> คน</td>
                <td></td>
            </tr>
             <tr>
                <td>วันที่ต้องการจอง</td>
                <td><input type="text" id="date1" name="date1" class="timepicker" readonly="readonly" size="30"/></td>
                <td></td>
            </tr>
             <tr>
                <td>ถึงวันที่</td>
                <td><input type="text" id="date2" name="date2" class="timepicker" readonly="readonly" size="30"/></td>
                <td><img src="img/ok_icon.png" width="25" height="25" id="getemptyroom" name="getemptyroom" /></td>
            </tr>
            
            <tr>
                <td>ประเภทห้องประชุม</td>
                <td>
                    <select name="get_type" id="get_type" class="selectbox">
                        
                    </select>
                </td>
                <td></td>
            </tr>
            <tr>
                <td>รายชื่อห้องประชุม</td>
                <td>
                    <select name="get_room" id="get_room" class="selectbox">
                        
                    </select>
                </td>
                <td></td>
            </tr>
            <tr>
                <td>เวลา</td>
                <td><input type="text" id="time1" name="time1" class="smalltimepicker" readonly="readonly" size="30"/></td>
                <td>*ระบุเวลาเริ่มต้นที่ต้องการใช้ห้องประชุม</td>
            </tr>
            <tr>
                <td>ถึงเวลา</td>
                <td><input type="text" id="time2" name="time2" class="smalltimepicker" readonly="readonly" size="30"/></td>
                <td>*ระบุเวลาสิ้นสุดในการใช้ห้องประชุม</td>
            </tr>
            <tr>
                <td></td>
                <td>
                   <button type="button" id="getlistroom" name="getlistroom"><img src="img/appointment.png" width="27" height="25" /> ทำรายการจอง</button> 
                </td>
                <td></td>
            </tr>
        </table>
    </form>
    <br/>
    <div id="reserve_form">
        
    </div>
    
</html>