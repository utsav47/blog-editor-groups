<?php
session_start();
  if (!isset($_SESSION['aid'])) 
  	{  
  	   header('Location:login.php');
  	   exit();  
    }
require_once("dbconnect.php");
$aut_id=$_SESSION['aid'];
$query="select * from author_info where author_id='$aut_id'";
$data=mysqli_query($dbc,$query);
$row=mysqli_fetch_array($data);
$query="select * from blog_info where author_id='$aut_id'";
$data1=mysqli_query($dbc,$query);
?>

<!DOCTYPE html>
<html>
<head>
	<title><?php echo $row['fname']." ".$row['lname']; ?></title>
	<style type="text/css">
		#myar
		{
			font-size: 2em;
		}
		.ar
		{
			font-size: 1.5em;
			height: 2em;	
			border-top:1px solid #b1e7fb;


		}
		.ar a
		{
			text-decoration:none;
			color:darkcyan;

		}
		.views
		{
			color:red;
			float:right;
			margin-left:2em;
			width: 3em;

		}
		.likes
		{
			color:pink;
			float:right;
			margin-right:2em;
			width: 3em;
		}
		div[contenteditable]
		{
			width: 10em;
			height:10em;
			border:1px solid darkcyan;
			float:right;
			width: fixed;

		}
	</style>
</head>
<body>
	<a href="writeblog2.php"><button>New Article</button></a>	
	<a href="logout.php"><button>Logout</button></a>
	<div contenteditable="true"></div>
     <div id="my_blogs">
     	<div><p id="myar">Published Articles</p></div>
     	<?php
     	while ($row1=mysqli_fetch_array($data1)) {
     		echo "<div class=ar>".
     		"<a href=index.php?id=".$row1['blog_id'].">".$row1['heading']."</a>".
     		"<span class=views>".$row1['views']."</span>".
     		"<span class=likes>".$row1['lokes']."</span>".
     		"</div>";
     	}
     		?>
     </div>
</body>
</html>