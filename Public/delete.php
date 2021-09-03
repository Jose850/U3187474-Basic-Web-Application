<?php 
   session_start();
   
       // include the config, common and check templates file
       require_once "../config.php";
       require_once "common.php";
       require_once "templates/check.php";
   
       // This code will only run if the delete button is clicked
       if (isset($_GET["id"])) {
   	    // this is called a try/catch statement 
           try {
               // define database connection
               $connection = new PDO($dsn, $username, $password, $options);
               
               // set id variable
               $id = $_GET["id"];
               
               // Create the SQL 
               $sql = "DELETE FROM assignmenttracker WHERE id = :id";
   
               // Prepare the SQL
               $statement = $connection->prepare($sql);
               
               // bind the id to the PDO
               $statement->bindValue(':id', $id);
               
               // execute the statement
               $statement->execute();
   
               // Success message
               $success = "<h2>Work successfully deleted!</h2>";
   
           } catch(PDOException $error) {
               // if there is an error, tell us what it is
               echo $sql . "<br>" . $error->getMessage();
           }
       };
   
       // This code runs on page load
       try {
           $connection = new PDO($dsn, $username, $password, $options);
   		
           // SECOND: Create the SQL 
           $sql = "SELECT * FROM assignmenttracker WHERE userid = {$_SESSION["id"]}";
           
           // THIRD: Prepare the SQL
           $statement = $connection->prepare($sql);
           $statement->execute();
           
           // FOURTH: Put it into a $result object that we can access in the page
           $result = $statement->fetchAll();
       } catch(PDOException $error) {
           echo $sql . "<br>" . $error->getMessage();
       }
   
   ?>
<!-- Header Template -->
<?php include "templates/header.php"; ?>
<!DOCTYPE HTML>
<html>
   <head>
      <meta charset="utf-8" />
      <title>Delete an Assignment</title>
   </head>
   <body>
      <!-- Heading-->
      <h2 class="heading">Delete an Assignment</h2>
      <div class="row">
         <div class="col">
            <!-- Table -->
            <table class="table table-striped">
            <thead>
            <tbody>
               <tr>
                  <th scope="col">Assignment Name</th>
                  <th scope="col">Class Name</th>
                  <th scope="col">Due Date</th>
                  <th scope="col">Assignment Percentage</th>
                  <th scope="col">Submit</th>
               </tr>
            </tbody>
            </thead>
         </div>
      </div>
      <form method ="post" onsubmit="confirm('Do you really want to delete everything?')";>
      <?php if (isset($success)){
         echo $success;
         }?>
      <!-- This is a loop, which will loop through each result in the array -->
      <?php foreach($result as $row) { ?>
      <!-- Values -->
      <tbody>
         <tr>
            <th scope="col"><?php echo $row['assignmentname']; ?></td>
            <th scope="col"><?php echo $row['classname']; ?></td>
            <th scope="col"><?php echo $row['duedate']; ?></td>
            <th scope="col"><?php echo $row['assignmentpercentage']; ?><br></td>
            <th scope="col">
               <form method ="post" onsubmit="confirm('Are you sure you want to delete this item?')";>
               <a class="btn btn-danger" onClick ="return confirm('Do you really want to delete this item?');" href='delete.php?id=<?php echo $row['id']; ?>'>Delete</a></td>
         </thead>
      </tbody>
      </tr>
      <?php }; //close the foreach
         ?>
         </table>
      </div>
      </div>
<!-- Footer Template-->
<?php include "templates/footer.php"; ?>