<?php

class Message {
	public $isOk;
	public $message;
	public $downloadUrl = null;
	public $fileName = null;
    public $isAuthRequired = False;
    public $isAuthorized = False;
    public $AuthUrl = "";

    public static function get_error_message($message)
    {
        $m = new Message();

        $m->isOk = false;
        $m->message = $message;

        return $m;
    }

    public static function get_auth_error_message($message, $isAuthRequired, $isAuthorized, $AuthUrl)
    {
        $m = new Message();

        $m->isOk = false;
        $m->message = $message;
        $m->isAuthRequired = $isAuthRequired;
        $m->isAuthorized = $isAuthorized;
        $m->AuthUrl = $AuthUrl;

        return $m;
    }

    public static function get_info_message($message)
    {
        $m = new Message();

        $this->isOk = true;
        $this->message = $message;

        return $m;
    }

    public static function get_download_message($message, $downloadUrl, $fileName)
    {
        $m = new Message();

        $this->isOk = true;
        $this->message = $message;
        $this->downloadUrl = $downloadUrl;
        $this->fileName = $fileName;

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