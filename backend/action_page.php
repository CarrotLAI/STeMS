<?php
require_once('db_connect.php');
//include "script.js";

session_start();


if(isset($_POST['uname']) && isset($_POST['password'])){
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $uname = validate($_POST['uname']);
    $password = validate($_POST['password']);
    $sql = "SELECT * FROM admin_acc WHERE username='$uname' AND pass='$password'";
    $result = mysqli_query($conn, $sql);
    if ($result){
        $row = mysqli_fetch_assoc($result);
        if($row['username'] === $uname && $row['pass'] === $password){
           // echo "Logged In";
        //    $_SESSION['username'] = $username;
            $_SESSION['uname'] = $row['username'];
            $_SESSION['password'] = $row['pass'];
            // $id = 1;
            $direct = '../Dashboard/dashboard.php';
            header("Location: ".$direct);
            echo "<script>alert('Log in successfully');</script>";
            exit();
        }
        else {
            echo '<script>alert("error")</script>';
            header("Location: ../index-login.php?");
            exit();       
        }
    }
    else{
        echo "<script>alert('error');</script>";
        $errorLink = '../index-login.php?';
        header("Location: ".$errorLink);
        exit();
    }
}   
?>