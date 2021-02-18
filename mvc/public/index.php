<?php
namespace PHPMVC;
use PHPMVC\LIBS\FrontController;
require_once '..'.DIRECTORY_SEPARATOR.'app/config.php';
require_once '..'.DS.'app'.DS.'libs'.DS.'autoload.class.php';

$frontController = new FrontController();
$frontController->Dispatch();