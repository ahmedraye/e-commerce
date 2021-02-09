<?php
/*
*************************
//this page to mange categories make add|delet|other
*************
*/

    $Title ='categories mangment';
    session_start();
    if (isset($_SESSION['USERNAME'])){
        include 'init.php';
        //check page request
        $test = isset( $_GET['do']) ? $_GET['do'] :'mangment';
        switch($test){
            case 'Update':
                
                if($_SERVER['REQUEST_METHOD'] =='POST'){
                    $name    = $_POST['name'];
                    $ID      = $_POST['catid'];
                    $dec     = $_POST['Description'];
                    $order   = $_POST['Ordering'];
                    $Visible = $_POST['Visibility'];
                    $comment = $_POST['Allow_comment'];
                    $ads     = $_POST['Allow_ads'];
                    echo '<div class="container">';
                    /// update Data
                    $stmt   = $conn->prepare('UPDATE categories 
                                              SET 
                                                    name=?, 
                                                    Description=?, 
                                                    Ordering=?,
                                                    Visibility=?,
                                                    Allow_comment=?,
                                                    Allow_ads=?
                                              WHERE ID=?');
                    $stmt->execute(array($name,$dec, $order, $Visible, $comment,$ads,$ID));
                    $row = $stmt->rowcount();
                    if($row > 0){
                        redirect('<strong>Successfull</strong> Save data.','success','back  ');
                    }else{
                        redirect('<strong>error!</strong> NO Record.','error');
                    }
                    echo '</di>';
                }
                break;
            case 'insert':
                //insert data ino db
                
                if($_SERVER['REQUEST_METHOD'] =='POST'){
                    $name    = isset($_POST['name'])         ? $_POST['name']          : '';
                    $dec     = isset($_POST['Description'])  ? $_POST['Description']   : '';
                    $order   = isset($_POST['Ordering'])     ? $_POST['Ordering']      : 0;
                    $Visib   = isset($_POST['Visibility'])   ? $_POST['Visibility']    : 0;
                    $comment = isset($_POST['Allow_comment'])? $_POST['Allow_comment'] : 0;
                    $ads     = isset($_POST['Allow_ads'])    ? $_POST['Allow_ads']     : 0;

                    if(!empty($name)){
                        if(checkItem('name','categories', $name) == 1){
                            redirect('<strong>warning!</strong> categorey is Found.','warning','back');
                        }else{
                            $stmt   = $conn->prepare('INSERT INTO 
                                                    categories (name, Description, Ordering, Visibility,Allow_comment,Allow_ads) 
                                                    VALUES (:Qname,:Qdec, :Qorder, :Qvisible ,:Qcomm,:Qads)');
                            $stmt->execute(array(
                            'Qname'=> $name,
                            'Qdec' => $dec,
                            'Qorder'=> $order,
                            'Qvisible'=> $Visib,
                            'Qcomm'=> $comment,
                            'Qads'=> $ads));
                            $row = $stmt->rowcount();
                            if($row > 0){
                                redirect('<strong>success </strong> add categories data','success','back');
                            }else{
                                redirect('<strong>INFO!</strong> NO Record.','warning','back');
                            }
                        }
                    }else{
                        redirect('<strong>warning!</strong> categroy is empty.','warning','back');
                    }
                }
                break;
            case 'add':?>
                <h1 class="text-center add-member">Add categories</h1>
                <div class="container">
                    <form action="<?php echo 'categories.php?do=insert'?>" method='POST'>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class='col-form-label'>name</label>
                                <input type="text" class="form-control" name='name' placeholder="name of categories" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4" class=" col-form-label">Description</label>
                                <input type="text" name="Description" class="form-control" placeholder="Description">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class='col-form-label'>Ordering</label>
                                <input type="number" class='form-control' name='Ordering' placeholder="order of category" >
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-8">
                                <div class="form-group">
                                        <label class='col-form-label'>Visibility</label>
                                        <label for ="visb-yes" class='col-form-label'>yes</label>
                                        <input type="radio" name="Visibility" id="visb-yes" value='1'>
                                        <label for ="visb-no" class='col-form-label'>no</label>
                                        <input type="radio" name="Visibility" id="visb-no" value='0'>
                                </div>
                                <div class="form-group ">
                                        <label class='col-form-label'>allow_comment</label>
                                        <label for ="comm-yes" class='col-form-label'>yes</label>
                                        <input type="radio" name="Allow_comment" id="comm-yes" value='1'>
                                        <label for ="comm-no" class='col-form-label'>no</label>
                                        <input type="radio" name="Allow_comment" id="comm-no" value='0'>
                                </div>
                                <div class="form-group">
                                        <label class='col-form-label'>Allow_ads</label>
                                        <label for ="ads-yes" class='col-form-label'>yes</label>
                                        <input type="radio" name="Allow_ads" id="ads-yes" value='1'>
                                        <label for ="ads-no" class='col-form-label'>no</label>
                                        <input type="radio" name="Allow_ads" id="ads-no" value='0'>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary ">Save</button>
                    </form>
                </div><?php
                break;
            case 'Delete':
                //Delet page
                echo'<h1 class="text-center add-member">Delete category</h1>';
                echo'<div class="container">';
                $CID  = (isset($_GET['catid']) && is_numeric($_GET['catid'])) ? $_GET['catid'] : 0 ;
                $stmt = $conn->prepare('SELECT * FROM categories WHERE ID = ? LIMIT 1');
                $stmt->execute(array($CID)); //array
                $row  = $stmt->rowcount();
                if($row > 0){
                    $stmt = $conn->prepare('DELETE FROM categories WHERE ID =:zuser');
                    $stmt->bindParam(':zuser',$CID);
                    $stmt->execute(); //array
                    
                    redirect('<strong>Successfull</strong> Delete category.','success','back');
                }else{
                    redirect('Error!','error','back');
                }
                echo '</div>';
                break;
            case 'edit':
                $CID = (isset($_GET['catid']) && is_numeric($_GET['catid'])) ? $_GET['catid'] : 0 ;
                $stmt = $conn->prepare('SELECT * FROM categories WHERE ID = ?');
                $stmt->execute(array($CID)); //array
                $Cat = $stmt->fetch();
                if($Cat > 0){?>
                        <h1 class="text-center add-member">edit categories</h1>
                    <div class="container">
                        <form action="<?php echo 'categories.php?do=Update'?>" method='POST'>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class='col-form-label'>name</label>
                                    <input type="hidden" name='catid' value=<?php echo $CID; ?>>
                                    <input type="text" class="form-control" name='name' placeholder="name of categories"<?php echo 'value='.$Cat['name'];?> required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class=" col-form-label">Description</label>
                                    <input type="text" name="Description" class="form-control" placeholder="Description" <?php echo 'value='.$Cat['Description'];?>>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class='col-form-label'>Ordering</label>
                                    <input type="number" class='form-control' name='Ordering' placeholder="order of category" <?php echo 'value='.$Cat['Ordering'];?>>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-8">
                                    <div class="form-group">
                                            <label class='col-form-label'>Visibility</label>
                                            <label for ="visb-yes" class='col-form-label'>yes</label>
                                            <input type="radio" name="Visibility" id="visb-yes" value='1' <?php if($Cat['Visibility']== 1){echo 'checked';}?>>
                                            <label for ="visb-no" class='col-form-label'>no</label>
                                            <input type="radio" name="Visibility" id="visb-no" value='0'    <?php if($Cat['Visibility']== 0){echo 'checked';}?>>
                                    </div>
                                    <div class="form-group ">
                                            <label class='col-form-label'>allow_comment</label>
                                            <label for ="comm-yes" class='col-form-label'>yes</label>
                                            <input type="radio" name="Allow_comment" id="comm-yes" value='1' <?php if($Cat['Allow_comment']== 1){echo 'checked';}?>>
                                            <label for ="comm-no" class='col-form-label'>no</label>
                                            <input type="radio" name="Allow_comment" id="comm-no" value='0' <?php if($Cat['Allow_comment']== 0){echo 'checked';}?>>
                                    </div>
                                    <div class="form-group">
                                            <label class='col-form-label'>Allow_ads</label>
                                            <label for ="ads-yes" class='col-form-label'>yes</label>
                                            <input type="radio" name="Allow_ads" id="ads-yes" value='1' <?php if($Cat['Allow_ads']== 1){echo 'checked';}?>>
                                            <label for ="ads-no" class='col-form-label'>no</label>
                                            <input type="radio" name="Allow_ads" id="ads-no" value='0' <?php if($Cat['Allow_ads']== 0){echo 'checked';}?>>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary ">Save</button>
                        </form>
                    </div><?php
                }else{
                    redirect('this is not found','error','back');
                }
                break;
            default:
                $list_Sort = array('DESC','ASC');
                $sort = (isset($_GET['sort']) && in_array($_GET['sort'], $list_Sort)) ? $_GET['sort'] : 'ASC';
                $stmmt = $conn->prepare("SELECT * FROM categories order by Ordering $sort");
                $stmmt->execute();
                $row = $stmmt->fetchAll();
                ?>
                <h1 class='text-center category'>mange Categories</h1>
                <div class="container">   <?php
                  /*  <div class="card-deck">
                     
                            foreach($row as $ro){
                              echo '<div class="card border-dark mb-3">';
                                    echo '<div class="card-header">'.$ro['name'].'</div>';
                                    echo '<div class="card-body text-dark">';
                                        echo '<p class="card-text">';
                                                echo $ro['Description'];
                                        echo '</p>';
                                        if($ro['Visibility'] == 1){
                                         echo   '<span class="badge badge-info"> Is visibile</span>';
                                        }
                                        if($ro['Allow_comment'] == 1){
                                            echo   '<span class="badge badge-danger"> Is comment</span>';
                                        }
                                        if($ro['Allow_ads'] == 1){
                                            echo   '<span class="badge badge-dark">Dark</span>';
                                        }
                                    echo '</div>';
                              echo '</div>';
                            }
                        
                    </div>*/?>
                    <div class="card text-white bg-dark  mb-3">
                        <div class="card-header">
                            <h4>Categories</h4>
                            <div class="ordering float-right">
                                <h5>Order By</h5>
                                <a class='<?php if($sort == 'ASC') {echo 'active';}?>'  href="?sort=ASC">ASC</a> |
                                <a class='<?php if($sort == 'DESC'){echo 'active';}?>' href="?sort=DESC">DESC</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php
                                foreach($row as $ro){
                                    echo '<div class="Totalcard">';
                                        echo '<h5 class="card-title">'.$ro['name'].'</h5>';
                                        echo '<p class="card-text">';
                                            echo $ro['Description'];
                                        echo '</p>';
                                        if($ro['Visibility'] == 1){
                                            echo   '<span class="badge badge-info"> Is visibile</span>';
                                        }
                                        if($ro['Allow_comment'] == 1){
                                            echo   '<span class="badge badge-danger"> Is comment</span>';
                                        }
                                        if($ro['Allow_ads'] == 1){
                                            echo   '<span class="badge badge-success">Allow ads</span>';
                                        }
                                        echo '<hr/>';
                                        echo '<div class="icon">';
                                            echo '<a href="categories.php?do=edit&catid='.$ro['ID'].'" >'.'<i class="fa fa-edit"></i>'.'</a>';
                                            echo '<a href="categories.php?do=Delete&catid='.$ro['ID'].'" >'.'<i class="far fa-trash-alt Confirm"></i>'.'</a>';
                                        echo '</div>';
                                        echo '</div>';
                                }
                            ?>
                        </div>
                    </div>
                    <a href="?do=add" class="btn btn-dark"><i class="fa fa-plus"></i> Add category</a>
                </div>
                <?php
                break;
        }

        include $temp.'footer.php';
    }else{
        header('location: index.php');
        exit();
    }