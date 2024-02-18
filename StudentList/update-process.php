<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "stemsdb";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

if(isset($_POST['update'])){
    // if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"])){
        $id = $_GET['id'];
        // $link = $_POST['action'];
        echo "<script>alert($id.' '.$action )</script>";
 
    $lastname =$_POST['last_name'];
    $firstname =$_POST['first_name'];
    $middle_initial =$_POST['middle_initial'];
    $sex =$_POST['sex'];
    $course =$_POST['course'];
    $year =$_POST['year'];
    $section =$_POST['section'];

    $sql =mysqli_query($conn, "UPDATE student SET 
    last_name = '$lastname', first_name = '$firstname', middle_initial ='$middle_initial',
    sex = '$sex', course = '$course', year ='$year', section = '$section' WHERE id='$id'
    ");
    if($sql){
        echo "<script>alert('updated successfully');</script>";
        echo "<script>document.location='studentlist.php' </script>";
        mysqli_close($conn);
    }
    else{
        echo "<script>alert('something went wrong');</script>";
        mysqli_close($conn);
    }
    mysqli_close($conn);
}

?>
<!DOCTYPE html>
<head lang="eng">
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="update-style.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
<title>Update Data</title>
</head>
<body>
    <div class="navbar navbar-expand-lg p-3 mb-2 text-white bg-dark bg-gradient" id="">
    <img id="stems-logo" src="../image/stemslogo.png" alt="logo">
          <h1 id="homepage">
              Student Body Temperature <br> Monitoring System
          </h1>
          <div class="row">
              <div class="h2-title">
                  <h2>Update data</h2>
              </div>
          </div>
    </div>
<div class="div-container">
    <form method="post" action="" autocomplete="off">
        <?php
            $id = $_GET['id'];
            $sql = "SELECT * FROM student WHERE id = '$id' ";
            $query = mysqli_query($conn, $sql);
            while($row=mysqli_fetch_array($query)){
        ?>
        <div class="form-inputs form-container">    
              <!-- <input type="hidden" name="student_id" class="txtField" value="<?php echo $row['student_id']; ?>"> -->
              <!-- <input type="text" name="student_id" class="txtField" value="<?php echo $row['student_id']; ?>"><br> -->
            
              <!-- <input type="text" name="rf_id" class="txtField" value="<?php echo $row['rf_id'];?>"><br> -->
              
              Last Name <br>
              <input type="text" name="last_name" class="txtField" value="<?php echo $row['last_name']; ?>"><br>
              
              First Name <br>
              <input type="text" name="first_name" class="txtField" value="<?php echo $row['first_name']; ?>">
              <br> 
              
              Middle Initial <br>
              <input type="text" name="middle_initial" class="txtField" value="<?php echo $row['middle_initial']; ?>">
              <br>
              <div class="Select-container">
                  Sex: <br>
                  <select name="sex" class="txtField">
                  <option value="<?php echo $row['sex']?>" disabled><?php echo $row['sex']?></option>
                      <option value="Male">Male</option>
                      <option value="Female">Female</option>
                  </select>
                  
                  Course:<br>
                  <select name="course" class="txtField">
                  <option value="<?php echo $row['course']?>"><?php echo $row['course']?></option>
                      <option value="BSIT">BSIT</option>
                      <option value="BSHM">BSHM</option>
                      <option value="BSOA">BSOA</option>
                      <option value="BSED">BSED</option>
                      <option value="BEED">BEED</option>
                      <option value="BSEntrep">BSEntrep</option>
                      <option value="BSA">BSA</option>
                      <option value="BSFT">BSFT</option>
                    </select>
              </div>
            <div class="Select-container-2">
                    Year:<br>
                    <select name="year" class="txtField">
                    <option value="<?php echo $row['year']?>" disabled><?php echo $row['year']?></option>
                        <option value="1">1st</option>
                        <option value="2">2nd</option>
                        <option value="3">3rd</option>
                        <option value="4">4th</option>
                    </select>
                    
                    Section:<br>
                    <select name="section" class="txtField">
                    <option value="<?php echo $row['section']?>" disabled><?php echo $row['section']?></option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                    </select><br>
                </div>
                <?php 
                }
                ?>
            </div>
            <div class="div-button">
                <input id="updatebtn" type="submit" name="update" value="Update" class="updatebtn btn btn-primary"> 
                <button class="btn btn-danger">  <a class="anchor-button" href='studentlist.php'> Cancel </a></button>
            </div>
      
    </form>
    </div>
</body>
</html>
<?php 
mysqli_close($conn);
?>