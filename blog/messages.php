<?php
session_start();
if (!isset($_SESSION['aid'])) 
  	{  
  	   header('Location:login.php');
  	   exit();  
    }

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<form method="post">
	<textarea></textarea>
	<input type="submit" name="submit">
</form>
</body>
</html>