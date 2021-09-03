<?php 
session_start();
	
    // include the config, common and check file. Only require it once
    require_once "../config.php";
    require_once "common.php";
    require_once "templates/check.php";

    
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
 <!-- Header Template -->
<?php include "templates/header.php"; ?>
<!DOCTYPE HTML>
<html>
    <head>
    <meta charset="utf-8" />
    <title>Update Your Assignments</title>
</head>
<body>
     <!-- Heading-->
<h2 class="heading">Update Your Assignments</h2>
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
        <!-- This is a loop, which will loop through each result in the array -->
<?php foreach($result as $row) { ?>
    <thead>
         <!-- Values -->
    <tbody> 
        <tr>
            <th scope="col"><?php echo $row['assignmentname']; ?><br> Class Name:</th>
            <th scope="col"><?php echo $row['classname']; ?><br> Due Date:</th>
            <th scope="col"><?php echo $row['duedate']; ?><br> Assignment Percentage:</th>
            <th scope="col"><?php echo $row['assignmentpercentage']; ?><br></th>
            <th scope="col"><form class="submit">
            <a class="btn btn-success"href='update-work.php?id=<?php echo $row['id']; ?>'>Edit</a></th>
        </thead>
    </tbody>
</tr>
                <?php // this willoutput all the data from the array
            //echo '<pre>'; var_dump($row); ?>

        <?php }; //close the foreach ?>
    </table>
</div>
        </div>
 <!-- Footer  -->
<?php include "templates/footer.php"; ?>