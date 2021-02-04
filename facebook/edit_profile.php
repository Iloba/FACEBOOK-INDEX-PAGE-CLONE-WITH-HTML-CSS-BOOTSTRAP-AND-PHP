 <?php 

 $year = "--Year--";
 $month = "---Month---";
 $day = "--Day--";
 $select = "----Select Gender----"; 
 $server = "localhost";
 $user = "root";
 $password = "holyspirit";
 $db = "facebook";

 $con = mysqli_connect($server, $user, $password, $db);
 if (!$con) {
 	echo "Connection Not Established";
 }


?> 


<?php 
	if (isset($_GET['edit'])) {
		$edit_id = $_GET['edit'];

		$query = "SELECT * FROM signup WHERE id = '$edit_id'";
		$run_query = mysqli_query($con, $query);
		if (mysqli_num_rows($run_query) > 0) {
			while ($data = mysqli_fetch_assoc($run_query)) {
				$id = $data['id'];
				$fname = $data['fname'];
        $lname = $data['lname'];
        $email = $data['email'];
        $pass = $data['password'];
        $dob = $data['dob'];
        $mob = $data['mob'];
        $yob = $data['yob'];
        $gender = $data['gender'];
				echo " Welcome,  $fname Edit your Profile so other people can get to know you";
			}
		}
	

	}


  //Enter your New Details 
  if (isset($_POST['update'])) {
    $new_fname = $_POST['new_fname'];
    $new_lname = $_POST['new_lname'];
    $new_email = $_POST['new_email'];
    $new_pass = $_POST['new_password'];
    $new_dob = $_POST['new_dob'];
    $new_mob = $_POST['new_mob'];
    $new_yob = $_POST['new_yob'];
    $new_gender = $_POST['new_gender'];

    //Validate The Form Being Filled
    if (empty($new_fname)) {
      $update_error = "Please Enter New Firstname";
    }elseif (empty($new_lname)) {
      $update_error = "Please Enter New Lastname";
    }elseif (empty($new_email)) {
      $update_error = "Please Enter New Email";
    }elseif (empty($new_pass)) {
      $update_error = "Please Enter New Password";
    }elseif (strlen($new_pass) < 8) {
      $update_error = "Passwords Must Be Up To Eight Characters";
    }elseif ($new_dob == $day) {
      $update_error = "Please Select Date of Birth";
    }elseif ($new_mob == $month) {
      $update_error = "Please Select Month of Birth";
    }elseif ($new_yob == $year) {
      $update_error = "Please Select Year of Birth";
    }elseif ($new_gender == $select) {
      $update_error = "Please Select  Your Gender";
    }else{
      $query = "UPDATE signup SET
                fname = '{$new_fname}',
                lname = '{$new_lname}',
                email = '{$new_email}',
                password = '{$new_pass}',
                dob = '{$new_dob}',
                mob = '{$new_mob}',
                yob = '{$new_yob}',
                gender = '{$new_gender}' WHERE  id = '{$edit_id}'";
      $run_query = mysqli_query($con, $query);
      if ($run_query) {
        $msg_success = "Update Successful";
      }else{
        $update_error = "Update Failed";
      }
  } 
}

?>





<!DOCTYPE html>
<html>
<head>
	<title>My Fb</title>
  <link rel="icon"  href="img/fb.png">
	 <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

      <link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
      <script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
      <script type="text/javascript" src="js/bootstrap.js"></script>
      <link rel="stylesheet" type="text/css" href="css/fb.css">
