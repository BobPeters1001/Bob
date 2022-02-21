<?php  

$con = new PDO("mysql:host=localhost; dbname=examenbeter", "root", "");
    
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

var_dump($con);

?>