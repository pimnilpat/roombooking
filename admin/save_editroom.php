<?php

if($_POST['roomname']=='')
{
    echo "<script>";
    echo "alert('Enter name')";
    echo"</script>";
}
else
{
    include_once("../connectdb.php");
    if($_FILES['file_roomicon']['error']==4)
    {
        $imgroom = $_POST['oldpic'];
    }
    elseif($_FILES['file_roomicon']['error']==0)
    {
        $typeicon = explode("/", $_FILES['file_roomicon']['type']);
        if($typeicon[0]!='image')
        {
            echo "<script>";
            echo "alert('file not correct')";
            echo"</script>";
        }
        else
        {
             $imgroom = "images/".$_FILES['file_roomicon']['name'];
             $destination = "../images/".$_FILES['file_roomicon']['name'];
             $upload_roomicon = move_uploaded_file($_FILES['file_roomicon']['tmp_name'], $destination);             
        }       
    }
    else
    {
        echo "<script>";
        echo "alert('error upload file')";
        echo"</script>";
    }
    
    //start insert data to database
    $name=trim($_POST['roomname']);    
   
    $updated=date("Y-m-d H:i:s");
    if($_POST['get_roomtype']=='0')
    {
        $type='';
    }
    else
    {        
        $type=$_POST['get_roomtype'];
    }
    
    if($_POST['oldvote']=='')
    {
        $vote='';
    }
    else
    {        
        $vote=$_POST['oldvote'];
    }
    
    if($_POST['oldsuggest']=='')
    {
        $suggest='';
    }
    else
    {        
        $suggest=$_POST['oldsuggest'];
    }
    
    $query = "update list_room set name='$name',
                                   picture='$imgroom',
                                   vote='$vote',
                                   suggest='$suggest',
                                   updated_time='$updated',
                                   type='$type'
                          where name='{$_POST['oldname']}'
            ";
    $result=mysql_query($query);
    if($result){
        echo"<script>";
        echo "alert('Save completed')";
        echo "</script>";
    }
}

?>
