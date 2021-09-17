<?php
/*
	Non Sticky News.
*/  

    $exclude_term_id = getTermId('commentaries');

    $excludePosts = ( isset($featured_posts) && $featured_posts ) ? $featured_posts : '';
    $cat_id = ( isset($excludeCatID) && $excludeCatID ) ? $excludeCatID : '';
    //$cat_id = get_category_by_slug( 'sponsored-post' ); 
    $postWithVideos = get_news_posts_with_videos(200);
    $excludePostIds = array();
    $excludeCategories = array();

    $args1 = array(
        'post_type'             =>'post',
        'post_status'           => 'publish',       
        'posts_per_page'        => 6,    
        'paged'                 => 1
    );

    // if($exclude_term_id) {
    //     $args1['category__not_in'] = $exclude_term_id;
    // }

    // if($cat_id) {
    //     $args1['tax_query'] = array(
    //         array(
    //             'taxonomy' => 'category',
    //             'field'    => 'id',
    //             'terms'    => $cat_id,
    //             'operator' => 'NOT IN'
    //         )
    //     );
    // }

    if($exclude_term_id) {
        $excludeCategories[] = $exclude_term_id;
    }
    if($cat_id) {
        $excludeCategories[] = $cat_id;
    }

    if($excludeCategories) {
        $args1['category__not_in'] = $excludeCategories;
    }


    if($excludePosts) {
        if($postWithVideos) {
            $ex_ids = array_unique(array_merge($excludePosts,$postWithVideos));
            $excludePostIds = $ex_ids;
            //$args1['post__not_in'] = $ex_ids;
        } else {
            //$args1['post__not_in'] = $excludePosts;
            $excludePostIds = $excludePosts;
        }
    } else {
        if($postWithVideos) {
            //$args1['post__not_in'] = $postWithVideos;
            $excludePostIds = $postWithVideos;
        }
    }

    $sp_args = array(     
        'category_name'     => 'offers-invites+sponsored-post',        
        'post_type'         => 'post',        
        'post_status'       => 'publish',
        'posts_per_page'    => -1,
        'orderby'           => 'rand',
        'meta_query'        => array(
            array(
                'key'       => 'sponsored_content_post',
                'compare'   => '=',
                'value'     => 1,
            ),      
        ),
    );
    $sp_posts = get_posts($sp_args);
    $sp_post_ids = array();
    if($sp_posts) {
        foreach($sp_posts as $sp) {
            $sp_post_ids[] = $sp->ID;
        }
    }
    if($excludePostIds) {
        if($sp_post_ids) {
            $catLists = array_unique( array_merge($excludePostIds,$sp_post_ids) );
        } else {
            $catLists = $excludePostIds;
        }
        $args1['post__not_in'] = $excludePostIds;
    } else {
        if($sp_post_ids) {
            $args1['post__not_in'] = $sp_post_ids;
        }
    }
	
	$wp_query = new WP_Query($args1);
    $existingIDS = array();

	?>
	
	<section class="news-home newsHomeV2">

        <div class="mobile-version" style="margin-bottom: 20px; text-align: center;"> <!-- Small Optional Ad Right -->
                <?php $small_ad =  get_ads_script('small-ad-right'); echo $small_ad['ad_script']; ?>
        </div> <!-- Small Optional Ad Right -->

		<section class="twocol qcity-news-container">	

    		<?php 
            $i = 0;
           
                if ( $wp_query->have_posts() ) : 	
                    $total = $wp_query->found_posts;	
    				 while ( $wp_query->have_posts() ) :  $wp_query->the_post();
                        $existingIDS[] = get_the_ID();
                        if($i == 2){
                            
                            //get_template_part( 'template-parts/sponsored-paid');

                            echo '<div class="moreNewsWrap">';
                            get_template_part( 'template-parts/headlines-blocks');
                            echo '</div>';
                        }

                        else if($i == 4){
                            get_template_part( 'template-parts/commentary-posts');
                        }



    		    		//include( locate_template('template-parts/story-block.php', false, false) );

    		    		get_template_part( 'template-parts/story-block');
                        $i++;

                        if($i != 2){
                            get_template_part( 'template-parts/separator');
                        }


    		    	
    			 	endwhile; 
    			endif;
    			wp_reset_postdata();
    		?>	 	
		 </section>
		 
         <?php get_sidebar('home'); ?>

         <?php 
         if ($excludePostIds) {
            $n = count($excludePostIds);
            if($existingIDS) {
                foreach($existingIDS as $x) {
                    $excludePostIds[$n] = $x;
                    $n++;
                }
            }
         } else {
            if($existingIDS) {
                $n=0; foreach($existingIDS as $x) {
                    $excludePostIds[$n] = $x;
                    $n++;
                }
            }
         }
         ?>
             

         <div class="more"> 
            <a class="red qcity-load-more" data-page="1" data-action="qcity_load_more" data-basepoint="10" data-excludecat="<?php echo ($excludeCategories) ? implode(",",$excludeCategories):'' ?>" data-except="<?php echo ($excludePostIds) ? implode(',', $excludePostIds):''; ?>" data-perpage="6">        
                <span class="load-text">Load More</span>
                <span class="load-icon"><i class="fas fa-sync-alt spin"></i></span>
            </a>
        </div>

	 </section>


