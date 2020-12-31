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
		<nav class="navbar navbar-expand-sm navbar-light bg-light pr-5 pl-5">
			<a class="navbar-brand" href="/"><img style="width:4rem;" src="assets/brand.png"> Inventory Panel</a>
			<button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="collapsibleNavId">
				<ul class="navbar-nav ml-auto mt-2 mt-lg-0">
					<li class="nav-item active">
						<a class="nav-link" href="/login.php">Login <span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item active">
						<a class="nav-link" href="/register.php">Register</a>
					</li>
					<li class="ml-5 nav-item dropdown active">
						<a class="nav-link dropdown-toggle btn btn-sm btn-warning" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Founder's Website</a>
						<div class="dropdown-menu" aria-labelledby="dropdownId">
							<a class="dropdown-item" href="https://ammart.net" target="_blank">AmmarT</a>
							<a class="dropdown-item" href="https://trostrum.com" target="_blank">Trostrum</a>
						</div>
					</li>
				</ul>

			</div>
		</nav>
		<div class="jumbotron mb-0">
			<h2 class="display-5 ">Inventory Panel</h2>
			<p class="lead">Please Login to Continue</p>
			<hr class="my-4">
			<p>Login or Register</p>
			<p class="lead">
				<a class="btn btn-outline-primary" role="button" href="login.php">Login</a>
				<a class="btn btn-primary" href="register.php" role="button" href="register.php">Register</a>
			</p>
		</div>

		<div class="jumbotron jumbotron-fluid">
			<div class="container">
				<h2 class="display-3">Why Database Abstraction</h2>
				<p class="text-justify">Giving direct access to database greatly increases the risks of data violation
					and leakage which may cause huge impact on trust issues of our clientele. Furthermore, it increases
					the risk of data corruption or deletion by an inexperienced person trying to retrieve or extract
					the data from a bare metal database. In worst case scenario if Database credentials are leaked or
					stolen it can greatly increase the risk of blackmail or bribery.
				</p>
				<p class="text-justify">
					We will provide a PHP application which acts as a security (application)
					layer on top of our bare metal database which in this case will greatly
					increases the security and reduces the risk of data violation.
				</p>
				<p class="text-justify">
					In this Web app we have use PHP Database Object modelling to access and display data using an object-oriented
					fashion. Which increases the performance of our application and provides a clean code. The basic purpose of
					this application is to ensure the secure accessibility of data henceforth using this Web application we can
					limit the data access from CRUD to R and we can also limit the availability by allowing only specific people
					to access the Database using sessions and server-side authentication algorithms. Finally concluded this
					will provide an application layer over bare metal database.
				</p>
				<p class="text-justify">The Given Scenario defines why we need the Database abstraction and why you should not let a layman blow a hand around in your Warehouse.</p>

				<hr class="my-2">
				<h2 class="display-5 ">Introduction</h2>
				<ul>
					<li>Our program is efficient</li>
					<li>It uses PHP Object Modelling Technique</li>
					<li>It provides Secure access to Database</li>
				</ul>
				<hr class="my-2">
				<h2 class="display-5 ">Competitors/Competitive Analysis</h2>
				<p class="text-justify">In the given comparison on next page shows why out app is better than other Database abstraction Visualization apps.
				</p>

				<table class="table text-center table-striped table-inverse table-responsive">
					<thead class="thead-inverse">
						<tr>
							<td>
								<h4>Other Apps</h4>
							</td>
							<td>
								<h4>Our App</h4>
							</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								Iterative and line to line database
								access is used therefore connectivity is required multiple times
							</td>
							<td>
								Object oriented model is used in our app therefore only one-time
								connectivity is required
							</td>
						</tr>
						<tr>
							<td>
								Long and inefficient code takes too long to load the data into DOM of HTML document
							</td>
							<td>
								Short and efficient. Loads the data instantly into DOM of HTML document
							</td>
						</tr>
					</tbody>
				</table>
				<h4 class="display-5 my-2 ">Objectives</h4>


				<p class="text-justify">Our application will provide an abstraction layer where we will only
					allow the access to read the database items hence it will make our
					application secure and less vulnerable to attacks such as SQL
					injections and so on and so forth</p>
				<ul>
					<li>Security Layer</li>
					<li>Authorized access</li>
					<li>Limited Functionality</li>
					<li>Proper Visualization</li>

				</ul>


				<h4 class="display-5 my-2">Requirements</h4>


				<p>Software used to code and implement this project</p>
				<ol>
					<li>Visual Studio Code</li>
					<li>XAMPP</li>

				</ol>


				<h4 class="display-5 my-2">Server-side functionality</h4>
				<ol>
					<li>PHP Data Object Library (PDO)</li>
					<li>PHP Native Libraries</li>

				</ol>


				<h4 class="display-5 my-2">External Stylesheets</h4>
				<ol>
					<li>Bootstrap</li>
					<li>Google Font API</li>

				</ol>

				<h4 class="display-5 my-2">External JavaScript</h4>
				<ol>
					<li>Popper JS</li>
					<li>Bootstrap JS</li>

				</ol>

				<h4 class="display-5 my-2">Features of Project</h4>

				This Web app includes following features
				<ul>
					<li>
						Login/Registration
					</li>
					<li>
						Data Visualization/Abstraction
					</li>
					<li>
						Role Segmentation
					</li>
					<li>
						Table Labelling (Hardcoded)
					</li>
				</ul>



			</div>
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