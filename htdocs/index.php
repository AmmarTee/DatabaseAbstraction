<?php

session_start();

require 'database.php';

if (isset($_SESSION['user_id'])) {

	$records = $conn->prepare('SELECT id,email,password FROM users WHERE id = :id');
	$records->bindParam(':id', $_SESSION['user_id']);
	$records->execute();
	$results = $records->fetch(PDO::FETCH_ASSOC);
	$user = NULL;

	try {
		$inventorySQL = $conn->prepare("SELECT ID, Name, Price, IdentityNo, Role FROM inventory");

		$inventorySQL->execute();
		// set the resulting array to associative
		$result = $inventorySQL->setFetchMode(PDO::FETCH_ASSOC);
	} catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
	}

	if (count($results) > 0) {
		$user = $results;
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Warehouse Inventory</title>
	<link href='http://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

</head>

<body>
	<?php if (!empty($user)) : ?>
		<div class="alert alert-success d-flex mb-0 justify-content-between" role="alert">
			<strong>Welcome <?= $user['email']; ?> You are successfully logged in!</strong> <a name="" id="" class="ml-auto btn btn-secondary " href="logout.php" role="button">Logout</a>
		</div>
		<div class="jumbotron mb-0 jumbotron-fluid">
			<div class="container">
				<h1 class="display-3">Warehouse Inventory</h1>
				<p class="lead">Welcome to Admin Panel</p>
				<hr class="my-2">
			</div>
		</div>
		<?php
		echo "<div class=\"container-fluid pt-5 justify-content-center row bg-light\">";
		echo "<div class=\"ml-5 col-lg-5  display-4\">General</div>
		<table class=\"col-lg-6 table table-responsive\">
		<thead class=\"thead-inverse\">
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Price</th>
				<th>Serial No</th>
			</tr>
		</thead>

		<tbody>
		";

		foreach (($inventorySQL->fetchAll()) as $k => $v) {
			if ($v["Role"] == "General") {
				echo "<tr>";

				echo "<td scope=\"row\">" . $v['ID'] . "</td>";

				echo "<td>" . $v['Name'] . "</td>";

				echo "<td>" . $v['Price'] . "</td>";

				echo "<td>" . $v['IdentityNo'] . "</td>";

			//	echo "<td>" . $v['Role'] . "</td>";


				echo "</tr>";
			}
		}

		echo "</table>";
		echo "<div class=\"ml-5 col-lg-5 display-4\">Footwear</div>
		<table class=\"col-lg-6 table table-responsive\">
		<thead class=\"thead-inverse\">
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Price</th>
				<th>Serial No</th>
			</tr>
		</thead>

		<tbody>
		";
		$inventorySQL->execute();
		foreach (($inventorySQL->fetchAll()) as $k => $v) {
			if ($v["Role"] == "Footwear") {
				echo "<tr>";

				echo "<td scope=\"row\">" . $v['ID'] . "</td>";

				echo "<td>" . $v['Name'] . "</td>";

				echo "<td>" . $v['Price'] . "</td>";

				echo "<td>" . $v['IdentityNo'] . "</td>";

			//	echo "<td>" . $v['Role'] . "</td>";


				echo "</tr>";
			}
		}

		echo "</table>";
		echo "<div class=\"ml-5 col-lg-5  display-4\">Food</div>
		<table class=\"col-lg-6 table table-responsive\">
		<thead class=\"thead-inverse\">
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Price</th>
				<th>Serial No</th>
			</tr>
		</thead>

		<tbody>
		";

		$inventorySQL->execute();
		foreach (($inventorySQL->fetchAll()) as $k => $v) {
			if ($v["Role"] == "Food") {
				echo "<tr>";

				echo "<td scope=\"row\">" . $v['ID'] . "</td>";

				echo "<td>" . $v['Name'] . "</td>";

				echo "<td>" . $v['Price'] . "</td>";

				echo "<td>" . $v['IdentityNo'] . "</td>";

			//	echo "<td>" . $v['Role'] . "</td>";


				echo "</tr>";
			}
		}

		echo "</table>";
		echo "<div class=\"ml-5 col-lg-5 display-4\">Toys</div>
		<table class=\"col-lg-6 table table-responsive\">
		<thead class=\"thead-inverse\">
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Price</th>
				<th>Serial No</th>
			</tr>
		</thead>

		<tbody>
		";
		$inventorySQL->execute();
		foreach (($inventorySQL->fetchAll()) as $k => $v) {
			if ($v["Role"] == "Toys") {
				echo "<tr>";

				echo "<td scope=\"row\">" . $v['ID'] . "</td>";

				echo "<td>" . $v['Name'] . "</td>";

				echo "<td>" . $v['Price'] . "</td>";

				echo "<td>" . $v['IdentityNo'] . "</td>";

			//	echo "<td>" . $v['Role'] . "</td>";


				echo "</tr>";
			}
		}

		echo "</table>";
		echo "</div>";

		$conn = null;
		?>



	<?php else : ?>
		<div class="jumbotron mb-0">
			<a href="/" class="link">
				<h1 class="display-5">Data Abstraction</h1>
			</a>
			<p class="lead">Please Login to Continue</p>
			<hr class="my-4">
			<p>Login or Register</p>
			<p class="lead">
				<a class="btn btn-outline-primary" role="button" href="login.php">Login</a>
				<a class="btn btn-primary" href="register.php" role="button" href="register.php">Register</a>
			</p>
		</div>


	<?php endif; ?>

</body>
<footer>
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
	</script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
	</script>
</footer>

</html>