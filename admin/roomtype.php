<?php
include_once '../connectdb.php';

$arrroomtype = array();
$i=0;
$result = mysql_query("select * from roomtype order by name");
while($row=  mysql_fetch_array($result))
{
    $arrroomtype[$i]['name'] = $row['name'];
    $arrroomtype[$i]['price'] = $row['price'];
    $arrroomtype[$i]['coffeebreak'] = $row['coffeebreak'];
    $arrroomtype[$i]['accessories'] = $row['accessories'];
    $i++;
}
?>
<html>
    <head>
        <script src="../js/jquery.js" type="text/javascritp" ></script>
        <script type="text/javascript">
            function edit_roomtype(name)
            {
               jQuery.get("edit_roomtype.php", {value:name}, function(data){
                    jQuery("#title_content").html(data);
        
                });
            }
            function  addroomtype()
            {
                jQuery.get("add_roomtype.php", {value:name}, function(data){
                    jQuery("#title_content").html(data);
        
                });
            }
        </script>
    </head>
<table style="width: 100%;">
    <tr>
        <th>No.</th>
        <th>Name</th>
        <th>Price</th>        
    </tr>
    <?php
    $no=1;
    for($i=0;$i<count($arrroomtype);$i++)
    {
     ?>
    <tr>
        <td><?php echo $no++; ?></td>
        <td><a href="javascript:edit_roomtype('<?php echo $arrroomtype[$i]['name'] ;?>')"><?php echo $arrroomtype[$i]['name'] ;?></a></td>
        <td><?php echo $arrroomtype[$i]['price'] ;?></td>        
    </tr>
    <?php
    }
    ?>
</table>
    <br />  <br />
  
        <button type="button" name="btn_addtype" onclick="addroomtype()"><img src="img/plus.png" />Add type</button>
    
</html>