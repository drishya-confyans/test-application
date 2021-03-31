<?php
session_start();
function getdb(){
$servername = "localhost";
$username = "root";
$password = "root";
$db="test_application";
try {
   
    $conn = mysqli_connect($servername, $username, $password, $db);
    //  echo "Connected successfully"; 
    }
catch(exception $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
    return $conn;
}
?>