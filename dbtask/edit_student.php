<?php
include "config.php";

$success = $error = "";

if (isset($_GET["id"])) {
    $id     = $_GET["id"];
    $result = $conn->query("SELECT * FROM students WHERE id='$id'");
    $row    = $result->fetch_assoc();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id         = $_POST["id"];
    $name       = $_POST["name"];
    $email      = $_POST["email"];
    $department = $_POST["department"];

    if (empty($name) || empty($email) || empty($department)) {
        $error = "Please fill all the fields.";
    } else {
        $sql = "UPDATE students
                SET name='$name', email='$email', department='$department'
                WHERE id='$id'";

        if ($conn->query($sql) === TRUE) {
            $success = "Student record updated successfully.";

            $result = $conn->query("SELECT * FROM students WHERE id='$id'");
            $row    = $result->fetch_assoc();
        } else {
            $error = "Error: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
</head>
<body>

<h2>Edit Student Record</h2>

<p><?php echo $success; ?></p>
<p><?php echo $error; ?></p>

<form method="post" action="">

    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

    <table>
        <tr>
            <td><label>Student Name</label></td>
            <td><input type="text" name="name" value="<?php echo $row['name']; ?>"></td>
        </tr>
        <tr>
            <td><label>Email</label></td>
            <td><input type="email" name="email" value="<?php echo $row['email']; ?>"></td>
        </tr>
        <tr>
            <td><label>Registration Number (cannot be changed)</label></td>
            <td><input type="text" value="<?php echo $row['registration_no']; ?>" disabled></td>
        </tr>
        <tr>
            <td><label>Department</label></td>
            <td><input type="text" name="department" value="<?php echo $row['department']; ?>"></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="Update Student"></td>
        </tr>
    </table>

</form>

<a href="index.php">&larr; Back to Student List</a>

</body>
</html>