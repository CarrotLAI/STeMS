<?php
session_start();
if(!isset($_SESSION["uname"])){
  header("Location: ../index-login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css"> 
    <link rel="stylesheet" href="style.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
    <!-- <link rel="stylesheet" href="dashboard.css"> -->
    <title>STeMS - Home</title>
</head>
<body>
    <div class="navbar navbar-expand-lg p-3 mb-2 text-white bg-dark bg-gradient" id="navbar">
      <!-- <div class="box-for-logo"> -->
        <img id="stems-logo" src="../image/stemslogo.png" alt="logo">
      <!-- </div> -->
        <h1 id="homepage">
            Student Body Temperature Monitoring System
        </h1>
      <nav class="anchor-button">
        <button id="btnStudentLog" onclick="directStudentLog();">Student Log </button> <!-- redirect to studenlog.php --> 
        <button id="btnAddStudent" onclick="directStudentList();">Student List</button> <!-- redirect to add addUser.php -->
        <button id="btnAccount" onclick="directAccountSetting();"> Account </button>
        <button id="btnLogOut" onclick="funcLogout();"> Log out </button>
      </nav>        
    </div>
    
    <!-- Slideshow container -->
    <!-- <div class="slideshow-container"> -->

<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <!-- <img src="..." class="d-block w-90" alt="..."> -->
      <img class="d-block w-90 m-auto" src="../image/1.jpg" style="width:1000px;height:530px" alt="First slide">
    </div>
    <div class="carousel-item">
      <!-- <img src="..." class="d-block w-90" alt="..."> -->
      <img class="d-block w-90 m-auto" src="../image/2.png" style="width: 1000px;height:530px" alt="Second slide">
    </div>
    <div class="carousel-item">
      <!-- <img src="..." class="d-block w-90" alt="..."> -->
      <img class="d-block w-90 m-auto" src="../image/3.png" style="width: 1000px;height:530px" alt="Third slide">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon bg-primary" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span id="btnNext" class="carousel-control-next-icon btn-primary"  aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

<br>

<!-- </div> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<script src="../script.js"></script>
<div class="footer">
    <hr>
    <ul class="nav justify-content-center border-bottom pb-1 mb-1">
      <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Facebook</a></li>
      <p class="footer-text text-center px-2 text-muted">&copy; 2023 SICT</p>
    </ul>
</div>
</body>
</html>