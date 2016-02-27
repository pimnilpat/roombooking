<?php
//date_default_timezone_set("Asia/Bangkok");
include_once("../connectdb.php");
if($_POST['username']==''|| $_POST['firstname']=='' || $_POST['lastname']=='')
{
    echo "<script>";
    echo "alert('fill input data')";
    echo "</script>";
}
else
{
    // check if user no select image file
    if($_FILES['userpicture']['error']=='4')
    {
          $imageprofile = $_POST['oldusericon'];
    }
    elseif($_FILES['userpicture']['error']=='0')
    {
        $type=explode("/",$_FILES['userpicture']['type']);
        if(strcmp($type[0],'image')!=0)
        {
            echo "<script>";
            echo "alert('file not correct')";
            echo "</script>";
        }
        else
        {
            $destination = "img/".$_FILES['userpicture']['name'];
            $upload_complete = move_uploaded_file($_FILES['userpicture']['tmp_name'], $destination);
            $imageprofile = "img/".$_FILES['userpicture']['name'];            
        }        
    }
    $username = trim($_POST['username']);
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $password = trim($_POST['password']);
    $update_time = date("Y-m-d H:i:s");
    if($_POST['select_priviledge']=='admin')
    {
        $priviledge = '0';
    }
    
    $sql_update = "update user set username='$username',
                                   firstname='$firstname',
                                   lastname = '$lastname',
                                   password = '$password',
                                   priviledge = '$priviledge',
                                   icon = '$imageprofile',
                                   updated_time = '$update_time'
                              where username='{$_POST['oldusername']}'
                    ";
    $result = mysql_query($sql_update);
    if($result)
    {
        echo "<script>";
        echo "alert('updated complete');";
        echo "</script>";
    }
    echo date("Y-m-d H:i:s");
}
?>
