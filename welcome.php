<?php

	session_start();



	if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}

if(!isset($_SESSION["username"])){
	$_SESSION['msg'] = "You must log in first";
    header("location: welcome.php");}
  

  

    	if (isset($_GET['logout'])) {

    	$db = new mysqli('localhost', 'root', '', 'account');
    	$event = mysqli_query($db, "INSERT INTO event_log(event_user, event_act, date) VALUES('".$_SESSION['username']."', 'Signed-Out', current_timestamp())");

    	if (isset($_SESSION['username'])) {
    		

    	session_destroy();
	  	unset($_SESSION['username']);
	  	header("location: index.php");
    	}
    	
    	}
   

   
	  
  
  


?>

<!DOCTYPE html>
<html>
<head>
	<title>My Website</title>
</head>

<style type="text/css">
	
body {

	background: url(bgneutral.jpg);
	background-repeat: no-repeat;
	background-size: cover;
	font-family: sans-serif;
}



h1{
	color: black;
	font-size: 44px;

}


.content{

	width: 300px;
	height: auto;
	padding: 45px;
	background-color: white;
	margin-left: auto;
	margin-right: auto;
	border-radius: 10px;
	border: 2px solid;



}

.img{

	width: 650px;
	height: 300px;
	padding: 20px;
	margin-right: auto;
	margin-left: auto;
}

p a:hover {
	color: black;
}

</style>
<body>

<center>
	<h1>WELCOME BACK MASTER!</h1>
</center>

<div class="content">

<?php if (isset($_SESSION['success'])): ?>

			<div class="error success">
				<h3>
					<?php 
						echo $_SESSION['success'];
						unset($_SESSION['success']);
						?>
				</h3>			
			</div>
		<?php endif	?>

		   <?php  if (isset($_SESSION['username'])) : ?>
    	<center><p style="font-size: 26px;">Welcome ! <strong style="color: slategrey; "><?php echo $_SESSION['username']; ?></strong></p></center>
      <br>
    <?php endif ?>

    	<p> <a href="welcome.php?logout='1'" style="color: red;" >logout</a> </p>
    	
       

</div>

<br><br>


<div class="img">
<img src="hackerman.jpg" alt="" width="650px"  >
</div>
	

</body>
</html>