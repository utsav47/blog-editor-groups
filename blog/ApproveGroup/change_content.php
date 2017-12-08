<?php
session_start();
require_once("dbconnect.php");
$val=$_GET['value'];
$bid=$_SESSION['blo_id'];
$admid=$_SESSION['admid'];
$query="insert into changes (changep,blog_id,id,datetime) values('$val','$bid','$admid',NOW())";
$result=mysqli_query($dbc,$query);
?>