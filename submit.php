<?php
//Initializing variables
$host = "localhost";
$user = "root";
$password = "Lapras#131";
$database = "bucketList";
$getItem = array();
$getItem2 = array();
$newItem = $_POST['enterItem'];
//start connection
$conn = new mysqli($host, $user, $password, $database);
$sql = "INSERT INTO items(item) VALUE ('$newItem')";
$conn->query($sql);//Insert into database
?>
