<?php
/*
*************************
//this page to mange items make add|delet|other
*************
*/

    $Title ='items';
    session_start();
    if (isset($_SESSION['USERNAME'])){
        include 'init.php';
        //chech page request
        $test = isset( $_GET['do']) ? $_GET['do'] :'mangme';
        switch($test){
            case 'insert':
                 //insert data ino db
                
                 if($_SERVER['REQUEST_METHOD'] =='POST'){
                    $name     = $_POST['name'];
                    $price    = $_POST['price'];
                    $dec      = $_POST['Description'];
                    $made     = $_POST['country_made'];
                    $status   = $_POST['status'];
                    $user     = $_POST['user'];
                    $category = $_POST['category'];


                    $formError = array();
                    if(empty($name)){
                        $formError[]= '<strong>Error!</strong> name is empty';
                    }if(empty($price)){
                        $formError[]= '<strong>Error!</strong> price is empty';
                    }if(empty($dec)){
                        $formError[]='<strong>Error!</strong> Description is empty';
                    }if(empty($made)){
                        $formError[]='<strong>Error!</strong> made is empty';
                    }if(empty($status)){
                        $formError[]='<strong>Error!</strong> status is empty';
                    }if(empty($user)){
                        $formError[]='<strong>Error!</strong> user is empty';
                    }if(empty($category)){
                        $formError[]='<strong>Error!</strong> category is empty';
                    }

                    echo '<div class="container">';
                    foreach($formError as $error){
                        redirect($error,'error','back');
                    }
                    echo '</di>';
                    if(empty($formError)){
                    
                        $stmt   = $conn->prepare('INSERT INTO 
                                                items (`name`, `Description`, price, country_made,`status`, Add_Data, cat_ID, member_ID) 
                                                VALUES (:Qname,:Qdec, :Qprice, :Qmade ,:Qstatus,now(),:Qcategory,:Qmember)');
                        $stmt->execute(array(
                        'Qname'    => $name,
                        'Qdec'     => $dec,
                        'Qprice'   => $price,
                        'Qmade'    => $made,
                        'Qstatus'  => $status,
                        'Qcategory'=> $category,
                        'Qmember'  => $user));
                        $row = $stmt->rowcount();
                        if($row > 0){
                            redirect('<strong>success</strong>add item data','success','items.php');
                        }else{
                            redirect('<strong>INFO!</strong> NO Record.','warning','back');
                        }
                    }
                }
                break;
            case 'add':
                ?>
                <h1 class="text-center add-items">Add items</h1>
                <div class="container">
                    <form action="<?php echo 'items.php?do=insert'?>" method='POST'>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class='col-form-label'>name</label>
                                <input type="text" class="form-control" name='name' placeholder="name" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label class='col-form-label'>price</label>
                                <input type="text" class="form-control" name='price' placeholder="price" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class='col-form-label'>Description</label>
                                <input type="text" class='form-control' name='Description' placeholder="Description" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label class='col-form-label '>Country made</label>
                                <input type="text" class='form-control valid' name='country_made' placeholder="country made" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label class='col-form-label'>Status</label>
                                <select class="custom-select valid" name="status" >
                                    <option value="1">New</option>
                                    <option value="2">Like new</option>
                                    <option value="3">old</option>
                                    <option value="4">used</option>
                                </select>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <label class='col-form-label'>user</label>
                                <select class="custom-select valid" name="user" >
                                    <?php
                                         $getStmt = $conn->prepare("SELECT * FROM users");
                                         $getStmt->execute();
                                         $users = $getStmt->fetchAll();
                                         foreach($users As $user){
                                            echo '<option value='.$user['UserID'].'>';
                                                echo $user['username'];
                                            echo '</option>'; 
                                         }
                                         
                                    ?>
                                </select>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <label class='col-form-label'>category</label>
                                <select class="custom-select valid" name="category" >
                                    <?php
                                         $getStmt = $conn->prepare("SELECT * FROM categories");
                                         $getStmt->execute();
                                         $users = $getStmt->fetchAll();
                                         foreach($users As $user){
                                            echo '<option value='.$user['ID'].'>';
                                                echo $user['name'];
                                            echo '</option>'; 
                                         }
                                         
                                    ?>
                                </select>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary ">Save</button>
                    </form>
                </div><?php
                break;
            case 'Delete':
                //Delet page
                echo'<h1 class="text-center header">Delete items</h1>';
                echo'<div class="container">';
                $UID = (isset($_GET['item_id']) && is_numeric($_GET['item_id'])) ? $_GET['item_id'] : 0 ;
                $stmt = $conn->prepare('SELECT * FROM items WHERE item_ID = ? LIMIT 1');
                $stmt->execute(array($UID)); //array
                $row = $stmt->rowcount();
                if($row > 0){
                    $stmt = $conn->prepare('DELETE FROM items WHERE item_ID =:zid');
                    $stmt->bindParam(':zid',$UID);
                    $stmt->execute(); //array
                    
                    redirect('<strong>Successfull</strong> Delete item.','success','items.php');
                }else{
                    redirect('Error!','error','back');
                }
                echo '</div>';
                
                break;
            case 'approve':
                echo'  <h1 class="text-center ">active item</h1>';
                echo'<div class="container">';
                $UID = (isset($_GET['item_id']) && is_numeric($_GET['item_id'])) ? $_GET['item_id'] : 0 ;
                $stmt = $conn->prepare('SELECT * FROM items WHERE item_id = ? LIMIT 1');
                $stmt->execute(array($UID)); //array
                $row =$stmt->rowcount();
                if($row > 0){
                    $stmt = $conn->prepare('UPDATE items SET approve_items = 1 WHERE item_ID=?');
                    $stmt->execute(array($UID)); //array
                    
                    redirect('<strong>Successfull</strong> activition item.','success','items.php');
                }else{
                    redirect('Error!','error','items.php');
                }
                echo '</div>';
                break;
            case 'update':
                $name     = $_POST['name'];
                $price    = $_POST['price'];
                $dec      = $_POST['Description'];
                $made     = $_POST['country_made'];
                $status   = $_POST['status'];
                $user     = $_POST['user'];
                $category = $_POST['category'];
                $ID       = $_POST['itemid'];

                $formError = array();
                if(empty($name)){
                    $formError[]= '<strong>Error!</strong> name is empty';
                }if(empty($price)){
                    $formError[]= '<strong>Error!</strong> price is empty';
                }if(empty($dec)){
                    $formError[]='<strong>Error!</strong> Description is empty';
                }if(empty($made)){
                    $formError[]='<strong>Error!</strong> made is empty';
                }if(empty($status)){
                    $formError[]='<strong>Error!</strong> status is empty';
                }if(empty($user)){
                    $formError[]='<strong>Error!</strong> user is empty';
                }if(empty($category)){
                    $formError[]='<strong>Error!</strong> category is empty';
                }

                echo '<div class="container">';
                foreach($formError as $error){
                    redirect($error,'error','back');
                }
                echo '</di>';
                if(empty($formError)){
                    $stmt   = $conn->prepare('UPDATE
                                                items
                                                SET 
                                                name = ?,
                                                price = ?,
                                                Description = ?,
                                                country_made = ?,
                                                status = ?,
                                                cat_ID =?,
                                                member_ID=?
                                                WHERE item_iD =?');
                    $stmt->execute(array($name,$price, $dec, $made,$status,$category,$user, $ID));
                    $row = $stmt->rowcount();
                    if($row > 0){
                    redirect('<strong>Successfull</strong> Save data.','success','items.php');
                    }else{
                        redirect('<strong>error!</strong> NO Record.','error');
                    }
                }
                
                break;
            case 'Edit':
                $IID = (isset($_GET['item_id'])&&is_numeric($_GET['item_id'])) ? $_GET['item_id'] : 0 ;
                $stmt = $conn->prepare('SELECT * FROM items WHERE item_iD = ? ');
                $stmt->execute(array($IID)); //array
                $items = $stmt->fetch();
                    if($items > 0){?>
                    <h1 class="text-center add-items">Edit items</h1>
                    <div class="container">
                        <form action="<?php echo 'items.php?do=update'?>" method='POST'>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class='col-form-label'>name</label>
                                    <input type="hidden" name='itemid' value=<?php echo $IID; ?>>
                                    <input type="text" class="form-control valid" name='name' placeholder="name" <?php echo 'value='.$items['name'];?> >
                                </div>
                                <div class="form-group col-md-6">
                                    <label class='col-form-label'>price</label>
                                    <input type="text" class="form-control valid" name='price' placeholder="price" <?php echo 'value='.$items['price'];?> >
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class='col-form-label valid'>Description</label>
                                    <input type="text" class='form-control' name='Description' placeholder="Description" <?php echo 'value='.$items['Description'];?> >
                                </div>
                                <div class="form-group col-md-6">
                                    <label class='col-form-label '>Country made</label>
                                    <input type="text" class='form-control valid' name='country_made' placeholder="country made" <?php echo 'value='.$items['country_made'];?> >
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label class='col-form-label'>Status</label>
                                    <select class="custom-select valid" name="status" >
                                        <option value="1"<?php if($items['status']==1){echo 'selected';}?>>New</option>
                                        <option value="2" <?php if($items['status']==2){echo 'selected';}?>>Like new</option>
                                        <option value="3" <?php if($items['status']==3){echo 'selected';}?>>old</option>
                                        <option value="4" <?php if($items['status']==4){echo 'selected';}?>>used</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class='col-form-label'>user</label>
                                    <select class="custom-select valid" name="user" >
                                        <?php
                                            $getStmt = $conn->prepare("SELECT * FROM users");
                                            $getStmt->execute();
                                            $users = $getStmt->fetchAll();
                                            foreach($users As $user){
                                                echo '<option value="'.$user['UserID'].'"';
                                                if($items['member_ID'] == $user['UserID'])
                                                {
                                                    echo 'selected';
                                                }echo '>';  
                                                
                                                    echo $user['username'];
                                                echo '</option>'; 
                                            }
                                            
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class='col-form-label'>category</label>
                                    <select class="custom-select valid" name="category" >
                                        <?php
                                            $getStmt = $conn->prepare("SELECT * FROM categories");
                                            $getStmt->execute();
                                            $cats = $getStmt->fetchAll();
                                            foreach($cats As $cat){
                                                echo '<option value="'.$cat['ID'].'"';
                                                if($items['cat_ID'] == $cat['ID'])
                                                {
                                                    echo 'selected';
                                                }echo '>';
                                                    echo $cat['name'];
                                                echo '</option>'; 
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary ">Save</button>
                        </form>
                    </div>
                <?php
                $stmt = $conn->prepare('SELECT 
                                            comment.*, 
                                            users.username As "user"
                                        FROM comment 
                                        INNER JOIN users
                                            ON 
                                                users.UserID = comment.user_ID
                                            where comment.item_ID=?');
                $stmt->execute(array($IID));
                $res = $stmt->fetchAll();
                ?>
                <div class="container">
                <table class="table table-hover table-light text-center">
                    <thead>
                        <tr>
                            <th scope="col">comment</th>
                            <th scope="col">comment Date</th>
                            <th scope="col">User</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        
                            foreach($res as $item){
                                echo '<tr>';
                                echo '<td>'.$item['comment_text'].'</td>';
                                echo '<td>'.$item['comment_Date'].'</td>';
                                echo '<td>'.$item['user'].'</td>';
                                echo '<td>'.'<a href="comment.php?do=Edit&comm_id='.$item['C_ID'].'" >'.'<i class="fa fa-edit"></i>'.'</a>'.
                                '<a href="comment.php?do=Delete&comm_id='.$item['C_ID'].'" >'.
                                '<i class="far fa-trash-alt Confirm"></i>'.'</a>';
                                if($item['comment_Status'] == 0){
                                    echo '<a href="comment.php?do=approve&comm_id='.$item['C_ID'].'" >'.'<i class="fa fa-check"></i>'.'</a>';
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
                
                }else{
                    redirect('this is not found','error','back');     
                }
                break;
            default:
                $stmt = $conn->prepare('SELECT 
                                            items.*,
                                            users.username As "user",
                                            categories.name As "cat_Name"
                                        FROM items 
                                        INNER JOIN users
                                            ON users.UserID = items.member_ID 
                                        INNER JOIN categories 
                                            ON categories.ID = items.cat_ID');
                $stmt->execute();
                $items = $stmt->fetchAll();?>
                <h1 class='text-center header_add'>mange Items</h1>
                <div class="container">
                    <table class="table table-hover table-light text-center">
                    <thead>
                    <tr>
                        <th scope="col">#ID</th>
                        <th scope="col">name</th>
                        <th scope="col">Description</th>
                        <th scope="col">price</th>
                        <th scope="col">AddData</th>
                        <th scope="col">Category</th>
                        <th scope="col">User</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($items as $item){
                                echo '<tr>';
                                echo '<td>'.$item['item_iD'].'</td>';
                                echo '<td>'.$item['name'].'</td>';
                                echo '<td>'.$item['Description'].'</td>';
                                echo '<td>'.$item['price'].'</td>';
                                echo '<td>'.$item['Add_Data'].'</td>';
                                echo '<td>'.$item['cat_Name'].'</td>';
                                echo '<td>'.$item['user'].'</td>';
                                echo '<td>'.'<a href="?do=Edit&item_id='.$item['item_iD'].'" >'.'<i class="fa fa-edit"></i>'.'</a>'.
                                '<a href="?do=Delete&item_id='.$item['item_iD'].'" >'.
                                '<i class="far fa-trash-alt Confirm"></i>'.'</a>';
                                if($item['approve_items'] == 0){
                                    echo '<a href="?do=approve&item_id='.$item['item_iD'].'" >'.'<i class="fa fa-check"></i>'.'</a>';
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
                <a href="?do=add" class="btn btn-dark"><i class="fa fa-plus"></i> Add memmber</a>
            </div><?php
            break;
        }

        include $temp.'footer.php';
    }else{
        header('location: index.php');
        exit();
    }