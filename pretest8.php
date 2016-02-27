<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<html>
    <head>
    <script src="js/jquery.js" type="text/javascript" ></script>
    <script type="text/javascript">
        
         function calltest()
         {
            var resp;
            $.get('test.html', function(data) {
                 resp = $(data).find("#div1");   
                 if(resp)
                     {
                         alert($(data).load);
                     }
                     else
                     {
                         alert("not found");
                     }    
            }); 
           
         }
         
    </script>
    </head>
    <body>
        <a href="javascript:calltest()"><button type="button" >click me</button></a>
        <div id="selector"></div>
    </body>
</html>
