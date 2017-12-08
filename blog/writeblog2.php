<?php
session_start();
  if (!isset($_SESSION['aid'])) 
  	{  
  	   header('Location:login.php');
  	   exit();  
    } 
require_once("dbconnect.php");
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="jquery-3.2.1.min.js"></script>
	<style type="text/css">
		#display
		{
			width:85%;
			min-height:40em;
			border:1px solid darkcyan;
			padding: 2em;
			margin-left: 4em;
			margin-right:4em;
			box-shadow: 1px 1px 20px 6px #053848;
		}
		#display>img
		{
			width: 40em;
			margin-left: 25%;
		}
		#ta
		{
			width:90%;
			border:1px solid darkcyan;
			padding: 2em;
			margin: 2em;
		}
		#title
		{
			width:70%;
			border:1px solid darkcyan;
			padding-left: 1em;
			margin: 1.75em;
			height: 2em;
			box-shadow: 1px 1px 20px 6px #053848;
			font-size: 2em;
			text-align: center;


		}
		#input
		{
			text-align: center;
		}
	</style>
</head>
<body><div>
	<button id="1">H1</button>
	<button id="2">H2</button>
	<button id="3">Bold</button>
	<button id="4">Italic</button>
	<button id="5">Underline</button>
	<select>
<option name="topic" id="topic">Topic Name</option>		
<option value="webdevelopment">web development</option>
<option>Web design</option>
<option>App Development</option>
<option>Programming</option>		
	</select>
	<form method="post" enctype="multipart/form-data" id="image_upload_form" action="">
		<input type="file" name="image">
		<input type="submit" name="submit_image"  value="upload" id="upload">

	</form>
	<div id="save">SAVE</div>
	<div id="pr">Preview</div>
<div id="d"></div>
</div>
  <textarea id="ta"></textarea>
<div id="input"><input type="text" name="title" id="title" placeholder="Title of the article"></div>
  <div id="display"></div>
<script type="text/javascript">
	var open=["<p class=w>","<h1 class=w>", "<b>","<i>", "<u>"];
	var close=["</p>","</h1>", "</b>","</i>", "</u>"];
var set=0;
$('button').click(function(){
	
	var id = $(this).get(0).id;
	set=id;
	console.log(id);
	$(this).css({
		color:'red'
	});
});

	$('#ta').keydown(function(e){
    if(e.keyCode == 13)
    {
  var str=open[set]+$('#ta').val()+close[set];

  $('#ta').val("");
 $("#"+set).css({
		color:'black'
	});
  console.log(str);
  set=0;
   // var sendData={data:str};
	//$.get('file.php',sendData,function(data){
   //  $('#display').load('file.html');
   //  console.log(document.getElementById("display").innerHTML);
	//});
$(str).appendTo('#display');
    }


});
	document.getElementById("display").contentEditable="true";
	//console.log(document.getElementById("display").innerhtml);

</script>
<script type="text/javascript">
	$('#save').click(function(){
	console.log("got it");
	var edit_html=document.getElementById("display").innerHTML;
	var tit=$('#title').val();
	var topic=$('option:selected').val();
	//var sendd={value:edit_html};
	//var send2={title:tit};
	//$.get('save.php',sendd,send2,function(data){
   //  $('#display').load('file.html');
  // $('<h1></h1>').appendTo('#display');

  $.ajax({  
  	url: 'save.php', 
   data:{value:edit_html,title:tit,topic:topic},
   success: function(data) {    $('#d').html(data); 
    
}
    
	});
});
	$('#pr').click(function(){
		$('#display').load("file.html");
	});

	$(document).ready(function (e) {

	$('#image_upload_form').submit(function(e){
		e.preventDefault();
		$.ajax({
			url:'upload.php',
			type: "POST",           
			data: new FormData(this), 
            contentType: false,       
            cache: false,             
            processData:false,        
            success: function(data)
                    {
                     $('#display').append(data);
		console.log(data);
                    }

		});
	});
});
</script>
</body>
</html>