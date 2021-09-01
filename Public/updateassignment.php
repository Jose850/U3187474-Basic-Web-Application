<?php 

    session_start();
	
    // include the config file that we created before
    require "../config.php"; 
    
    // this is called a try/catch statement 
	try {
        // FIRST: Connect to the database
        $connection = new PDO($dsn, $username, $password, $options);
		
        // SECOND: Create the SQL 
        $sql = "SELECT * FROM assignmenttracker WHERE userid = {$_SESSION["id"]}";
        
        // THIRD: Prepare the SQL
        $statement = $connection->prepare($sql);
        $statement->execute();
        
        // FOURTH: Put it into a $result object that we can access in the page
        $result = $statement->fetchAll();

	} catch(PDOException $error) {
        // if there is an error, tell us what it is
		echo $sql . "<br>" . $error->getMessage();
	}	

?>

<?php include "templates/header.php"; ?>


<h2>Update an Assignment</h2>

<!-- This is a loop, which will loop through each result in the array -->
<?php foreach($result as $row) { ?>

<p>
    

    <div class="row">
        <div class="col">
            Assignment Name:
            <?php echo $row['assignmentname']; ?><br> Class Name:
            <?php echo $row['classname']; ?><br> Due Date:
            <?php echo $row['duedate']; ?><br> Assignment Percentage:
            <?php echo $row['assignmentpercentage']; ?><br>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <form class="submit">
                <a class="btn btn-success"href='update-work.php?id=<?php echo $row['id']; ?>'>Edit</a>
            </form>
</div>
</div>
        </p>
<?php }; //close the foreach
?>





<?php include "templates/footer.php"; ?>


