<?php 

session_start();

    // include the config file 
    require "../config.php";
    require "common.php";

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
            $success = "Work successfully deleted";

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

<?php include "templates/header.php"; ?>

        <body>
    <div class="page-header">
    <div class="jumbotron">
        <div class="container">
          <h1 class="display-3">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to the Assignment Due Date Tracker App</h1>
        </div>
      </div>
    </div>


 <h2 class="heading">Your Most Recent Tasks</h2>

        <!-- This is a loop, which will loop through each result in the array -->
        <?php foreach($result as $row) { ?>
          <div class="row">
    <div class="col">
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
        <tr>
        <th scope="col"><?php echo $row['assignmentname']; ?><br></th>
        <th scope="col"><?php echo $row['classname']; ?><br></th>
        <th scope="col"><?php echo $row['duedate']; ?><br></th>
        <th scope="col"><?php echo $row['assignmentpercentage']; ?><br></th>
    </tbody>
</div>
 </div>


                <?php // this willoutput all the data from the array
            //echo '<pre>'; var_dump($row); ?>

        <?php }; //close the foreach ?>

    </div>

<?php include "templates/footer.php"; ?>