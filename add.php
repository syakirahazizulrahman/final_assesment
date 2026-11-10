<?php
include 'header.php'; 
include 'db.php';

$student_name = "";
$matric_number = "";
$subject_name = "";
$subject_code = "";
$test1 = "";
$test2 = "";
$final_exam = "";

if (isset($_POST['submit'])) {
    $student_name = $_POST['student_name'];
    $matric_number = $_POST['matric_number'];
    $subject_name = $_POST['subject_name'];
    $subject_code = $_POST['subject_code']; 
    $test1 = $_POST['test1'];
    $test2 = $_POST['test2'];
    $final_exam = $_POST['final_exam'];

    $total = ($test1 + $test2 + $final_exam);

    if($total > 80) 
        $grade = 'A';
    else if ($total > 65) 
        $grade = 'B';
    else if ($total > 50)
        $grade = 'C';
    else if ($total > 40)
        $grade = 'D';
    else 
        $grade = 'E';

    $sql = $conn->prepare("INSERT INTO results
    (student_name, matric_number, subject_name, subject_code, test_1, test_2, final, total, grade)
    VALUES ('$student_name', '$matric_number', '$subject_name', '$subject_code', $test1, 
    $test2, $final_exam, $total, '$grade')");

    if($sql->execute()) {
        header("Location: index.php");
    }
}
?>

<style>
    label {
        display: inline-block;
        width: 200px;
    }
</style>
<h2>Add Results</h2>

<?php
include 'footer.php'; 
include 'form.php';
?>