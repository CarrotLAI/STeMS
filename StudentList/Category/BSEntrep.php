<?php
    require_once('conn.php');

    if(isset($_POST['delete'])){
        // $id = $_POST['password'];
        // header("Location: delete.php?".$id);
        $pass = $_POST['password'];
        $delete_id = $_POST['delete_id'];

        $Data = [
            'pass' => $pass,
            'id' => $delete_id
        ];

        $checksql = "SELECT * FROM admin_acc WHERE pass = :pass";
        $stmt = $conn->prepare($checksql);
        $stmt->bindParam(':pass', $Data['pass'], PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchALl(PDO::FETCH_ASSOC);
        if($result){
            foreach($result as $result){
                
                $sql = "SELECT * FROM student WHERE id = :id";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':id', $Data['id'], PDO::PARAM_INT);
                $stmt->execute();
                // header("Location: delete.php?error=failtodelete");
                // echo $result['id'];
            }
            $sql = "DELETE FROM student WHERE id = :id";
            $delstmt = $conn->prepare($sql);
            $delstmt->bindParam(':id', $Data['id'], PDO::PARAM_INT);
            $delstmt->execute();            
        } 
    }   
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
      <link rel="stylesheet" href="categoryTable.css">
      <link rel="stylesheet" href="modal.css">

      <script defer src="jquery-3.5.1.js"></script>
      <script defer src="jquery.dataTables.min.js"></script>
      <script defer src="dataTables.bootstrap5.min.js"></script>
      <script defer src="script.js"></script>
      <script src="function.js"></script>
    <!-- <script src="../../js/bootstrap.min.js"></script> -->
    <script src="../../js/jquery.js"></script>
    <!-- <script src="../../js/jquery.min.js"></script> -->

      <title>STeMS - BSEntrep</title>
    
  </head>
  <body>
    <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
  <div class="home-container" id="home-container">
          <img id="stems-logo" src="../../image/stemslogo.png" alt="logo">
          <h1 id="homepage">
              Student Body Temperature <br> Monitoring System
          </h1>
          <h3>BSEntrep</h3>
          <button id="btnbackToHome" onclick="directDashboard();">Home</button>  <!-- back to dashboard -->
          <button id="btnStudentLog" onclick="directStudentLog();">Student Log </button> <!-- redirect to studenlog.php --> 
          <button id="return-to-recent" onclick="window.history.go(-1)">Return</button>


</div>
    </nav>
<div class = "category-box">    
<div id="navigation-section">
<button id="btnAddStudent" onclick="directStudentList();">Add Student</button>
<!-- <label for="Year">Year: </label>
<div id="selectFilter">
    <select name="fetchval" id="filterYear">
        <option value="" disabled="" selected=""> Select filter </option>
        <option value="All" selected>All</option>
        <option value="1">1st year</option>
        <option value="2">2nd year</option>
        <option value="3">3rd year</option>
        <option value="4">4th year</option>
    </select>
</div> -->
<!-- <div class="form-group">
    <input type="text" id="myInput" placeholder="Search for names" class="form-control">
</div> -->

</div>

<!-- Female -->
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
        <th>Year & Section</th>
        <th>Operation</th>
    </tr>
</thead> 
<tbody id="myTable">
    <?php 
        $sql = "SELECT * FROM student WHERE course = 'BSEntrep'";
        // if(isset($_REQUEST['val'])){
        //     $to_search = $_REQUEST['val'];
        //     $sql = "SELECT * FROM student WHERE year = '$to_search' AND course = 'BSIT' AND sex = 'Female'";
        // }
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
                <td> <?php echo $row["year"]. "-" . $row["section"]; ?> </td> 
                <td><a><button class="fcc-btn-delete" onclick=deleteModal(<?php echo $row["id"]; ?>) style=width:auto;>Delete </button> </a>
                <a class="fcc-btn" href="update-process.php?id=<?php echo $row["id"];?>">Update</a>
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
      <input id="deletebtn" type="hidden" name="delete_id" value="<?php echo $Idel;?>">
      <input id="deletebtn" type="submit" name="delete" value="Delete" class="deletebtn"> 

      <button type="button" onclick="document.getElementById('modal').style.display='none'" class="cancelbtn">Cancel</button>
    </div>
    <!-- <div class="container" style="background-color:#f1f1f1">
      
      <span class="psw">Forgot <a href="#">password?</a></span>
    </div>  -->
  </form>
</div>
</table>
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