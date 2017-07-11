<?php
$host = "localhost";
$user = "root";
$password = "Lapras#131";
$database = "bucketList";
$getItem = array();
$connection = mysqli_connect($host, $user, $password, $database) or die("Cound not connect! <br>" . mysqli_connect_error() );

$sql = "SELECT * FROM items";
$result = $connection->query($sql);

if ($result->num_rows >0){
    while($row = $result->fetch_assoc()){
        array_push($getItem, $row["item"]);
    }
}
else {
    echo "0 results <br>";
}
echo json_encode($getItem);
mysqli_close($connection);
?>
