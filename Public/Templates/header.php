<!doctype html>
<html lang="en">

<head>

    <title>Assignment Due Date Tracker</title>
    <meta charset="utf-8">

    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
</head>

<body> 
    <header>
  <div class="topnav">
  <a class="navbar-brand" href="index.php">Assignment Due Date Tracker</a>
  <a class="nav-link" href="newassignment.php">Add a new assignment</a></li>
  <a class="nav-link" href="read.php">Find an assignment</a></li>
  <a class="nav-link" href="updateassignment.php">Update an assignment</a></li>
  <a class="nav-link" href="delete.php">Delete an assignment</a>
  <div class="topnav-right">
    <a class="nav-link" href="reset-password.php">Reset Your Password</a>
    <a class="nav-item" href="logout.php"onClick ="return confirm('Are you sure you want to logout?');" href='logout.php?id= <?php echo $row['id']; ?>'>Logout</a></a>
  </div>
</div>
</header>

