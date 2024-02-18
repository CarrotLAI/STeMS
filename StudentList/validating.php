<?php
$conn = new mysqli ("localhost", "root", "", "stemsdb");
if($conn->connect_error){
echo "Connection failed" .  $conn->connect_error;

if(isset($_POST['student_id'])){
    $std_id = mysqli_real_escape_string($conn, $_POST['student_id']);

    $sql = "SELECT Student ID FROM user";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()){
            if($row['Student ID'] === $std_id){
               echo "data already exist"; 
            }
            else{
                header("Location: studentList.php?");
                $conn.exit();
            }
        }
}
}
}