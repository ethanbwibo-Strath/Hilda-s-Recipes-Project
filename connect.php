<?php

$DB_HOST = "localhost";
$DB_USER = "BwibzzZ";
$DB_PASS = "@Eset254";
$DB_NAME = "hildas_recipes";


try{
    $conn = mysqli_connect($DB_HOST,$DB_USER, $DB_PASS, $DB_NAME);
}catch(mysqli_connect_error $e){
    die("Connection failed: " .mysqli_connect_error());
}
echo "Connected successfully";
?>