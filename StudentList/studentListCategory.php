<?php
    session_start();
    include_once('connection.php');
    
    $query = "UPDATE condition_2 SET `isfetch` = 0 WHERE `id` = 0"; 
    $fetch = $conn->query($query);
    
      ?>
  
  <!DOCTYPE html>
  <html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- <link rel="stylesheet" href="studentListcopy.css"> -->
      <!-- <link rel="stylesheet" href="../adduser.css"> -->
      <link rel="stylesheet" href="studentListCategory.css">
      <link rel="stylesheet" href="../css/bootstrap.min.css"> 
      <title>STeMS - Category</title>
      <div id="alertmsg"></div>
  </head>
  <body class="">
  <div class="navbar navbar-expand-lg p-3 mb-2 text-white bg-dark bg-gradient" id="navbar">
          <img id="stems-logo" src="../image/stemslogo.png" alt="logo">
          <h1 id="homepage">
              Student Temperature Monitoring System
          </h1>
        <div class="anchor-button">
          <button id="btnbackToHome" onclick="directDashboard();">Home</button>  <!-- back to dashboard -->
          <button id="btnStudentLog" onclick="directStudentLog();">Student Log </button>
        </div>
</div>
<h1 id="title"> Student Category </h1>
<div class = "category-box .bg-secondary-subtle">
<category class="course-list">
    <button class="p-3 mb-2 bg-dark text-white" id="btnCategory" onclick="goToBsit()">BSIT</button>
    <button class="p-3 mb-2 bg-dark text-white" id="btnCategory" onclick="goToBshm()">BSHM</button>
    <button class="p-3 mb-2 bg-dark text-white" id="btnCategory" onclick="goToBsa()">BSA</button>
    <button class="p-3 mb-2 bg-dark text-white" id="btnCategory" onclick="goToBsEntrep()">BSEntrep</button>
    <button class="p-3 mb-2 bg-dark text-white" id="btnCategory" onclick="goToBsa()">BSOA</button>
    <button class="p-3 mb-2 bg-dark text-white" id="btnCategory" onclick="goToBsa()">BSED</button>
    <button class="p-3 mb-2 bg-dark text-white" id="btnCategory" onclick="goToBsa()">BEED</button>
    <button class="p-3 mb-2 bg-dark text-white" id="btnCategory" onclick="goToBsa()">BSFT</button>
</category>

<script src="studentList.js"></script>
</div>
</div>
  <footer class="py-3 my-4 fixed-bottom">
    <hr>
    <ul class="nav justify-content-center border-bottom pb-1 mb-1">
      <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Facebook</a></li>
      <p class="footer-text text-center px-2 text-muted">&copy; 2023 SICT</p>
    </ul>
  </footer>
</body>
</html>