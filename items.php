<?php 
    session_start();
    include 'init.php';
    $Title ='profile';
    global $item_id;
    $item = (isset($_GET['item_id'])&& is_numeric($_GET['item_id']))? $_GET['item_id']:'';
    $stmt = $conn->prepare('SELECT 
                                    items.*,
                                    categories.name AS cat_name,
                                    users.username AS mem_name 
                                FROM 
                                    items
                                inner join 
                                    categories
                                ON
                                    categories.ID = items.Cat_ID
                                INNER JOIN 
                                    users
                                ON
                                    users.UserID = items.member_ID
                                WHERE 
                                    item_iD = ?');
    $stmt->execute(array($item)); 
    $status = $stmt->fetch();
    if($stmt->rowcount() > 0){    
        echo '<h1 class="header_add text-center">'.$status['name'].'</h1>';?>
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <img class="card-img-top" src="layout/images/What-are-Action-Items.jpg" alt="Card image cap">
                </div>
                <div class="col-md-9">
                    <h2><?php echo $status['name'];?></h2>
                    <p>Des: <?php  echo $status['Description'];?></p>
                    <p>Data  :<?php  echo $status['Add_Data'];?></p>
                    <p>price : <?php echo $status['price'];?></p>
                    <p>County: <?php echo $status['country_made'];?></p>
                    <p><?php echo $status['cat_name'];?></p>
                    <p><?php echo $status['mem_name'];?></p>
                </div>
            </div>
            <hr/>
       <?php     
    }else{
        redirect("error",'error','index.php');
    }
    
?>
<div class="row">
                <div class="col-md-9 offset-3">
                    <form action="<?php echo $_SERVER['PHP_SELF'].'?item_id='.$status['item_iD']; ?>" method="post">
                        <textarea class="form-control" name="comment"  rows="3"></textarea>
                        <input class="btn btn-primary" type="submit" >
                    </form><?php
                    if($_SERVER['REQUEST_METHOD'] === 'POST'){
                        if(isset($_POST['comment'])){
                            global $conn;
                            $comment = filter_var($_POST['comment'] ,FILTER_SANITIZE_STRING);
                            $use_id  = $_SESSION['ID'];
                            $item_id = $status['item_iD'];
                            $stmt    = $conn->prepare('INSERT INTO 
                                                comment (comment_text, comment_Date, comment_Status,item_ID,`user_ID`) 
                                                VALUES (:Qcomment,now(), 0 ,:Qitem_id,:Quser)');
                            $stmt->execute(array(
                            'Qcomment'   => $comment,
                            'Qitem_id'   => $_GET['item_id'],
                            'Quser'      => $use_id));
                            $row = $stmt->rowcount();
                            if($row > 0){
                                echo '<div class="alert alert-success">'.'success add comment'.'</div>';
                            }
                            
                        }
                    }
                    ?>
                </div>
            </div>
            <hr/>
            <?php
              $stmt = $conn->prepare('SELECT 
                                            comment.*, 
                                            users.username As "user"
                                        FROM 
                                            comment 
                                        INNER JOIN 
                                            users
                                        ON 
                                            users.UserID = comment.user_ID
                                        WHERE
                                            item_ID = ?');
                $stmt->execute(array($item_id));
                $items = $stmt->fetchAll();
                    
            
            ?>
            <div class="row">
                <div class="col-md-3">
                <?php
                        foreach($items as $item){
                            echo $item['user'].'<br>';
                            
                        }

                    ?>
                </div>
                <div class="col-md-9">
                    <?php
                        foreach($items as $item){
                            echo $item['comment_text'].'<br>';
                            echo $item['comment_Date'].'<br>';
                        }

                    ?>
                </div>
            </div>
        </div>
<?php include $temp.'footer.php';?>