<?php
session_start();


$dir = '';
$accepted_chars = 'abcdefghijklmnopqrstuvwxyz1234567890';
  
for ($i=0; $i<=15; $i++) {   
    $random_number = rand(0, (strlen($accepted_chars) -1));    
    $dir .= $accepted_chars[$random_number] ; 
}
//$_SESSION['dir']=$dir;
//------------------
//image upload
$img_name="";
$img_tag="";


	$img_name=$_FILES['image']['name'];
	mkdir("images/".$dir);

	$dest="images/".$dir."/".$img_name;
	move_uploaded_file($_FILES['image']['tmp_name'], $dest);
	$img_tag="<img src=images/".$dir."/".$img_name."></img>";
    echo $img_tag;




?>