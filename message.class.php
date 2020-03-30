<?php

class Message {
	public $isOk;
	public $message;
	public $downloadUrl = null;
	public $fileName = null;

    public static function get_error_message($message)
    {
        $m = new Message();

        $m->isOk = false;
        $m->message = $message;

        return $m;
    }

    public static function get_info_message($message)
    {
        $m = new Message();

        $m->isOk = true;
        $m->message = $message;

        return $m;
    }

    public static function get_download_message($message, $downloadUrl, $fileName)
    {
        $m = new Message();

        $m->isOk = true;
        $m->message = $message;
        $m->downloadUrl = $downloadUrl;
        $m->fileName = $fileName;

        return $m;
    }

	public function __construct()
	{
    }

    public function toJSON()
    {
        return json_encode(get_object_vars($this));
    }
}