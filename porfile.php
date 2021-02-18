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
            <div class="card-header">info</div>
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
            <div class="card-header">ADS</div>
            <div class="card-body"><?php
                $getitems = $conn->prepare("SELECT * FROM items WHERE member_ID= ?");
                $getitems->execute(array($status['UserID']));
                $items = $getitems->fetchAll();
                foreach($items as $item){
                        ?>
                            
                            <p class="card-text"><?php echo $item['name'];?></p>
                        <?php
                }
            
            ?></div>
        </div>
    </div>
</div>
<div class="comment block">
    <div class="container">
        <div class="card text-white bg-info">
        <div class="card-header">comment</div>
            <div class="card-body"><?php
                $getitems = $conn->prepare("SELECT * FROM comment WHERE user_ID= ?");
                $getitems->execute(array($status['UserID']));
                $comments = $getitems->fetchAll();
                foreach($comments as $comment){
                        ?>
                            <p class="card-text"><?php echo $comment['comment_text'];?></p>
                        <?php
                }
            
            ?></div>
        </div>
    </div>
</div>



<?php 
    }else{
        header("location:login.php?action=login");
    }
include $temp.'footer.php';?>