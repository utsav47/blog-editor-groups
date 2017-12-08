<?php 
session_start();
require_once("dbconnect.php");
$bid=$_GET['id'];
$_SESSION['blo_id']=$bid;
$query="select * from blog_info where blog_id='$bid'";
$result=mysqli_query($dbc,$query);
$row=mysqli_fetch_array($result);

$id=$_SESSION['admid'];
$query="select * from firstcomp where blog_id='$bid' and id='$id'";
$result1=mysqli_query($dbc,$query);
$row1=mysqli_fetch_array($result1);
if ($row1) {
	# code...
}
?>
<!DOCTYPE html>
<html>
<head>
	<script src="jquery-3.2.1.min.js"></script>
	<title>Group 1 Check</title>
	<style type="text/css">
		#display
		{
			width: 60%;
		}
		#messages
		{
			float: right;
			width: 35%;
		}
		#change
		{
			border: 1px solid black;
		}
	</style>
</head>
<body>
	<div id="change">
		<div id="changedis"></div>
		<input type="text" id="enterch" name="changed">
		<button class="sub">Send</button>
     </div>
     <button id="done"> Done</button>
	<div id="messages"></div>
	<input type="text" name="msg" id="enter">
<div id="display"></div>
<script type="text/javascript">
	var loc="<?php echo 'http://localhost/blog/data/'.$row['location'].'/file.html'; ?>";
	$('#display').load(loc);
		function new1(){
     		$('#messages').load("displaymsg.php");
     	}
     	setInterval(new1,1000);

     	$('#enter').keyup(function(e){
           if(e.keyCode==13)
           {
           	var msg=$('#enter').val();
           	var blog=<?php echo $_GET['id']; ?>;
             $.ajax({
             	url:'insertmsg.php',
             	type:'get',
             	data:{msgs:msg,blog_id:blog},
             	success:function(){
             		$('#messages').append(msg);
             	}
             });
           }
     	});



     	$('.sub').click(function(){
     		var valn=$('#enterch').val();
     		$.ajax({
     			url:'change_content.php',
     			type:'get',
     			data:{value:valn},
     			success:function(){
     				$('#changedis').append(valn);
     			}
     		});
     		     	});
     	$('.done').click(function(){
     		
     		$.ajax({
     			url:'insertfirstcmp.php',
     			type:'get',
     		
     			success:function(){
     			//	$('#changedis').append("worked");
     			}
     		});
     		     	});

</script>
<?php
if ($row1) {
	echo "<script type=text/javascript src=disable.js></script>";
}
?>
</body>
</html>