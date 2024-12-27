<?php
$serverName="localhost";
$dbUsername="Savindu";
$dbPassword= "CMa*d8y89gxr3l3k";
$dbName="restaurantsavi";

$conn = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);

if(!$conn){
    die("Connection failed :" . mysqli_connect_error(). " - Error Code: " . mysqli_connect_errno());
}else{
    echo"Database connection successful!";
   
}