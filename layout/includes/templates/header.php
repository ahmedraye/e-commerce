<!Doctype html>
<html>
    <head>
        <meta charset="UTF-8">
       
        <title><?php echo getTitle();?></title>
        <link rel="stylesheet" href="<?php echo $css; ?>bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo $css; ?>all.min.css">
        <link rel="stylesheet" href="<?php echo $css; ?>front.css">
    </head>
    <body>
		    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
      <div class="container">
          <a class="navbar-brand" href="<?php echo 'index.php';?>"><?php echo lang('CP-ADMIN');?></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
            <?php
              if (!isset($_SESSION['USER'])){
                ?>
                <li class="nav-item">
                  <a class="nav-link login" href="login.php?action=login">LOGIN</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link login" href="login.php?action=singup">SIGNUP</a>
                </li>
            <?php }else{?>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle"  id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    section Profile
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="porfile.php">profile</a>
                      <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href='logout.php'>LOGOUT</a>
                  </div>
                </li>
             <?php }?>
              <?php
                foreach(getcat() as $cat){
                  echo '<li class="nav-item">';
                    echo '<a class="nav-link" href="categories.php?cat_ID='.$cat['ID'].'&cat_name='.$cat['name'].'">'.$cat['name'].'</a>';
                  echo '</li>';
              }
              ?>
            </ul>
          </div>
      </div>
    </nav>