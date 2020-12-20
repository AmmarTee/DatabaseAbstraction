<?php

session_start();

if (isset($_SESSION['user_id'])) {
	header("Location: /");
}

require 'database.php';

if (!empty($_POST['email']) && !empty($_POST['password'])) :

	$records = $conn->prepare('SELECT id,email,password FROM users WHERE email = :email');
	$records->bindParam(':email', $_POST['email']);
	$records->execute();
	$results = $records->fetch(PDO::FETCH_ASSOC);

	$message = '';

	if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {

		$_SESSION['user_id'] = $results['id'];
		header("Location: /");
	} else {
		$message = 'Sorry, those credentials do not match';
	}

endif;

?>

<!DOCTYPE html>
<html>

<head>
	<title>Login Below</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<link href='http://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
	<div class="alert mb-0 d-flex justify-content-between alert-primary" role="alert">
		<strong>Please Login to Continue</strong>

		<a class="btn btn-primary" href="register.php">Register</a>
	</div>
	<?php if (!empty($message)) : ?>
		<div class="alert alert-warning" role="alert">
			<strong><?php echo $message ?></strong>
		</div>
	<?php endif; ?>

	<h1>Login</h1>
	<form action="login.php" method="POST">

		<input type="text" placeholder="Enter your email" name="email">
		<input type="password" placeholder="and password" name="password">
		<input class="btn btn-outline-primary" type="submit">

	</form>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>

</html>