<?php
session_start();

require_once("dbconnect.php");

$id=$_GET['id'];
$_SESSION['id']=$id;
$query="select * from blog_info where blog_id='$id'";

$result = mysqli_query($dbc, $query);
$row = mysqli_fetch_array($result);
if($row)
{
$views=$row['views'];
	if(!isset($_SESSION['v']))
	{
$views=$views+1;
$query="update blog_info set views='$views' where blog_id='$id'";
$result1 = mysqli_query($dbc, $query);
     $_SESSION['v']="set";
   }

$_SESSION['likes']=$row['lokes'];



$file_data = '';
$file_name="data/".$row['location']."/file.html";
$fd = fopen($file_name, 'r'); 
if (!$fd) {
    echo "Error! Couldn't open the file.";
        die;
         } 
while (! feof($fd)) {
    $file_data .= fgets($fd);

}
fclose($fd); 
$auth_id=$row['author_id'];
$query="select * from author_info where author_id='$auth_id'";
$result2 = mysqli_query($dbc, $query);
$row2 = mysqli_fetch_array($result2);
}
else
{
	echo "couldnt find";
}






?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
<script src="jquery-3.2.1.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
<style type="text/css">

    body
    {
    	margin: 0;
    	background-color:#edf4e2;
    	font-family: "Segoe UI",Arial,sans-serif;

    }
	div
	{
		
		


	

	}
	#blog_title, #blog_area, #blog_details,#comment_area
	{
		width: 100%;
		margin-top: 0.5em;
		background-color:#ffffff;


		
	}
	#heading
	{
		
		height: 7em;
		background-color: #2a2118;
		text-align: center;
		
		
		
	}
	#comment_area
	{
		width: 100%;
		background-color:#ebf1cb; 
		margin-top: 3em;
		padding-left: 0.5em;
		padding-right:0.5em;
		padding-top: 2em;
		padding-bottom: 2em;
		
	}
	#comment_area	p
	{

margin:0;
border-bottom: 2px solid #669f44;
	}
	#menu_bar
	{
		
		
		height: 3em;
		background-color: #669f44;
        border-bottom: 1px solid #bbda12;

		

		

	}
	#blog_details
	{
		height: 5em;
		background: none;
		border: none;
		border-bottom: 2px solid #cfd6d0; 
	}

	#blog_title
	{
		
		
		background-color: #dbe8bc;
		text-align: center;
		font-size: 1.5em;
		color:#565a41;
		border-bottom:2px solid #669f44;
		border-top:4px solid #669f44;


	}

	#blog_area
	{
		
		font-size: 1.3em;		
		border-bottom: 2px solid #cfd6d0; 
	}

	#counter
	{
		width: 30%;
		float: right;
		margin-top: 2em;
		
		
	}
    textarea
    {
    
   display: block;
   
    	
    }

    #button
    {
      margin-top: 0.5em;
    
    }
    #blog_wrap
    {
    	
    	border: none;
    	width: 55%;
    	margin-left: 0;
    	
    	background-color:white;
    	padding-left: 4em;
    	padding-right:4em;
    	padding-top: 5em;
    	padding-bottom:3em;
    }
   #blog_area p
    {
    	padding: 0.5em;
    }
    #blog_title p
    {
    	font-size: 2em;
    	margin: 0;
    }
    #heading p
    {
    	font-size: 3em;
    	margin: 0;
    	color: white;
    }

    h1.w
    {
    	color: #7ba552;
    	font-size: 1.4em;
    }
    #footer
    {
    	height: 5em;
    	background-color: #2a2118;
    	margin-top: 3em;

    }
    #v1
    {
    	padding: 0.2em;
    	border-bottom:1px solid #669f44;
    	padding-left:1.5em;
    	padding-right: 1.5em;
    }
    #v3
    {
    	padding: 0.2em;
    	border-top:1px solid #669f44;

    	padding-left:1.5em;
    	padding-right: 1.5em;
    }
    #v2
    {
    	padding: 0.2em;
    	border:1px solid #669f44;
    	background-color: #669f44;
    	color: white;
    	padding-left:1.5em;
    	padding-right: 1.5em;
    	border-radius: 9px 0px 9px 0px;
    }
    #view
    {
    	font-size: 1.5em;
    	
    }
    #topics
    {
    	color: white;
    	text-align: center;
    	background-color: #2a2118;
    	border-bottom: 1px solid #bbda12;
    }
    #topics span
    {
    	background-color: #669f44;
    	padding: 0.2em 0.6em 0.1em 0.6em;
    	font-size: 1.2em;
    	border-radius: 3px 3px 0 0;
    	border-right:1px solid #bbda12; 
    	border-top:1px solid #bbda12;
    	border-left: 1px solid #bbda12;
    }
   #nav
   {
   	margin: 0;
   }
   #nav li
   {
   	margin: 1em;
   	float:left;
   	width: 10em;
   	color: white;
  
   
   	text-align: center;
   }
   #nav li:first-child
   {
   	display: table;
   	 	font-size: 1.4em;
   	 	margin:0.4em;

   }
   #nav li:second-child
   {
   	display: table;
   }
   #des
   {

   	height: 15em;
   	background-color: black;
   	opacity: 0.9;
   	display: none;

   }
  #des div
   {
   	float:left;
    width: 33%;
    color: white;
    text-align: center;

   }
   .webz
   {
display: table;
   }
      #des a
   {
    text-decoration: none;
    color:white;
   }
