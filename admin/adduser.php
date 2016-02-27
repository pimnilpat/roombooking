<?php

?>
<html>
    <head>
        <script src="../js/jquery.js" type="text/javascritp" ></script>
    </head>
</html>
<form name="frm_adduser" action="save_adduser.php" method="post" enctype="multipart/form-data" target="iframe_adduser">
    <p>
        <div>ชื่อผู้ใช้</div>
        <div><input type ="text" MAXLENGTH="20" name="username" size="60" /></div>
    </p>
    <p>
        <div>ชื่อ</div>
        <div><input type ="text" MAXLENGTH="30" name="firstname" size="60" /></div>
    </p>
    <p>
        <div>นามสกุล</div>
        <div><input type ="text" MAXLENGTH="30" name="lastname" size="60" /></div>
    </p>
    <p>
        <div>รหัสผ่าน</div>
        <div><input type ="password" MAXLENGTH="30" name="password" size="60" /></div>
    </p>
    <p>
        <div><img src="img/avatar.png" width="44" height="44" alt="user image"/></div>
        รูปประจำตัว&nbsp;<div><input type="file" name="userpicture" size="50"/></div>
    </p>
    <p>
        <div>สิทธิการเข้าใช้งาน</div>
        <div><select name="select_priviledge" style="width: 200px;">
                <option value="admin">Administrator</option>
            </select></div>
    </p>
    <input type="hidden"  name="oldusername"/>
    <br />
    <p>
    <button type="submit" name="sb_edituser"><img src="img/button_ok.png" width="22" height="16"/>บันทึก</button>
    </p>
</form>
<iframe name="iframe_adduser" style="width: 0px; height: 0px; border:none;"></iframe>
