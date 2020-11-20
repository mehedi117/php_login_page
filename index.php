<?php 
  $pass = false;
  $cr = false;
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  include "partials/_dbconnect.php";
  
  $username = $_POST["username"];
  $password = $_POST["password"];

  $sql = "SELECT * FROM `users` WHERE Username = '$username'";
  $result = mysqli_query($conn, $sql);
  $num = mysqli_num_rows($result);
  if($num == 1){
      while($row = mysqli_fetch_assoc($result)){
        if(password_verify($password, $row['Password'])){
          $login = true;
          echo "successfully log in";
          session_start();
          $_SESSION['loggedin'] = true;
          $_SESSION['username'] = $username;
          header("location: welcome.php");
        }
        else{
          $pass = true;
        }
      }


  }else{
    $cr = true;
  }

}


?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
      <?php
        require "partials/navbar.php";

        if($pass){
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        <span class="sr-only">Close</span>
        </button>
        <strong>Error!</strong> Password dose not match.
        </div>';
        }
        if($cr){
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        <span class="sr-only">Close</span>
        </button>
        <strong>Error!</strong> Invalid Credentials.
        </div>';
        }

      ?>
    <div class="container">
        <form class="d-flex flex-column align-items-center" action="/login/index.php" method="POST">
            <h2 class="my-3">Login to your accout</h2>

            <div class="form-group col-md-6">
                <label for="">Username</label>
                <input type="text" class="form-control" name="username" id="" aria-describedby="emailHelpId" placeholder="">
            </div>
            <div class="form-group col-md-6">
                <label for="">Password</label>
                <input type="password" class="form-control" name="password" id="" aria-describedby="emailHelpId" placeholder="">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </div>




    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
  </body>
</html>