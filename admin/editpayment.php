<?php
include_once("../connectdb.php");
$bank_account = array();
$result = mysql_query("select * from payment where bank_no='{$_GET['account']}'");
while($row = mysql_fetch_array($result))
{
    $bank_account['bankname'] = $row['bank_name'];
    $bank_account['accountname'] = $row['accountname'];
    $bank_account['accountno'] = $row['bank_no'];
    $bank_account['accounttype'] = $row['accounttype'];
    $bank_account['bankbranch'] = $row['bank_branch'];
}
?>
<html>
    <head>
        <script src="../js/jquery.js" type="text/javascript" ></script>
        <script>
            function editpayment(id,account)
            {
                //alert(id+"  > "+account);
                if(id=='del_payment')
                {
                      var del=confirm("delete account "+account+" ?");
                      if(del)
                       {
                           jQuery.get("save_editpayment.php",{accountno:account,action:"delete"}, function(data){
                               alert(data);
                               jQuery("#setpayment").click();
                           })
                       }
                }
                else if(id=='saved_editpayment')
                {
                      var bankname=jQuery("#selectbank").val();
                      var accname=jQuery("#txt_accountname").val();
                      var accno = jQuery("#txt_accountno").val();
                      var banktype=jQuery("#selectbanktype").val();
                      var bankbranch=jQuery("#txt_bankbranch").val();
                      jQuery.get("save_editpayment.php",{accountno:account,action:"update",bankname:bankname,accname:accname,accno:accno,banktype:banktype,bankbranch:bankbranch}, function(data){
                               alert(data);
                               jQuery("#setpayment").click();
                           })  
                }
            }
        </script>
        <style>
            .tbeditpayment
            {
                width: 70%;
            }
            .tbeditpayment td:first-child
            {
                width: 20%;
                text-align: right;
                padding-right: 20px;
            }
            .tbeditpayment td:last-child{
                width: 80%;
            }
            .selectbox
            {
                width: 220px;
            }
        </style>
    </head>
    <table class="tbeditpayment">
        <tr>
            <td>ธนาคาร</td>
            <td>
                <?php
                $banklist=  mysql_query("select bank_name from banklist order by bank_name");
                ?>
                <select name="selectbank" class="selectbox" id="selectbank">
                   <?php
                   while($bank=mysql_fetch_array($banklist))
                   { 
                       if($bank_account['bankname']==$bank['bank_name'])
                       {
                        ?>
                            <option value="<?php echo $bank['bank_name'];?>" selected="selected"><?php echo $bank['bank_name'];?></option>
                       <?php
                       }
                       else
                       {
                           ?>
                            <option value="<?php echo $bank['bank_name'];?>"><?php echo $bank['bank_name'];?></option>
                           <?php
                       }
                       
                   }
                   
                   ?>
                            
                </select>
            </td>
        </tr>
        <tr>
            <td>ชื่อบัญชี</td>
            <td><input type="text" name="txt_accountname" id="txt_accountname" value="<?php echo $bank_account['accountname'];?>" size="40"/></td>
        </tr>
        <tr>
           <td>เลขที่บัญชี</td>
            <td><input type="text" name="txt_accountno" id="txt_accountno" value="<?php echo $bank_account['accountno'];?>" size="40"/></td> 
        </tr>
        <tr>
            <td>สาขา</td>
            <td><input type="text" name="txt_bankbranch" id="txt_bankbranch" value="<?php echo $bank_account['bankbranch'];?>" size="40"/></td>
        </tr>
        <tr>
            <td>ประเภทบัญชี</td>
            <td>
                <?php 
                $accounttype=mysql_query("select * from bank_account_type order by type_name");
                ?>
                <select name="selectbanktype" class="selectbox" id="selectbanktype">
                    <?php
                    while($acctype = mysql_fetch_array($accounttype))
                    {
                        if($bank_account['accounttype']==$acctype['type_name'])
                        {
                          ?>
                                <option value="<?php echo $acctype['type_name']; ?>" selected="selected"><?php echo $acctype['type_name'];?></option>                        
                          <?php
                        }
                        else
                        {
                            ?>
                                <option value="<?php echo $acctype['type_name']; ?>"><?php echo $acctype['type_name'];?></option> 
                            <?php
                        }
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <button type="submit" name="saved_editpayment" id="saved_editpayment" onclick="editpayment(this.id,'<?php echo $bank_account['accountno'];?>')"><img src="img/button_ok.png" />บันทึก</button>&nbsp;&nbsp;
                <button type="button" name="del_payment" id="del_payment" onclick="editpayment(this.id,'<?php echo $bank_account['accountno'];?>')"><img src="img/button_cancel.png" />ลบ</button> 
            </td>
        </tr>
    </table>
    
</html>