</head>
<body vlink="white">
	<header>
    <form method="POST" action="">
        <div class="container-fluid "><br>  
          <div class="row white"><br> 
            <div class="col-md-4">
              Email or Phone <br>
              <input  class="head_input" type="text" name="username">
            </div>
              <div class="col-md-4">
              Password <br>
              <input  type="Password" class="head_input" type="text" name="userpass">
              <a  class="link" href="#">forgotten account?</a><br>  
            </div>
              <div class="col-md-4">
              <br>  
              <input type="submit"  class="btn_log" value="Login" name="login">
            </div>
          </div> 
       </div>
    </form>
	</header><br>
  <div class="container">
    <div class="row">
        <div class="col-md-6">
          <h4 class="blue"> Facebook Helps You Connect and Share with People In Your Life</h4>
          <img  class="img-responsive" src="img/pic.png">
        </div>
        <div class="col-md-6">
          <h1>Update Your Profile</h1>
          <h5>Let Other People Know About you.</h5><br> 
          <?php 
          	if (isset($update_error)) {
          		echo "<center><alert class='alert alert-danger'>{$update_error}</alert></center>";
          	}
          	if (isset($msg_success)) {
          		echo  "<center><alert class='alert alert-success'>{$msg_success}</alert></center>";
          	}




           ?>
          <form method="POST" action=""><br>
            <div class="row">
              <div class="col-md-6">
                <input  id="bold_text" class="form-control" type="text" name="new_fname"  placeholder="First Name" value="<?php echo $fname; ?>">
              </div>
              <div class="col-md-6">
                <input  id="bold_text" class="form-control " type="text" name="new_lname" placeholder="Last Name" value="<?php echo $lname; ?>">    
              </div>
            </div>
             <input  id="bold_text" class="form-control " type="text" name="new_email" placeholder="Mobile Number Or Email Adress" value="<?php echo $email; ?>">
             <input id="bold_text" type="Password" name="new_password" class="form-control" placeholder="New Password" value="<?php echo $pass; ?>"><br> 
             <h5>Birthday</h5>
             <select name="new_dob">
                <option><?php echo "$dob"; ?></option> 
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
                <option>6</option>
                <option>7</option>
                <option>8</option>
                <option>9</option>
                <option>10</option>
                <option>11</option>
             </select>
             <select name="new_mob"> 
                <option><?php echo "$mob"; ?></option>
                <option>Jan</option>
                <option>Feb</option>
                <option>Mar</option>
                <option>Apr</option>
                <option>May</option>
                <option>June</option>
                <option>July</option>
                <option>Aug</option>
                <option>Sep</option>
                <option>Oct</option>
                <option>Nov</option>
                <option>Dec</option>
             </select>
              <select name="new_yob"> 
                <option><?php echo "$yob"; ?></option>
                <option>2001</option>
                <option>2002</option>
                <option>2003</option>
                <option>2004</option>
                <option>2005</option>
                <option>2006</option>
                <option>2007</option>
                <option>2008</option>
                <option>2009</option>
                <option>2010</option>
                <option>2011</option>
             </select>
             <a href="#"><small>why do i need to provide my date of birth ?</small></a><br>
            <select  name="new_gender" class="form-control">
              <option><?php echo $gender; ?></option>
              <option>Male</option>
              <option>Female</option>
            </select><br>
            <p class="small">By clicking Sign Up, you agree to our Terms, Data Policy and Cookie Policy. You may receive SMS notifications from us and can opt out at any time</p>
          <input class="btn btn-success" type="submit" name="update" value="Update Profile">
          <a href="index.php">Back</a>
          <p class="smalli">Create a Page for a celebrity, band or business</p>
          </form>
        </div>
    </div>
  </div>
  <footer>
      <div class="container"><br>
          <div class="col-md-12 text-center">
              <p><a href="#">English, Youruba, Hausa, Tiv, Idoma, Calabar, Jaba, Adara, Nupe, Ebira, Fufudae, Tiv</a></p><hr>
              <p class="small">
                Sign UpLog InMessengerFacebook LiteFind FriendsPeopleProfilesPagesPage categoriesPlacesGamesLocationsMarketplaceGroupsInstagramLocalFundraisersEventsAboutCreate adCreate PageDevelopersCareersPrivacyCookiesAdChoicesTermsAccount securityLogin helpHelpSettingsActivity log <br>
                Facebook © 2019
            </p>
            <p class="tradesoft">Designed By Tradesoft Solutions</p>
        </div>
      </div>
  </footer>
</body>
</html>