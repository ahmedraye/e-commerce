<?php
    session_start();//Start session

    session_unset();
    session_destroy();//delet session

    header('location: login.php?action=login');
    exit();





?>