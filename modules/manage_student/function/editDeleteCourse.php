<html>
<head>
    <title>View - Delete Student Courses | EGyaan</title>
</head>
<body>

<?php
/**
 * Created by PhpStorm.
 * User: fireion
 * Date: 20/6/17
 * Time: 1:20 PM
 */

require_once("../../../classes/Constants.php");
require_once("../../../classes/DBConnect.php");
require_once("../classes/Student.php");

$dbConnect = new DBConnect(Constants::SERVER_NAME,
    Constants::DB_USERNAME,
    Constants::DB_PASSWORD,
    Constants::DB_NAME);

if (isset($_REQUEST['branchId']) && isset($_REQUEST['batchId']) && !empty(trim($_REQUEST['branchId']))
    && !empty(trim($_REQUEST['batchId']))
) {
    $branchId = $_REQUEST['branchId'];
    $batchId = $_REQUEST['batchId'];

    $student = new Student($dbConnect->getInstance());

    $getData = $student->getStudent(0, $batchId);

    if ($getData != false) {
        $id = 1;
        echo "<table border='3'>";
        echo "<tr><th>Sr. no.</th><th>Student Name</th><th>View</th><th>Add</th><th>Delete</th></tr>";
        while ($row = $getData->fetch_assoc()) {
            $studentId = $row['id'];
            $studentFirstName = $row['firstname'];
            $studentLastName = $row['lastname'];

            echo "<tr><td>" . $id . "</td><td>" . $studentFirstName . " " . $studentLastName . "</td><td>
        <form action='viewStudentCourse.php' method='post'><input type='hidden' name='studentId' value='" . $studentId . "'>
        <input type='submit' value='View Course'></form></td><td><form action='addStudentCourse.php' method='post'>
        <input type='hidden' name='studentId' value='" . $studentId . "'><input type='submit' value='Add Course'></form></td>
        <td><form action='deleteStudentCourse.php' method='post'><input type='hidden' name='studentId' value='" . $studentId . "'>
        <input type='submit' value='Delete Course'></form></td></tr>";
            $id++;
        }
    } elseif ($getData == false) {
        echo Constants::STATUS_FAILED;
    } else {
        echo "No Records Found!";
    }
} else {
    echo Constants::EMPTY_PARAMETERS;
}
?>
</body>
</html>