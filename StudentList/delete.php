<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "stemsdb";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

if(isset($_POST['delete'])){
    $id=$_POST["delete_id"];
    $pass = $_POST["password"];
    $sql= "SELECT * FROM `admin_acc` WHERE `pass` = '$pass'";
    $result = mysqli_query($conn, $sql);
    if($result->num_rows>0){
        // echo "<script>alert('$pass.$id');</script>";
        echo "<script>alert('successfuly deleted');</script>";
        $sql = "DELETE FROM student WHERE id = '$id'";
        $delstmt = mysqli_query($conn, $sql);
    }
    else{
        echo "<script>alert('Failed to delete');</script>";
        // echo "<script>alert('$pass.$id');</script>";
    }
}
?>