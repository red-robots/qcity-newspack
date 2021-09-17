<?php
/*
	Non Sticky News.
*/  

    //$exclude_term_id = getTermId('commentaries');
    //$exclude_term_id = array('sponsored-post','commentaries');
    $excludePosts = ( isset($featured_posts) && $featured_posts ) ? $featured_posts : array();
    //$cat_id = ( isset($excludeCatID) && $excludeCatID ) ? $excludeCatID : '';
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


    if( isset($postsNotIn) && $postsNotIn ) {
        $excludePostIds = $postsNotIn;
    }

    if( isset($excludePosts) && $excludePosts ) {
        if($excludePostIds) {
            $excludePostIds = array_merge($excludePostIds,$excludePosts);
        } else {
            $excludePostIds = $excludePosts;
        }
    }

    $doNotIncludeIds = ($excludePostIds) ? array_unique($excludePostIds) : array();
    if($doNotIncludeIds) {
        $args1['post__not_in'] = $doNotIncludeIds;
    }

    // $sp_args = array(     
    //     'category_name'     => 'offers-invites+sponsored-post',        
    //     'post_type'         => 'post',        
    //     'post_status'       => 'publish',
    //     'posts_per_page'    => -1,
    //     'orderby'           => 'rand',
    //     'meta_query'        => array(
    //         array(
    //             'key'       => 'sponsored_content_post',
    //             'compare'   => '=',
    //             'value'     => 1,
    //         ),      
    //     ),
    // );
    // $sp_posts = get_posts($sp_args);
    // $sp_post_ids = array();
    // if($sp_posts) {
    //     foreach($sp_posts as $sp) {
    //         $sp_post_ids[] = $sp->ID;
    //     }
    // }
    // if($excludePostIds) {
    //     if($sp_post_ids) {
    //         $catLists = array_unique( array_merge($excludePostIds,$sp_post_ids) );
    //     } else {
    //         $catLists = $excludePostIds;
    //     }
    //     $args1['post__not_in'] = $excludePostIds;
    // } else {
    //     if($sp_post_ids) {
    //         $args1['post__not_in'] = $sp_post_ids;
    //     }
    // }
	
	$wp_query = new WP_Query($args1);
    $existingIDS = array();
    $ex = ($doNotIncludeIds) ? count($doNotIncludeIds) : 0;
    $exclude_categories = array('sponsored-post','offers-invites','commentaries');
    $excludeCategories = getAllCategoriesByTermSlug($exclude_categories,'category');
	?>
	
	<section class="news-home newsHomeV2">

        <?php $show_ads = false; ?>
        <?php if ($show_ads) { ?>
        <div class="mobile-version" style="margin-bottom: 20px; text-align: center;"> <!-- Small Optional Ad Right -->
            <?php $small_ad =  get_ads_script('small-ad-right'); echo $small_ad['ad_script']; ?>
        </div> <!-- Small Optional Ad Right -->
         <?php } ?>

		<section class="twocol qcity-news-container">	

    		<?php 
                $i = 0;
                $key = $ex;

                if ( $wp_query->have_posts() ) : 	
                    $total = $wp_query->found_posts;	
    				 while ( $wp_query->have_posts() ) :  $wp_query->the_post();
                        $doNotIncludeIds[$key] = get_the_ID();

                        $key++;
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

        <div class="more"> 
            <a class="red qcity-load-more" data-page="1" data-action="qcity_load_more" data-basepoint="10" data-excludecat="<?php echo ($excludeCategories) ? implode(",",$excludeCategories):'' ?>" data-except="<?php echo ($doNotIncludeIds) ? implode(',', $doNotIncludeIds):''; ?>" data-perpage="6">        
                <span class="load-text">Load More</span>
                <span class="load-icon"><i class="fas fa-sync-alt spin"></i></span>
            </a>
        </div>

	 </section>



