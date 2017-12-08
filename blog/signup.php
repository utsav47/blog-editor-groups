<?php
session_start();
if (isset($_SESSION['aid'])) 
  	{  
  	   header('Location:authorhome.php');
  	   exit();  
    } 
require_once("utility.php");
require_once("dbconnect.php");
if (isset($_POST['submit'])) {
	$fname=mysqli_real_escape_string($dbc, trim($_POST['name_first']));
	$lname=mysqli_real_escape_string($dbc, trim($_POST['name_last']));
	$usern=mysqli_real_escape_string($dbc, trim($_POST['usern']));
	$email=mysqli_real_escape_string($dbc, trim($_POST['email']));
	$lang=mysqli_real_escape_string($dbc, trim($_POST['lang']));
	$desc=mysqli_real_escape_string($dbc, trim($_POST['description']));
	$pass=mysqli_real_escape_string($dbc, trim($_POST['password']));
	$passc=mysqli_real_escape_string($dbc, trim($_POST['password_c']));
	$img_name=$_FILES['pic']['name'];
	$img_loc=$_FILES['pic']['tmp_name'];
	echo $img_loc;
    
    $dir = '';
    $accepted_chars = 'abcdefghijklmnopqrstuvwxyz1234567890';
    for ($i=0; $i<=15; $i++) {   
        $random_number = rand(0, (strlen($accepted_chars) -1));    
        $dir .= $accepted_chars[$random_number] ; 
    }
    mkdir("author/".$dir);

    $query="insert into author_info (fname, lname, usern, email, lang, desci, pass, location, imgname, time) values ('$fname','$lname','$usern','$email', '$lang', '$desc','$pass','$dir','$img_name',NOW())";
    $result=mysqli_query($dbc,$query);
    if ($result) {
    	echo "Inserted";
    	
    }
    else{
    	echo "not inseted";
    }
    move_uploaded_file($img_loc, "author/".$dir."/".$img_name);
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Signup</title>
	<script src="jquery-3.2.1.min.js"></script>
	<style type="text/css">
		.form
		{
			width: 30%;
			padding: 2%;
			margin-right:33%; 
			margin-left:33%;
			border:1px solid black;
		}
		.form input,textarea
		{
			width:100%;
			
			font-size: 1.2em;
			height:2em;
		}
		.form p
		{
			font-size: 1.3em;
		}
		textarea
		{
			height: 6em;
		}
		.mem
		{
			text-align: center;
			font-size: 3em;
		}
	</style>
</head>
<body>
	<div class="mem"><p>Member's Signup</p></div>
	<div class="form">
<form enctype="multipart/form-data" method="post" id="signup">
	<p>First Name:</p>
	<div><input type="text" name="name_first" required></div>
	<p>Last Name:</p>
	<div><input type="text" name="name_last" required></div>
	<p>Username:</p>
    <div><input type="text" name="usern" required></div>
	<p>Email:</p>
	<div><input type="email" name="email" required></div>
	<p>Languages:</p>
	<div><input type="text" name="lang" required></div>
	<p>Description:</p>
	<div><textarea name="description" required></textarea></div>
	<p>Password:</p>
	<div><input type="Password" name="password" id="pass" required></div>
	<p>Confirm-Password:</p>
	<div><input type="Password" name="password_c" id="confirm" required></div>
	<p>Image:</p>
	<div><input type="file" name="pic" required></div>
	<div><input type="submit" name="submit"></div>



</form>
</div>
<script type="text/javascript">
	var fun=function(){
		if($('#confirm').val()!="" && $('#pass').val()!="")
		{
		if($('#confirm').val()==$('#pass').val())
		{
			console.log("matched");
			$('#confirm').css({
				backgroundColor:'green'
				
			});
		}
		else
		{
			$('#confirm').css({
				backgroundColor:'red'
				
			});
			console.log("not matched");
		}
	}
	};
	$('#confirm').bind('keyup',fun);
	$('#confirm').bind('focus',fun);
	$('#pass').bind('focus',fun);
	$('#pass').bind('keyup',fun);


	$(document).ready(function(e) {
	$('#signup').submit(function(e){

		if($('#confirm').val()!=$('#pass').val())
		{
          e.preventDefault();
		}
	});
	});
</script>
</body>
</html>