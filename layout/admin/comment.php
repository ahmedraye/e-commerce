<?php
/*
*************************
//this page to mange comment make add|delet|other
*************
*/

    $Title ='members mangment';
    session_start();
    if (isset($_SESSION['USERNAME'])){
        include 'init.php';
        //chech page request
        $test = isset( $_GET['do']) ? $_GET['do'] :'mange';
        switch($test){
            case 'insert':
                # code...
                break;
            case 'approve':
                echo'  <h1 class="text-center ">active comment</h1>';
                echo'<div class="container">';
                $CID = (isset($_GET['comm_id']) && is_numeric($_GET['comm_id'])) ? $_GET['comm_id'] : 0 ;
                $stmt = $conn->prepare('SELECT * FROM comment WHERE C_ID = ? LIMIT 1');
                $stmt->execute(array($CID)); //array
                $row =$stmt->rowcount();
                if($row > 0){
                    $stmt = $conn->prepare('UPDATE comment SET comment_Status = 1 WHERE C_ID=?');
                    $stmt->execute(array($CID)); //array
                    
                    redirect('<strong>Successfull</strong> activition comment.','success','back');
                }else{
                    redirect('Error!','error','comment.php');
                }
                echo '</div>';
                break;
            case 'Delete':
                //Delet page
                echo'  <h1 class="text-center">Delete comment</h1>';
                echo'<div class="container">';
                $CID = (isset($_GET['comm_id'])&&is_numeric($_GET['comm_id'])) ? $_GET['comm_id'] : 0 ;
                $stmt = $conn->prepare('SELECT * FROM comment WHERE C_ID = ? LIMIT 1');
                $stmt->execute(array($CID)); //array
                $row =$stmt->rowcount();
                if($row > 0){
                    $stmt = $conn->prepare('DELETE FROM comment WHERE C_ID =:zcom');
                    $stmt->bindParam(':zcom',$CID);
                    $stmt->execute(); //array
                    
                    redirect('<strong>Successfull</strong> Delete comment.','success','comment.php');
                }else{
                    redirect('Error!','error','comment.php');
                }
                echo '</div>';
                break;
            case 'Update':
                if($_SERVER['REQUEST_METHOD'] =='POST'){
                    $comment   = $_POST['comment'];
                    $ID     = $_POST['comm_id'];
                   
                    $stmt   = $conn->prepare('UPDATE comment SET comment_text=? WHERE C_ID=?');
                    $stmt->execute(array($comment, $ID));
                    $row = $stmt->rowcount();
                    if($row > 0){
                    redirect('<strong>Successfull</strong> Save data.','success','comment.php');
                    }else{
                        redirect('<strong>error!</strong> NO Record.','error');
                    }
                }
                break;
            case 'Edit':
                $CID = (isset($_GET['comm_id'])&&is_numeric($_GET['comm_id'])) ? $_GET['comm_id'] : 0 ;
                $stmt = $conn->prepare('SELECT * FROM comment WHERE C_ID = ? LIMIT 1');
                $stmt->execute(array($CID)); //array
                $row = $stmt->fetch();
                if($row > 0){?>
                <h1 class="text-center header_add">Edit comment</h1>
                <div class="container">
                    <form action="<?php echo 'comment.php?do=Update'?>" method='POST'>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class='col-form-label'>comment</label>
                                <input type="hidden" name='comm_id' value=<?php echo $CID; ?>>
                                <textarea class="form-control" name="comment">
                                    <?php echo $row['comment_text'];?>
                                </textarea>

                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary ">Save</button>
                    </form>
                </div>
                <?php
                }else{
                   redirect('this is not found','error','back');
                }
                break;
            default:
                $stmt = $conn->prepare('SELECT 
                                            comment.*, 
                                            users.username As "user",
                                            items.name As "item_name"
                                        FROM comment 
                                        INNER JOIN users
                                            ON 
                                                users.UserID = comment.user_ID 
                                        INNER JOIN items 
                                            ON 
                                                items.item_iD = comment.item_ID');
                $stmt->execute();
                $items = $stmt->fetchAll();
                ?>
                <h1 class='text-center header_add'>mange comment</h1>
                <div class="container">
                    <table class="table table-hover table-light text-center">
                        <thead>
                            <tr>
                                <th scope="col">#ID</th>
                                <th scope="col">comment</th>
                                <th scope="col">comment Date</th>
                                <th scope="col">comment_Status</th>
                                <th scope="col">item</th>
                                <th scope="col">User</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            
                                foreach($items as $item){
                                    echo '<tr>';
                                    echo '<td>'.$item['C_ID'].'</td>';
                                    echo '<td>'.$item['comment_text'].'</td>';
                                    echo '<td>'.$item['comment_Date'].'</td>';
                                    echo '<td>'.$item['item_name'].'</td>';
                                    echo '<td>'.$item['user'].'</td>';
                                    echo '<td>'.'<a href="?do=Edit&comm_id='.$item['C_ID'].'" >'.'<i class="fa fa-edit"></i>'.'</a>'.
                                    '<a href="?do=Delete&comm_id='.$item['C_ID'].'" >'.
                                    '<i class="far fa-trash-alt Confirm"></i>'.'</a>';
                                    if($item['comment_Status'] == 0){
                                        echo '<a href="?do=approve&comm_id='.$item['C_ID'].'" >'.'<i class="fa fa-check"></i>'.'</a>';
                                    }else{
                                        echo '<a class="info-activation">'.
                                        '<i class="fas fa-info-circle"></i>'.
                                        '</a>';
                                    }
                                    echo '</td>';
                                    echo '</tr>';
                                }
                            ?>
                        </tbody>
                    </table>
            </div>
            <?php
            break;
        }
        include $temp.'footer.php';
    }else{
        header('location: index.php');
        exit();
    }