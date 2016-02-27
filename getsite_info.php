<?php

include_once("connectdb.php");

$query = "select * from site_infomation";
$result = mysql_query($query);
while($row = mysql_fetch_array($result))
{
    $site_info['name']=$row['site_name'];
    $site_info['company']=$row['site_company'];
    $site_info['picture']=$row['site_image'];
    $site_info['wellcome']=$row['wellcome'];
    $site_info['wellcome_capture']=$row['wellcome_capture'];
    $site_info['wellcome_detail']=$row['wellcome_detail'];
    $site_info['sitebar_menu']=$row['sitebar_menu'];
}

$i=0;
$vote_room = array();
$vote_query = mysql_query("select * from list_room where vote='vote'");
while($rr = mysql_fetch_array($vote_query))
{
    $vote_room[$i]['vote_name'] = $rr['name'];    
    $vote_room[$i]['updated_time'] = $rr['updated_time'];
    $vote_room[$i]['type'] = $rr['type'];
    $gettype = mysql_query("select * from roomtype where name='{$rr['type']}'");
    while($rtype=  mysql_fetch_array($gettype))
    {
        $vote_room[$i]['vote_caption'] = $rtype['description'];
        $vote_room[$i]['price'] = $rtype['price'];
        $vote_room[$i]['coffeebreak'] = $rtype['coffeebreak'];
        $vote_room[$i]['accessories'] = $rtype['accessories'];
        $vote_room[$i]['seat'] = $rtype['seat'];
    }
    $i++;
}

$j=0;
$suggest = array();
$suggest_query = mysql_query("select * from list_room where suggest='suggest'");
while($gg = mysql_fetch_array($suggest_query))
{
    $suggest[$j]['suggest_name']=$gg['name'];   
    $suggest[$j]['suggest_image']=$gg['picture'];
    $suggest[$j]['update_time']=$gg['updated_time'];
    $suggest[$j]['type']=$gg['type'];
    $gettype2 = mysql_query("select * from roomtype where name='{$gg['type']}'");
    while($gtype=  mysql_fetch_array($gettype2))
    {
        $suggest[$j]['suggest_caption'] = $gtype['description']; 
        $suggest[$j]['suggest_price'] = $gtype['price'];
        $suggest[$j]['suggest_coffeebreak'] = $gtype['coffeebreak'];
        $suggest[$j]['suggest_accessories'] = $gtype['accessories'];
        $suggest[$j]['suggest_seat'] = $gtype['seat'];
    }
    $j++;
}

mysql_close();
?>
