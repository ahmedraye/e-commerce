<?php
/*
*************************
//this page to mange mamber make add|delet|other
*************
*/

$Title ='members mangment';
    session_start();
    if (isset($_SESSION['USERNAME'])){
        include 'init.php';
        //chech page request
        $test = isset( $_GET['do']) ? $_GET['do'] :'mangment';
        switch($test)
        {
            case 'insert':
                //insert data ino db
                
                if($_SERVER['REQUEST_METHOD'] =='POST'){
                    $user   = $_POST['username'];
                    $pass   = $_POST['password'];
                    $email  = $_POST['email'];
                    $name   = $_POST['full-name'];

                    $hashpass=sha1($pass);
                    $formError = array();
                    if(empty($user)){
                        $formError[]= '<strong>Error!</strong> username is empty';
                    }if(strlen($user) < 4){
                        $formError[]= '<strong>Error! username most be grater than 4ch</strong>';
                    }if(empty($email)){
                        $formError[]= '<strong>Error!</strong> email is empty';
                    }if(empty($name)){
                        $formError[]='<strong>Error!</strong> Fullname is empty';
                    }
                    echo '<div class="container">';
                    foreach($formError as $error){
                        redirect($error,'error','back');
                    }
                    echo '</di>';
                    if(empty($formError)){
                        if(checkItem('username','users', $user) == 1){
                            redirect('<strong>warning!</strong> User is Found.','warning','back');
                        }else{
                            $stmt   = $conn->prepare('INSERT INTO 
                                                    users (username, password, Email, FullName,Date) 
                                                    VALUES (:Quser,:Qpass, :Qmail, :Qname ,now())');
                            $stmt->execute(array(
                            'Quser'=> $user,
                            'Qpass'=> $hashpass,
                            'Qmail'=> $email,
                            'Qname'=> $name));
                            $row = $stmt->rowcount();
                            if($row > 0){
                                redirect('<strong>success</strong>add user data','success','members.php');
                            }else{
                                redirect('<strong>INFO!</strong> NO Record.','warning','back');
                            }
                        }
                    }
                }
                break;
            case 'Update':
                if($_SERVER['REQUEST_METHOD'] =='POST'){
                    $user   = $_POST['username'];
                    $ID     = $_POST['userid'];
                    $email  = $_POST['email'];
                    $name   = $_POST['full-name'];
                    $pass =(empty($_POST['newpassword'])) ? $_POST['oldpassword'] : sha1($_POST['newpassword']);
                    $formError = array();
                    if(empty($user)){
                        $formError[]= '<strong>Error!</strong> username is empty';
                    }if(strlen($user) < 4){
                        $formError[]= '<strong>Error! username most be grater than 4ch</strong>';
                    }if(empty($email)){
                        $formError[]= '<strong>Error!</strong> email is empty';
                    }if(empty($name)){
                        $formError[]='<strong>Error!</strong> Fullname is empty';
                    }
                    echo '<div class="container">';
                    foreach($formError as $error){
                        redirect($error,'error','back');
                    }
                    echo '</di>';
                    if(empty($formError)){
                        $stmt   = $conn->prepare('UPDATE users SET username=?, Email=?, FullName=?, password=? WHERE userID=?');
                        $stmt->execute(array($user,$email, $name, $pass, $ID));
                        $row = $stmt->rowcount();
                        if($row > 0){
                        redirect('<strong>Successfull</strong> Save data.','success','members.php');
                        }else{
                            redirect('<strong>error!</strong> NO Record.','error');
                        }
                    }
                }
                break;
            case 'Edit':
                $UID = (isset($_GET['userid'])&&is_numeric($_GET['userid'])) ? $_GET['userid'] : 0 ;
                $stmt = $conn->prepare('SELECT * FROM USERS WHERE userID = ? LIMIT 1');
                $stmt->execute(array($UID)); //array
                $row = $stmt->fetch();
                if($row > 0){?>
                <h1 class="text-center edit-member">Edit member</h1>
                <div class="container">
                    <form action="<?php echo 'members.php?do=Update'?>" method='POST'>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class='col-form-label'>username</label>
                                <input type="hidden" name='userid' value=<?php echo $UID; ?>>
                                <input type="text" class="form-control" name='username' placeholder="username" value=<?php echo $row['username'];?> autocomplete='off' required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4" class=" col-form-label">Password</label>
                                <input type="hidden" name='oldpassword' value='<?php echo $row['password']?>'>
                                <input type="password" name="newpassword" class="form-control" placeholder="Leave Blank empty if you Dont change password" autocomplete='new-password'>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class='col-form-label'>E-mail</label>
                                <input type="email" class='form-control' name='email' value='<?php echo $row['Email'];?>' placeholder="E-mail" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label class='col-form-label'>Full name</label>
                                <input type="text" class='form-control' name='full-name' value='<?php echo $row['FullName'];?>' placeholder="Full name" required>
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
            case 'Delet':
                //Delet page
                echo'  <h1 class="text-center add-member">Delete member</h1>';
                echo'<div class="container">';
                $UID = (isset($_GET['userid'])&&is_numeric($_GET['userid'])) ? $_GET['userid'] : 0 ;
                $stmt = $conn->prepare('SELECT * FROM USERS WHERE userID = ? LIMIT 1');
                $stmt->execute(array($UID)); //array
                $row =$stmt->rowcount();
                if($row > 0){
                    $stmt = $conn->prepare('DELETE FROM USERS WHERE UserID =:zuser');
                    $stmt->bindParam(':zuser',$UID);
                    $stmt->execute(); //array
                    
                    redirect('<strong>Successfull</strong> Delete User.','success','members.php');
                }else{
                    redirect('Error!','error','member.php');
                }
                echo '</div>';
                break;
            case 'add':?>
                <h1 class="text-center add-member">Add member</h1>
                <div class="container">
                    <form action="<?php echo 'members.php?do=insert'?>" method='POST'>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class='col-form-label'>username</label>
                                <input type="hidden" name='userid'>
                                <input type="text" class="form-control" name='username' placeholder="username" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4" class=" col-form-label">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="your New Password" autocomplete='new-password' required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class='col-form-label'>E-mail</label>
                                <input type="email" class='form-control' name='email' placeholder="E-mail" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label class='col-form-label'>Full name</label>
                                <input type="text" class='form-control' name='full-name' placeholder="Full name" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary ">Save</button>
                    </form>
                </div><?php
                break;
            default:
                $stmt = $conn->prepare('SELECT * FROM users WHERE GroupID=0');
                $stmt->execute();
                $rows = $stmt->fetchAll();?>

                <h1 class='text-center mange-member'>mange members</h1>
                <div class="container">
                    <table class="table table-hover table-dark text-center">
                    <thead>
                    <tr>
                        <th scope="col">#ID</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">FullName</th>
                        <th scope="col">Registerd Data</th>
                        <th scope="col">Control</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($rows as $row){
                                echo '<tr>';
                                echo '<td>'.$row['UserID'].'</td>';
                                echo '<td>'.$row['username'].'</td>';
                                echo '<td>'.$row['Email'].'</td>';
                                echo '<td>'.$row['FullName'].'</td>';
                                echo '<td>'.$row['Date'].'</td>';
                                echo '<td>'.'<a href="?do=Edit&userid='.$row['UserID'].'" >'.'<i class="fa fa-edit"></i>'.'</a>'.
                                '<a href="?do=Delet&userid='.$row['UserID'].'" >'.'<i class="far fa-trash-alt Confirm"></i>'.'</a>'.'</td>' ;
                                echo '<td>'.'</td>' ;
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

