<?php
   if(isset($_POST['enterItem'])) {
        //Initializing variables
        $host = "localhost";
        $user = "root";
        $password = "Lapras#131";
        $database = "bucketList";
        $getItem = array();
        $newItem = $_POST['enterItem'];
        //start connection
        $conn = mysqli_connect($host, $user, $password, $database) or die("Cound not connect! <br>" . mysqli_connect_error() );
        $sql = "INSERT INTO items(item) VALUE ('$newItem')";
        $conn->query($sql);//Insert into database
        mysqli_close($conn);
}
header('Location: index.html');
?>
