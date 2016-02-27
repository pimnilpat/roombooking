<?php
include_once("../connectdb.php");
$result = mysql_query("insert into payment(bank_name,bank_no,bank_branch,accountname,accounttype) 
                  value('{$_GET['bank']}','{$_GET['accountno']}','{$_GET['branch']}','{$_GET['accountname']}','{$_GET['type']}')");
if($result)
{
    echo "save complete";
}
?>
