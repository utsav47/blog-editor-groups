<?php
session_start();
$id=$_SESSION['id'];
require_once("dbconnect.php");
$query="select * from blog_info where blog_id='$id'";

$result = mysqli_query($dbc, $query);
$row = mysqli_fetch_array($result);
if($row)
{
echo $row['views'];

}
else
{
	echo "couldnt find";
}
?>