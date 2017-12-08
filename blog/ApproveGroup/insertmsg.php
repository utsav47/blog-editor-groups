<?php
session_start();
require_once("dbconnect.php");
$msg=$_GET['msgs'];
$blog_id=$_GET['blog_id'];
$id=$_SESSION['admid'];
$query="insert into discuss (messages, id ,time, datetime,blog_id)values('$msg','$id',NOW() ,NOW(),'$blog_id')";
$result=mysqli_query($dbc,$query);
if ($result) {
	echo "inseted";
}
else
{
	echo "not inserted";
}
?>