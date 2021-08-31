<?php

// Initialize the session
session_start();

if(!isset($_SESSION['user'])) // The exact conditional depends on your login-system implementation
{
    header('Location: login.php'); // Instructs the visitor's browser to redirect
    exit; // <-- What you want. Prevents further code from being executed, works as a security measure.
}

require_once "../config.php";


 
// Check if the user is already logged in, if yes then redirect him to welcome page
/* if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;
} */

include "templates/header.php";
?>

<body>
    <div class="page-header">
    <div class="jumbotron">
        <div class="container">
          <h1 class="display-3">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to the Assignment Due Date Tracker App</h1>
        </div>
      </div>
    </div>


<?php 
include "templates/footer.php"; 
?>
