<?php
  // Initialiser la session
  session_start();
  // Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
  if(!isset($_SESSION["username"])){
    header("Location: login.php");
    exit();
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Zniti Blog</title>
  <!-- Font Awesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
<!-- Google Fonts -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
<!-- Bootstrap core CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
<!-- Material Design Bootstrap -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.18.0/css/mdb.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap" rel="stylesheet">
<!-- JQuery -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.18.0/js/mdb.min.js"></script>
  <link rel="stylesheet" href="css/style.css" />
  </head>
  <body>

  <nav class="navbar navbar-expand-lg navbar-light warning-color lighten-5">
  <a class="navbar-brand" href="index.php">ZNITI</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
    aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Home</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="profile.php">Profile</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="addpost.php">New post</a>
      </li>
    </ul>
    <span class="navbar-text white-text">
          <?php




        if(!isset($_SESSION["username"])){

          echo '<a href="login.php">Sign in</a>';

        }else {
          echo '<a href="logout.php">Sign out</a>';
        }
      ?>
    </span>
  </div>
</nav>


<div class="container">
<div class="row">
<div class="allposts">

 <?php

 require('config.php');
 require('class.php');


 $sql = "SELECT * FROM post WHERE id_user = '{$_SESSION[ "id" ]}'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
 // output data of each row
 while($row = $result->fetch_assoc()) {
   echo '<div class="post"><span class="username">' .$_SESSION['username'].'  </span><span class="date"> ' . $row["date"]. ' </span><br /> <h3 class="title"> ' . $row["title"]. ' </h3><br /> ' . $row['content']. '<br><a class="delete" href="profile.php?del='.$row['id'].'">Delete</a>&nbsp<a class="update" href="updatepost.php?id='.$row['id'].'">Update</a></div>';
 }
} else {
 echo "<p class='noposts'>No posts yet ! <a href='addpost.php'> Click here</a> to add a new post </p>";
}
//zniti
if (isset($_GET['del'])) {
    $id = $_GET['del'];
    $sqldel = "DELETE FROM post WHERE id=$id";
$result = $conn->query($sqldel);
    header('location: profile.php');
  }

  ?>
</div>
</div>
</div>


  </body>
</html>
