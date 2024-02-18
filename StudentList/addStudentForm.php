<?php 
@include_once('../backend/conn.php');

$query = "UPDATE condition_2 SET isfetch = 1 WHERE id = 0"; 
$fetch = $conn->query($query);
$stmt=$fetch->execute();

// $queryData = "SELECT `rf_id` FROM rfid";
// $stmt=$conn->query($queryData);
// $r = $db->fetch();
?>
<!DOCTYPE html> 
<html lang="en">
<head>
<meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- <link rel="stylesheet" href="studentlistcopy.css"> -->
      <link rel="stylesheet" href="adduser.css">
      <link rel="stylesheet" href="../css/bootstrap.min.css"> 
      <!-- <link rel="stylesheet" href="studentLisCategory.css"> -->
      <!-- <link rel="stylesheet" href="categoryTable.css"> -->
      <title>STeMS - Add Student</title>
      <div id="alertmsg"></div>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg p-3 mb-2 text-white bg-dark bg-gradient"> 
  <div class="home-container" id="home-container">
          <img id="stems-logo" src="../image/stemslogo.png" alt="logo" height="100" width="100">
          <h1 id="homepage">
              Student Temperature Monitoring System
          </h1>
          <div class="anchor-button">
          <button id="btnBack" onclick="window.location.href = 'studentlist.php';"> Back </button> <!-- redirect to studenlog.php --> 
          </div>
</div>
    </nav>
</head>
<body>
    <div class ="container">
        <div id="forMessage">
            <?php if(isset($_GET['msg'])){
                echo "<p class=error>" . $_GET['msg'] . "</p>" ;
            }?>
        </div> 
    <form id="post-form" autocomplete="off" action="addUser.php" method="post">

        <label for="student_id"> Student ID </label> <br>
        <input class="addUserId" type="text" placeholder="Student Id" name="student_id" minlength="9" oninput="this.value = this.value.toUpperCase()" required> <br>  
    
        <label for="rf_id"> Rf Id </label> <br>
        <div id=InputRf></div><br>

        <label for="lname">Last Name</label><br>
        <input class="addUserInput" id="capitalize-text"Placeholder="Last Name" type="text" name="lname" onkeypress="return textKey(event)" style="text-transform: capitalized;" required> <br>

        <label for="fname">First Name</label> <br>
        <input class="addUserInput" id="capitalize-text" Placeholder="First Name" type="text" name="fname" onkeypress="return textKey(event)" style="text-transform: capitalized;" required> <br>

        <label for="midInit">Middle Initial</label> <br>
        <input class="addUserInput" Placeholder="Middle Initial" type="char" name="midInit" maxlength="1" min="20" max="22" oninput="this.value = this.value.toUpperCase()" onkeypress="return textKey(event)"> <br>

        <div class="select-container">            
            <label for="sex">Sex</label> <br>
            <select name="sex" required>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select><br>
            
        <label for="course">Course</label> <br>
         <select name="course" class="txtField" required>
             <option value="BSIT">BSIT</option>
             <option value="BSHM">BSHM</option>
             <option value="BSOA">BSOA</option>
             <option value="BSED">BSED</option>
             <option value="BEED">BEED</option>
             <option value="BSEntrep">BSEntrep</option>
             <option value="BSA">BSA</option>
             <option value="BSFT">BSFT</option>
            </select> <br> 
        <!-- <input id="addUserInput" Placeholder="Course" type="text" name="course" required><br> -->
        <label for="year">Year</label><br>
        <select name="year" required id="onchangeYear">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
        </select><br>
        <!-- <input id="addUserInput" Placeholder="Year" type="text" name="year" required onchange="valid(val);"><br> to be change -->
        <label for="section">Section</label><br>
        <select name="section" required>
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
            <option value="D">D</option>
        </select><br>
    </div>
        <button id="btnaddUser" type="submit" name="submit">Add User</button>
    </nav>
</form>
</div>

<!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script> -->
<script src="jquery.1.3.js"></script>
<script src="studentList.js"></script>
<script src="script.js"></script>
<script>
function textKey(evt) {
      // Only ASCII character in that range allowed
      var ASCIICode = (evt.which) ? evt.which : evt.keyCode

     if ((ASCIICode >= 65 && ASCIICode <= 90) || (ASCIICode >= 97 && ASCIICode <= 122) || ASCIICode === 32)
          return true //letter and space
      return false;
  }
function fetchRf(){
}
    document.querySelector("#capitalize-text").addEventListener("keypress", (e) => {
    if(0 == this.selectionStart) {
      // uppercase first letter
      forceKeyPressUppercase(e);
    } else {
      // lowercase other letters
      forceKeyPressLowercase(e);
    }
  });
</script>
</body>
</html>