<?php
$name = $email = $username = $password = $confirmPassword = $age = $gender = $course = "";
$nameErr = $emailErr = $usernameErr = $passwordErr = $confirmPasswordErr = $ageErr = $genderErr = $courseErr = $termsErr = "";
$success = false;
function test_input($data) {
    return trim($data);
}

if ($_SERVER["REQUEST_METHOD"]=="POST") {
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = test_input($_POST["name"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            $nameErr = "Only letters and white space allowed";
        }
    }
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }
    if (empty($_POST["username"])) {
        $usernameErr = "Username is required";
    } else {
        $username = test_input($_POST["username"]);
        if (strlen($username) < 5) {
            $usernameErr = "Username must be at least 5 characters long";
        }
    }
    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
    } else {
        $password = $_POST["password"];
        if (strlen($password) < 6) {
            $passwordErr = "Password must be at least 6 characters";
        }
    }
    if (empty($_POST["confirm_password"])) {
        $confirmPasswordErr = "Please confirm your password";
    } else {
        $confirmPassword = $_POST["confirm_password"];
        if ($confirmPassword !== $password) {
            $confirmPasswordErr = "Passwords do not match";
        }
    }
    if (empty($_POST["age"])) {
        $ageErr = "Age is required";
    } else {
        $age = test_input($_POST["age"]);
        if (!is_numeric($age)) {
            $ageErr = "Age must be a number";
        } elseif ($age < 18) {
            $ageErr = "Age must be 18 or above";
        }
    }
    if (empty($_POST["gender"])) {
        $genderErr = "Please select your gender";
    } else {
        $gender = test_input($_POST["gender"]);
    }
    if (empty($_POST["course"])) {
        $courseErr = "Please select a course";
    } else {
        $course = test_input($_POST["course"]);
    }
    if (!isset($_POST["terms"])) {
        $termsErr = "You must agree to the Terms & Conditions";
    }
    if (
        empty($nameErr) && empty($emailErr) && empty($usernameErr) &&
        empty($passwordErr) && empty($confirmPasswordErr) && empty($ageErr) &&
        empty($genderErr) && empty($courseErr) && empty($termsErr)
    ) {
        $success = true;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>PHP Form Validation</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 50px; }
        .error { color: red; font-size: 0.9em; }
        input[type="text"], input[type="email"], input[type="password"], input[type="number"], select {
            margin: 8px 0; padding: 8px; width: 320px;
        }
        label { font-weight: bold; }
        .success-box {
            background: #e6ffe6; border: 1px solid green;
            padding: 15px; margin-top: 20px; width: 400px;
        }
        .success-box h3 { color: green; margin-top: 0; }
        .success-box p { margin: 5px 0; }
    </style>
</head>
<body>

<h2>Registration Form - PHP Validation</h2>

<?php if ($success): ?>

    <div class="success-box">
        <h3>Registration Successful!</h3>
        <p><strong>Full Name:</strong> <?php echo htmlspecialchars($name); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
        <p><strong>Username:</strong> <?php echo htmlspecialchars($username); ?></p>
        <p><strong>Age:</strong> <?php echo htmlspecialchars($age); ?></p>
        <p><strong>Gender:</strong> <?php echo htmlspecialchars($gender); ?></p>
        <p><strong>Course:</strong> <?php echo htmlspecialchars($course); ?></p>
    </div>
<?php else: ?>
<form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <label>Full Name:</label><br>
    <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>">
    <span class="error">* <?php echo $nameErr; ?></span><br><br>
    <label>Email Address:</label><br>
    <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
    <span class="error">* <?php echo $emailErr; ?></span><br><br>
    <label>Username:</label><br>
    <input type="text" name="username" value="<?php echo htmlspecialchars($username); ?>">
    <span class="error">* <?php echo $usernameErr; ?></span><br><br>
    <label>Password:</label><br>
    <input type="password" name="password">
    <span class="error">* <?php echo $passwordErr; ?></span><br><br>
    <label>Confirm Password:</label><br>
    <input type="password" name="confirm_password">
    <span class="error">* <?php echo $confirmPasswordErr; ?></span><br><br>
    <label>Age:</label><br>
    <input type="number" name="age" value="<?php echo htmlspecialchars($age); ?>" min="18">
    <span class="error">* <?php echo $ageErr; ?></span><br><br>
    <label>Gender:</label><br>
    <input type="radio" name="gender" value="Male" <?php echo ($gender == "Male") ? "checked" : ""; ?>> Male
    <input type="radio" name="gender" value="Female" <?php echo ($gender == "Female") ? "checked" : ""; ?>> Female
    <span class="error">* <?php echo $genderErr; ?></span><br><br>
    <label>Course Selection:</label><br>
    <select name="course" style="margin: 8px 0; padding: 8px; width: 320px;">
        <option value="">-- Select a Course --</option>
        <option value="Computer Science" <?php echo ($course == "Computer Science") ? "selected" : ""; ?>>Computer Science</option>
        <option value="Business Administration" <?php echo ($course == "Business Administration") ? "selected" : ""; ?>>Business Administration</option>
        <option value="Electrical Engineering" <?php echo ($course == "Electrical Engineering") ? "selected" : ""; ?>>Electrical Engineering</option>
        <option value="Mechanical Engineering" <?php echo ($course == "Mechanical Engineering") ? "selected" : ""; ?>>Mechanical Engineering</option>
        <option value="Medicine" <?php echo ($course == "Medicine") ? "selected" : ""; ?>>Medicine</option>
    </select>
    <span class="error">* <?php echo $courseErr; ?></span><br><br>
    <label>
        <input type="checkbox" name="terms" <?php echo (isset($_POST["terms"])) ? "checked" : ""; ?>>
        I agree to the Terms &amp; Conditions
    </label>
    <span class="error">* <?php echo $termsErr; ?></span><br><br>
    <input type="submit" value="Register" style="padding: 12px 25px; font-size: 16px;">
</form>

<?php endif; ?>

</body>
</html>