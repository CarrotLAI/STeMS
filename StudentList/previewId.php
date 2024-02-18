<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="studentlistcopy.css">
      <link rel="stylesheet" href="adduser.css">
      <link rel="stylesheet" href="preview.css">
      <!-- <link rel="stylesheet" href="studentLisCategory.css"> -->
      <!-- <link rel="stylesheet" href="categoryTable.css"> -->
      <title>STeMS - Preview</title>
      <div id="alertmsg"></div>
  </head>
  <body>
    <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
  <div class="home-container" id="home-container">
          <img id="stems-logo" src="../image/stemslogo.png" alt="logo">
          <h1 id="homepage">
              Student Temperature Monitoring System
          </h1>
          <button id="btnBack" onclick="window.history.go(-1)"> Back </button> <!-- redirect to studenlog.php --> 
  </div>
    </nav>
    <?php 
    include_once('addUserDb.php');
    ?>
    <div id="outside-margin">
        <div id="preview-content">
            <p > <?php 
            // if(isset($_POST['msg'])){
            //     echo "<script> alert.window("
            // }
            ?> </p>
            <div id="user-details">
            <?php 
            echo "<p>Name: ". $lname ."". $fname . "</p>";
            echo "<p>Student ID: ". $stdId. "</p>";
            echo "<p>RF ID: ". $rf_id. "</p>";
            echo "<p>Sex: " . $sex."</p>";
            echo "<p>Course & Section: " . $crs . $section. "</p>";
            ?>
            </div>            
        </div>
        <div id="print-preview">
                <button> print </button>
        </div>

    </div>
<body>


    <script src="studentList.js"></script>
</body>
</html>