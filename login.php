<?php 
session_start();
$Title ='Login';
if (isset($_SESSION['USER'])){
   header('location: index.php');
   exit();
}
require 'init.php';
global $msgErrorArray;
//check if data method = 'post'
if( $_SERVER['REQUEST_METHOD'] === 'POST'){
    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $pass     = sha1($_POST['password']);
        
        //check if user found in database
        $stmt = $conn->prepare('SELECT 
                                    username,password,UserID
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
            foreach($stmt as $stat){
                $_SESSION['ID']   = $stat['UserID'];
            }
            
            header('location: index.php');
            exit();
        }
    }else{
        
        if(isset($_POST['username'])){
            $fillterUser = filter_var($_POST['username'],FILTER_SANITIZE_STRING);
            if(strlen($fillterUser) < 4){
                $msgErrorArray[] = 'user must be larg';
            }
            var_dump($msgErrorArray);
            var_dump($fillterUser);
        }
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
                            <input type="submit" name="login" class="btn btn-success" value="Login" />
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
                    <form class="col-md-6 login-f text-center" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                        <h3>LOGIN</h3>
                        <div class="form-group">
                            <input type="text" name ='username' class="form-control" placeholder="Your username *" value="" />
                        </div>
                        <div class="form-group">
                            <input type="password" name ='password' class="form-control" placeholder="Your Password *" value="" />
                        </div>
                        <div class="form-group">
                            <input type="text" name ='email' class="form-control" placeholder="Your email *" value="" />
                        </div>
                        <div class="form-group">
                            <input type="submit"  name="singup" class="btn btn-success" value="SIGN up" />
                        </div>
                    </form>
                </div>
            </div>
            <div class="error">
                <?php 
                    if(!empty($msgErrorArray)){
                        foreach($msgErrorArray as $error){
                            echo '<p>'.$error.'</p>';
                        }
                    }
                    
                ?>
            </div>

        <?php
        break;
    default:

       // redirect("NOT FOUND",'error','index.php');
        break;
}

?>


<?php include $temp.'footer.php'?>