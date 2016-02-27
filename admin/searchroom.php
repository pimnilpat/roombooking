<?php

include_once("../connectdb.php");
if($_POST['type']=='0' && $_POST['room']=='0'){ 
    $result = mysql_query("select * from list_room order by name");
}
else if($_POST['type']!='0' && $_POST['room']=='0')
{
    $result = mysql_query("select * from list_room where type='{$_POST['type']}' order by name");
}
else if($_POST['type']=='0' && $_POST['room']!='0')
{ 
    $result = mysql_query("select * from list_room where name = '{$_POST['room']}' order by name");
}
else if($_POST['type']!='0' && $_POST['room']!='0')
{
    $result = mysql_query("select * from list_room where name='{$_POST['room']}' 
                                                   and type='{$_POST['type']}'
                                                   order by name
                          ");
}

$arr = array();
$i=0;
while($row=mysql_fetch_array($result))
{
    $arr[$i]['name'] =$row['name']; 
    $arr[$i]['picture'] =$row['picture'];
    $arr[$i]['vote'] =$row['vote'];
    $arr[$i]['suggest'] =$row['suggest'];
    $arr[$i]['type'] =$row['type'];
    $i++;
}

$no =1;
?>
<html>
    <head>
        <script src="../js/jquery.js" type="text/javascritp" ></script>
        <script type="text/javascript">
            function editroom(name)
            {
                jQuery.ajax({
                    type:"POST",
                    url:"editroom.php",
                    data:"name="+name,
                    success:function (data){
                        jQuery("#title_content").html(data);
                    }
                });
            }
        </script>
        <style type="text/css">
            .tb_displayroom
            {
                width: 100%;
            }
            .tb_displayroom td
            {
                text-align: center;
            }
            .tb_displayroom th
            {
                text-align: center;
            }
        </style>
    </head>
<table class="tb_displayroom">
    <tr>
        <th widht="10%">No.</th>
        <th width="20%">Image</th>
        <th width="25%">Name</th>
        <th width="25%">Type</th>
        <th width="10%">Vote</th>
        <th width="10%">Suggest</th>
    </tr>
    <?php
        for($i=0;$i<count($arr);$i++)
        {
        ?>
            <tr>
                <td><?php echo $no++; ?></td> 
                <td><img src="../<?php echo $arr[$i]['picture'];?>" width="90" height="60" /></td>
                <td><a href="javascript:editroom('<?php echo $arr[$i]['name']; ?>')"><?php echo $arr[$i]['name']; ?></a></td>
                <td><?php echo $arr[$i]['type'];?></td>
                <td>
                    <?php if($arr[$i]['vote']=='vote')
                          {
                           ?>
                               <img src="img/favorite.png" width="22" height="22" />
                           <?php
                          }
                    ?>
                </td>
                <td>
                   <?php if($arr[$i]['suggest']=='suggest')
                          {
                           ?>
                               <img src="img/suggest.png" width="22" height="22" />
                           <?php
                          }
                    ?> 
                </td>               
            </tr>
       <?php
        }
    ?>
    
</table>
</html>