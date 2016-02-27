<?php
         include_once("../connectdb.php");  
         $result = mysql_query("update reserved_room 
                                          set status='approved'
                                          where transaction_id='{$_GET['value']}'");
          if($result)
          {
              echo"1";
          }
?>
