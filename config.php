<?php
function getdb(){
$servername = "35.247.59.3";
$username = "root";
$password = "Geethu12345_";
$db="webhook";
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