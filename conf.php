<?php
	$server_ffmpeg_path = "ffmpeg";
	#$server_ffmpeg_path = dirname(__FILE__) . "/ffmpeg_centos6/ffmpeg";
	
	$server_captions_save_folder_name = "/captions/";
	$server_captions_save_folder_path = dirname(__FILE__) . $server_captions_save_folder_name;

	$server_video_save_folder_name = "/videos/";
	$server_video_save_folder_path = dirname(__FILE__) . $server_video_save_folder_name;

	$server_ca_cert_name = "ca-bundle.crt";
	$server_ca_cert_path = dirname(__FILE__) . "/" . $server_video_save_folder_name;
?>