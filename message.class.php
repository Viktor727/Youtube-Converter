<?php

class Message {
	public $isOk;
	public $message;
	public $downloadUrl;
	public $fileName;

	public function __construct($isOk, $message, $downloadUrl, $fileName)
	{
        $this->isOk = $isOk;
        $this->message = $message;
        $this->downloadUrl = $downloadUrl;
        $this->fileName = $fileName;
    }

    public function toJSON()
    {
        return json_encode(get_object_vars($this));
    }
}