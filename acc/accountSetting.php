<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="../DataTable/datatables.css"/>
    <link rel="stylesheet" href="date-picker/font-awesome.min.css"/>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    
    <sctipt src="date-picker/bootstrap-datepicker.min.js"> </sctipt>
    <sctipt src="test.js"> </sctipt>
    <!-- <script src="datatable.datetime.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"> </script>
    <!-- <script src="https://cdn.datatables.net/datetime/1.3.1/js/dataTables.dateTime.min.js"> </script> -->
    <script src="../DataTable/datatables.min.js"> </script>
    <script defer src="script.js"></script>
    <script defer src="../js/bootstrap.min.js"></script>
    

    <title>Account</title>
</head>
<body>

<nav class="navbar navbar-expand-lg p-3 mb-2 bg-dark bg-gradient">
  <div class="container-fluid">
    <!-- account -->
    <a class="navbar-brand text-white" href="../Dashboard/dashboard.php" onclick="">STeMS</a> 
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarScroll">
      <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">

        <li class="nav-item">
          <button class="nav-link tablinks text-white" aria-current="page" onclick="openContents(event, 'Temperature-log')" id="defaultOpen">Temperature log</button>
        </li>
        <li class="nav-item">
          <button class="nav-link tablinks text-white" onclick="openContents(event, 'Archive-data')">Archived data</button>
        </li>

        <li class="nav-item">
          <button class="nav-link tablinks text-white" onclick="openContents(event, 'Account-setting')">Account and Privacy Setting</button>      
        </li>
  
      </ul>
    </div>
  </div>
</nav>
<div class="main-contain">
<!-- temperature log tab -->
<div id="Temperature-log" class="tabcontent">
    <h3>Temperature Log</h3>
    <div class="filterTemp">
      <!-- <table cellspacing="5" cellpadding="5" border="0">
        <tbody>
          <tr>
            <td>Filter Date</td>
            <td><input type="text" class="clearText" id="mintemp" name="min" placeholder="From" maxlength="4"></td>
            <td>-</td>
            <td><input type="text" class="clearText" id="maxtemp" name="max" placeholder="To" maxlength="4" ></td>
             <td><button class="btn btn-danger" onclick="clearAll()">Clear</button></td> 
          </tr>
          <tr>
          </tr>
        </tbody>
      </table> -->
    </div>
    <table class="table display table-striped table-hover table-dark table-bordered table-sm" id="dataTable1" style="text-align:center">
        <thead class="thead">
        <tr>
            <th>Student ID</th>
            <th>RF ID</th>
            <!-- <th>Name</th> -->
            <th>Temperature</th>
            <th>Date</th>
            <th>Time</th>
        </tr> 
        </thead>
        <tbody>
            <?php
            include_once('temperature-log.php');
            ?>
        </tbody>
    </table>
</div>


<!-- archive data tab -->
<div id="Archive-data" class="tabcontent">
    <!-- <p> This is the content of the archive data</p> -->
    <h3>Archived Data</h3>

    <!-- <select><option value=""></option></select> -->
    <div class="filterTab">
      <table cellspacing="5" cellpadding="5" border="0">
        <tbody>
          <tr>
            <td>Filter Date</td>
            <td><input type="text" class="clearText" id="min" name="min" placeholder="From" maxlength="0"></td>
            <td>-</td>
            <td><input type="text" class="clearText" id="max" name="max" placeholder="To" maxlength="0" ></td>
             <!-- <td><button class="btn btn-danger" onclick="clearAll()">Clear</button></td> -->
          </tr>
          <tr>
          </tr>
        </tbody>
      </table>
    </div>
    <table class="table display table-striped table-hover table-dark table-bordered table-sm" id="dataTable" style="text-align:center">
        <thead>
        <tr class="thead">
            <!-- <td>No.</td> -->
            <th>Student ID</th>
            <th>Last Name</th>
            <th>First Name</th>
            <!-- <th>Middle Initial</th> -->
            <!-- <th>Sex</th> -->
            <th>Course</th>
            <th>Year</th>
            <th>Section</th>
            <th>RF ID</th>
            <th>Temperature</th>
            <th>Date</th>
            <th>Time</th>
            <!-- <td>Option</td> -->
        </tr> 
        </thead>
        <tbody>
             <?php 
            include_once('archive-data.php');
            ?>
        </tbody>
    </table> 
</div>

 <!-- account setting tab -->
  <div id="Account-setting" class="tabcontent">
  <div id="acc-setting-form" class="account-setting-box">
    <form action="update.php" method="post" autocomplete="off">
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "stemsdb";
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

     $id = 1;
     $sql = "SELECT * FROM admin_acc WHERE id = '$id'"; 
     $query = mysqli_query($conn, $sql);
     $row=mysqli_fetch_array($query)
     ?>
      New username: <br>
      <input class="form-input" type="text" name="new-username" placeholder="New username" value="<?php echo $row['username']; ?>" required>
      <br>
      New Password: <br>
      <input class="form-input" type="password" name="new-password" placeholder="New Password" value="<?php echo $row['pass']; ?>" required>
      <br>
      Enter Last Password: <br>
      <input class="form-input" type="password" name="password" placeholder="Enter Password" required>
      <br>
      <div class="d-grid gap-4">
      <button class="btn btn-primary btn-default" type="submit" name="update">Update</button>
      </div>
    </form>
  </div>
 </div>
</div>
 <div class="footer py-3 my-4 fixed-bottom ">
     <ul class="nav justify-content-center border-bottom pb-1 mb-1" id="footer-content">
       <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Facebook</a></li>
       <p class="footer-text text-center px-2 text-muted">&copy; 2023 SICT</p>
     </ul>
    </div>
</body>
</html>s