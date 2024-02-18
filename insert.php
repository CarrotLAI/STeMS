<?php
include 'config.php';
if(isset($_POST['submit'])){
    $temp = $_POST('Temperature');
    $time = $_POST('Time');
}

$sql = "INSERT INTO 'user' ('Temperature', 'Time') VALUES('$temp', '$time')";
$result = $conn->query($sql);
if(result == TRUE){
    echo "record posted";
}
else{
    echo "Error: " . $sql . "<br>". $conn->error;
}
$conn->close();