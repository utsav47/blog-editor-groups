<?php
$data=$_GET['data'];
$location="file.html";
$fd = fopen($location,'a');
if (!$fd) {
   echo "Error! Couldn't open/create the file.";
      die;
       } 
       fwrite($fd, $data);
       fclose($fd); 



/*$file_name="file.html";
$fd = fopen($file_name, 'r'); 
if (!$fd) {
    echo "Error! Couldn't open the file.";
        die;
         } 
while (! feof($fd)) {
    $file_data .= fgets($fd);
    echo $file_data;

}*/
?>