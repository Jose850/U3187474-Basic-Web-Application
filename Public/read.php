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

        <h2>All Assignments</h2>

    </div>

        <!-- This is a loop, which will loop through each result in the array -->
        <?php foreach($result as $row) { ?>
    
    ID:
    <?php echo $row["id"]; ?><br> Assignment Name:
    <?php echo $row['assignmentname']; ?><br> Class Name:
    <?php echo $row['classname']; ?><br> Due Date;
    <?php echo $row['duedate']; ?><br> Assignment Percentage:
    <?php echo $row['assignmentpercentage']; ?><br>
</p>

                <?php // this willoutput all the data from the array
            //echo '<pre>'; var_dump($row); ?>

        <?php }; //close the foreach ?>

    </div>



</div>
<?php include "templates/footer.php"; ?>