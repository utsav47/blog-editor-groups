<?php
session_start();
require_once("dbconnect.php");
  if (!isset($_SESSION['admid'])) 
  	{  
  	   header('Location:index.php');
  	   exit();  
    } 
$query="select * from blog_info where state=0";
$data=mysqli_query($dbc,$query);

?>
<!DOCTYPE html>
<html>
<head>
	<script src="jquery-3.2.1.min.js"></script>
	<title></title>
	<style type="text/css">
		#display
		{
			max-height: 20px;
		}

	</style>
</head>
<body>
	
<div><p id="myar">Articles</p></div>
     	<?php
     	while ($row1=mysqli_fetch_array($data)) {
     		echo "<div class=ar>".
     		"<a href=g1check.php?id=".$row1['blog_id'].">".$row1['heading']."</a>".
     	
     		"</div>";
     	}
     		?>
     </div> 

     <div style="float: right;" id="display">
     </div>
     <div id="messages">
     	<input type="text" name="messages" id="enter">
     </div>
     <script type="text/javascript">
     	$('#enter').keyup(function(e){
           if(e.keyCode==13)
           {
           	var msg=$('#enter').val();
             $.ajax({
             	url:'insertmsg.php',
             	type:'get',
             	data:{msgs:msg},
             	success:function(){
             		$('#display').append(msg);
             	}
             });
           }
     	});


     	function new1(){
     		$('#display').load("displaymsg.php");
     	}
     	setInterval(new1,1000);
     </script>
</body>
</html> 