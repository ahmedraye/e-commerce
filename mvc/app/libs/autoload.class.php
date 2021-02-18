<?php

namespace PHPMVC\LIBS;
class AutoLoad{
    public static function autoload($calssName){ 
        $EditClassName = APP_PATH .strtolower(str_replace('PHPMVC','',$calssName)).'.class.php';
        if(file_exists($EditClassName)){
            require_once APP_PATH .strtolower(str_replace('PHPMVC','',$calssName)).'.class.php';
        }else{
            
        }
    }
}
spl_autoload_register(__NAMESPACE__ .'\Autoload::autoload');