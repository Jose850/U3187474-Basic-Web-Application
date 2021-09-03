<?php 

session_start();

    // include the config file 
    require_once "../config.php";
    require_once "common.php";
    require_once "templates/check.php";

    // This code runs on page load
    try {
		
        // SECOND: Create the SQL 
        $sql = "SELECT * FROM assignmenttracker WHERE userid = {$_SESSION["id"]} ORDER BY duedate LIMIT 3";
        
        // THIRD: Prepare the SQL
        $statement = $pdo_connection->prepare($sql);
        $statement->execute();
        
        // FOURTH: Put it into a $result object that we can access in the page
        $result = $statement->fetchAll();
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }

?>

<?php include "templates/header.php"; ?>
<!DOCTYPE HTML>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Assignment Due Date Tracker</title>
  </head>
  <body>
    <div class="page-header">
      <div class="jumbotron">
        <div class="container">
          <h1 class="display-3">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. <br>Welcome to the Assignment Due Date <br>Tracker App</h1>
        </div>
      </div>
    </div>
    <h2 class="heading">Your Most Recent Tasks</h2>
    <div class="row">
        <div class="col">
          <!-- Table -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Assignment Name</th>
                        <th scope="col">Class Name</th>
                        <th scope="col">Due Date</th>
                        <th scope="col">Assignment Percentage</th>
                    </tr>
                </thead>
                <tbody>
                  <!-- This is a loop, which will loop through each result in the array -->
                <?php foreach ($result as $row) { ?>
                    <tr>
                        <td scope="col"><?php echo $row['assignmentname']; ?></td>
                        <td scope="col"><?php echo $row['classname']; ?></td>
                        <td scope="col"><?php echo $row['duedate']; ?></td>
                        <td scope="col"><?php echo $row['assignmentpercentage']; ?></td>
                    </tr>
                    <?php };?>
                </tbody>
                </table>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <form class="submit">
            <a class="btn btn-success"href="read.php">See More</a>
            </form>
          </div>
        </div>
      </body>
      </html>
      <?php include "templates/footer.php"; ?>