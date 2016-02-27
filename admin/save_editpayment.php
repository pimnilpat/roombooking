<?php
include_once("../connectdb.php");
if($_GET['action']=='delete')
{
    $result=mysql_query("delete from payment where bank_no='{$_GET['accountno']}'");
    if($result)
    {
        echo "delete {$_GET['accountno']} completed";
    }
}
elseif($_GET['action']=='update')
{
    
    $query = "update payment set bank_name='{$_GET['bankname']}',
                                bank_no='{$_GET['accno']}',
                                bank_branch='{$_GET['bankbranch']}',
                                accountname='{$_GET['accname']}',
                                accounttype='{$_GET['banktype']}'
               where bank_no='{$_GET['accountno']}'";
    $result = mysql_query($query);
    if($result)
    {
        echo "update complete ";
    }
}
?>
