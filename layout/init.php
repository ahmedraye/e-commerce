<?php

    ini_set('display_error','on');
    error_reporting(E_ALL);
    include 'admin/connect.php';
    //Rote
    $temp ="includes/templates/";
    $func ="includes/function/";
    $css  ="layout/css/";
    $js   ="layout/js/";
    $lang ='includes/language/';
    
    //include important file
    include $lang . 'english.php';
    include $func . 'function.php';
    include $temp . 'header.php';

    
  
?>