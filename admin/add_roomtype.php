
<html>
    <head>
        <script src="../js/jquery.js" type="text/javascritp" ></script>
        
    </head>
<form name="frm_addroomtype" action="save_roomtype_add.php" method="post" target="iframe_roomtype">
    <table style="width:100%">
        <tr>
            <td style="width:20%;" valign="top">ชื่อประเภทห้อง</td>
            <td style="width:80%;"><input type="text" name="typename" size="60"  /></td>
        </tr>
        <tr>
            <td style="width:20%;" valign="top">ราคาต่อรอบ</td>
            <td style="width:80%;"><input type="text" name="typeprice" size="60" /></td>
        </tr>
        <tr>
            <td style="width:20%;" valign="top">จำนวนที่นั่ง</td>
            <td style="width:80%;"><input type="text" name="typeseat" size="30" MAXLENGTH="3"/></td>
        </tr>
        <tr>
            <td style="width:20%;" valign="top">อธิบายเกี่ยวกับประเภทห้อง</td>
            <td style="width:80%;">
                <textarea name="typedescription" cols="60" rows="5"></textarea>
            </td>
        </tr>
        <tr>
            <td style="width:20%;" valign="top">คอฟฟี่เบรค</td>
            <td style="width:80%;">
                <textarea name="typecoffeebreak" cols="60" rows="5"></textarea>
            </td>
        </tr>
        <tr>
            <td style="width:20%;" valign="top">อุปกรณ์ประกอบ</td>
            <td style="width:80%;">
                <textarea name="typeaccessories" cols="60" rows="5"></textarea>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                
                <button type="submit" name="sb_editroomtype"><img src="img/button_ok.png" width="22" height="16"/>บันทึก</button>
               
            </td>
        </tr>
    </table>
</form>
<iframe name="iframe_roomtype" style="width: 0px; height: 0px; border:none;"></iframe>
</html>