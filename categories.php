<?php require 'init.php';
    $CatID   = (isset($_GET['cat_ID']))?$_GET['cat_ID']:'';
    $CatName = (isset($_GET['cat_name']))?$_GET['cat_name']:'';
?>
    <div class="container">
        <h1 class='text-center header_add'><?php echo $CatName;?></h1>
        <div class="row">
        <?php
            foreach(getitems($CatID) as $item){
                echo '<div class="card col-3">';
                    ?>
                    <img class="card-img-top" src="layout/images/What-are-Action-Items.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $item['name'];?></h5>
                        <p class="card-text"><?php echo $item['Description'];?></p>
                    </div>
                    <?php
                echo '</div>';
            }
        ?>
        </div>
       
    </div>
   
    
<?php require $temp . 'footer.php';?>