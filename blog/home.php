<?php
session_start();

require_once("dbconnect.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Main Page</title>
	<script src="jquery-3.2.1.min.js"></script>
	<style type="text/css">
	body
	{
		margin:0; 
    }
		#heading
	{
		
		height: 7em;
		background-color: #2a2118;
		text-align: center;
		
		
		
	}
	  #heading p
    {
    	font-size: 3em;
    	margin: 0;
    	color: white;
    }
	#menu_bar
	{
		
		
		height: 3em;
		background-color: #669f44;
        border-bottom: 1px solid #bbda12;

		

		

	}
	 #footer
    {
    	height: 5em;
    	background-color: #2a2118;
    	margin-top: 3em;

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
   	display: none;

   }
  #des div
   {
   	float:left;
    width: 33%;
    color: white;
    text-align: center;
   }
   #des a
   {
    text-decoration: none;
    color:white;
   }
   .webz
   {
display: table;
   }
   #article_h,#tutorial_h,#project_h
   {
   	font-size: 3em;
   	color:#2a2118;
   	clear: left;

   }
    #article_b,#tutorial_b,#project_b
    {
    	height:15em;
    }
    #article_b div
    {
    	float: left;
    	margin:2em;
    	height:5em;
    	width:18%;
    	border:1px solid #2a2118;
    }
</style>
</head>
<body>
<div id="heading"><p>The ferternity of genises</p><p style="font-size: 2em;">Programmers</p></div>
<div id="topics"><span>Topics</span></div>
<div id="menu_bar">
	<ul id="nav">
               <li>Home</li>
                
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



 <div id="article_h">Featured Articles </div>
 <div id="article_b">
 	<?php
		$query="select * from blog_info ORDER BY views DESC";
		$data8=mysqli_query($dbc,$query);
		$count=0;
		while ($count<8) {
			$count++;
			$row8=mysqli_fetch_array($data8);
			echo "<a href=index.php?id=".$row8['blog_id']."><div>".$row8['heading']."</div></a>";
		}
		?>
 </div>
 <div id="tutorial_h">Featured Tutorials </div>
 <div id="tutorial_b"> </div>
 <div id="project_h">Featured Projects </div>
 <div id="project_b"> </div>






<div id="footer">Footer</div>
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