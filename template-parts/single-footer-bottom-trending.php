<?php 
// $footer_title_article_right = get_field('footer_title_article_right', 'option');
// $excludeItems2 = array();
 ?>
<!--- Trending Articles -->
<div id="footTrending" class="ad flexbox bgwhite">
    <div class="fxdata">
        <header class="before-footer-title ">
            <h2 ><?php echo $footer_title_article_right; ?></h2>
        </header>
        <div class="footer-content-list txtwrap">
        <?php
            $args = array(
                    'post_type'         => 'post',
                    'posts_per_page'    => 5,
                    'post_status'       => 'publish',  
                    'orderby'           => 'date',
                    'order'             => 'DESC'
            );
            if($excludeItems2) {
                $args['post__not_in'] = $excludeItems2;
            }
            $trending = new WP_Query( $args );
            if( $trending->have_posts() ):                    
                while( $trending->have_posts() ): $trending->the_post();
                    $guest_author =  get_field('author_name');
                    $author = ( $guest_author ) ? $guest_author : get_the_author();
                    echo '<div class="footer-content-list-item">';
                    echo '<h3><a href="'. get_permalink() .'">'. get_the_title() .'</a></h3>';
                    echo '<div class="footer-content-author"><span class="footer-author">'. $author .'</span> <span class="footer-content-date">'. date('M. j, Y', strtotime(get_the_date() )) .'</span></div>';
                    echo '</div>';
                endwhile;  
                ?>

                <div class="more footer-more"> 
                    <a href="<?php bloginfo('url'); ?>/category/news/" class="red " >        
                        <span class="load-text">Read More</span>                    
                    </a>
                </div>
                <div class="clearfix"></div>

                <?php
            else:

                echo 'No posts available';

            endif; 
            wp_reset_postdata();
        ?>
        </div>
    </div>
</div>