  <?php

 $year = "--Year--";
 $month = "---Month---";
 $day = "--Day--";
 $select = "----Select Gender----"; 
 $server = "localhost";
 $user = "root";
 $password = "holyspirit";
 $db = "facebook";

 // Connect To the Database
 $con = mysqli_connect($server, $user, $password, $db);
 if (!$con) {
   echo "Connection Not Established";
 }

 // If the Register Button is Pressed and all The Forms are Intact
 if (isset($_POST['submit'])) {
   $fname = $_POST['fname'];
   $lname = $_POST['lname'];
   $email = $_POST['email'];
   $password = $_POST['password'];
   $dob = $_POST['dob'];
   $mob = $_POST['mob'];
   $yob = $_POST['yob'];
   $gender = $_POST['gender'];

   // Make it work Under Conditions(Ensure That The Forms are Filled Properly)
   if (empty($fname)) {
     $msg = "Please Enter Firstname";
   }
   elseif (empty($lname)) {
     $msg = "Please Enter Lastname";
   }
   elseif (empty($email)) {
     $msg = "Please Enter Email Or Phone Number";
   }
   elseif (empty($password)) {
     $msg = "Please Enter New Password";
   }
   elseif (strlen($_POST['password']) < 8) {
     $msg = "Password Must be Up to Eight Characters";
   }
   elseif ($dob == $day) {
     $msg = "Please Select Date of Birth";
   }
   elseif ($mob == $month) {
     $msg = "Plese Select Month of Birth";
   }
   elseif ($yob == $year) {
     $msg = "Please Select Year of Birth";
   }
   elseif ($gender == $select) {
     $msg = "Please Select Gender";
   }else{

    //send all entered data into database
    $query = "INSERT INTO signup (fname, lname, email, password, dob, mob, yob, gender)
                        VALUES('{$fname}', '{$lname}', '{$email}', '{$password}', '{$dob}', '{$mob}', '{$yob}', '{$gender}')";
          $run_query = mysqli_query($con, $query);
          if ($run_query) {
            $good = "Congratulations You Now Own A brand New Facebook Account Log In and Share with Friends ";
          }else{
            $msg = "Registration Failed Please Check Your Details and Try Again";
          }
   }  
    
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

  if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $userpass = $_POST['userpass'];

    //Ensure That The Forms are Filled Properly
    if (empty($username)) {
      $msg_error = "Please Enter Username";
    }
    elseif (empty($userpass)) {
      $msg_error = "Please Enter Password";
    }
    else{

      $login_query = "SELECT * FROM signup WHERE email  = '$username' && password = '$userpass'";
      $run_query = mysqli_query($connection, $login_query);
      if (mysqli_num_rows($run_query) > 0) {
          session_start();

          while ($result = mysqli_fetch_assoc($run_query)) {
            $user_id = $result['id'];

            $_SESSION['user'] = $user_id;
            header('location: dashboard.php','_blank');
          }
      }else{
        $msg_error = "Wrong Username/Password Match"; 
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
        <?php 
          if (isset($msg_error)) {
            echo "<alert class=' alert alert-failed'>{$msg_error}</alert>";
          }
        ?>     
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
          <h1>Create an account</h1>
          <h5>it's free and will always be.</h5><br> 
          <?php 
            if (isset($msg)) {
              echo "<center><alert class='alert alert-danger'>{$msg}</alert></center>";
            }
            if (isset($good)) {
              echo "<center><alert class='alert alert-success'>{$good}</alert></center>";
            }

           ?>
          <form method="POST" action=""><br>
            <div class="row">
              <div class="col-md-6">
                <input  id="bold_text" class="form-control" type="text" name="fname" value="" placeholder="First Name">
              </div>
              <div class="col-md-6">
                <input  id="bold_text" class="form-control " type="text" name="lname" placeholder="Last Name">    
              </div>
            </div>
             <input  id="bold_text" class="form-control " type="text" name="email" placeholder="Mobile Number Or Email Adress">
             <input id="bold_text" type="Password" name="password" class="form-control" placeholder="New Password"><br> 
             <h5>Birthday</h5>
             <select name="dob">
                <option><?php echo "$day"; ?></option> 
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
             <select name="mob"> 
                <option><?php echo "$month"; ?></option>
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
              <select name="yob"> 
                <option><?php echo "$year"; ?></option>
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
            <select  name="gender" class="form-control">
              <option><?php echo "$select"; ?></option>
              <option>Male</option>
              <option>Female</option>
            </select><br>
            <p class="small">By clicking Sign Up, you agree to our Terms, Data Policy and Cookie Policy. You may receive SMS notifications from us and can opt out at any time</p>
          <input class="btn btn-success" type="submit" name="submit" value="Sign Up">
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