
<?php
include 'db.php';

// Check if the form was submitted using POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Check whether the delete ID exists
    if (!isset($_POST['delete']) || !is_numeric($_POST['delete'])) {
        die("Invalid student ID.");
    }

    // Get student ID
    $id = (int) $_POST['delete'];

    // Delete student record
    $sql = $conn->prepare("DELETE FROM results WHERE id = ?");
    $sql->bind_param("i", $id);

    if ($sql->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }

} else {
    echo "Invalid request.";
}
?>
