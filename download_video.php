<?php
if (isset($_POST["url"]) && !empty($_POST["url"])) 
{
	$fileName = "converted_video.mp4";
	if(isset($_POST["filename"]) && !empty($_POST["filename"]))
	{
		$fileName =  $_POST["filename"];
	}
	
	// Define header for force download 
    header("Cache-Control: public"); 
    header("Content-Description: File Transfer"); 
    header("Content-Disposition: attachment; filename=$fileName"); 
    header("Content-Type: application/zip"); 
    header("Content-Transfer-Encoding: binary"); 
     
    // Read the file 
    readfile($_POST["url"]);
}


?>