<?php
session_start();
// this code will only execute after the submit button is clicked
if (isset($_POST['submit'])) {
    if(!isset($_SESSION['user'])) // The exact conditional depends on your login-system implementation
{
    header('Location: login.php'); // Instructs the visitor's browser to redirect
    exit; // <-- What you want. Prevents further code from being executed, works as a security measure.
}
// include the config file that we created before
require "../config.php";
// this is called a try/catch statement
try {
// FIRST: Connect to the database
$connection = new PDO($dsn, $username, $password, $options);

$userid = $_SESSION['id'];
$assignmentname  = $_POST['assignmentname'];
$classname = $_POST['classname'];
$duedate = $_POST['duedate'];
$assignmentpercentage = $_POST['assignmentpercentage'];

// SECOND: Get the contents of the form and store it in an array
$new_work = array(
    "assignmentname" => $_POST['assignmentname'],
    "classname" => $_POST['classname'],
    "duedate" => $_POST['duedate'],
    "assignmentpercentage" => $_POST['assignmentpercentage'],
    "userid" => $_SESSION["id"]
);
// THIRD: Turn the array into a SQL statement
$sql = "
    INSERT 
    INTO assignmenttracker (assignmentname, classname, duedate, assignmentpercentage, userid) 
    VALUES (:assignmentname, :classname, :duedate, :assignmentpercentage, :userid)
    ";
// FOURTH: Now write the SQL to the database
$statement = $connection->prepare($sql);
$statement->execute($new_work);
} catch(PDOException $error) {
// if there is an error, tell us what it is
echo $sql . "<br>" . $error->getMessage();
}
}
?>
<?php include "templates/header.php"; ?>
<h2>Add a new assignment</h2>

<?php if (isset($_POST['submit']) && $statement) { 
    echo "<h2>Work successfully added!</h2";
 } ?>

<!--form to collect data for each artwork-->
    <form class="form-inline" method="post">
    <div class="row">
    <div class="col">
    <label for="assignmentname">Assignment Name</label>
    <input class="form-control mr-sm-2" type="text" name="assignmentname" id="assignmentname" placeholder="Assignment Name">
    <label for="classname">Class Name</label>
    <input class="form-control mr-sm-2" type="text" name="classname" id="classname" placeholder="Class Name">
    <label for="duedate">Due Date</label>
    <input class="form-control mr-sm-2" type="text" name="duedate" id="duedate" placeholder="Due Date">
    <label for="form-control mr-sm-2" for="assignmentpercentage">Assignment Percentage</label>
    <input class="form-control mr-sm-2"type="text" name="assignmentpercentage" id="assignmentpercentage"placeholder="Assignment Percentage"> 
</div>
</div> 
            <div class="row">
                <div class="col">
    <input class="btn btn-outline-success my-2 my-sm-0"type="submit" name="submit" value="Submit">
</form>
</div>
</div>
<?php include "templates/footer.php"; ?>


</form>