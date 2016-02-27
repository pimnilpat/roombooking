<?php
$fighter = array(
array("name" => "Buakaw", "last_name" => "Porpramuk", "fight" => 415),
array("name" => "Klaoklai", "last_name" => "Kaennorasing", "fight" => 385)

);
// many fighters
function display1($data)
{
print_r($data);
}
function display2(&$data)
{
print_r($data);
}
echo "<pre>";
display1($fighter); // call display1
echo "</pre>";
echo "<pre>";
display2($fighter); // call display2
echo "</pre>";
?>