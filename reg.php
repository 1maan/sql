<?php
require 'config.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    if ($password != $confirm_password) {
        echo "Passwords do not match";
        exit();
    }

    $query = "INSERT INTO users (username, password) VALUES ('$username','$password')";
    if (mysqli_query($conn, $query)) {
        echo "User registered successfully";
        header("Location: login.php");

    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Registration Form</title>
</head>
<body>
	<form action="" method="post">
		<input type="text" name="username" placeholder="Username">
		<input type="email" name="email" placeholder="Email">
		<input type="password" name="password" placeholder="Password">
		<input type="password" name="confirm_password" placeholder="Confirm Password">
		<input type="submit" value="Register">
	</form>
</body>
</html>
