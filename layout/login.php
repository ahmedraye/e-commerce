<?php 
session_start();
$Title ='Login';
if (isset($_SESSION['USER'])){
   header('location: index.php');
   exit();
}
require 'init.php';
//check if data method = 'post'
if( $_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = $_POST['username'];
    $pass     = sha1($_POST['password']);
    
    //check if user found in database
    $stmt = $conn->prepare('SELECT 
                                username,password
                            FROM 
                                USERS
                            WHERE 
                                username = ?
                            AND 
                                password = ?');
    $stmt->execute(array($username,$pass)); //array
    //rowCount ->for check user login or not
    if($stmt->rowCount() == 1){
        $_SESSION['USER'] = $username;
        header('location: index.php');
        exit();
    }
    
}

$action = (isset($_GET['action']))? $_GET['action']:'';
switch($action){
    case'login':
        ?>
            <div class="container">
                <div class="row">
                    <form class="col-md-6 login-f text-center" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                        <h3>LOGIN</h3>
                        <div class="form-group">
                            <input type="text" name="username" class="form-control" placeholder="Your Email *" value="" />
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control" placeholder="Your Password *" value="" />
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="Login" />
                        </div>
                    </form>
                </div>
            </div>


        <?php
        break;
    case 'singup':
        ?>
            <div class="container">
                <div class="row">
                    <div class="col-md-6 login-f text-center">
                        <h3>LOGIN</h3>
                        <div class="form-group">
                            <input type="text" name ='username' class="form-control" placeholder="Your username *" value="" />
                        </div>
                        <div class="form-group">
                            <input type="password" name ='password' class="form-control" placeholder="Your Password *" value="" />
                        </div>
                        <div class="form-group">
                            <input type="email" name ='email' class="form-control" placeholder="Your email *" value="" />
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="SIGN up" />
                        </div>
                    </div>
                </div>
            </div>


        <?php
        break;
    default:

        redirect("NOT FOUND",'error','index.php');
        break;
}

?>


<?php include $temp.'footer.php'?>