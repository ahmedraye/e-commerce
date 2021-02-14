<?php
/**function ***/


//get categoires
function Getcat(){
    global $conn;
    $getcat = $conn->prepare("SELECT * FROM categories");
    $getcat->execute();
    $row = $getcat->fetchAll();
    return $row;
}
//get items
function Getitems($catID){
    global $conn;
    $getitems = $conn->prepare("SELECT * FROM items WHERE cat_ID= ? ORDER BY item_iD DESC");
    $getitems->execute(array($catID));
    $items = $getitems->fetchAll();
    return $items;
}

// check if user activetion

function getStatus($user){
    global $conn;
        $stmt = $conn->prepare('SELECT 
        username,RegStatus 
    FROM 
        USERS
    WHERE 
        username = ?');
    $stmt->execute(array($user)); 
    return $status = $stmt->rowCount();
}









//func to get title 
function getTitle(){
    global $Title;
    if(isset($Title)){
        return $Title;
    }else{
        return 'defualt';
    }
}

///redirect function 
//palce
//masg
//time
//type of msg
function redirect($msg, $type,$url='index.php',$secand = 2){
    $finalMsg ='';
    switch($type){
        case 'info':
            $finalMsg = '<div class="alert alert-info">'.$msg.'</div>';
            break;
        case 'danger':
            $finalMsg = '<div class="alert alert-danger">'.$msg.'</div>';
            break;
        case 'error':
            $finalMsg = '<div class="alert alert-danger">'.$msg.'</div>';
            break;
        case 'success':
            $finalMsg = '<div class="alert alert-success">'.$msg.'</div>';
            break;
        case 'warning':
            $finalMsg = '<div class="alert alert-warning">'.$msg.'</div>';
            break;
        default:
            $finalMsg = '<div class="alert alert-primary">'.$msg.'</div>';
    }

    if($url == 'back'){
        $url = (isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : 'index.php';
    }
    echo $finalMsg;
    header('refresh:'.$secand.';url='.$url);
}

//check item if exist

function checkItem($select ,$form, $value){
    global $conn;
    $statment = $conn->prepare("SELECT $select FROM $form WHERE $select =?");
    $statment ->execute(array($value));
    $row =$statment->rowCount();
    return $row;

}


//function to give count of item
function countItem($Itme,$table){
    global $conn;
    $stmmt = $conn->prepare("SELECT COUNT('$Itme') FROM $table");
    $stmmt->execute();
    return $stmmt->fetchcolumn();
}



//func to GetLatest
function Getlatest($select,$table,$order,$NUM){
    global $conn;
    $getStmt = $conn->prepare("SELECT $select FROM $table ORDER BY $order DESC LIMIT $NUM");
    $getStmt->execute();
    $row = $getStmt->fetchAll();
    return $row;
}