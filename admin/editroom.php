<?php
include_once("../connectdb.php");
$result = mysql_query("select * from list_room where name='{$_POST['name']}'");
$room=array();
while($row= mysql_fetch_array($result))
{
    $room['name']=$row['name'];
    $room['picture'] = $row['picture'];
    $room['type']=$row['type'];
    $room['vote']=$row['vote'];
    $room['suggest']=$row['suggest'];
}

?>
<form name="frm_editrom" method="post" action="save_editroom.php" Enctype="multipart/form-data" target="iframe_editroom">
    <table style="width:70%">
        <tr>
            <td style="width:25%" valign="top">ชื่อห้อง</td>
            <td><input type="text" MAXLENGTH="30" name="roomname" size="70" value="<?php echo $room['name'];?>"></td>
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
                    <option value="0">------------</option>
                    <?php
                        for($j=0;$j<count($arrtype);$j++)
                        {
                            if($room['type']==$arrtype[$j]['name'])
                            {
                                ?>
                                        <option value="<?php echo $arrtype[$j]['name']; ?>" selected="selected"><?php echo $arrtype[$j]['name']; ?></option>
                                <?php
                                
                            }
                            else
                            {
                                ?>
                                        <option value="<?php echo $arrtype[$j]['name']; ?>"><?php echo $arrtype[$j]['name']; ?></option>
                                <?php
                            }
                        ?>
                            
                    <?php
                        }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type="hidden" name="oldname" value="<?php echo $room['name']; ?>" />
                <input type="hidden" name="oldpic" value="<?php echo $room['picture'] ?>" />
                <input type="hidden" name="oldvote" value="<?php echo $room['vote'] ?>" />
                <input type="hidden" name="oldsuggest" value="<?php echo $room['suggest'] ?>" />
                <button type="submit" name="submit_editroom" ><img src="img/button_ok.png" />บันทึก</button>
            </td>
        </tr>
    </table>
</form>
<iframe name="iframe_editroom" style="width: 400px; height: 400px; border:none;"></iframe>