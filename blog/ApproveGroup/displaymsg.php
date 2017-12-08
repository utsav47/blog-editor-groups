<?php
session_start();
require_once("dbconnect.php");
$blog_id=$_SESSION['blo_id'];
$query="select * from discuss inner join adm on discuss.id=adm.id and adm.des='content' and discuss.blog_id='$blog_id' order by discuss.datetime desc";
$data1=mysqli_query($dbc,$query);

while ($row2=mysqli_fetch_array($data1)) {
	     
     		echo "<div class=ar>".
     		"<p>".$row2['fnm']." ".$row2['lnm']." ".$row2['messages']."</p>";
     	
     		
     	} 
?>