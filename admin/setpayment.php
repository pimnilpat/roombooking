<?php
include_once("../connectdb.php");
?>
<html>
    <head>
        <script src="../js/jquery.js" type="text/javascritp" ></script>
        <script type="text/javascript">
            function editpayment(accountid)
            {
                $.get("editpayment.php",{account:accountid},function(data){
                    $("#title_content").html(data);
                });
            }
            function addpayment()
            {
                $.get("addpayment.php",function(data){
                    $("#title_content").html(data);                    
                });
            }
            function addaccount(id)
            {
                
                $.get("add_account_list.php",{value:id},function(data){
                    $("#title_content").html(data);                    
                });
            }
        </script>
        <style>
            .tbpayment
            {
                width: 100%;                
            }
            .tbpayment .th1
            {
                width:20%;
            }
            .tbpayment .th2
            {
                width:20%;
            }
            .tbpayment .th3
            {
                width:20%;
            }
            .tbpayment .th4
            {
                width:20%;
            }
            .tbpayment .th5
            {
                width:20%;               
            }
        </style>
    </head>
    
     <table class="tbpayment">
         <thead>
             <tr>
                 <th class="th1">ธนาคาร</th>
                 <th class="th2">ชื่อบัญชี</th>
                 <th class="th3">เลขที่บัญชี</th>
                 <th class="th4">สาขา</th>
                 <th class="th5">ประเภทบัญชี</th>
             </tr>
         </thead>
         <tbody>
          <?php
          $result = mysql_query("select * from payment order by bank_name");
          while($row= mysql_fetch_array($result))
          {
            ?>
             <tr>
                 <td><?php echo $row['bank_name'];?></td>
                 <td><?php echo $row['accountname'];?></td>
                 <td><a href="javascript:editpayment('<?php echo $row['bank_no'];?>')"><?php echo $row['bank_no'];?></a></td>
                 <td><?php echo $row['bank_branch'];?></td>
                 <td><?php echo $row['accounttype'];?></td>
             </tr>
             <?php
          }
          ?>
         </tbody>
     </table>
    <p>&nbsp;</p>
    <button type="button" id="addpayment" name="addpayment" onclick="javascript:addpayment()"><img src="img/plus.png" />เพิ่มบัญชี</button>
    <button type="button" id="editbanklist" name="editbanklist" onclick="javascript:addaccount(this.id)"><img src="img/edit_icon.png" width="25" height="25"/>แก้ไขรายชื่อธนาคาร</button>
    <button type="button" id="editaccounttype" name="editaccounttype" onclick="javascript:addaccount(this.id)"><img src="img/edit_icon.png" width="25" height="25" />แก้ไขประเภทบัญชี</button>
    </html>