<?php
session_start();
 // if (isset($_SESSION['id'])) 
  //	{  
  //	   header('Location:content.php');
  //	   exit();  
   // } 
require_once("dbconnect.php");

if (isset($_POST['login'])) {

	$user=mysqli_real_escape_string($dbc, trim($_POST['usern']));
	echo $user;
	echo $_POST['usern'];
	$pass=mysqli_real_escape_string($dbc, trim($_POST['pass']));
	$query="select * from adm where usr='$user'";
	$result=mysqli_query($dbc,$query);
	if ($result) {
		$row=mysqli_fetch_array($result);
		if($pass==$row['pas'])
		{
          $_SESSION['admid']=$row['id'];
        // header('Location:authorhome.php');
          echo "succesfull";
		}
		else
		{
			echo "invalid";
		}	

	}
	else
	{
		echo "invalid us";
	}
		
}


 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>login</title>
 	<style type="text/css">
 		.user input,.pass input
 		{
        width: 100%;
        height: 2.5em;
        border: 1px solid black;
        padding-left:2%;
        font-size: 1.3em;
 		}
 		.form
 		{
         width: 24%;
         position: relative;
         margin-right:37%; 
         margin-left:37%;
         margin-top:13%;
         border: 1px solid;
         padding: 2%;
         padding-left: 1.5%;

 		}
 		.form p
 		{
 			font-size: 150%;
 			width: 50%;
 		}
 		.submit input
 		{
 			margin-top: 2em;
 			width:22%;
 			height:2.3em;

 		}
 		.submit
 		{
 			text-align: center;
 		}
 		.log
 		{
 			text-align: center;
 			font-size: 3em;
 		}
 	</style>
 </head>
 <body>
 	<div class="log"><p>Approve Group:</p></div>
 	<div class="form">
 		
 <form method="post">
 	<p>Username:</p>
 	<div class="user"><input type="text" name="usern" required></div>
 	<p>Password:</p>
 	<div class="pass"><input type="password" name="pass" required></div>
 	<div class="submit"><input type="submit" name="login" value="login"></div>
 </form>
 	</div>
 </body>
 </html>