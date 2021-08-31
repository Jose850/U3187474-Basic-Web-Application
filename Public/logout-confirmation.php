<?php
// Initialize the session
session_start();

require_once "../config.php";
 
// Check if the user is already logged in, if yes then redirect him to welcome page
/* if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;
} */

include "templates/header-logout.php";
?>


<div class="jumbotron text-center">
  <h1 class="display-3">You have successfully logged out!</h1>
  <hr>
  <p>We hope to see you again!</p>
  <p>
        <a href="login.php" class="btn btn-dark">Login</a>
        <a href="register.php" class="btn btn-dark">Create a new account</a>
    </p>
</div>
<?php include "templates/footer.php"; ?>