<?php
error_reporting(E_ERROR | E_PARSE);

include_once 'message.class.php'; 
include_once 'youtube_converter.class.php'; 
include_once 'google_client_helper.php';

require_once('conf.php');
require_once __DIR__ . '/vendor/autoload.php';

use YoutubeDl\YoutubeDl;
use YoutubeDl\Exception\CopyrightException;
use YoutubeDl\Exception\NotFoundException;
use YoutubeDl\Exception\PrivateVideoException;

session_start();

function is_ajax() {
  	return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

function GetYoutubeVideoByURL($youtubeURL) {
	/*
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
	} else
    	return Message::get_error_message("Please provide valid YouTube URL.");
	*/


	if(!empty($youtubeURL) && !filter_var($youtubeURL, FILTER_VALIDATE_URL) === false)
	{ 
    	$dl = new YoutubeDl([
		    'continue' => false, // force resume of partially downloaded files. By default, youtube-dl will resume downloads if possible.
		    'format' => 'bestvideo+bestaudio',
		]);
		// For more options go to https://github.com/rg3/youtube-dl#user-content-options

		$dl->setDownloadPath('/var/www/html/videos');
		// Enable debugging
		/*$dl->debug(function ($type, $buffer) {
		    if (\Symfony\Component\Process\Process::ERR === $type) {
		        echo 'ERR > ' . $buffer;
		    } else {
		        echo 'OUT > ' . $buffer;
		    }
		});*/
		try {
		    $video = $dl->download($youtubeURL);
		    //echo $video->getTitle(); // Will return Phonebloks
		    //$video->getFile(); // \SplFileInfo instance of downloaded file
		    
		    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
		    $link = $actual_link . "/videos/". $video->getFilename();
		    chmod("/var/www/html/videos/".$video->getFilename(), 777);
    		
    		return Message::get_download_message("Video is downloading. You will be redirected to the download page.", $link , $video->getFilename());
		} catch (NotFoundException $e) {
		    return Message::get_error_message("Video not found");
		} catch (PrivateVideoException $e) {
		    return Message::get_error_message("Video is private");
		} catch (CopyrightException $e) {
		    return Message::get_error_message("The YouTube account associated with this video has been terminated due to multiple third-party notifications of copyright infringement");
		} catch (Exception $e) {
		    return Message::get_error_message("Failed to download");
		}
    	return Message::get_error_message("Something goes wrong while downloading video. Please, try again.");
	} 
	else
    	return Message::get_error_message("Please provide valid YouTube URL.");

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
		//if(file_exists($localVideoPath)) 
		//	$localVideoPath = $server_video_save_folder_path . date("YmdHms") . "_" . $videoFileName;

		$mp3filePath = substr($localVideoPath, 0, strrpos($localVideoPath, '.')) . ".mp3";

		touch($localVideoPath);
		chmod($localVideoPath, 777);

		// download mp4
		//$download = download_file($videoURL, $localVideoPath);
		//if($download === FALSE)
		//	return Message::get_error_message("Error While Saving Video On Server. Please, Try Again.");

		$logdir = dirname(__FILE__);

		// convert mp4 to mp3
        $cmd = "$server_ffmpeg_path -i \"$localVideoPath\" -vn -ar 44100 -ab 320k -y \"$mp3filePath\"";
        exec($cmd);
        chmod($mp3filePath, 777);

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
	global $server_captions_save_folder_name;
	global $server_captions_save_folder_path;

	if(empty($url) || filter_var($url, FILTER_VALIDATE_URL) === false)
		return Message::get_error_message("Please, Provide Valid URL.");

    $parsed_url = parse_url($url);
    if($parsed_url == null)
 		return Message::get_error_message("Please, Provide Valid URL.");

 	parse_str($parsed_url["query"], $queryParams);
 	if($queryParams == null || empty($queryParams))
 		return Message::get_error_message("Please, Provide Valid URL.");

    $videoId = $queryParams["v"];
    if($videoId == null || empty($videoId))
    	return Message::get_error_message("Please, Provide valid URL.");

    $foldername = $videoId;

    if(file_exists($server_captions_save_folder_path . $foldername))
    	$foldername = $videoId . "_" . date("YmdHms");
    $_i = 0;
    while(file_exists($server_captions_save_folder_path . $foldername)) {
    	$foldername = $videoId . "_" . date("YmdHms") . "_" . i;
    	$i = $i + 1;
    }

    $saveFolder_path = $server_captions_save_folder_path . $foldername;

    $zipFile_Name = $foldername . ".zip";
    $zipFile_Path = $server_captions_save_folder_path . $zipFile_Name;

    exec("mkdir \"$saveFolder_path\"");
    exec("chmod 777 \"$saveFolder_path\"");
    exec("youtube-dl -o \"$saveFolder_path/%(title)s.%(ext)s\" --all-subs --skip-download  \"$url\"");
    exec("zip -r -j \"$zipFile_Path\" \"$saveFolder_path\"");

    if(!file_exists($zipFile_Path))
    	Message::get_error_message("Something went wring while getting captions. Please, Try again.");

    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
    $zip_link = $actual_link . $server_captions_save_folder_name . $zipFile_Name;

	return Message::get_download_message("Success", $zip_link, $zipFile_Name);
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
			$return = Message::get_error_message("Uknown type. Only mp3, mp4 and srt is allowed.");

		echo $return->toJSON();
	}
}

?>