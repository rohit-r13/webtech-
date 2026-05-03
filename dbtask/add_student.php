<?php
include "config.php";

$success = $error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name            = $_POST["name"];
    $email           = $_POST["email"];
    $registration_no = $_POST["registration_no"];
    $department      = $_POST["department"];

    if (empty($name) || empty($email) || empty($registration_no) || empty($department)) {
        $error = "Please fill all the fields.";
    } else {
        $sql = "INSERT INTO students (name, email, registration_no, department)
                VALUES ('$name', '$email', '$registration_no', '$department')";

        if ($conn->query($sql) === TRUE) {
            $success = "Student record added successfully.";
        } else {
            $error = "Error: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
</head>
<body>

<h2>Add New Student</h2>

<p><?php echo $success; ?></p>
<p><?php echo $error; ?></p>

<form method="post" action="">

<table>
    <tr>
        <td><label>Student Name</label></td>
        <td><input type="text" name="name" placeholder="Enter student name"></td>
    </tr>
    <tr>
        <td><label>Email</label></td>
        <td><input type="email" name="email" placeholder="Enter email"></td>
    </tr>
    <tr>
        <td><label>Registration Number</label></td>
        <td><input type="text" name="registration_no" placeholder="e.g. 2021-CSE-001"></td>
    </tr>
    <tr>
        <td><label>Department</label></td>
        <td><input type="text" name="department" placeholder="e.g. CSE"></td>
    </tr>
    <tr>
        <td></td>
        <td><input type="submit" value="Add Student"></td>
    </tr>
</table>

</form>

<a href="index.php">&larr; Back to Student List</a>

</body>
</html>
