<?php
date_default_timezone_set('Asia/Manila');
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "stemsdb";

// try {
//     $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
//     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     }
// catch(PDOException $e)
//     {
//     	echo "Connection failed: " . $e->getMessage();
//     }
    
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

    // $stdId = "sample 1";
    // $rf_id = "sample 1";
    // $lname =   "sample 1";
    // $fname =  "sample 1";
    // $midInit =  "s";
    // $sex =  "male";
    // $crs =  "bsit";
    // $year =  "1";
    // $section =  "A";
    $query = "UPDATE condition_2 SET isfetch = 0 WHERE id = 0"; 
    $fetch = $conn->query($query);
    // $stmt=$fetch->execute();

if(isset($_POST['submit'])) {
    $stdId = $_POST['student_id'];
    // echo "<script>alert('$stdId')</script>";
    $rf_id = $_POST['rf_id'];
    $lname =   $_POST['lname'];
    $fname =  $_POST['fname'];
    $midInit =  $_POST['midInit'];
    $sex =  $_POST['sex'];
    $crs =  $_POST['course'];
    $year =  $_POST['year'];
    $section =  $_POST['section'];
    
    // $data = [
    //     'student_id' => $stdId
    // ];
    
    $checkSql = "SELECT student_id FROM student WHERE `student_id` = '$stdId'";
	$checkstmt = $conn->query($checkSql);
	// $checkstmt->bindParam(':student_id', $data['student_id'], PDO::PARAM_INT);
    
    // $count = $checkstmt->rowCount();
    // $checkResult = $checkstmt->fetch(PDO::FETCH_ASSOC);
    // echo "$checkResult";
    if($checkstmt->num_rows > 0){
    // if ($checkResult > 0) {
        // echo $count;
        echo "<script>alert('Please enter unique ID or unique rf id');</script>";
        header("Location: addStudentForm.php?msg=Please enter a non existing ID");
        exit(); 
    }
    // $checkSql1 = "SELECT * FROM student WHERE rf_id = $rf_id";
	// $checkstmt1 = $conn->query($checkSql1);
    // if ($checkstmt1->num_rows < 0) {
        // // if(!$checkResult){
            //     // header("Location: addStudentForm.php?msg=Please enter a your correct rf id ");
            //     echo "<script>alert('Please enter valid rf id');</script>";
            //     header("Location: addStudentForm.php");
            //     exit();
            // }
    if($checkstmt->num_rows < 1){
    // if(!$checkResult){
    // if(!$checkResult < 0){
        $query = "INSERT INTO student(student_id, rf_id, last_name, first_name, middle_initial, sex, course, year, section) VALUES('$stdId', '$rf_id', '$lname', '$fname', '$midInit', '$sex', '$crs', '$year', '$section')";
        $result = $conn->query($query);
        if($result){
            echo "<script>alert('successfully inserted');</script>";
    ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- <link rel="stylesheet" href="studentlistcopy.css"> -->
        <!-- <link rel="stylesheet" href="adduser.css"> -->
        <link rel="stylesheet" href="preview_copy.css">
      <link rel="stylesheet" href="../css/bootstrap.min.css"> 
      <title>STeMS - Preview</title>
      <!-- <div id="alertmsg"></div> -->
  </head>
  <body class="">
      <nav class="navbar navbar-expand-lg p-3 mb-2 text-white bg-dark bg-gradient" id="navbar">
      <div class="box-for-logo">
          <img id="stems-logo" src="../image/stemslogo.png" alt="logo">
      </div>
      <div class="home-container" id="home-container">
          <h1 id="homepage">
              Student Temperature Monitoring System
            </h1>
        </div>
    </nav>
    <h3 id="headPreview"> 
        Preview
    </h3> <br>
    <div id="outside-margin">
        <div id="preview-content">
            <!-- <div id="preview-header"> -->
                <img id="preview-logo" src="../image/stemslogo.png" alt="logo" height="10" width="10">
                <!-- </div> -->
                <div id="user-details">
                    <p style="text-transform:capitalize">Name: <?php  echo " ". $lname ." ".$midInit." ". $fname; ?> </p>
                    <p style="text-transform:capitalize">Student ID: <?php echo " ". $stdId ; ?></p>               
                    <p style="text-transform:capitalize">RF ID: <?php echo " ". $rf_id ; ?></p>               
                    <p style="text-transform:capitalize">Sex: <?php echo " ". $sex ; ?></p>               
                    <p style="text-transform:capitalize"> Course, Year & Section: <?php echo " ". $crs . " ".$year. " ".$section ; ?></p>
                </div>            
            </div>
                <div id="button-for-preview">
                    <button class="btn btn-default btn-info" id="btnSave" onclick="saveAsImage()"> Save </button>                
                    <button class="btn btn-default btn-primary" id="btnGoback" onclick="window.location.href = 'studentlist.php';"> Continue</button>
                </div>
    </div>
    <footer class="py-3 my-4 fixed-bottom">
    <hr>
    <ul class="nav justify-content-center border-bottom pb-1 mb-1">
      <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Facebook</a></li>
      <p class="footer-text text-center px-2 text-muted">&copy; 2023 SICT</p>
    </ul>
  </footer>
    <!-- <script src="studentList.js"></script> -->
    <script src="./../js/dom-to-image-master/src/dom-to-image.js">
        </script>
    <script>
        function saveAsImage(){
            domtoimage.toJpeg(document.getElementById('preview-content'), { quality: 0.95 })
            .then(function (dataUrl) {
                var link = document.createElement('a');
                link.download = 'my-image-name.jpeg';
                link.href = dataUrl;
                link.click();       
            });
        }
</script>
</body>
</html>
<?php
    $delQuery = "DELETE FROM rfid";
    $fetchdelQuery = $conn->query($delQuery);
    // $stmtQuery = $fetchdelQuery->execute();
    exit();
    $conn = null;
        }
    else{
        // echo $checkstmt->num_rows;
        // echo "failed to execure the query";
        echo "<script>alert('failed to execure the query');</script>";
        header("Location: addStudentForm.php?msg=failed to execure the query");
    }
    }
    else{
        // echo $checkstmt->num_rows;
    echo "<script>alert('Something went wrong');</script>";
    header("Location: addStudentForm.php?msg=Something went wrong");
    // reconnect connection
    $conn = null;
    }
}
?>