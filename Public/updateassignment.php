<?php 

    // include the config file that we created last week
    require "../config.php";
    require "common.php";


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
              "assignmentpercentage"   => $_POST['assignmentpercentage'],
              "date"   => $_POST['date'],
              
            ];
            
            // create SQL statement
            $sql = "UPDATE `assignmenttracker` 
                    SET id = :id, 
                        assignmentname = : assignmentname, 
                        classname = :classname, 
                        duedate = :duedate, 
                        assignmentpercentage = :assignmentpercentage, 
                        date = :date 
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

<?php include "templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) : ?>
	<p>Work successfully updated.</p>
<?php endif; ?>

<h2>Update an assignment</h2>

<form method="post">
    
    <label for="id">ID</label>
    <input class="form-control mr-sm-2" type="text" name="id" id="id" value="<?php echo escape($work['id']); ?>" >
    
    <label for="assignmentname">Assignment Name</label>
    <input class="form-control mr-sm-2" type="text" name="assignmentname" id="assignmentname" value="<?php echo escape($work['assignmentname']); ?>">

    <label for="classname">Class Name</label>
    <input class="form-control mr-sm-2" type="text" name="classname" id="classname" value="<?php echo escape($work['classname']); ?>">

    <label for="duedate">Due Date</label>
    <input class="form-control mr-sm-2" type="text" name="duedate" id="duedate" value="<?php echo escape($work['duedate']); ?>">

    <label for="assignmentpercentage">Assignment Percentage</label>
    <input class="form-control mr-sm-2" type="text" name="assignmentpercentage" id="assignmentpercentage" value="<?php echo escape($work['assignmentpercentage']); ?>">
    
    <label for="date">Work Date</label>
    <input class="form-control mr-sm-2" type="text" name="date" id="date" value="<?php echo escape($work['date']); ?>">

    <input class="btn btn-outline-success my-2 my-sm-0" type="submit" name="submit" value="Save">

</form>

<?php include "templates/footer.php"; ?>
