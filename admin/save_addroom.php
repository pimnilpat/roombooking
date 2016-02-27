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
        $imgroom = "images/no_image.gif";
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
    $vote='';
    $suggest='';
    $updated=date("Y-m-d H:i:s");
    $type=$_POST['get_roomtype'];
    $query = "insert into list_room(name,picture,vote,suggest,updated_time,type)
                            values('$name','$imgroom','$vote','$suggest','$updated','$type')
            ";
    $result=mysql_query($query);
    if($result){
        echo"<script>";
        echo "alert('Save completed')";
        echo "</script>";
    }
}

?>
