<?php 

$question = '';
$user = '';

include 'connect.php';

date_default_timezone_set('Asia/Manila');
$currentDate = date('Y-m-d H:i:s');


if (isset($_POST['submit1']))
  {
      $user = $_POST['username'];
      $sql = ("SELECT question FROM users WHERE username ='$user' ");
      $result = mysqli_query($db,$sql);
      
      if ($row = mysqli_fetch_array( $result ))
      {
          $question = $row['question'];
	  }
	  else
	  {
	  	  echo '<script>alert("Username not Found!")</script>'; 
	  }
  }

 if (isset($_POST['submit2']))
  {
      $user = $_POST['username'];
      $ans = $_POST['answer'];
      $pass = $_POST['password'];
      $cpass = $_POST['cpassword'];
      $fpassword = $cpass;
      $sql = ("SELECT answer FROM users WHERE username ='$user' ");
      $result = mysqli_query($db,$sql);
      
      if ($row = mysqli_fetch_array( $result ))
      {
           if ($ans==$row['answer'])
        	{
        		if ($pass == $cpass)
        		{
        			$query2 = "UPDATE users SET password = '$fpassword' WHERE username = '$user'";
    				mysqli_query($db, $query2);
           		 	$event = mysqli_query($db, "INSERT INTO event_log(event_user, event_act, date) VALUES('$user', 'Change Password', current_timestamp())");
    				header('Location: index.php');
    			}
    			else
    			{
    				echo '<script>alert("Passwords do not Match!")</script>'; 
    			}
        	}
        	else
        	{
        		echo '<script>alert("Your answer is Wrong!")</script>';
        	}
	  }
  }



 ?>



<!DOCTYPE html>
<html lang="en-US">
<head>
	<title>FORGOT PASSWORD</title>
</head>

<style >
body {
	background: url(house1.jpg);
	background-repeat: no-repeat;
	background-size: cover;
}

div.wrapper {

	font-size: 15px;
	background-color: white;
	width: 500px;
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
	border-radius: 10px 10px 0px 0px;
	border: 5px solid;
}




input[type=text]{

height: 25px;
width: 150px;
border-radius: 5px;
padding: 10px;
margin-top: 10px;
text-align:center;

}
input[type=text]:focus{

height: 25px;
width: 250px;
border-radius: 5px;
padding: 10px;
margin-top: 10px;
text-align:center;

}


input[type=password]{

height: 25px;
width: 150px;
border-radius: 5px;
padding: 10px;
margin-top: 10px;
}
input[type=password]:focus{

height: 25px;
width: 250px;
border-radius: 5px;
padding: 10px;
margin-top: 10px;
}



input[type=submit]{

		
		width: auto;
		height: 35px;
		background-color: lightgreen;
		border-radius: 4px;
		font-family: sans-serif;
		;
}

input[type=submit]:hover {

	background-color: green;
}


a:hover{
	color: #AB210E;
}

.first{
	
	width: 300px;
	margin: auto;
	height: auto;
	padding: 5px;
	text-align: center;

	
	
}

.second{
	
	width: 300px;
	margin: auto;
	height: auto;
	padding: 5px;
	text-align: center;
}




	</style>
<body>

	<div class="wrapper">
        <form action="" method="post">
        <div class="header">
      	
      	<h1> FORGOT PASSWORD FORM</h1>
      </div><br><br>

      <div class="container">

      	


       <div class="first">
        <input type="text" placeholder="Enter Username" name="username" value = "<?php echo $user;?>" required>
</div>
<div class="first">
        <input type= "submit" value = "Get Secret Question" name= "submit1" id= "Sub1">
        </div>



      	<div class="second">
      		
      	<input type="text" name="question" class= "text" placeholder="Your Secret Question" value = "<?php echo $question;?>" disabled>
      </div>

       <div class="second">
        <input type="text" placeholder="Answer Here" name="answer" >  </div>

      <div class="second">
        <input type="password" placeholder="Enter Password" name="password">  </div>

      <div class="second">
        <input type="password" placeholder="Confirm Password" name="cpassword">   </div>


        <div class="second">
        <input type= "submit" value = "Change Password" name= "submit2" id= "Sub">  </div>
      	</div>

 
        <br>

      <div class="first">
      	<a href="index.php">BACK TO LOGIN FORM</a>
      </div>
      <br><br>
      </div>

     
        </form>

  

	

</body>
</html>