<?php
    if($_POST['text_address']=='' || $_POST['text_phone']=='' || $_POST['text_email']=='')
    {
        echo "<script>";
        echo "alert('Enter empty field')";
        echo "</script>";
    }
 else {
        include_once("../connectdb.php");
        
        $address=trim($_POST['text_address']);
        $phone = trim($_POST['text_phone']);
        $email = trim($_POST['text_email']);
        $fax = trim($_POST['text_fax']);
        
        $update_query = "update contactus set address='$address',
                                              phone = '$phone',
                                              email = '$email',
                                              fax = '$fax'
                        ";
        $result_update = mysql_query($update_query);
        if($result_update)
        {
            echo "<script>";
            echo "alert('Edit complete')";
            echo "</script>";
        }
}
?>
