
<?php
include 'db.php';

// Check whether an ID was passed through the URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid student ID. Please go back to Student Records.");
}

$id = (int) $_GET['id'];

// Get the existing student record
$sql = $conn->prepare("SELECT * FROM results WHERE id = ?");
$sql->bind_param("i", $id);
$sql->execute();

$result = $sql->get_result();
$row = $result->fetch_assoc();

if (!$row) {
    die("Student record not found.");
}

// Store existing information
$student_name = $row['student_name'];
$matric_number = $row['matric_number'];
$subject_name = $row['subject_name'];
$subject_code = $row['subject_code'];
$test1 = $row['test_1'];
$test2 = $row['test_2'];
$final_exam = $row['final'];

// Update record when the form is submitted
if (isset($_POST['submit'])) {

    $student_name = trim($_POST['student_name']);
    $matric_number = trim($_POST['matric_number']);
    $subject_name = trim($_POST['subject_name']);
    $subject_code = trim($_POST['subject_code']);

    $test1 = (float) $_POST['test1'];
    $test2 = (float) $_POST['test2'];
    $final_exam = (float) $_POST['final_exam'];

    // Calculate total marks
    $total = $test1 + $test2 + $final_exam;

    // Calculate grade
    if ($total >= 80) {
        $grade = 'A';
    } else if ($total >= 70) {
        $grade = 'B';
    } else if ($total >= 60) {
        $grade = 'C';
    } else if ($total >= 50) {
        $grade = 'D';
    } else {
        $grade = 'F';
    }

    // Update database
    $sql = $conn->prepare("
        UPDATE results SET
        student_name = ?,
        matric_number = ?,
        subject_name = ?,
        subject_code = ?,
        test_1 = ?,
        test_2 = ?,
        final = ?,
        total_marks = ?,
        grade = ?
        WHERE id = ?
    ");

    $sql->bind_param(
        "ssssddddsi",
        $student_name,
        $matric_number,
        $subject_name,
        $subject_code,
        $test1,
        $test2,
        $final_exam,
        $total,
        $grade,
        $id
    );

    if ($sql->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

include 'header.php';
?>

<h2>Edit Results</h2>

<?php
include 'form.php';
include 'footer.php';
?>
</body>
</html>
