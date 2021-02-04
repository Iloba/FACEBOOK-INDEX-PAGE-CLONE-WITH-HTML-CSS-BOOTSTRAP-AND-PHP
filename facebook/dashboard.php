<?php 
	$server = "localhost";
	$user = "root";
	$password = "";
	$db = "facebook";

	$conn = mysqli_connect($server, $user, $password, $db);
	if (!$conn) {
		echo "Connection Not Established";
	}
?>
<?php 
	if (($_SESSION['user']) == 'FALSE') {
			header("Location: index.php");
		}


?>

<?php 
	session_start();
?>

<?php 
	$query = "SELECT * FROM signup WHERE  id = '{$_SESSION['user']}'";
	$run_query = mysqli_query($conn, $query);

	if (mysqli_num_rows($run_query) == 1) {
		while ($result = mysqli_fetch_assoc($run_query)) {
			$user_id = $result['id'];
			$username = $result['fname'];
			$lastname = $result['lname'];
			$dob = $result['dob'];
			$email = $result['email'];
			$mob = $result['mob'];
			$yob = $result['yob'];
			$password = $result['password'];
		}
	}
?>
<?php 
	// Delete User Account
	if (isset($_POST['delete_btn'])) {
	  $delete_id = $_POST['delete_id'];

	  $query = "DELETE FROM signup WHERE id = {$delete_id}";
	  $run_query = mysqli_query($conn, $query);
	  if ($run_query) {
	    echo "User Deleted";
	    header('location: index.php');
	  }else{
	  	echo "Delete Failed";
	  }
	}



?>
<!DOCTYPE html>
<html>
<head>
	<title>Fb Dash</title>
	<link rel="icon"  href="img/fb.png">
	 <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

      <link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
      <script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
      <script type="text/javascript" src="js/bootstrap.js"></script>
      <link rel="stylesheet" type="text/css" href="css/fb.css">
</head>
<body>
	<div class="container"><br>
		<div class="row dashbg">
			<div class="col-md-12 text-center"><br>
				<h1 style="font-family: fall is coming; color: blue;">Welcome to Facebook</h1><hr>
				<h5 style="font-family: tahoma;">WELCOME <?php echo $username; ?>, <?php echo $lastname; ?></h5><hr>
				<h4 style="font-family: tahoma;">Here are Your Details</h4>
				<p>	Username: <B><?php echo $username; ?></B><br>
					Othernames : <b><?php echo $lastname; ?></b><br>
					Email or Phone Number : <b><?php echo $email; ?></b><br>
					Date of Birth: <b><?php echo $dob; ?>th</b><br>
					Month of Birth: <b><?php echo $mob; ?></b><br>
					Year of Birth: <b><?php echo $yob; ?></b><br>
					Facebook ID: <b><?php echo $user_id; ?></b>
				</p><hr>
				<h5 style="font-family: tahoma;">My Login Details</h5>
				<p>
					Username: <b><?php echo $username; ?></b><br>
					Password: <b><?php echo $password; ?></b>
				</p><hr>
				<h5 style="font-family: tahoma;">Edit My Details</h5>
				<p><a href="edit_profile.php?edit=<?php echo $user_id; ?>" target="_blank" class="btn btn-info">Edit Profile</a></p><hr>
				<h5>Logout</h5>
				<p><a href="dashboard.php?logout" class="btn btn-bg">Logout</a></p><hr>
				<h5 style="font-family: tahoma;">Delete My Profile</h5>
				<form method="POST">
					<input type="hidden" name="delete_id" value="<?php echo $user_id; ?>"/>
					<input type="submit" name="delete_btn" value="Delete Profile" class="btn btn-danger">
				</form><hr>
			</div>
		</div><br>
	</div>
</body>
</html>
<?php 
# Log User Out
if (isset($_GET['logout'])) {
	unset($_SESSION['username']);
	session_destroy();
	header('Location: index.php');
}

?>

