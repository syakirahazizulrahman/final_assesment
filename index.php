<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Final Assessment - Student Grading</title>
</head>

<body>
    <?php
    include 'db.php';

    $search = $_GET['search'] ?? "";

    $like = "%" . $search . "%";

    $sql = $conn->prepare("SELECT * FROM results
    WHERE student_name LIKE ? OR
    matric_number LIKE ? OR
    subject_name LIKE ? OR
    subject_code LIKE ?
    ORDER BY student_name");

    $sql->bind_param("ssss", $like, $like, $like, $like);

    $sql->execute();

    $result = $sql->get_result();

    include 'header.php';
    ?>

    <h2>Student Records</h2>

    <a href="add.php">+ Add Student</a>
    <br><br>
    <form method="get">
        <input type="text" name="search" placeholder="Search by name or matric numnber" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
        <input type="submit" value="Search">
        <a href="index.php">Show all</a>
    </form>

    <table border="1">
        <tr>
            <th>No.</th>
            <th>StudentName</th>
            <th>Matric No.</th>
            <th>Subject</th>
            <th>Test 1 (20%)</th>
            <th>Test 2 (30%)</th>
            <th>Final (50%)</th>
            <th>Total (100%)</th>
            <th>Grade</th>
            <th>Actions</th>
        </tr>
        <tr>
            <td></td>
        </tr>

        <?php
        $count = 1;
        ?>

        <?php
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $count++ . "</td>";
            echo "<td>" . $row['student_name'] . "</td>";
            echo "<td>" . $row['matric_number'] . "</td>";
            echo "<td>" . $row['subject_name'] . " (" . $row['subject_code'] . ")</td>";
            echo "<td>" . $row['test_1'] . "</td>";
            echo "<td>" . $row['test_2'] . "</td>";
            echo "<td>" . $row['final'] . "</td>";
            echo "<td>" . $row['total_marks'] . "</td>";
            echo "<td>" . $row['grade'] . "</td>";
            echo "<td>";
            echo "<button><a href='edit.php?id=" . $row['id'] . "'>Edit</a></button>";
            echo "<form method='post' action='delete.php' onsubmit='return confirm(\"Delete this reecord?\");'>";
            echo "<input type='hidden' name='delete' value='" . $row['id'] . "'>";
            echo "<input type='submit' value='Delete'>";
            echo "</form>";
        }

        ?>
    </table>
</body>

<?php
if($result->num_rows == 0) {
    if($search != "") {
        echo "<h3 style='color: red;'>No records matches your search criteria.</h3>";
    } else {
        echo "<h3 style='color: grey;'>No records found.</h3>";
    }
}
?>
<?php include 'footer.php'; ?>

</html>