</style>
</head>
<body>
<div id="heading"><p>The ferternity of genises</p><p style="font-size: 2em;">Programmers</p></div>
<div id="topics"><span>Topics</span></div>
<div id="menu_bar">
	<ul id="nav">
               <a href="home.php"><li>Home</li></a>
                
               <li class="webz">Web Design</li>
                
               <li class="webv"> Web Development</li>
                
               <li class="app">App Development</li>	
                
               <li class="pro">Programming</li>
                
                
               <li class="oth">Others</li>



                  </ul>
</div>
<div id="des">
	<div class="design">
		<h1>Top Articles</h1>
		<div id="dez5">
		<?php
		$query="select * from blog_info where topic='dez' ORDER BY views DESC";
		$data7=mysqli_query($dbc,$query);
		while ($row7=mysqli_fetch_array($data7)) {
			echo "<a href=index.php?id=".$row7['blog_id']."><p>".$row7['heading']."</p></a>";
		}
		?>
	</div>
	<div id="dev5">
				<?php
		$query="select * from blog_info where topic='dev' ORDER BY views DESC";
		$data3=mysqli_query($dbc,$query);
		while ($row3=mysqli_fetch_array($data3)) {
			echo "<a href=index.php?id=".$row3['blog_id']."><p>".$row3['heading']."</p></a>";
		}
		?>
	</div>

	<div id="app5">
				<?php
		$query="select * from blog_info where topic='app' ORDER BY views DESC";
		$data4=mysqli_query($dbc,$query);
		while ($row4=mysqli_fetch_array($data4)) {
			echo "<a href=index.php?id=".$row4['blog_id']."><p>".$row4['heading']."</p></a>";
		}
		?>
	</div>

	<div id="pro5">
				<?php
		$query="select * from blog_info where topic='pro' ORDER BY views DESC";
		$data5=mysqli_query($dbc,$query);
		while ($row5=mysqli_fetch_array($data5)) {
			echo "<a href=index.php?id=".$row5['blog_id']."><p>".$row5['heading']."</p></a>";
		}
		?>
	</div>

	<div id="oth5">
				<?php
		$query="select * from blog_info where topic='oth' ORDER BY views DESC";
		$data6=mysqli_query($dbc,$query);
		while ($row6=mysqli_fetch_array($data6)) {
			echo "<a href=index.php?id=".$row6['blog_id']."><p>".$row6['heading']."</p></a>";
		}
		?>
	</div>
	</div>
    <div class="design"><h1>Top Tutorials</h1></div>
    <div class="design"><h1>Top Projects</h1></div>
</div>
<div id="counter">

	
	<p id="view"><span id="v1">Page</span><span id="v2"><?php echo $views;?></span><span id="v3">Views</span></p>
	<p onclick="likes();"><!--like--></p>
	
</div>

	<div id="blog_wrap">
		



<div id="blog_title"><p><?php echo $row['heading']; ?></p></div>

