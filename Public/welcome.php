
<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
include "templates/header.php";
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to the Assignment Tracker</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <div class="jumbotron text-center">
    <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to the Assignment Tracker App</h1>
  <hr>
    <p>
        <a href="index.php" class="btn btn-dark">Continue to the site!</a>
        <a href="reset-password.php" class="btn btn-dark">Reset Your Password</a>
        <a href="logout.php" class="btn btn-dark">Sign Out of Your Account</a>
    </p>
</body>
</html>