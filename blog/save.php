<?php
session_start();
require_once("utility.php");
require_once("dbconnect.php");
$title=mysqli_real_escape_string($dbc, trim($_GET['title']));
$topic=mysqli_real_escape_string($dbc, trim($_GET['topic']));
$data=$_GET['value'];
$author_id=$_SESSION['aid'];
$query="select * from blog_info where heading='$title'";

$result = mysqli_query($dbc, $query);
$row = mysqli_fetch_array($result);
if($row)
{
$location="data/".$row['location']."/file.html";
$fd = fopen($location,'w');
if (!$fd) {
   echo "Error! Couldn't open/create the file.";
      die;
       } 
       fwrite($fd, $data);
       fclose($fd); 
       echo "if part";
}
else
{echo "else part";
	$dir = '';
$accepted_chars = 'abcdefghijklmnopqrstuvwxyz1234567890';
  
for ($i=0; $i<=15; $i++) {   
    $random_number = rand(0, (strlen($accepted_chars) -1));    
    $dir .= $accepted_chars[$random_number] ; 

}
$loc="data/".$dir;
 mkdir($loc);

$location=$loc."/file.html";
$fd = fopen($location,'w');
if (!$fd) {
   echo "Error! Couldn't open/create the file.";
      die;
       } 
       fwrite($fd, $data);
       fclose($fd); 

       $query="insert into blog_info (date,time,location,views,lokes,heading,author_id,topic)values(NOW(),NOW(), '$dir', 0, 0, '$title', '$author_id','$topic')";
$result = mysqli_query($dbc, $query);
if ($result) {
	echo "inserted";
}
}
?>