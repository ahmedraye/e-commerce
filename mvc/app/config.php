<?php
define('DS', DIRECTORY_SEPARATOR);
define ('APP_PATH' , realpath(dirname(__FILE__)));

//////////////////////////////////////
// Valores de uri
/////////////////////////////////////

define('URI', $_SERVER['REQUEST_URI']);

define('REQUEST_METHOD', $_SERVER['REQUEST_METHOD']);

//////////////////////////////////////
// Valores de rutas
/////////////////////////////////////


define('ROOT', $_SERVER['DOCUMENT_ROOT']);

define('PATH_VIEWS', 'app/views/');

define('PATH_CONTROLLERS', 'app/controllers/');


//////////////////////////////////////
// Valores de base de datos
/////////////////////////////////////

define('HOST', 'localhost');
define('USER', 'root');
define('PASSWORD', '');
define('DB_NAME', 'curso_mvc');
