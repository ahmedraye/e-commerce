<?php

    function lang($phrase){
        static $lang = array(
            //navBar words
            'Dropdown'       => 'section',
            'CP-ADMIN'       => 'Home',
            'section_nav'    =>'edit profile',
            'settings_navbar'=>'settings',
            'Logout-nav'     =>'Logout',
            'Categories-nav' =>'Categories',
            'Items-nav'      =>'Items',
            'Member-nav'     =>'Member',
            'Statistics-nav' =>'Statistics',
            'Logs-nav'       =>'Logs',
        );
        return $lang[$phrase];
    }





?>