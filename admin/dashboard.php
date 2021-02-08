<?php
    $Title ='Dashboard';
    session_start();
    if (isset($_SESSION['USERNAME'])){
        include 'init.php';
        $NLU = 5;
        $latsetUser = GetLatest('*','users','Username',$NLU);
        
        ?>
            <div class="status text-center">
                <div class="container">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Library</li>
                        </ol>
                    </nav>
                    <h1 class='dashboard'>Dashboard</h1>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="stat">
                                total members
                                <span><a href='members.php'><?php echo countItem('UserID','users');?></a></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stat">
                                pending users
                                <span><a href="members.php?do='mange'&page='pending'"><?php echo checkItem('RegStatus','users',0);?></a></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stat">
                                total tag
                                <span>1564</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stat">
                                command
                                <span>14000</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title"><i class='fa fa-user'></i> Letest <?php echo $NLU;?> user registed</h5>
                                </div>
                                <div class="card-body">
                                    <?php
                                        foreach($latsetUser as $user){
                                            echo '<p class="card-text ">'.$user['username'].'<a class="float-right" href="members.php?do=Edit&userid='.$user['UserID'].'" >'.'<i class="fa fa-edit"></i>'.'</a>';
                                            if($user['RegStatus'] == 0){
                                                echo '<a class="float-right activation" href="members.php?do=active&userid='.$user['UserID'].'" >'.'<i class="fa fa-user-lock"></i>'.'</a>';
                                            }
                                            echo '</p>';
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title"><i class='fa fa-tag'></i> Panel heading without title</h5>
                                </div>
                                <div class="card-body">
                                    <p class="card-text">card body</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        
        <?php
        include $temp.'footer.php';
    }else{
        header('location: index.php');
        exit();
    }








