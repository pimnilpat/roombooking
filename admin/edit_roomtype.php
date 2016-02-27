<?php
include_once("../connectdb.php");
$result = mysql_query("select * from roomtype where name='{$_GET['value']}'");
while($row = mysql_fetch_array($result))
{
    $typeroom['name'] = $row['name'];
    $typeroom['price'] = $row['price'];
    $typeroom['coffeebreak'] = $row['coffeebreak'];
    $typeroom['accessories'] = $row['accessories'];
    $typeroom['seat'] = $row['seat'];
    $typeroom['des'] = $row['description'];
}
?>
<html>
    <head>
        <script src="../js/jquery.js" type="text/javascritp" ></script>
        <script type="text/javascript">
            function delroomtype(name)
            {
                jQuery.get("delete_roomtype.php", {value:name}, function(data){
                    alert(data);
                 jQuery("#typeroomsetting").click();
                });
            }
        </script>
    </head>
<form name="frm_editroomtype" action="save_roomtype_edit.php" method="post" target="iframe_roomtype">
    <table style="width:100%">
        <tr>
            <td style="width:20%;" valign="top">ชื่อประเภทห้อง</td>
            <td style="width:80%;"><input type="text" name="typename" size="60" value="<?php echo $typeroom['name'];?>" /></td>
        </tr>
        <tr>
            <td style="width:20%;" valign="top">ราคาต่อรอบ</td>
            <td style="width:80%;"><input type="text" name="typeprice" size="60" value="<?php echo $typeroom['price'];?>" /></td>
        </tr>
        <tr>
            <td style="width:20%;" valign="top">จำนวนที่นั่ง</td>
            <td style="width:80%;"><input type="text" name="typeseat" size="30" MAXLENGTH="3" value="<?php echo $typeroom['seat'];?>"/></td>
        </tr>
        <tr>
            <td style="width:20%;" valign="top">อธิบายเกี่ยวกับประเภทห้อง</td>
            <td style="width:80%;">
                <textarea name="typedescription" cols="60" rows="5"><?php echo $typeroom['des']; ?></textarea>
            </td>
        </tr>
        <tr>
            <td style="width:20%;" valign="top">คอฟฟี่เบรค</td>
            <td style="width:80%;">
                <textarea name="typecoffeebreak" cols="60" rows="5"><?php echo $typeroom['coffeebreak'];?></textarea>
            </td>
        </tr>
        <tr>
            <td style="width:20%;" valign="top">อุปกรณ์ประกอบ</td>
            <td style="width:80%;">
                <textarea name="typeaccessories" cols="60" rows="5"><?php echo $typeroom['accessories'];?></textarea>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type="hidden" name="oldtype" value="<?php echo $typeroom['name'];?>"/>
                <button type="submit" name="sb_editroomtype"><img src="img/button_ok.png" width="22" height="16"/>บันทึก</button>
                <button type="reset" name="bt_delroomtype" onclick="delroomtype('<?php echo $typeroom['name']; ?>')"><img src="img/button_cancel.png" width="22" height="16"/>ลบ</button>
            </td>
        </tr>
    </table>
</form>
<iframe name="iframe_roomtype" style="width: 0px; height: 0px; border:none;"></iframe>
</html>