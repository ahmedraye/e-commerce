<?php
    $Title ='Dashboard';
    session_start();
    if (isset($_SESSION['USERNAME'])){
        include 'init.php';
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
                                <span>50</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stat">
                                members
                                <span>1500</span>
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
                                    <h5 class="card-title"><i class='fa fa-user'></i> Panel heading without title</h5>
                                </div>
                                <div class="card-body">
                                    <p class="card-text">card body</p>
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








