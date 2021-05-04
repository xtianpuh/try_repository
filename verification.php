<?php 
session_start(); 

if(!isset($_SESSION["verify"]) || $_SESSION["verify"] !== true){
    header("location: index.php");
    exit;
}
 
require_once "connect.php";


$code_err = "";
$_SESSION["code_access"] = true;



if(isset($_POST['login']))
{ 
    if(empty(trim($_POST["inputcode"]))){
        echo "<script>alert('PLEASE ENTER CODE');</script>";
    } else{ 

        date_default_timezone_set('Asia/Manila');
        $currentDate = date('Y-m-d H:i:s');
        $currentDate_timestamp = strtotime($currentDate);
        $code = $_POST['inputcode'];
        

        $id_code = mysqli_query($db,"SELECT * FROM authentication WHERE auth_code='$code' AND auth_id=auth_id") or die('Error connecting to MySQL server');
        $count = mysqli_num_rows($id_code);


        $dbhost = 'localhost';
        $dbuser = 'root';
        $dbpass = '';
        $dbname = 'account';

        
        $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
        
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT expire FROM authentication where auth_code='$code'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            
            while($row = $result->fetch_assoc()) {
                echo "<div style='display: none;'>"."Expiration: " . $row["expire"]. "<br>";
                echo $currentDate."<br></div>";
                if($row["expire"] > $currentDate){

                    $_SESSION["loggedin"] = true;
                    $_SESSION["id"] = $id;                         
                    header("location: welcome.php");

                }
                else{
                    echo "<script>alert('EXPIRED CODE ERROR');</script>";
                }
            }
          } else {
            echo "<script>alert('WRONG CODE ERROR');</script>";
          }

          $conn->close();
    }
    
    mysqli_close($db);
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Verification</title>
</head>

<style>

        body{
            background: url(house1.jpg);
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: 100% 100%;
        }

        .verification{

            background: white;
            margin-left: auto;
            margin-right: auto;
            margin-top: 150px;
            width: 400px;
            height: auto;
            text-align: center;
            padding: 30px;
            font-family: sans-serif;
            border-radius: 10px;
            border: 2px solid black;
           
        }

        header{
            text-align: center;
            font-weight: bold;
            font-size: 26px;
            margin: auto;
            padding: 10px;
        }

        input[type=text]{
            width: 180px;
            height: 35px;
            border-radius: 5px;
            margin: auto;
            font-weight: bold;
            font-size: 12px;

        }

        a{
            text-decoration: none;
            color:blue;

        }
        a:hover{
            text-decoration: underline;
            color: purple;
        }

         input[type=submit]{
            width: 150px;
            height: 30px;
            border-radius: 5px;
            margin: auto;
            font-weight: bold;
            font-size: 15px;
            background-color: green;
            color:white;

        }

        input[type=submit]:hover{
            background-color: green;
            opacity: .8;
            cursor: pointer;
            color:black;
        }


       
    </style>
<body>

     <div class="verification">
        <header>Verification</header>
        
        
        <form role="form" method="post">

                
                    
                    <input type="text" name="inputcode" placeholder="Enter the Code here">
                   
           <br> <br> 
               
                    <input type="submit" name="login" value="Log-In">

                    <br>  <br>

                    <a  href="ramdom.php" target="_blank">GET CODE</a> <br> <br>
                   
                    <a  href="index.php"> BACK TO LOGIN FORM</a> <br> <br>

       

                
        </form>



    </div>

</body>
</html>