<?php
session_start();




  
require_once 'connect.php';

$_SESSION["verify"] = false;
$_SESSION["code_access"] = false;

		$password = '';
		$username = '';
		$errors = $arrayName = array();



if (isset($_POST['signin'])) {


  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
    array_push($errors, "Username is required");
  }
  if (empty($password)) {
    array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
    $password = $password;
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'"; 
    $results = mysqli_query($db, $query);
 

    if (mysqli_num_rows($results) == 1) {
    	
    	$event = mysqli_query($db, "INSERT INTO event_log(event_user, event_act, date) VALUES('$username', 'Signed-In', current_timestamp())");
    	$user_results = mysqli_query($db, "SELECT * FROM users WHERE username='$username' AND user_id=user_id");
    	


		while ($row = mysqli_fetch_array($user_results)) {


		$_SESSION['id'] = $row["user_id"];
		$_SESSION['username'] = $row["username"];
		$_SESSION["verify"] = true;
        $_SESSION["code_access"] = true;
	    $_SESSION['success'] = "You are now logged in";
	    header('location: verification.php');
	    exit();
	}

    }else {
      array_push($errors, "Invalid password/username. Please Try again");
    }


  }

  	
       
  		

}



?>



<!DOCTYPE html>
<html>
<head>
	<title>Sign-In</title>
	<style type="text/css">
		

body {
	padding: 0;
	margin: 0;
	background: url(house1.jpg);
	background-repeat: no-repeat;
	background-size: cover;

}

div.login {

	
	font-size: 15px;
	background-color: white;
	width: 400px;
	height: auto;
	margin-left: 40%;
	margin-top: 100px;
	

	}

.header {

	text-align: center;
	padding: 20px;
	font-family: sans-serif;
	background-color: #1F44D3;
	color: white;
	border-radius: 10px;
	border: 5px solid;
}




input[type=text]{

height: 25px;
width: 170px;
border-radius: 5px;
padding: 10px;
margin-top: 10px;
margin-left: 100px;

}


input[type=password]{

height: 25px;
width: 170px;
border-radius: 5px;
padding: 10px;
margin-top: 10px;
margin-left: 100px;

}

input[type=submit]{

		float: right;
		width: 100px;
		height: 35px;
		margin-right: 109px;
		background-color: lightgreen;
		border-radius: 4px;
		font-family: sans-serif;
}

input[type=submit]:hover {

	background-color: green;
}


a:hover{
	color: #AB210E;
}

.error{

	width: 92%; 
  	margin: 0px auto; 
  	padding: 10px; 
  	border: 1px solid #a94442; 
 	color: #a94442; 
  	background: #f2dede; 
  	border-radius: 5px; 
 	text-align: center;


}



	</style>
</head>
<body>


<div class="login">

<div class="header">
	<h1>Log-In</h1>
</div>

	<form action="" method="post">
		<?php include('error.php')?>

			<div class="username">
				<input type="text" name="username" placeholder="Username" required>
			</div>
<br>	<div class="pass">
				<input type="password" name="password" placeholder="Password" required>
			</div>
<br>
			<div class="btn-login">
				<input type="submit" name="signin" value="Sign-In">
			</div>
	
	<br><br>
	<br><br>
	<center>
	<span>Forgot Password?<a href="forgot.php"> Click Here</a></span><br>
	<span>Not a Member?<a href="register.php"> Register here</a></span>
		</center>
	<br><br>

	</form>

</div>






</body>
</html>