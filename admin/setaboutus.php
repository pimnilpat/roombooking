<?php 
include_once '../connectdb.php';

$result = mysql_query("select * from aboutus");

while($row=  mysql_fetch_array($result))
{
    $aboutus['description'] = $row['description'];
}
?>
<form name ="frm_aboutus" action="save_aboutus.php" method="post" target="iframe_saveaboutus">
    <table style="width:70%;">
        <tr>
            <td style="width: 20%;" valign="top">เกี่ยวกับเรา</td>
            <td style="width: 80%;">
                <textarea cols="60" rows="5" name="text_aboutus"><?php echo $aboutus['description']; ?></textarea>
            </td>
        </tr>       
        <tr>
            <td></td>
            <td><button type="submit"><img src="img/button_ok.png" width="22" height="16"/>บันทึก</button></td>
        </tr>
    </table>
    
</form>
<iframe name="iframe_saveaboutus" style="width: 0px; height: 0px; border: none;" />