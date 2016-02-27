<?php
include_once("../connectdb.php");
//print_r($_GET);
if($_GET['action']=='del')
{
    if($_GET['options']=='bank')
    {
        $check=mysql_query("select bank_name from payment where bank_name='{$_GET['menu']}'");
        if(mysql_num_rows($check)>0)
        {
            echo "Can not delete, name was inused";
        }
        else
        {
            $result_del = mysql_query("delete from banklist where bank_name='{$_GET['menu']}'");
            if($result_del)
            {
                echo "delete complete"; 
            }
        }
    }
    elseif($_GET['options']=='type')
    {
        $check=mysql_query("select accounttype from payment where accounttype='{$_GET['menu']}'");
        if(mysql_num_rows($check)>0)
        {
            echo "Can not delete, type name was inused";
        }
        else
        {
            $result_del = mysql_query("delete from bank_account_type where type_name='{$_GET['menu']}'");
            if($result_del)
            {
                echo "delete complete"; 
            }
        }
    }
}
elseif($_GET['action']=='add')
{
    if($_GET['menu']=='addbank')
    {
        $name = trim($_GET['addname']);
        $query = "insert into banklist(bank_name) values('$name')";
        $result = mysql_query($query);
        if($result)
        {
            echo "save complete";
        }        
    }
    elseif($_GET['menu']=='addacctype')
    {
        $name = trim($_GET['addname']);
        $query = "insert into bank_account_type(type_name) values('$name')";
        $result = mysql_query($query);
        if($result)
        {
            echo "save complete";
        } 
    }
}
?>
