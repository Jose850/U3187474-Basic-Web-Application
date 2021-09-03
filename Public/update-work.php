<?php 
session_start();

    // include the config, common and check file. Only require it once
    require_once "../config.php";
    require_once "common.php";
    require_once "templates/check.php";

    // run when submit button is clicked
    if (isset($_POST['submit'])) {
        try {
            $connection = new PDO($dsn, $username, $password, $options);  
            
            //grab elements from form and set as varaible
            $work =[
              "id"         => $_POST['id'],
              "assignmentname" => $_POST['assignmentname'],
              "classname"  => $_POST['classname'],
              "duedate"   => $_POST['duedate'],
              "assignmentpercentage"   => $_POST['assignmentpercentage']
            ];

            // create SQL statement
            $sql = "UPDATE `assignmenttracker` 
                    SET id = :id, 
                        assignmentname = :assignmentname, 
                        classname = :classname, 
                        duedate = :duedate, 
                        assignmentpercentage = :assignmentpercentage 
                    WHERE id = :id";

            //prepare sql statement
            $statement = $connection->prepare($sql);
            
            //execute sql statement
            $statement->execute($work);

        } catch(PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
        }
    }

    // GET data from DB
    //simple if/else statement to check if the id is available
    if (isset($_GET['id'])) {
        //yes the id exists 
        
        try {
            // standard db connection
            $connection = new PDO($dsn, $username, $password, $options);
            
            // set if as variable
            $id = $_GET['id'];
            
            //select statement to get the right data
            $sql = "SELECT * FROM assignmenttracker WHERE id = :id";
            
            // prepare the connection
            $statement = $connection->prepare($sql);
            
            //bind the id to the PDO id
            $statement->bindValue(':id', $id);
            
            // now execute the statement
            $statement->execute();
            
            // attach the sql statement to the new work variable so we can access it in the form
            $work = $statement->fetch(PDO::FETCH_ASSOC);
            
        } catch(PDOExcpetion $error) {
            echo $sql . "<br>" . $error->getMessage();
        }
    } else {
        // no id, show error
        echo "No id - something went wrong";
        //exit;
    };

?>

 <!-- Include the header -->
 <?php include "templates/header.php"; ?>
 <!DOCTYPE HTML>
 <html>
     <head>
         <meta charset="utf-8" />
         <title>Update your Assignments</title>
    </head>
    <body>
    <!-- Heading -->
    <h2 class="heading">Edit Your Assignments</h2>
    <!-- Php statement- submit -->
    <?php if (isset($_POST['submit']) && $statement) : ?>
        <h2>Work successfully updated!</h2>
        <?php endif; ?>
 <!-- Form-->
 <form class="form-inline"method="post">
     <input readonly type="hidden" name="id" id="id" value="<?php echo escape($work['id']); ?>" >
    <div class="row">
        <div class="col">
            <label for="assignmentname">Assignment Name:</label>
            <input class="form-control mr-sm-2" type="text" name="assignmentname" required id="assignmentname" value="<?php echo escape($work['assignmentname']); ?>">
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label for="classname">Class Name:</label>
            <input class="form-control mr-sm-2" type="text" name="classname" required id="classname" value="<?php echo escape($work['classname']); ?>">
        </div>
</div>
<div class="row">
    <div class="col">
    <label for="classname">Date Due</label>
        <input class="form-control mr-sm-2" type="date" name="duedate" required id="duedate" value="<?php echo escape($work['duedate']); ?>">
    </div>
</div>
<div class= "row">
    <div class="col">
        <label for="assignmentpercentage">Assignment Percentage</label>
        <input class="form-control mr-sm-2" type="text" name="assignmentpercentage" required id="assignmentpercentage" value="<?php echo escape($work['assignmentpercentage']); ?>">
</div>
</div>
</form>
 <!-- Submit Button -->
<div class="row">
    <div class="col">
        <form class="submit">
            <input class="btn btn-outline-success my-2 my-sm-0"type="submit" name="submit" value="Save">
            <a class="btn btn-success" href="updateassignment.php">Go Back</a>
        </form>
</div> 
</div>
  </body>
   <!-- Footer  -->
<?php include "templates/footer.php"; ?>

