<?php 

		$db = mysqli_connect('localhost', 'root', '', 'account');

		if ($db->connect_error) {
			die("FAILED TO CONNECT" .$db->connect_error);
		}else{
			echo "";
		}




?>

