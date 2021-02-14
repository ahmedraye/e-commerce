<?php 
    session_start();
    $Title ='Login';
    $NoNavBar='';
    if (isset($_SESSION['USERNAME'])){
        header('location: dashboard.php');
    }
    require 'init.php';
    //check if data method = 'post'
    if( $_SERVER['REQUEST_METHOD'] === 'POST'){
   
        $username = $_POST['user'];
        $pass     = sha1($_POST['pass']);
        
        //check if user found in database
        $stmt = $conn->prepare('SELECT 
                                    UserID,username,password
                                FROM 
                                    USERS
                                WHERE 
                                    username = ?
                                AND 
                                    password = ?
                                AND 
                                    GroupID = 1
                                LIMIT 1');
        $stmt->execute(array($username,$pass)); //array
        $row = $stmt->fetch();
        //rowCount ->for check user login or not
        if($stmt->rowCount() == 1){
            $_SESSION['USERNAME'] = $username;
            $_SESSION['ID']       = $row['UserID'];
            header('location: dashboard.php');
            exit();
        }
        
    }
    
    
?>
<form class="login" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
    <h4 class="text-center">Admin Login</h4>
    <input class="form-control" type="text" name='user' placeholder='username' autocomplete="off">
    <input class="form-control" type="password" name='pass' placeholder='password' autocomplete="new-password">
    <input class="btn btn-info btn-block"type="submit" name="submit"/>
</form>


<?php require $temp . 'footer.php';?>