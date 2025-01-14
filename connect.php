<?php

$_servername = "localhost:3307";
$_username = "root";
$_password = "";
$_database = "hilda's_recipes";


try{
    $conn = mysqli_connect($_servername,$_username, $_password, $_database);
}catch(mysqli_connect_error $e){
    die("Connection failed: " .mysqli_connect_error());
}
