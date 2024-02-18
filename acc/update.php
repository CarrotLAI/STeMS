<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "stemsdb";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

if(isset($_POST['update'])){
    // if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"])){
    // $id = $_GET['id'];
    // $id = 1;
    // $link = $_GET['action'];

    $newUsername = $_POST['new-username'];
    $newPassword = $_POST['new-password'];
    $password = $_POST['password'];

    echo $newUsername;
    
    $checkSql = "SELECT * FROM admin_acc WHERE pass = '$password'";
    $result = mysqli_query($conn, $checkSql);
    if($result){
        $sql = mysqli_query($conn, "UPDATE admin_acc SET 
        username = '$newUsername', pass = '$newPassword' WHERE id=1");
        echo "<script>alert('updated successfully');</script>";
        echo "<script>document.location='accountSetting.php' </script>"; 
    }
    else{
        echo "<script>alert('something went wrong');</script>";
    }
}

?>