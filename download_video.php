<?php
error_reporting(0);

if (isset($_POST["url"]) && !empty($_POST["url"])) 
{
	$fileName = "converted_video.mp4";
	if(isset($_POST["filename"]) && !empty($_POST["filename"]))
	{
		$fileName =  $_POST["filename"];
	}

    $parsed = parse_url($_POST["url"]);

	if(file_exists(dirname(__FILE__) . $parsed["path"]))
	{
		// Define header for force download 
		header("Cache-Control: public"); 
		header("Content-Description: File Transfer"); 
		//header("Content-Length: ".filesize(dirname(__FILE__) . $parsed["path"]));
		header("Content-Disposition: attachment; filename=$fileName"); 
		header("Content-Type: application/zip"); 
		header("Content-Transfer-Encoding: binary");

		// Read the file 
		readfile(dirname(__FILE__) . $parsed["path"]);
	} 
	else
	{
		echo "File not exist. " .  $parsed["path"];
	}
}


?>