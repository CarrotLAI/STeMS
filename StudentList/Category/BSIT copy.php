<?php
    require_once('conn.php');
    include_once('delete.php');
    include_once('update-process.php');
     
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
      <link rel="stylesheet" href="update-style.css">
      <!-- <link rel="stylesheet" href="../../DataTables/css/dataTables.bootstrap5.css"> -->
      <link rel="stylesheet" href="categoryTable.css">
      <link rel="stylesheet" href="modal.css">

      <script defer src="jquery-3.5.1.js"></script>
      <script defer src="jquery.dataTables.min.js"></script>
      <script defer src="dataTables.bootstrap5.min.js"></script>
      <script defer src="script.js"></script>
      <script defer src="function.js"></script>
      <script defer src="../js/bootstrap.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- <script src="../../js/bootstrap.min.js"></script> -->
    <script src="../../js/jquery.js"></script>
    <!-- <script src="../../js/jquery.min.js"></script> -->

      <title>STeMS - BSIT</title>
    
  </head>
  <body>
    <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
  <div class="home-container" id="home-container">
          <img id="stems-logo" src="../../image/stemslogo.png" alt="logo">
          <h1 id="homepage">
              Student Body Temperature <br> Monitoring System
          </h1>
          <h3>BSIT</h3>
          <button id="btnbackToHome" onclick="directDashboard();">Home</button>  <!-- back to dashboard -->
          <button id="btnStudentLog" onclick="directStudentLog();">Student Log </button> <!-- redirect to studenlog.php --> 
          <button id="return-to-recent" onclick="window.history.go(-1)">Return</button>


</div>
    </nav>
<div class = "category-box">    
<div id="navigation-section">
<button id="btnAddStudent" onclick="directStudentList();">Add Student</button>
<label for="Year">Year: </label>
<div id="selectFilter">
    <select name="" id="filterYear">
        <option value="" disabled="" selected=""> Select filter </option>
        <option value="">All</option>
        <option value="1">1st year</option>
        <option value="2">2nd year</option>
        <option value="3">3rd year</option>
        <option value="4">4th year</option>
    </select>
    <label for="Year">Section: </label>
    <select name="" id="filterSection">
        <option value="" disabled="" selected=""> Select filter </option>
        <option value="">All</option>
        <option value="A">Section A</option>
        <option value="B">Section B</option>
        <option value="C">Section C</option>
        <option value="D">Section D</option>
    </select>
    <label for="Sex">Sex: </label>
    <select name="" id="filterSex">
        <option value="" disabled="" selected=""> Select filter </option>
        <option value="">All</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
    </select>
</div>
</div>

<table class="table sortable-table table-hover table-sm table-container table-striped" id="example"> <br><br>

<thead class="thead">
    <tr>
        <th>No.</th>
        <th>Student ID</td>
        <th>RF ID</th>
        <th>Last Name</th>
        <th>First Name</th>
        <th>Middle Initial</th>
        <th>Sex</th>
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
                <td> <?php echo $row["last_name"]; ?></td>
                <td> <?php echo $row["first_name"]; ?></td>
                <td> <?php echo $row["middle_initial"]; ?></td>
                <td> <?php echo $row["sex"]; ?> </td> 
                <td> <?php echo $row["year"];?> </td> 
                <td> <?php echo $row["section"];?></td>
                <td><a><button class="fcc-btn-delete" onclick=deleteModal(<?php echo $row["id"]; ?>) style=width:auto;>Delete </button> </a>
                <a><button class="fcc-btn" onclick=UpdateModal(<?php echo $row["id"]; ?>) style=width:auto;>Update</button></a>
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
      <input id="deletebtn" type="hidden" name="delete_id" value="">
      <input id="deletebtn" type="submit" name="delete" value="Delete" class="deletebtn"> 

      <button type="button" onclick="document.getElementById('modal').style.display='none'" class="cancelbtn">Cancel</button>
    </div>
  </form>
</div>

<!-- <?php
    // $stmt = $conn->prepare("Select * from student WHERE id=65");
    // $result = execute();
    // if($result){
    //     foreach($result as $row){
    //         fetch 
    //     }
    // }
?> -->
<!--  to be fix -->

<!-- The Modal for update-->
<div id="update-modal" class="modal">
  
<form name="frmUser" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="form-control form-container"> 
    <div class="form-inputs form-container">

            <label for="">Student ID:</label><br>
        <!-- <input type="hidden" name="student_id" class="txtField" value="<?php echo $row['student_id']; ?>"> -->
            <input type="text" name="student_id" class="txtField" value="<?php echo $row['student_id']; ?>"><br>
        

            RF ID: <br>
            <input type="text" name="rf_id" class="txtField" value="<?php echo $row['rf_id'];?>"><br>
    
            Last Name :<br>
            <input type="text" name="last_name" class="txtField" value="<?php echo $row['last_name']; ?>"><br>

            First Name: <br>
            <input type="text" name="first_name" class="txtField" value="<?php echo $row['first_name']; ?>">
            <br> 

            Middle Initial:<br>
            <input type="text" name="middle_initial" class="txtField" value="<?php echo $row['middle_initial']; ?>">
            <br>
            <div class="Select-container">
                Sex: <br>
                <select name="sex" class="txtField">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>

                Course:<br>
                <select name="course" class="txtField">
                    <option value="BSIT">BSIT</option>
                    <option value="BSHM">BSHM</option>
                    <option value="BSOA">BSOA</option>
                    <option value="BSED">BSED</option>
                    <option value="BEED">BEED</option>
                    <option value="BSEntrep">BSEntrep</option>
                    <option value="BSA">BSA</option>
                    <option value="BSFT">BSFT</option>
                </select>

                Year:<br>
                <select name="year" class="txtField">
                    <option value="1">1st</option>
                    <option value="2">2nd</option>
                    <option value="3">3rd</option>
                    <option value="4">4th</option>
                </select>

                Section:<br>
                <select name="section" class="txtField">
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                </select><br>
            </div>
            
  </div>
  <input id="updatebtn" type="hidden" name="update" value="">
  <input id="updatebtn" type="submit" name="update" value="update" class="updatebtn"> 
    <button type="button" onclick="document.getElementById('update-modal').style.display='none'" class="cancelbtn">Cancel</button>
    <!--  -->
</form>
      
</div>

</div>

</div>

    
    <!-- <script>
    document.querySelector('#mySelect').addEventListener('change', ()=>{
    const toSearch = document.querySelector('#mySelect').value;
    console.log(toSearch);
    window.location.replace("/project/studentList/Category/BSIT.php?val="+toSearch)
});
    </script> -->
  </body>
  </html>