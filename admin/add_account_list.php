<?php
include_once("../connectdb.php");
?>
<html>
    <head>
        <script src="../js/jquery.js" type="text/javascritp" ></script>
        <script>
            function addlist(choice){
                var bankname=$("#txt_bankname").val();
                var typename=$("#txt_acctype").val();
                
                
                    if(choice=='addbank')
                    {
                         if($.trim(bankname)==''){
                                alert("Enter data");
                         }
                         else
                         {
                                 var name= bankname;
                                 $.get("save_account_list.php",{menu:choice,action:"add",options:"",addname:name},function(data){
                                alert(data);
                                if(data=='save complete')
                                    {
                                       $("#setpayment").click(); 
                                    }
                                });   
                
                         }                        
                    }
                     else if(choice=='addacctype')
                     {
                         if($.trim(typename)==''){
                                alert("Enter data");
                         }
                         else
                         {
                               var name= typename; 
                               $.get("save_account_list.php",{menu:choice,action:"add",options:"",addname:name},function(data){
                                alert(data);
                                if(data=='save complete')
                                    {
                                       $("#setpayment").click(); 
                                    }
                                });   
                
                         }                            
                     }                 
                     
                
            }
            function delaction(name,option)
            {
                $.get("save_account_list.php",{menu:name,action:"del",options:option},function(data){
                      alert(data);
                      if(data=='delete complete')
                          {
                              $("#setpayment").click();
                          }
                      
                });
            }
        </script>
        <style>
            .tblist
            {
                width:50%;
            }
            .tblist td:first-child
            {
                width:5%;
                text-align: right;
                padding-right: 20px;
            }
            .tblist td:last-child
            {
                width: 5%;
                text-align: center;
            }
            .tblist td.td2
            {
                width:40%;
                padding-left: 20px;
            }
            .tblist th.thfirst
            {
                text-align: right;
                width:5%;
                padding-right: 20px;
            }
            .tblist th:last-child
            {
                width:5%;
                text-align: center;
            }
            .tblist th.th2
            {
                padding-left: 20px;
                width: 40%;
            }
        </style>
    </head>
<?php
if($_GET['value']=='editbanklist')
{
    ?>
    <table class="tblist">
        <tr>
        <th class="thfirst">No</th>        
        <th class="th2">Name</th>
        <th>Action</th>
        </tr>
      <?php
      $result = mysql_query("select * from banklist order by bank_name");
      $no=1;
      while($row = mysql_fetch_array($result))
      {
         ?>
        <tr>
            <td><?php echo $no++;?></td>                      
            <td class="td2"><?php echo $row['bank_name'];?></td>
            <td><a href="javascript:delaction('<?php echo $row['bank_name'];?>','bank')"><img src="img/delete_icon.png" style="border:none; width:21px; height:21px;" title="delete"/></a></td>
        </tr>
        <?php
      }
      ?>
    </table>
    <br /><br />
    เพิ่มรายชื่อธนาคาร
    <input type="text" name="txt_bankname" id="txt_bankname" size="50" maxlength="50"/>
    <button type="button" onclick="addlist('addbank')"><img src="img/plus.png" width="22" height="22"/>บันทึก</button>
    <?php
}
elseif($_GET['value']=='editaccounttype')
{
    ?>
    <table class="tblist">
        <tr>
        <th  class="thfirst">No</th>       
        <th class="th2">Type Name</th>
        <th>Action</th>
        </tr>
        <?php
      $result = mysql_query("select * from bank_account_type order by type_name");
      $no=1;
      while($row = mysql_fetch_array($result))
      {
         ?>
        <tr>
            <td><?php echo $no++;?></td>                     
            <td class="td2"><?php echo $row['type_name'];?></td>
            <td><a href="javascript:delaction('<?php echo $row['type_name'];?>','type')"><img src="img/delete_icon.png" style="border:none; width:21px; height:21px;" title="delete"/></a></td>
        </tr>
        <?php
      }
      ?>
    </table>
    <br/><br />
    เพิ่มประเภทบัญชี 
    <input type="text" name="txt_acctype" id="txt_acctype" size="50" maxlength="50"/>
    <button type="button" onclick="addlist('addacctype')"><img src="img/plus.png" width="22" height="22"/>บันทึก</button>
    <?php
}
?>
</html>