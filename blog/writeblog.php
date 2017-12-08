<?php
session_start();
  if (!isset($_SESSION['aid'])) 
  	{  
  	   header('Location:login.php');
  	   exit();  
    } 
require_once("dbconnect.php");
//$dir1="";

//$blog='';

$author_id=$_SESSION['aid'];

//making directory

$dir = '';
$accepted_chars = 'abcdefghijklmnopqrstuvwxyz1234567890';
  
for ($i=0; $i<=15; $i++) {   
    $random_number = rand(0, (strlen($accepted_chars) -1));    
    $dir .= $accepted_chars[$random_number] ; 
}
$_SESSION['dir']=$dir;
//------------------
//image upload
$img_name="";
$img_tag="";
if (isset($_POST['submit_image'])) {

	$img_name=$_FILES['image']['name'];
	mkdir("data/".$dir);

	$dest="data/".$dir."/".$img_name;
	move_uploaded_file($_FILES['image']['tmp_name'], $dest);
	$img_tag="<img src=data/".$dir."/".$img_name."></img>";

}
//------------------
if(isset($_POST['submit']))
{


$heading=$_POST['heading'];
$blog=$_POST['textar']; 
$query="insert into blog_info (date,location,views,lokes,heading,author_id)values(NOW(), '$dir', 0, 0, '$heading', '$author_id')";
$result = mysqli_query($dbc, $query);
if ($result) {
	echo "inserted";
}
mkdir("data/".$dir);

$location="data/".$dir."/myfile.txt";
$fd = fopen($location,'w');
if (!$fd) {
   echo "Error! Couldn't open/create the file.";
      die;
       } 
       fwrite($fd, $blog);
       fclose($fd); 
} 
 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>


	<style type="text/css">
		.txt
		{
			width: 90%;
			height: 24em;
		}
	</style>
	<script src="jquery-3.2.1.min.js"></script>
</head>
<body>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="text_form">

	Heading:
	<input type="text" name="heading">
	Blog:
	<textarea class="txt" name="textar" id="ta"></textarea>
	<input type="submit" name="submit" value="submit">

</form>
<button id="bu" onclick="heade()">large</button>
<button id="perview" onclick="replace()">Preview</button>
<button id="image_upload_button">Image upload</button>
<div id="image_upload_div">
	<form method="post" enctype="multipart/form-data" id="image_upload_form" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<input type="file" name="image">
		<input type="submit" name="submit_image"  value="upload" multiple>

	</form>
	<button onclick="addimg()">add</button>
</div>
<div id="pre"></div>
<script type="text/javascript">
	function addimg()
	{      
       var _dir="";
//console.log(_dir);
          // while(_dir=="")
			 _dir="<?php echo $img_tag;?>";
document.getElementById("ta").value+=_dir;
	}

	
	function heade()
	{
		   var position=document.getElementById("ta").selectionStart;
    var str = document.getElementById("ta").value;
    var subst=str.substr(0,position);
    var suben=str.substr(position+1);
    var newst=subst+"\n@@@@"+suben;
    document.getElementById("ta").value=newst;
	}
	function replace()
	{ 
		var c=1;
		var r2="";
		var r1=document.getElementById("ta").value;
		for (var i = 0; i < r1.length-1; i++) {

			if ((r1[i]=="@")&&(r1[i+1]=="@")) {
				c++;
				i++;
			console.log("hiii");
				if (c%2==0) {
					r2+="<h1>";
				}
				else
				{
					r2+="</h1>";
				}
			}
			else if(r1[i]!="@")
			{
				r2+=r1[i];
			} 
		}
		document.getElementById("pre").innerHTML=r2;
	}
</script>
<script type="text/javascript">
	$('#ta').keydown(function(e){
    if(e.keyCode == 13)
    {
       var position=document.getElementById("ta").selectionStart;
    var str = document.getElementById("ta").value;
    var subst=str.substr(0,position);
    var suben=str.substr(position+1);
    var newst=subst+"<br>"+suben;
    document.getElementById("ta").value=newst;


    }
});
</script>
<script type="text/javascript">
//document.getElementById("submit_image").onclick=attr;
		//function attr()
	//{
        // var user=document.getElementById("user").value;
      //   var cmnt=document.getElementById("txtar").form=text_form;
		//console.log(user);
        // request3 = new XMLHttpRequest(); 
		//var url="comment.php?user="+escape(user)+"&comments="+escape(cmnt);
		//request3.open("GET",url,true);
		//request3.onreadystatechange=display;
		//request3.send(null);*/
	//}
</script>
</body>
</html> 