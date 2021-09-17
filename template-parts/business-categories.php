<?php

/*
*       Display Business Categories
*/           

    foreach($business_category as $category):  

     ?>
        
        <div class="cat">
            <a href="<?php echo $category['url']; ?>">
                <div class="icon">
                    <img src="<?php echo $category['icon']; ?>" alt="<?php echo $category['name']; ?>" class="business_category_icon">
                </div>
                <h2><?php echo $category['name']; ?></h2>
            </a>
        </div>
    <?php 
        //endif;
    endforeach;