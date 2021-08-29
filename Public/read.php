
<?php 

session_start();

// this code will only execute after the submit button is clicked
if (isset($_POST['submit'])) {
	
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
}
?>

<?php include "templates/header.php"; ?>
<h2>Find an Assignment</h2>

<?php  
    if (isset($_POST['submit'])) {
        //if there are some results
        if ($result && $statement->rowCount() > 0) { ?>



<?php 
                // This is a loop, which will loop through each result in the array
                foreach($result as $row) { 
            ?>

<p>
    
    ID:
    <?php echo $row["id"]; ?><br> Assignment Name:
    <?php echo $row['assignmentname']; ?><br> Class Name:
    <?php echo $row['classname']; ?><br> Due Date;
    <?php echo $row['duedate']; ?><br> Assignment Percentage:
    <?php echo $row['assignmentpercentage']; ?><br>
</p>
<?php 
                            // this willoutput all the data from the array
                            //echo '<pre>'; var_dump($row); 
                        ?>

<hr>
<?php }; //close the foreach
        }; 
    }; 
?>



<?php include "templates/footer.php"; ?>