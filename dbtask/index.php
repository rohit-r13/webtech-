<?php
include "config.php";

$success = $error = "";

if (isset($_GET["delete_id"])) {
    $id  = $_GET["delete_id"];
    $sql = "DELETE FROM students WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        $success = "Student record deleted successfully.";
    } else {
        $error = "Error: " . $conn->error;
    }
}
$result = $conn->query("SELECT * FROM students");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Management System</title>
</head>
<body>

<h2>Student Management System</h2>

<p class="msg-success"><?php echo $success; ?></p>
<p class="msg-error"><?php echo $error; ?></p>

<a class="add" href="add_student.php">+ Add New Student</a>

<table>
    <tr>
        <th>#</th>
        <th>Name</th>
        <th>Email</th>
        <th>Registration No</th>
        <th>Department</th>
        <th>Actions</th>
    </tr>

    <?php if ($result && $result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row["id"]; ?></td>
            <td><?php echo $row["name"]; ?></td>
            <td><?php echo $row["email"]; ?></td>
            <td><?php echo $row["registration_no"]; ?></td>
            <td><?php echo $row["department"]; ?></td>
            <td>
                <a class="btn edit"   href="edit_student.php?id=<?php echo $row['id']; ?>">Edit</a>
                <a class="btn delete" href="index.php?delete_id=<?php echo $row['id']; ?>"
                   onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr><td colspan="6" style="text-align:center;">No student records found.</td></tr>
    <?php endif; ?>
</table>

</body>
</html>
