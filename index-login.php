<?
session_start();
$_SESSION['uname'] = $uname;
if(!isset($_SESSION["uname"])){
  header("Location: index-login.php?msg=error");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="modal.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <title>Sudent Body Temperature Monitoring System</title>
</head>
<body>
<div class="navbar navbar-expand-lg p-3 mb-2 text-white bg-dark bg-gradient" id="navbar">
    <div class="downward-box"></div>
      <!-- <div class="box-for-logo"> -->
        <img id="stems-logo" src="image/stemslogo.png" alt="logo">
      <!-- </div> -->
      
        <h1 id="homepage">
            Student Body Temperature Monitoring System
        </h1>
      

    <!-- Form Modal -->
    <!-- Button to open the modal login form -->
      <nav class="anchor-button">
        <button id="homepage-link" onclick="document.getElementById('modal').style.display='block'">SIGN IN</button>
      </nav>
    </div>
 

<!-- The Modal -->
<div id="modal" class="modal">
  <span onclick="document.getElementById('modal').style.display='none'"
class="close" title="Close Modal">&times;</span>
  
  <!-- Modal Content -->
    <form class="modal-content animate bg-transparent" action="backend/action_page.php" method="post">
    <div class="modal-container">
      <label for="uname"><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="uname" required>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="password" required>

      <button class="submit" type="submit">Login</button>
      <button type="button" onclick="document.getElementById('modal').style.display='none'" class="cancelbtn">Cancel</button>
    

     <!-- <div class="modal-container belowContainer"> style="background-color:#f1f1f1"> -->
      <!-- <span class="psw">Forgot <a href="#">password?</a></span> -->
    <!-- </div>  -->
  </div>
  </form>
</div>
    </section> 


<!-- Slideshow container -->
<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <!-- <img src="..." class="d-block w-90" alt="..."> -->
      <img class="d-block w-90 m-auto" src="image/1.jpg" style="width:1000px;height:530px" alt="First slide">
    </div>
    <div class="carousel-item">
      <!-- <img src="..." class="d-block w-90" alt="..."> -->
      <img class="d-block w-90 m-auto" src="image/2.png" style="width: 1000px;height:530px" alt="Second slide">
    </div>
    <div class="carousel-item">
      <!-- <img src="..." class="d-block w-90" alt="..."> -->
      <img class="d-block w-90 m-auto" src="image/3.png" style="width: 1000px;height:530px" alt="Third slide">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon btn-primary" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon btn-primary" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="script.js"></script>

</html>