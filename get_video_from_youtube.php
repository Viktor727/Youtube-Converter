<?php
error_reporting(0);

include_once 'message.class.php'; 
include_once 'youtube_converter.class.php'; 

require_once('conf.php');

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
		        	$return = new Message(true, "Success", $downloadURL, $fileName);
		        else
		    		$return = new Message(false, "Cannot Get Video Download Url. Please, Try Again.", null, null);
	    	}
	    	else
	    		$return = new Message(false, "Cannot Get Video Donwload URL. Pleasem Try Again.", null, null);
	    } 
	    else
	    	$return = new Message(false, "The video is not found, please check YouTube URL.", null, null);
	} 
	else
    	$return = new Message(false, "Please provide valid YouTube URL.", null, null);

    return $return;
}

function GetMp3FromYoutubeVideo($youtubeURL)
{
	global $server_video_save_folder;
	global $server_ffmpeg_path;

	$youtubeVideoByURLReturnMessage = GetYoutubeVideoByURL($youtubeURL);

	if($youtubeVideoByURLReturnMessage->isOk == true) 
	{
		$videoURL = $youtubeVideoByURLReturnMessage->downloadUrl;
		
		$videoFileName = $youtubeVideoByURLReturnMessage->fileName;
		$localVideoPath = dirname(__FILE__) . $server_video_save_folder . $videoFileName;
		if(file_exists($localVideoPath)) 
			$localVideoPath = dirname(__FILE__) . $server_video_save_folder . date("YmdHms") . "_" . $videoFileName;

		$mp3filePath = substr($localVideoPath, 0, strrpos($localVideoPath, '.')) . ".mp3";

		touch($localVideoPath);
		chmod($localVideoPath, 0775);

		// download mp4
		$download = download_file($videoURL, $localVideoPath);
		if($download === FALSE)
			return new Message(false, "Error While Saving Video On Server. Please, Try Again.", null, null);

		$ffmpeg_cmd = dirname(__FILE__) . $server_ffmpeg_path;

		$logdir = dirname(__FILE__);

		// convert mp4 to mp3
        $cmd = "$ffmpeg_cmd -i \"$localVideoPath\" -ar 44100 -ab 320k -ac 2 \"$mp3filePath\" >$logdir/ 2>$logdir/ffmpeg.log &";
        shell_exec($cmd);

        //remove mp4
        unlink($localVideoPath);

        //return download mp3 link
        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
        $mp3_filename = substr($videoFileName, 0, strrpos($videoFileName, '.')) . ".mp3";
        $mp3_link = $actual_link . $server_video_save_folder . $mp3_filename;

        return new Message(true, "Success", $mp3_link, $mp3_filename);
	} 
	else
		return $youtubeVideoByURLReturnMessage;
}

/**
*  @param   string   $remote_file  String, containing the remote file URL.
*  @param   string   $local_file   String, containing the path to the file to save the curl result in to.
*/
function download_file($remote_file, $local_file)
{
	/*
	//const vars
	$YT_BASE_URL = "http://www.youtube.com/";
	$CURL_UA = "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:11.0) Gecko Firefox/11.0";

	$ch = curl_init($remote_file);
	curl_setopt($ch, CURLOPT_USERAGENT, $CURL_UA);
	curl_setopt($ch, CURLOPT_REFERER, $YT_BASE_URL);
	$fp = fopen($local_file, 'w');
	curl_setopt($ch, CURLOPT_FILE, $fp);
	curl_exec ($ch);
	curl_close ($ch);
	fclose($fp);
	*/

	/*
	$rh = fopen($file_source, 'rb');
    $wh = fopen($file_target, 'w+b');
    if (!$rh || !$wh) {
        return false;
    }

    while (!feof($rh)) {
        if (fwrite($wh, fread($rh, 4096)) === FALSE) {
        	echo 'heh';
            return false;
        }
        echo 'sss ';
        flush();
    }

    fclose($rh);
    fclose($wh);

    return true;
    */

	if(file_put_contents($local_file, file_get_contents($remote_file, 'r')))
	    return True;
	else
		return False;
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
		else
			$return = new Message(false, "Uknown type. Only mp3 and mp4 is allowed.", null, null);

		echo $return->toJSON();
	}
}

?>