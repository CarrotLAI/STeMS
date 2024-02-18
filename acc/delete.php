<?php
$conn = new mysqli ("localhost", "root", "", "stemsdb");
if($conn->connect_error){
echo "Connection failed" .  $conn->connect_error;
}
// echo "the id is";

if(isset($_POST['delete'])){
  $delete_id = mysqli_real_escape_string($conn, $_POST['delete_id']);

  $sql = "DELETE FROM student WHERE id = ('$delete_id')";

  if ($conn->query($sql) === true) {
    echo "Record deleted successfully";
    $link = 'studentlist.php?';
    header("Location: ". $link);
    } else {
    echo "Error deleting record: " . $conn->error;
    }
  }
$conn->close();