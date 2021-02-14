<?php
/*
*************************
//this page to mange mamber make add|delet|other
*************
*/

    $Title ='members mangment';
    session_start();
    if (isset($_SESSION['USERNAME'])){
        include 'init.php';
        //chech page request
        $test = isset( $_GET['do']) ? $_GET['do'] :'mangment';
        switch($test){
            case 'insert':
                # code...
                break;
            case 'add':
                # code...
                break;
            case 'Delete':
                # code...
                break;
            case 'edit':
                # code...
                break;
            default 'mange':
                # code...
                break;
        }

        include $temp.'footer.php';
    }else{
        header('location: index.php');
        exit();
    }