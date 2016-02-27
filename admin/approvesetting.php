<?php
include_once("../connectdb.php");
$result = mysql_query("select * from approve");
$approve = array();
while($row=  mysql_fetch_array($result))
{
   $approve['mode']=$row['mode']; 
   $approve['updated_time']=$row['updated_time'];
}
//print_r($approve);
?>
<html>
    <head>
    <script src="../js/jquery.js" type="text/javascritp" ></script>
    <script type="text/javascript">
        function edit_improve(value)
        {
            jQuery.ajax({
                type:"POST",
                url:"editapprove.php",
                data:"value="+value,
                success:function(data)
                {
                    jQuery("#title_content").html(data);
                }
            });
        }
    </script>
    <style type="text/css">
        .tbapprove{
            width: 70%;           
        }
        .tbapprove th,td{
             text-align: left;
        }
    </style>
    </head>
</html>
<div>
    <table class="tbapprove">
        <tr>
            <th width="50">Mode</th>
            <th width="50">Edit</th>
        </tr>
        <tr>
            <td>
                <?php if($approve['mode']=='auto')
                {
                   ?>
                <div>อัตโนมัติ</div>
                <?php                  
                }
                ?>
            </td>
            <td><a href="javascript:edit_improve('<?php echo $approve['mode'];?>')">Edit</a></td>
                
        </tr>
    </table>
</div>