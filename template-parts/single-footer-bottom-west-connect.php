<?php 
	$excludedPosts ='';
	$post_id = get_the_ID();
	$excludedPosts = get_trending_articles(5);
	$trend = ($excludedPosts) ? count($excludedPosts) : 0;
	$excludedPosts[$trend] = $post_id;
 ?>
<!--- West End Connect -->
<div class="biz-dir mobile-gap flexbox bgwhite" style="background-color: none">
    <div class="fxdata">
        <header class="before-footer-title ">
            <h2 ><?php echo $footer_title_article_middle; ?></h2>
        </header>
        <div class="footer-content-list txtwrap">
            <?php
            
                $args = array(
                    'post_type'         => 'post',
                    'posts_per_page'    => 5,
                    'post_status'       => 'publish',  
                    'category_name'     => 'west-end',
                );
                
                if($excludedPosts) {
                    $args['post__not_in'] = $excludedPosts;
                }
                $excludeItems2 = $excludedPosts;
                $lastIndex = ($excludedPosts) ? count($excludedPosts) : 0;
                $trending = new WP_Query( $args );
                if( $trending->have_posts() ):                    
                    while( $trending->have_posts() ): $trending->the_post();
                        $guest_author =  get_field('author_name');
                        $author = ( $guest_author ) ? $guest_author : get_the_author();
                        //$whatEx = $excludeItems2[$lastIndex] = get_the_ID();
                        $excludeItems2[$lastIndex] = get_the_ID();
	                    

                        // echo '<pre>';
                        // print_r($whatEx);
                        // echo '</pre>';
                        echo '<div class="footer-content-list-item">';
                        echo '<h3><a href="'. get_permalink() .'">'. get_the_title() .'</a></h3>';
                        echo '<div class="footer-content-author"><span class="footer-author">'. $author .'</span> <span class="footer-content-date">'. date('M. j, Y', strtotime(get_the_date() )) .'</span></div>';
                        echo '</div>';
                    $lastIndex++; endwhile; ?>  

                    <div class="more footer-more"> 
                        <a href="<?php bloginfo('url'); ?>/category/west-end/" class="red " >        
                            <span class="load-text">Read More</span>                    
                        </a>
                    </div>

                    <div class="clearfix"></div>

                    <?php 
                else:    

                    echo 'No posts available';

                endif; 
                wp_reset_postdata();
                echo '<pre>';
                        print_r($excludeItems2);
                        echo '</pre>';
            ?> 
        </div>
    </div>
</div>