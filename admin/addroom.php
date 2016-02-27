<form name="frm_addrom" method="post" action="save_addroom.php" Enctype="multipart/form-data" target="iframe_addroom">
    <table style="width:70%">
        <tr>
            <td style="width:25%" valign="top">ชื่อห้อง</td>
            <td><input type="text" MAXLENGTH="30" name="roomname" size="70"></td>
        </tr>
        <tr>
            <td style="width:25%" valign="top">เลือกรูปภาพประกอบ</td>
            <td>
                <input type="file"  name="file_roomicon" size="50">
                <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
                <div>ภาพมีขนาดไม่เกิน 1 MB</div>
            </td>
        </tr>
        <tr>
            <td style="width:25%" valign="top">เลือกประเภทห้องประชุม</td>
            <td>
                <?php
                    include_once("../connectdb.php");
                    $gettype=mysql_query("select * from roomtype order by name");
                    $arrtype=array();
                    $m=0;
                    while($row= mysql_fetch_array($gettype))
                    {
                        $arrtype[$m]['name'] = $row['name'];
                        $m++;
                    }
                ?>
                <select name="get_roomtype" style="width: 200px;">
                    <?php
                        for($j=0;$j<count($arrtype);$j++)
                        {
                        ?>
                            <option value="<?php echo $arrtype[$j]['name']; ?>"><?php echo $arrtype[$j]['name']; ?></option>
                    <?php
                        }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <button type="submit" name="submit_addroom" ><img src="img/button_ok.png" />บันทึก</button>
            </td>
        </tr>
    </table>
</form>
<iframe name="iframe_addroom" style="width: 0px; height: 0px; border:none;"></iframe>