<div id="blog_details">
	
	<p style="float: left; margin-left: 0.5em;"><span style="color: grey;"><?php echo " ".$row['date']; ?></span><b style="color:grey;">-By <?php echo " ".$row2['fname']." ".$row2['lname']; ?></b>
	</p>

</div>


<div id="blog_area"><p><?php echo $file_data; ?>

</p></div>

<div id="comment_area">
	<input type="text" name="username" placeholder="username" id="user">
<textarea id="txtar"></textarea>
	<input id="button" type="submit" name="submit">
	<?php 
	$query="select * from comment where blog_id='$id'";
	$data=mysqli_query($dbc,$query);
	if ($data) {
		 while ($row1 = mysqli_fetch_array($data)) { 
		 	echo "<p class=com>".$row1['comments']."</p>";

		 }
	}
	else
	{
		echo "no comments";
	}
	 ?>
	
</div>
	</div>



<div id="footer">Footer</div>
<script type="text/javascript">
	//window.onLoad=views();
	function views()
	{
		request = new XMLHttpRequest(); 
		var url="views.php";
		request.open("GET",url,true);
		request.onreadystatechange=display;
		request.send(null);
		//console.log("hii");

	}
	function display() {
	  if (request.readyState == 4) { 
	     if (request.status == 200) { 
	          detailDiv = document.getElementById("v2");      detailDiv.innerHTML = request.responseText;  
	            }
	          }
	       }
	       function likes()
	       {

	  	request1 = new XMLHttpRequest(); 
		var url="likes.php";
		request1.open("GET",url,true);
		//request1.onreadystatechange=display;
		request1.send(null);

	       }
	       setInterval(views, 500);


</script>
<script type="text/javascript">
	//window.onLoad=ini;
//	function ini()
//	{
		document.getElementById("button").onclick=comment;
		function comment()
		{
         var user=document.getElementById("user").value;
         var cmnt=document.getElementById("txtar").value;
		console.log(user);
         request3 = new XMLHttpRequest(); 
		var url="comment.php?user="+escape(user)+"&comments="+escape(cmnt);
		request3.open("GET",url,true);
		//request3.onreadystatechange=display;
		request3.send(null);

	//	}
	}
</script>
<script type="text/javascript">
	$('.webz').mouseover(function(){
		console.log("entered");
        $('#des').show();
        $('#dev5').hide();
        $('#pro5').hide();
        $('#app5').hide();
        $('#oth5').hide();
        $('#dez5').show();
	});

	$('.webv').mouseover(function(){
		console.log("entered");
        $('#des').show();
        $('#pro5').hide();
        $('#oth5').hide();
        $('#app5').hide();
        $('#dez5').hide();
        $('#dev5').show();
	});
	$('.app').mouseover(function(){
		console.log("entered");
        $('#des').show();
        $('#pro5').hide();
        $('#oth5').hide();
        $('#app5').show();
        $('#dez5').hide();
        $('#dev5').hide();
	});
	$('.pro').mouseover(function(){
		console.log("entered");
        $('#des').show();
        $('#pro5').show();
        $('#oth5').hide();
        $('#app5').hide();
        $('#dez5').hide();
        $('#dev5').hide();
	});
	$('.oth').mouseover(function(){
		console.log("entered");
        $('#des').show();
        $('#pro5').hide();
        $('#oth5').show();
        $('#app5').hide();
        $('#dez5').hide();
        $('#dev5').hide();
	});

	$('#des').mouseout(function(){
		console.log("out");
		$('#des').hide();
	});
		$('#des').mouseover(function(){
		console.log("out");
		//if (topc=1) {
		$('#des').show();
		//$('#dev5').hide();	
	//	}
		//else if(topc=2){
       //  	$('#des').show();
		//$('#dez5').hide();
		//}
		
	});



	/*	$('.webv').mouseover(function(){
		console.log("entered");
		
        $('#des').show();
        $('#dez5').hide();
	});
	$('#des').mouseout(function(){
		console.log("out");
		$('#des').hide();
	});
		$('#des').mouseover(function(){
		console.log("out");
		$('#des').show();
		$('#dez5').hide();
	});*/
</script>
</body>
</html>