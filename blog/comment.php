<?php
session_start();
require_once("dbconnect.php");
require_once("utility.php");
$user=mysqli_real_escape_string($dbc, trim($_GET['user']));
$comment=mysqli_real_escape_string($dbc, trim($_GET['comments']));
$id=$_SESSION['id'];
$query="insert into comment (blog_id,username,comments) values('$id','$user','$comment')";
$result = mysqli_query($dbc, $query);
if ($result) {
	echo "iserted";
}
  ?>
