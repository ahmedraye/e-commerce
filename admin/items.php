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
                    $name   = $_POST['name'];
                    $price  = $_POST['price'];
                    $dec    = $_POST['Description'];
                    $made   = $_POST['country_made'];
                    $status = $_POST['status'];

                    $formError = array();
                    if(empty($name)){
                        $formError[]= '<strong>Error!</strong> name is empty';
                    }if(empty($dec)){
                        $formError[]= '<strong>Error!</strong> Description is empty';
                    }if(empty($made)){
                        $formError[]='<strong>Error!</strong> made is empty';
                    }
                    echo '<div class="container">';
                    foreach($formError as $error){
                        redirect($error,'error','back');
                    }
                    echo '</di>';
                    if(empty($formError)){
                    
                        $stmt   = $conn->prepare('INSERT INTO 
                                                items (`name`, `Description`, price, country_made,status,Add_Data) 
                                                VALUES (:Qname,:Qdec, :Qprice, :Qmade ,:Qstatus,now())');
                        $stmt->execute(array(
                        'Qname'  => $name,
                        'Qdec'   => $dec,
                        'Qprice' => $price,
                        'Qmade'  => $made,
                        'Qstatus'=> $status));
                        $row = $stmt->rowcount();
                        if($row > 0){
                            redirect('<strong>success</strong>add item data','success','members.php');
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
                        </div>
                        <button type="submit" class="btn btn-primary ">Save</button>
                    </form>
                </div><?php
                break;
            case 'Delete':
                # code...
                break;
            case 'edit':
                # code...
                break;
            default:
                echo 'welcom to items page';
                break;
        }

        include $temp.'footer.php';
    }else{
        header('location: index.php');
        exit();
    }