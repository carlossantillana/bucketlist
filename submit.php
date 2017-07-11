<?php
$host = "localhost";
$user = "root";
$password = "Lapras#131";
$database = "bucketList";
$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error){
    echo "Connection failed";
}
else{
    echo "connection successful <br>";
}
echo $_POST['enterItem'];
?>
