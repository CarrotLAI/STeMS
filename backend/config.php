<?php 
//include 'data.php';
$conn = new mysqli("localhost", "root", "", "stemsdb");
$sql = "SELECT * FROM user";
$result = $conn->query($sql);