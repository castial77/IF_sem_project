
<?php

// connect to the database
session_start();
$id = session_id();

$server = 'localhost';
$user = 'root';
$pass = '';
$db = 'login1';

// connect to the database
$mysqli = new mysqli($server, $user, $pass, $db);
// confirm that the 'id' variable has been set
if (isset($_GET['id']) && is_numeric($_GET['id']))
{
// get the 'id' variable from the URL
$id = $_GET['id'];

// delete record from database
if ($stmt = $mysqli->prepare("DELETE FROM record WHERE id = ? LIMIT 1"))
{
$stmt->bind_param("i",$id);
$stmt->execute();
$stmt->close();
}
else
{
echo "ERROR: could not prepare SQL statement.";
}
$mysqli->close();

// redirect user after delete is successful
header("Location: lecturer_homepage.php");
}
else
// if the 'id' variable isn't set, redirect the user
{
header("Location: view.php");
}

?>

