<?php
require( Yii::app()->basePath . DIRECTORY_SEPARATOR . 'extensions' . DIRECTORY_SEPARATOR . 'ElephantIO' . DIRECTORY_SEPARATOR . 'Client.php');

class SendNode
{
    
    private $host = 'http://localhost:8080';
    
    public function __construct()
    {
        
        if(!extension_loaded('openssl')) 
        {
            var_dump('You need the openssl PHP extension to use SMTP/IMAP TLS!');
            exit();
        }
            
    }
    
    public function init($channel, $data)
    {
        return $this->send($channel, $data);
    }
    
    private function send($channel, $data)
    {
        $elephant = new \ElephantIO\Client($this->host, 'socket.io', 1, false, true, true);
        
        $elephant->init();        
        
        $elephant->send(
                \ElephantIO\Client::TYPE_EVENT, null, null, json_encode(array('name' => $channel, 'args' => $data  ))
        );
        
        $elephant->close(); 
        
        return true; 
    }
}