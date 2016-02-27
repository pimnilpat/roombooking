<?php
include_once("../connectdb.php");
?>
<html>
    <head>
        <script src="../js/jquery.js" type="text/javascript" ></script>
        <script>
            function saveaddpayment()
            {
                var bankname=$("#selectbank").val();
                var accname=$("#txt_accountname").val();
                var accno=$("#txt_accountno").val();
                var bankbranch=$("#txt_bankbranch").val();
                var acctype=$("#selectbanktype").val();
                if($.trim(accname)=='' || $.trim(accno)=='' || $.trim(bankbranch)=='')
                {
                        alert("Enter data");
                }
                else
                {
                    $.get("save_addpayment.php",{bank:bankname,accountname:accname,accountno:accno,branch:bankbranch,type:acctype}, function(data){
                        alert(data);
                        $("#setpayment").click();
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
                       
                           ?>
                            <option value="<?php echo $bank['bank_name'];?>"><?php echo $bank['bank_name'];?></option>
                           <?php                       
                       
                   }
                   
                   ?>
                            
                </select>
            </td>
        </tr>
        <tr>
            <td>ชื่อบัญชี</td>
            <td><input type="text" name="txt_accountname" id="txt_accountname"  size="40"/></td>
        </tr>
        <tr>
           <td>เลขที่บัญชี</td>
            <td><input type="text" name="txt_accountno" id="txt_accountno"  size="40"/></td> 
        </tr>
        <tr>
            <td>สาขา</td>
            <td><input type="text" name="txt_bankbranch" id="txt_bankbranch" size="40"/></td>
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
                        
                            ?>
                                <option value="<?php echo $acctype['type_name']; ?>"><?php echo $acctype['type_name'];?></option> 
                            <?php
                        
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <button type="submit" name="saved_addpayment" id="saved_addpayment" onclick="saveaddpayment()"><img src="img/button_ok.png" />บันทึก</button>&nbsp;&nbsp;                
            </td>
        </tr>
    </table>
    
</html>