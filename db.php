<?php 
// declaration
$hostname = "localhost";
$username = "root";
$password = "kiyoomieo<3";
$database = "student_grading";

$conn = new mysqli($hostname, $username, $password, $database);

if ($conn->connect_error)
    die("Connection failed: " . $conn->connect_error);

?>
