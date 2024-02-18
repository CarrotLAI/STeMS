<?php 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "stemsdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 
$query = "SELECT * FROM rfid";
$result = $conn->query($query);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    echo '<input class="addUserInput" type="text" placeholder="Rf Id" name="rf_id" value="'. $row['rf_id'] .'" size=7>';
    }
}
// else{
//     echo '<script>alert("error")</script>';
// }
exit();
