<?php
error_reporting(0);

include_once 'message.class.php'; 
include_once 'youtube_converter.class.php'; 

require_once('conf.php');
require_once __DIR__ . '/vendor/autoload.php';

session_start();

function is_ajax() {
  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

function GetYoutubeVideoByURL($youtubeURL) {
	$handler = new YoutubeConverter(); 
	$return = Message::get_info_message("Success!");

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
		        	$return = Message::get_download_message("Success", $downloadURL, $fileName);
		        else
		    		$return = Message::get_error_message("Cannot Get Video Download Url. Please, Try Again.");
	    	}
	    	else
	    		$return = Message::get_error_message("Cannot Get Video Donwload URL. Please, Try Again.");
	    } 
	    else
	    	$return = Message::get_error_message("The video is not found, please check YouTube URL.");
	} 
	else
    	$return = Message::get_error_message("Please provide valid YouTube URL.");

    return $return;
}

function GetMp3FromYoutubeVideo($youtubeURL)
{
	global $server_video_save_folder_name;
	global $server_video_save_folder_path;
	global $server_ffmpeg_path;

	$youtubeVideoByURLReturnMessage = GetYoutubeVideoByURL($youtubeURL);

	if($youtubeVideoByURLReturnMessage->isOk == true) 
	{
		$videoURL = $youtubeVideoByURLReturnMessage->downloadUrl;
		
		$videoFileName = $youtubeVideoByURLReturnMessage->fileName;
		$localVideoPath = $server_video_save_folder_path . $videoFileName;
		if(file_exists($localVideoPath)) 
			$localVideoPath = $server_video_save_folder_path . date("YmdHms") . "_" . $videoFileName;

		$mp3filePath = substr($localVideoPath, 0, strrpos($localVideoPath, '.')) . ".mp3";

		touch($localVideoPath);
		chmod($localVideoPath, 0775);

		// download mp4
		$download = download_file($videoURL, $localVideoPath);
		if($download === FALSE)
			return Message::get_error_message("Error While Saving Video On Server. Please, Try Again.");

		$logdir = dirname(__FILE__);

		// convert mp4 to mp3
        $cmd = "$server_ffmpeg_path -i \"$localVideoPath\" -ar 44100 -ab 320k -ac 2 \"$mp3filePath\"";
        exec($cmd);

        //remove mp4
        unlink($localVideoPath);

        //return download mp3 link
        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
        $mp3_filename = substr($videoFileName, 0, strrpos($videoFileName, '.')) . ".mp3";
        $mp3_link = $actual_link . $server_video_save_folder_name . $mp3_filename;

        return Message::get_download_message("Success", $mp3_link, $mp3_filename);
	} 
	else
		return $youtubeVideoByURLReturnMessage;
}

function GetSrtByURL($url)
{
	if(isset($_SESSION["authcode"]) && $_SESSION["authcode"]) {
		$return = Message::get_auth_error_message("Yeah, You've authorized", true, true, "");
	} else {
		$AuthUrl = GetGoogleAuthUrl("youtube-tomp3.com");
		$return = Message::get_auth_error_message("Please, Authorize before using this feature.", true, false, $AuthUrl);
	}
	return $return;
}

/**
*  @param   string   $remote_file  String, containing the remote file URL.
*  @param   string   $local_file   String, containing the path to the file to save the curl result in to.
*/
function download_file($remote_file, $local_file)
{
	if(file_put_contents($local_file, file_get_contents($remote_file, 'r')))
	    return True;
	else
		return False;
}

function GetGoogleAuthUrl($redirectUri)
{
	global $youtube_AppName;
	global $youtube_clientId;
    global $youtube_clientSecret;
    global $youtube_APIKey;

	$client = new Google_Client();

	$client->setApplicationName($youtube_AppName);
	$client->setDeveloperKey($g_youtubeDataAPIKey);  
	$client->setClientId($youtube_clientId);
	$client->setClientSecret($youtube_clientSecret);
	$client->setRedirectUri($redirectUri;
	//$client->setScopes(array('https://www.googleapis.com/auth/analytics.readonly'));

	$authUrl = "";

	try
	{ 
		$authUrl = $client->createAuthUrl();
	}
	catch (Exception $ex)
	{
		echo "Error While Getting Authorization URL: " . $ex->getMessage();
		$authUrl = "";
		return False;
	}

	return $authUrl;
}

if (is_ajax()) {
	if (isset($_POST["type"]) && !empty($_POST["type"]) 
		&& isset($_POST["url"]) && !empty($_POST["url"])) 
	{
		$return = "";
		if($_POST["type"] == "mp4")
			$return = GetYoutubeVideoByURL($_POST["url"]);
		elseif($_POST["type"] == "mp3")
			$return = GetMp3FromYoutubeVideo($_POST["url"]);
		else if($_POST["type"] == "srt") {
			$return = GetSrtByURL($_POST["url"]);
		}
		else
			$return = Message::get_error_message("Uknown type. Only mp3 and mp4 is allowed.");

		echo $return->toJSON();
	}
}

?>