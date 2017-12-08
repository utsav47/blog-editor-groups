<?php
session_start();
require_once("dbconnect.php");
$bid=$_SESSION['blo_id'];
$admid=$_SESSION['admid'];
$query="insert into firstcomp (blog_id,id,datetime) values('$bid','$admid',NOW())";
$result=mysqli_query($dbc,$query);
$query="update blog_info set counter=counter+1 where blog_id='$bid'";
$result1=mysqli_query($dbc,$query);
header('Location:content.php');
?>