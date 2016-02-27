<?php

include_once("../connectdb.php");
$query = mysql_query("select * from user where username ='{$_POST['user']}'");
$user = array();
while($row=  mysql_fetch_array($query))
{
    $user['username']=$row['username'];
    $user['firstname']=$row['firstname'];
    $user['lastname']=$row['lastname'];
    $user['password']=$row['password'];
    $user['priviledge']=$row['priviledge'];
    $user['icon']=$row['icon'];
}
?>
<html>
    <head>
        <script src="../js/jquery.js" type="text/javascritp" ></script>
        <script type="text/javascript">
            function deluser(user)
            {
                jQuery.get("deluser.php",{value:user},function(data){
                    alert(data);
                    jQuery("#setuser").click();
                });
            }
        </script>
    </head>
</html>
<form name="frm_edituser" action="save_useredit.php" method="post" enctype="multipart/form-data" target="iframe_edituser">
    <p>
        <div>ชื่อผู้ใช้</div>
        <div><input type ="text" MAXLENGTH="20" name="username" size="60" value="<?php echo $user['username'];?>"/></div>
    </p>
    <p>
        <div>ชื่อ</div>
        <div><input type ="text" MAXLENGTH="30" name="firstname" size="60" value="<?php echo $user['firstname'];?>"/></div>
    </p>
    <p>
        <div>นามสกุล</div>
        <div><input type ="text" MAXLENGTH="30" name="lastname" size="60" value="<?php echo $user['lastname'];?>"/></div>
    </p>
    <p>
        <div>รหัสผ่าน</div>
        <div><input type ="password" MAXLENGTH="30" name="password" size="60" value="<?php echo $user['password'];?>"/></div>
    </p>
    <p>
        <div><img src="<?php echo $user['icon'];?>" width="44" height="44" alt="user image"/></div>
        รูปประจำตัว&nbsp;<div><input type="file" name="userpicture" size="50"/></div>
    </p>
    <p>
        <div>สิทธิการเข้าใช้งาน</div>
        <div><select name="select_priviledge" style="width: 200px;">
                <option value="admin">Administrator</option>
            </select></div>
    </p>
    <input type="hidden" value="<?php echo $user['username'];?>" name="oldusername"/>
    <input type="hidden" value="<?php echo $user['icon'];?>" name="oldusericon"/>
    <br />
    <p>
    <button type="submit" name="sb_edituser"><img src="img/button_ok.png" width="22" height="16"/>บันทึก</button>
    
    </p>
</form>
<iframe name="iframe_edituser" style="width: 0px; height: 0px; border:none;"></iframe>
