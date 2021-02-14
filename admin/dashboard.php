<?php
    $Title ='Dashboard';
    session_start();
    if (isset($_SESSION['USERNAME'])){
        include 'init.php';
        $NLU = 5;
        $latsetUser = GetLatest('*','users','Username',$NLU);
        $ILU = 5;
        $latsetItems = GetLatest('*','items','name',$NLU);
        
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
                                <i class='fa fa-users'></i>
                                total members
                                <span><a href='members.php'><?php echo countItem('UserID','users');?></a></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stat">
                            <i class='fa fa-user-plus'></i>
                                pending users
                                <span><a href="members.php?do='mange'&page='pending'"><?php echo checkItem('RegStatus','users',0);?></a></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stat">
                            <i class='fa fa-tag'></i>
                                total tag
                                <span>1564</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stat">
                            <i class='fa fa-comment'></i>
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
                                    <div class="card-title">
                                        <i class='fa fa-user'></i> Letest <?php echo $NLU;?> user registed
                                        <span class="toggle-inf"><i class="fa fa-plus fa-lg float-right "></i></span>
                                    </div>
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
                                    <div class="card-title">
                                        <i class='fa fa-tag'></i> Letest <?php echo $ILU;?> items registed
                                        <span class="toggle-inf"><i class="fa fa-plus fa-lg float-right "></i></span>
                                    </div>
                                </div>
                                <div class="card-body">
                                <?php
                                        foreach($latsetItems as $item){
                                            echo '<p class="card-text ">'.$item['name'].'<a class="float-right" href="items.php?do=Edit&item_id='
                                            .$item['item_iD'].'" >'.'<i class="fa fa-edit"></i>'.'</a>';
                                            if($item['approve_items'] == 0){
                                                echo '<a class="float-right activation" href="items.php?do=approve&item_id='
                                                .$item['item_iD'].'" >'.'<i class="fa fa-user-lock"></i>'.'</a>';
                                            }
                                            echo '</p>';
                                        }
                                    ?>
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








