<?php
// Initialize the session
session_start();

require_once "../config.php";
require_once "templates/check.php";
include "templates/header-logout.php";
?>

<title>Successfully Logged Out</title>
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