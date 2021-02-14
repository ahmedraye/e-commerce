<?php 
    session_start();
    include 'init.php';
    $Title ='profile';
    if(isset($_SESSION['USER'])){
        $stmt = $conn->prepare('SELECT 
        * 
    FROM 
        USERS
    WHERE 
        username = ?');
    $stmt->execute(array($_SESSION['USER'])); 
    $status = $stmt->fetch();
    
?>
<div class="info block">
    <div class="container">
        <div class="card text-white bg-info">
            <div class="card-header">card header</div>
            <div class="card-body"><?php
                echo '<p class="card-text">'.'name: '.$status['username']."</p>";
                echo '<p class="card-text">'.'full Name: '.$status['FullName']."</p>";
                echo '<p class="card-text">'.'Email: '.$status['Email']."</p>";
                echo '<p class="card-text">'.'Date: '.$status['Date']."</p>";
            
            
            ?></div>
        </div>
    </div>
</div>
<div class="my-ads block">
    <div class="container">
        <div class="card text-white bg-info">
            <div class="card-header">card header</div>
            <div class="card-body">tesssst</div>
        </div>
    </div>
</div>
<div class="comment block">
    <div class="container">
        <div class="card text-white bg-info">
            <div class="card-header">card header</div>
            <div class="card-body">tesssst</div>
        </div>
    </div>
</div>



<?php 
    }else{
        header("location:login.php?action=login");
    }
include $temp.'footer.php';?>