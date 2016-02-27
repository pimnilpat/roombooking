<?php

include_once '../connectdb.php';
$typename = trim($_POST['typename']);
$typeprice = trim($_POST['typeprice']);
$typebreak = trim($_POST['typecoffeebreak']);
$typeacc = trim($_POST['typeaccessories']);
$typeseat = trim($_POST['typeseat']);
$typedes = trim($_POST['typedescription']);

$query = "update roomtype set name='$typename',
                              price = '$typeprice',
                              coffeebreak = '$typebreak',
                              accessories = '$typeacc',
                              seat = '$typeseat',
                              description = '$typedes'
           where name='{$_POST['oldtype']}'
            ";
$update = mysql_query($query) ;
if($update)
{
    echo "<script>";
    echo "alert('Update complete')";
    echo "</script>";
}
      
?>
