<?php
function getdb(){
$servername = "localhost";
$username = "t8n_root";
$password = "e9nhCw(%qLeLq2VX";
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
