<?php
session_start();
$id=$_SESSION['id'];
require_once("dbconnect.php");
$likes=$_SESSION['likes']+1;
$query="update blog_info set lokes='$likes' where blog_id='$id'";
$result = mysqli_query($dbc, $query);
if ($result) {
	
}
?>