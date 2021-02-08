    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
      <div class="container">
        <a class="navbar-brand" href="<?php echo 'dashboard.php';?>"><?php echo lang('CP-ADMIN');?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="Categories.php"><?php echo lang('Categories-nav');?></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#"><?php echo lang('Items-nav');?></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo 'members.php';?>"><?php echo lang('Member-nav');?></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#"><?php echo lang('Statistics-nav');?></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#"><?php echo lang('Logs-nav');?></a>
            </li>
            
          </ul>
          <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php echo lang('Dropdown');?>
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="<?php echo 'members.php?do=Edit&userid='.$_SESSION['ID'];?>"><?php echo lang('section_nav');?></a>
                <a class="dropdown-item" href="#"><?php echo lang('settings_navbar');?></a>
                <a class="dropdown-item" href="logout.php"><?php echo lang('Logout-nav');?></a>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>