<?php

session_start();

error_reporting(0);

if (isset($_SESSION['user_id'])) {
	header("Location: /");
}

require 'database.php';
$email = '';
$password = '';
$email = $_POST['email'];
$password = $_POST['password'];
$message = '';

if (!empty($email) && !empty($password)) :

	// Enter the new user in the database
	$sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
	$stmt = $conn->prepare($sql);

	

	$stmt->bindParam(':email', $email);
	$stmt->bindParam(':password', password_hash($password, PASSWORD_BCRYPT));

	if ($stmt->execute()) :
		$message = 'Successfully created new user';
	else :
		$message = 'Sorry there must have been an issue creating your account';
	endif;

endif;

?>

<!DOCTYPE html>
<html>

<head>
	<title>Register Below</title>
	<link href='http://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>

	<div class="alert d-flex justify-content-between alert-primary" role="alert">
		<strong>Enter your Detail Down Below</strong>
	<a class="btn btn-primary" href="login.php">Login</a>
	</div>

	<?php if (!empty($message)) : ?>
		<p><?= $message ?></p>
	<?php endif; ?>

	<h1>Register</h1>

	<form action="register.php" method="POST">

		<input type="email" placeholder="Enter your email" name="email" required>
		<input type="password" placeholder="and password" name="password" required>
		<input type="password" placeholder="confirm password" name="confirm_password" required>
		<input type="submit">

	</form>

</body>

</html>