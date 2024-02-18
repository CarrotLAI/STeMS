<?php
  require_once('../backend/conn.php');
?>
<html>
    <head>
      <link rel="stylesheet" href="studentlog.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <link href="../DataTable/datatables.min.css"/> 
        <link rel="stylesheet" href="../css/bootstrap.min.css"> 
        <!-- script side -->
        <script src="../DataTable/datatables.min.js"></script>              
        <!-- <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script> -->
        <script defer src="studentlog.js"></script>
        <!-- <script defer src="https://code.iconify.design/2/2.1.0/iconify.min.js"></script> -->

        <title>STeMS - Log</title>        
    </head>
    <body class=""> 
    <div class="navbar navbar-expand-lg p-3 mb-2 text-white bg-dark bg-gradient" id="navbar">
        <div class="box-for-logo">
        <img id="stems-logo" src="../image/stemslogo.png" alt="logo">
        </div>
        <div class="header-name">
        <h1 id="homepage">
            Student Temperature <br>
            Monitoring System
        </h1>
        <h1 id="main"> Student Log </h1>
        </div>
  
        <div class="anchor-button">
                 <button id="btnHome" onclick="directdashboard();"> Home </button>
                 <button id="btnHome" onclick="directStudentList();"> Student List </button>
        </div>
            
    </div>
        <div class="category-box main-contain ">
            <nav class="date-time">
            <p id="date-time"></p> <?php echo date('Y/m/d'); ?> 
            </nav>
            <table class="table table-striped table-sortable table-dark text-center" id="example" style="width:100%"> 
            <thead id="table-sortable">
                <tr class=headtable id=headtable>
                    <th> No. </td>
                    <th> Student ID </th>
                    <th> Last Name </th>
                    <th> First Name </th>
                    <th> Course </th>
                    <th> Year </th>
                    <th> Section </th>
                    <th> Rf ID</th>
                    <th> Temperature </th>
                    <th> Date & Time </th>
                    <!-- <th> Time </th> -->
                </tr>
            </thead>
            <tbody id="showTable">          
                    <?php       
                    date_default_timezone_set('Asia/Manila');     
                    $date = date("Y-m-d");                   
                    $sql = "SELECT * FROM attendance_form";

                    if(isset($_REQUEST['val'])){
                        $to_search = $_REQUEST['val'];
                        $sql = "SELECT * FROM attendance_form ORDER BY $to_search WHERE Date = '$date'";
                        $result = $conn->query($sql);
                    }
                                    
                    echo "<br><br>";
                    $i=1;
                    foreach($conn->query($sql) as $row){
                      echo "<tr class=tbrows id=tbrows width=100% >";
                      echo "<td>" . $i ."</td>";
                      echo "<td>" . $row["Student_ID"] . "</td>";
                      echo "<td>" . $row["Last_Name"] . "</td>";
                      echo "<td>" . $row["First_Name"] . "</td>";
                      echo "<td>" . $row["Course"] . "</td>";
                      echo "<td>" . $row["Year"] . "</td>";
                      echo "<td>" . $row["Section"] . "</td>";
                      echo "<td>" . $row["rf_id"] . "</td>";
                      echo "<td>" . $row["Temperature"] . "</td>";
                      echo "<td>" . $row["Date"]. " " .$row["Time"]. "</td></tr>";
                      // echo "<td>"  "</td></tr>";
                      $i = $i + 1;
                   }                                           
                  ?>
        </tbody>
      </form>
    </div>
  </div>
  </table>
  </div>
  <footer class="footer">
    <ul class="nav justify-content-center border-bottom pb-1 mb-1" id="footer-content">
      <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Facebook</a></li>
      <p class="footer-text text-center px-2 text-muted">&copy; 2023 SICT</p>
    </ul>
  </footer>
</body>
</html>