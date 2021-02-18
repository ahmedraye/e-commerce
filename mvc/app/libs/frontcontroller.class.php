<?php
 namespace PHPMVC\LIBS;
 
 class FrontController{
    private $_controller = 'index';
    private $_action     = 'default';
    private $_params      = array();

    private function _parseUrl(){
        $url = explode('/',trim(parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH),'/'),3);
        if(isset($url[0]) && $url[0] != ''){
            $this->_controller = $url[0];
        }
        if(isset($url[1]) && $url[1] != ''){
            $this->_action = $url[1];
        }
        if(isset($url[2]) && $url[2] != ''){
            $this->_params = explode('/',$url[2]);
        }

        echo "<pre>";
        var_dump($this);
        echo "</pre>";
    }
    public function Dispatch(){
        $this->_parseUrl();
    }
    
 }