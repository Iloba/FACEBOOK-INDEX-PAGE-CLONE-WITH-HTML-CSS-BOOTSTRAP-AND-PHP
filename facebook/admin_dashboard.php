<!DOCTYPE html>
<html>
<head>
	<title>Facebook Admin</title>
	<link rel="icon"  href="img/fb.png">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<link rel="stylesheet" type="text/css" href="css/fb.css">
</head>
<body>
	<div class="container-fluid"><br>
		<h1 class="text-center">Welcome to your Admin Dashboard</h1>
		<h3 class="text-center reg_user">Here are all the registered Users of Facebook </h3>
	</div>
</body>
</html>
<?php 	

		if (empty($_SESSION['user'])) {
			header("Location: index.php");
		}


 ?>
<?php 

	$server = "localhost";
	$user = "root";
	$password = "holyspirit";
	$db = "facebook";

	$connection = mysqli_connect($server, $user, $password, $db);
	if (!$connection) {
		echo "Connection Not Established";
	}


	$query = "SELECT * FROM signup";
	$run_query = mysqli_query($connection, $query);
	if (mysqli_num_rows($run_query) > 0) {
		echo "
			<div class='table-responsive'>
				<table class='table table-bordered'>
					<thead >
						<tr class='success'>
							<th>Id</th>
							<th>FirstName</th>
							<th>Last Name</th>
							<th>Email</th>
							<th>Password</th>
							<th>Date of Birth</th>
							<th>Month of Birth</th>
							<th>Year of Birth</th>
							<th>gender</th>
							<th>Edit</th>
							<th>Delete</th>
						</tr>
					</thead>
		";
		while ($row = mysqli_fetch_assoc($run_query)) {
			$id = $row['id'];
			$fname = $row['fname'];
			$lname = $row['lname'];
			$email = $row['email'];
			$password = $row['password'];
			$dob = $row['dob'];
			$mob = $row['mob'];
			$yob = $row['yob'];
			$gender = $row['gender'];
			echo "
					<tbody>
						<tr>
							<td>{$id}</td>
							<td>{$fname}</td>
							<td>{$lname}</td>
							<td>{$email}</td>
							<td>{$password}</td>
							<td>{$dob}</td>
							<td>{$mob}</td>
							<td>{$yob}</td>
							<td>{$gender}</td>
							<td><a href='edit.php?edit={$id}' class='btn btn-info'>Edit<a/></td>
							<td>
								<form method='POST'>
									<input type='hidden' name='delete_id' value='{$id}'>
									<input type='submit' name='delete_btn' value='del' class='btn btn-danger'>
								</form>
							</td>


						</tr>
					</tbody>
			";

		}
		echo "
				</table>
			</div>

			";
	}


 ?>