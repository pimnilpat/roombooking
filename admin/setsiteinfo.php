<?php
include("../getsite_info.php");
include ("anyfunction.php");
include('../connectdb.php');

$listroom=mysql_query("select * from list_room order by name");
$allroom=array();
$i=0;
while($row=  mysql_fetch_array($listroom))
{
    $allroom[$i]['name'] = $row['name'];
    $i++;
}
?>

<form name="frm_setsiteinfo" action="update_setsiteinfo.php" method="post" Enctype="multipart/form-data" target="ifram_setsiteinfo">
	  
    <table style="width:70%; border: none;">
        <tr>
            <td style="width: 25%" valign="top">ชื่อเว็บไซต์</td>
            <td style="width: 85%"><input type="text" size="70" MAXLENGTH="100" name="sitename" value="<?php echo $site_info['name'];?>"></td>
        </tr>
        <tr>
            <td style="width: 25%" valign="top">ชื่อบริษัท</td>
            <td style="width: 85%"><input type="text" size="70" MAXLENGTH="100" name="companyname" value="<?php echo $site_info['company'];?>"></td>
        </tr>
        <tr>
            <td style="width: 25%" valign="top">ภาพประกอบเว็บไซต์</td>
            <td style="width: 85%">
                <div id="display_siteimg">                    
                    <img src="../<?php echo $site_info['picture']; ?>" width="340" height="150" style="border: 3px solid #fff;"alt="logo"/>
                </div>
                <div>
                  <input type="file" size="50"  name="siteimage" >
                  <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
                </div>
            ขนาดของไฟล์ไม่เกิน 1 MB
            </td>
        </tr>
        <tr>
            <td style="width: 25%" valign="top">ข้อความต้อนรับ</td>
            <td style="width: 85%"><input type="text" size="70" MAXLENGTH="100" name="sitewelcome" value="<?php echo $site_info['wellcome'];?>"></td>
        </tr>
        <tr>
            <td style="width: 25%" valign="top">อธิบายข้อความต้อนรับ</td>
            <td style="width: 85%"><textarea cols="55" rows="4" name="welcomecapture" ><?php echo $site_info['wellcome_capture'];?></textarea></td>
        </tr>
        <tr>
            <td style="width: 25%" valign="top">รายละเอียดข้อความ</td>
            <td style="width: 85%"><textarea cols="55" rows="7" name="welcomedetail" ><?php echo $site_info['wellcome_detail']?></textarea></td>
        </tr>        
        <tr>
            <td style="width: 25%" valign="top">ห้องแนะนำ</td>
            <td>
                <p>
                    ห้องที่1: <select name="suggest1" style="width:200px">
                    <?php 
                    for($inc=0;$inc<count($allroom);$inc++)
                    {
                        if($allroom[$inc]['name']==$suggest[0]['suggest_name'])
                        {
                           ?>
                        <option value="<?php echo $allroom[$inc]['name'];?>" selected="selected"><?php echo $allroom[$inc]['name'];?></option>
                    <?php
                        }
                        else
                        {
                            ?>
                        <option value="<?php echo $allroom[$inc]['name'];?>" ><?php echo $allroom[$inc]['name'];?></option>
                        <?php
                        }
                    }
                    
                    ?>
                </select></p>
                <p>
                    ห้องที่2: <select name="suggest2" style="width:200px">
                      <?php 
                    for($inc=0;$inc<count($allroom);$inc++)
                    {
                        if($allroom[$inc]['name']==$suggest[1]['suggest_name'])
                        {
                           ?>
                        <option value="<?php echo $allroom[$inc]['name'];?>" selected="selected"><?php echo $allroom[$inc]['name'];?></option>
                    <?php
                        }
                        else
                        {
                            ?>
                        <option value="<?php echo $allroom[$inc]['name'];?>" ><?php echo $allroom[$inc]['name'];?></option>
                        <?php
                        }
                    }
                    
                    ?>  
                    </select>
                </p>
                <p>
                    ห้องที่3: <select name="suggest3" style="width:200px">
                        <?php 
                    for($inc=0;$inc<count($allroom);$inc++)
                    {
                        if($allroom[$inc]['name']==$suggest[2]['suggest_name'])
                        {
                           ?>
                        <option value="<?php echo $allroom[$inc]['name'];?>" selected="selected"><?php echo $allroom[$inc]['name'];?></option>
                    <?php
                        }
                        else
                        {
                            ?>
                        <option value="<?php echo $allroom[$inc]['name'];?>" ><?php echo $allroom[$inc]['name'];?></option>
                        <?php
                        }
                    }
                    
                    ?>
                    </select></p>
            </td>
        </tr>
        <tr>
            <td style="width: 25%" valign="top">ห้องที่ได้รับความนิยม</td>
            <td>
                <p>ห้องที่1: <select name="vote1" style="width:200px">
                        <?php 
                    for($inc=0;$inc<count($allroom);$inc++)
                    {
                        if($allroom[$inc]['name']==$vote_room[0]['vote_name'])
                        {
                           ?>
                        <option value="<?php echo $allroom[$inc]['name'];?>" selected="selected"><?php echo $allroom[$inc]['name'];?></option>
                    <?php
                        }
                        else
                        {
                            ?>
                        <option value="<?php echo $allroom[$inc]['name'];?>" ><?php echo $allroom[$inc]['name'];?></option>
                        <?php
                        }
                    }
                    
                    ?>
                    </select></p>
                <p>ห้องที่2: <select name="vote2" style="width:200px">
                        <?php 
                    for($inc=0;$inc<count($allroom);$inc++)
                    {
                        if($allroom[$inc]['name']==$vote_room[1]['vote_name'])
                        {
                           ?>
                        <option value="<?php echo $allroom[$inc]['name'];?>" selected="selected"><?php echo $allroom[$inc]['name'];?></option>
                    <?php
                        }
                        else
                        {
                            ?>
                        <option value="<?php echo $allroom[$inc]['name'];?>" ><?php echo $allroom[$inc]['name'];?></option>
                        <?php
                        }
                    }
                    
                    ?>
                    </select></p>
                <p>ห้องที่3: <select name="vote3" style="width:200px">
                        <?php 
                    for($inc=0;$inc<count($allroom);$inc++)
                    {
                        if($allroom[$inc]['name']==$vote_room[2]['vote_name'])
                            {
                           ?>
                        <option value="<?php echo $allroom[$inc]['name'];?>" selected="selected"><?php echo $allroom[$inc]['name'];?></option>
                    <?php
                        }
                        else
                        {
                            ?>
                        <option value="<?php echo $allroom[$inc]['name'];?>" ><?php echo $allroom[$inc]['name'];?></option>
                        <?php
                        }
                    }
                    
                    ?>
                    </select></p>
            </td>
        </tr>
        <tr>
            <td></td>
            <td style="padding-left: 130px;">
                <input type="hidden" value="<?php echo $site_info['name'];?>" name="oldsitename"/>
                <input type="hidden" value="<?php echo $site_info['wellcome'];?>" name="oldwellcome"/>
                <input type="hidden" value="<?php echo $site_info['wellcome_capture'];?>" name="oldwelcomecapture"/>
                <input type="hidden" value="<?php echo $site_info['wellcome_detail'];?>" name="oldwelcomedetail"/>
                <input type="hidden" value="<?php echo $site_info['picture']; ?>" name="oldsitepicture" />
                <button type="submit"><img src="img/button_ok.png" width="22" height="16"/>บันทึก</button>
            </td>
        </tr>
    </table>	       
    
   <br/>
</form>

<iframe name="ifram_setsiteinfo" style="border:none; height: 0px; width: 0px;" ></iframe>
</html>