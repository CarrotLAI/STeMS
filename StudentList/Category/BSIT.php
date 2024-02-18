<?php
    require_once('conn.php');
    include_once('delete.php');      

    $query = "UPDATE condition_2 SET isfetch = 0 WHERE id = 0"; 
    $fetch = $conn->query($query);
?>
<!DOCTYPE html>
  <html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">

      <link rel="stylesheet" href="style.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/dataTables.bootstrap5.min.css">
      <link rel="stylesheet" href="../../css/bootstrap.min.css"> 
      <!-- <link rel="stylesheet" href="../../DataTables/css/dataTables.bootstrap5.css"> -->
      <!-- <link rel="stylesheet" href="categoryTable.css"> -->
      <link rel="stylesheet" href="modal.css">

      <script defer src="jquery-3.5.1.js"></script>
      <script defer src="jquery.dataTables.min.js"></script>
      <script defer src="dataTables.bootstrap5.min.js"></script>
      <script defer src="script.js"></script>
      <script defer src="function.js"></script>
      <script defer src="../js/bootstrap.min.js"></script>
<!-- <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script> -->
    <!-- <script src="../../js/bootstrap.min.js"></script> -->
    <script src="../../js/jquery.js"></script>
    <!-- <script src="../../js/jquery.min.js"></script> -->

      <title>STeMS - BSIT</title>
    
  </head>
  <body class="bg-light">
  <div class="navbar navbar-expand-lg p-3 mb-2 text-white bg-dark bg-gradient" id="">
          <img id="stems-logo" src="../../image/stemslogo.png" alt="logo">
          <h1 id="homepage">
              Student Body Temperature <br> Monitoring System
          </h1>
          <h3 id="main">BSIT</h3>
          <div class="anchor-button">
          <button id="btnbackToHome" onclick="directDashboard();">Home</button>  <!-- back to dashboard -->
          <button id="btnStudentLog" onclick="directStudentLog();">Student Log </button> <!-- redirect to studenlog.php --> 
          <button id="return-to-recent" onclick="window.history.go(-1)">Return</button>
          </div>
</div>
<div class = "category-box bg-light bg-gradient">    
    <div class="navigation-section">
        <div id="div-selectFilter">
            <label class="label" for="Course">Course: </label>
                <select name="" id="filterCourse" class="selectFilter">
                    <option value="" disabled="" selected=""> Select filter </option>
                    <option value="" >All</option>
                    <option value="BSIT">BSIT</option>
                    <option value="BSHM">BSHM</option>
                    <option value="BSOA">BSOA</option>
                    <option value="BSED">BSED</option>
                    <option value="BEED">BEED</option>
                    <option value="BSEntrep">BSEntrep</option>
                    <option value="BSA">BSA</option>
                    <option value="BSFT">BSFT</option>
                </select>
            <label class="label" for="Year">Year: </label>
                <select name="" id="filterYear" class="selectFilter">
                    <option value="" disabled="" selected=""> Select filter </option>
                    <option value="" >All</option>
                    <option value="1">1st year</option>
                    <option value="2">2nd year</option>
                    <option value="3">3rd year</option>
                    <option value="4">4th year</option>
                </select>
                <label class="label" for="Year">Section: </label>
                <select name="" id="filterSection" class="selectFilter">
                    <option value="" disabled="" selected=""> Select filter </option>
                    <option value="">All</option>
                    <option value="A">Section A</option>
                    <option value="B">Section B</option>
                    <option value="C">Section C</option>
                    <option value="D">Section D</option>
                </select>
                <label class="label" for="Sex">Sex: </label>
                <select name="" id="filterSex" class="selectFilter">
                    <option value="" disabled="" selected=""> Select filter </option>
                    <option value="">All</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
        </div>
    </div>
    <div class="student-button">
        <button class="btn btn-success" id="btnAddStudent" onclick="directStudentList();">Add Student</button>
    </div>
    
<table class="table table-striped table-hover table-dark table-sm" id="example"> <br><br>

<thead class="thead">
    <tr>
        <th>No.</th>
        <th>Student ID</td>
        <th>RF ID</th>
        <th>Last Name</th>
        <th>First Name</th>
        <th>Middle Initial</th>
        <th>Sex</th>
        <th>Course</th>
        <th>Year </th>
        <th>Section</th>
        <th>Operation</th>
    </tr>
</thead> 
<tbody id="myTable">
    <?php 
        $sql = "SELECT * FROM student WHERE course = 'BSIT'";
        $i = 1;
        foreach($conn->query($sql) as $row){
            ?>
            <tr class="tbrows" id="tbrows" width=100% >
                <td> <?php echo  $i; ?> </td>
                <td><?php echo $row["student_id"]  ?> </td>
                <td> <?php echo $row["rf_id"]; ?> </td>
                <td style="text-transform: capitalize"> <?php echo $row["last_name"]; ?></td>
                <td style="text-transform: capitalize"> <?php echo $row["first_name"]; ?></td>
                <td> <?php echo $row["middle_initial"]; ?></td>
                <td> <?php echo $row["sex"]; ?> </td> 
                <td> <?php echo $row["course"];?> </td> 
                <td> <?php echo $row["year"];?> </td> 
                <td> <?php echo $row["section"];?></td>
                <td><button class="fcc-btn-delete" onclick=deleteModal(<?php echo $row["id"]; ?>) style=width:auto;>Delete </button>
                <a class="fcc-btn" href="update-process.php?id=<?php echo $row["id"];?> &action=BSIT">Update</a>
                </td>                
            </tr>
            <?php
            $i = $i + 1;
        } 
    ?>
</tbody>
</table>


<!-- The Modal for delete-->
<div id="modal" class="modal">
  
  <form class="modal-content animate" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <div class="container">
      <p> Are sure do you want to remove this data?
        Please enter password to delete.
    </p>
      <!-- <label for="psw"><b>Password</b></label> -->
      <input type="password" placeholder="Enter Password" name="password" required>
      <input id="deletebtn" type="hidden" name="delete_id" value="<?php echo $row["id"];?>">
      <input id="deletebtn" type="submit" name="delete" value="Delete" class="deletebtn"> 

      <button type="button" onclick="document.getElementById('modal').style.display='none'" class="cancelbtn">Cancel</button>
    </div>
  </form>
</div>
</div>
  </body>
  <footer class="py-3 my-4 fixed-bottom">
    <hr>
    <ul class="nav justify-content-center border-bottom pb-1 mb-1">
      <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Facebook</a></li>
      <p class="footer-text text-center px-2 text-muted">&copy; 2023 SICT</p>
    </ul>
  </footer>
  </html>