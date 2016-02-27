<?php
session_start();
include_once("../connectdb.php");
$sql_user=mysql_query("select * from user where username != '{$_SESSION['user']}' order by username");
$i=0;
$arruser = array();
while($u=  mysql_fetch_array($sql_user))
{
    $arruser[$i]['firtname'] = $u['firstname'];
    $arruser[$i]['lastname'] = $u['lastname'];
    $arruser[$i]['username'] = $u['username'];
    $arruser[$i]['priviledge'] = $u['priviledge'];
    $arruser[$i]['icon'] = $u['icon'];
    $i++;
}
?>
<html>
    <head>
        <script src="../js/jquery.js" type="text/javascritp" ></script>
        <script type="text/javascript">
            function calledituser(username)
            {
                 jQuery.get("edituser.php", {value:username}, function(data){
                 jQuery("#title_content").html(data);
        
                });
            }
            function call_adduser()
            {
                jQuery.get("adduser.php", {value:''}, function(data){
                 jQuery("#title_content").html(data);
        
                });
            }
        </script>
    </head>
</html>    
<form name="frm_setuser" action="update_user.php" method="post" >
	  
    <table style="width:100%; border: none;">
        <tr>
            <th>No.</th>
            <th>Image</th>
            <th>Name</th>
            <th>Username</th>
            <th>Priviledge</th>            
        </tr> 
        <?php
        $no = 1;
        for($j=0;$j<count($arruser);$j++)
        {
        ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><img src="<?php echo $arruser[$j]['icon']; ?>" width="25" width="25"/></td>
            <td><a href="javascript:calledituser('<?php echo $arruser[$j]['username'];?>')"><?php echo $arruser[$j]['firtname']."&nbsp;&nbsp;".$arruser[$j]['lastname']; ?></a></td>
            <td><?php echo $arruser[$j]['username']; ?></td>
            <td><?php if($arruser[$j]['priviledge']=='0'){echo "Administrator";}?></td>            
        </tr>
        <?php
        }
        ?>
    </table>	       
    
   <br/><br/>
   <p>
   <button type="button" onclick="call_adduser()"><img src="img/username.png" width="23" height="23"/> เพิ่มผู้ดูแล</button>
   </p>
</form>
