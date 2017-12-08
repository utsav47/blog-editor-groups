<?php
require_once("dbconnect.php");
function cu($dat){
return mysqli_real_escape_string($dbc, trim($dat)); 
}
?>