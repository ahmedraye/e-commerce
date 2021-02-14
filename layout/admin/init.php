<?php
    include 'connect.php';
    //Rote
    $temp ="includes/templates/";
    $func ="includes/function/";
    $css  ="layout/css/";
    $js   ="layout/js/";
    $lang ='includes/language/';
    
    //include important file
    include $lang . 'english.php';
    include $func . 'function.php';
    require $temp . 'header.php';
    if(!isset($NoNavBar)){include $temp.'NavBar.php';} //To include navbar only not found $navbar
    
  
?>