<?php

?>
<html>
    <head>
        <script src="../js/jquery.js" type="text/javascritp" ></script>
        <script>
            function callpayin()
            {
                var transac = $("#txt_transac").val();
                if($.trim(transac)=='')
                {
                       alert("กรุณาใส่รหัสการจองก่อนค่ะ"); 
                }
                else
                {
                      jQuery.get("cancelpayin.php",{value:transac},function(data){
                           jQuery("#title_content").html(data);                
                     });    
                }
            }
        </script>
    </head>
    <table style="width:65%;">
        <tr>
            <td>รหัสการจองที่ต้องการยกเลิก</td>
            <td>
                <input type="text" name="txt_transac" id="txt_transac" maxlength="30" size="30"/>
                <button type="button" name="btnpayin" id="btnpayin" onclick="callpayin()">ยกเลิก</button>
            </td>
            
        </tr>        
    </table>
</html>