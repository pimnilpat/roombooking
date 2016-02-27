<?php
include_once("../connectdb.php");
$contact = mysql_query("select * from contactus");

$arrcontact = array();
while($row=  mysql_fetch_array($contact))
{
    $arrcontact['address'] = $row['address'];
    $arrcontact['phone'] = $row['phone'];
    $arrcontact['email'] = $row['email'];
    $arrcontact['fax'] = $row['fax'];
}
?>
<form name ="frm_contactus" action="save_contactus.php" method="post" target="iframe_savecontactus">
    <table style="width:70%;">
        <tr>
            <td style="width: 20%;" valign="top">ที่อยู่</td>
            <td style="width: 80%;">
                <textarea cols="60" rows="5" name="text_address"><?php echo $arrcontact['address']; ?></textarea>
            </td>
        </tr>
        <tr>
            <td style="width: 20%;" valign="top">โทรศัพท์</td>
            <td style="width: 80%;">
                <input type="text" name="text_phone" size="70" value="<?php echo $arrcontact['phone']; ?>" />
            </td>
        </tr>
        <tr>
            <td style="width: 20%;" valign="top">แฟกซ์</td>
            <td style="width: 80%;">
                <input type="text" name="text_fax" size="70" value="<?php echo $arrcontact['fax']; ?>" />
            </td>
        </tr>
        <tr>
            <td style="width: 20%;" valign="top">อีเมล์</td>
            <td style="width: 80%;">
                <input type="text" name="text_email" size="70" value="<?php echo $arrcontact['email'];?>" MAXLENGTH="50"/>
            </td>
        </tr>
        <tr>
            <td></td>
            <td><button type="submit"><img src="img/button_ok.png" width="22" height="16"/>บันทึก</button></td>
        </tr>
    </table>
    
</form>
<iframe name="iframe_savecontactus" style="width: 0px; height: 0px; border: none;" />