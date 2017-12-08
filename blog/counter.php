<?php
session_start();
$_SESSION['x']=1;
 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div id="dis"></div>
<script type="text/javascript">
	//window.onLoad=views();
	function views()
	{
		request = new XMLHttpRequest(); 
		var url="views.php";
		request.open("GET",url,true);
		request.onreadystatechange=display;
		request.send(null);
		console.log("hii");

	}
	function display() {
	  if (request.readyState == 4) { 
	     if (request.status == 200) { 
	          detailDiv = document.getElementById("dis");      detailDiv.innerHTML = request.responseText;  
	            }
	          }
	       }
	       setInterval(views, 200);
</script>
</body>
</html>