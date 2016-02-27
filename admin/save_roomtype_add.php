<?php  
if(strlen($_POST['typename'])<=0)
{
    echo "<script>";
    echo "alert('Enter type name')";
    echo"</script>";
}
else
{
    include_once '../connectdb.php';
    $typename = trim($_POST['typename']);
    $typeprice = trim($_POST['typeprice']);
    $typebreak = trim($_POST['typecoffeebreak']);
    $typeacc = trim($_POST['typeaccessories']);
    $typeseat = trim($_POST['typeseat']);
    $typedes = trim($_POST['typedescription']);

    $query = "insert into roomtype(name,price,coffeebreak,accessories,seat,description) values('$typename','$typeprice','$typebreak','$typeacc',$typeseat,'$typedes')";
    $update = mysql_query($query) ;
    if($update)
    {
        echo "<script>";
        echo "alert('Save completed')";        
        echo "</script>";
    }
}      
?>
