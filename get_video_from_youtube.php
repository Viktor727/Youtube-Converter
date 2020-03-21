<?php

include_once 'message.class.php'; 
include_once 'youtube_converter.class.php'; 

function is_ajax() {
  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

function GetYoutubeVideoByURL($youtubeURL) {
	$handler = new YoutubeConverter(); 
	$return = new Message(true, "Success!", null, null);

	// Check whether the url is valid 
	if(!empty($youtubeURL) && !filter_var($youtubeURL, FILTER_VALIDATE_URL) === false)
	{ 
	    // Get the downloader object 
	    $downloader = $handler->getDownloader($youtubeURL); 
	     
	    // Set the url 
	    $downloader->setUrl($youtubeURL); 
	     
	    // Validate the youtube video url 
	    if($downloader->hasVideo())
	    { 
	        // Get the video download link info 
	        $videoDownloadLink = $downloader->getVideoDownloadLink(); 
	        
        	if(isset($videoDownloadLink) && $videoDownloadLink != null)
        	{
		       	$videoTitle = $videoDownloadLink[0]['title']; 
				$videoQuality = $videoDownloadLink[0]['qualityLabel']; 
				$videoFormat = $videoDownloadLink[0]['format']; 
				$videoFileName = strtolower(str_replace(' ', '_', $videoTitle)).'.'.$videoFormat; 
				$downloadURL = $videoDownloadLink[0]['url']; 
				$fileName = preg_replace('/[^A-Za-z0-9.\_\-]/', '', basename($videoFileName)); 

		        if(!empty($downloadURL))
		        {
		        	/*
		        	// Define header for force download 
		            header("Cache-Control: public"); 
		            header("Content-Description: File Transfer"); 
		            header("Content-Disposition: attachment; filename=$fileName"); 
		            header("Content-Type: application/zip"); 
		            header("Content-Transfer-Encoding: binary"); 
		             
		            // Read the file 
		            readfile($downloadURL);
		            */

		        	$return = new Message(true, "Success", $downloadURL, $fileName);
		        }
		        else
		        {
		    		$return = new Message(false, "Cannot Get Video Download Url. Please, Try Again.", null, null);
		    	}
	    	}
	    	else
	    	{
	    		$return = new Message(false, "Cannot Get Video Donwload URL. Pleasem Try Again.", null, null);
	    	}
	    } 
	    else 
	    {
	    	$return = new Message(false, "The video is not found, please check YouTube URL.", null, null);
	    } 
	} 
	else 
	{ 
    	$return = new Message(false, "Please provide valid YouTube URL.", null, null);
	} 

    return $return->toJSON();
}

if (is_ajax()) {
	if (isset($_POST["type"]) && !empty($_POST["type"]) 
		&& isset($_POST["url"]) && !empty($_POST["url"])) 
	{
		$return = GetYoutubeVideoByURL($_POST["url"]);
	  	echo $return;
	}
}

?>