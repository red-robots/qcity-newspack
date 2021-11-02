<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ACStarter
 */

wp_reset_postdata();
wp_reset_query();

$post_id = get_the_ID();

$sidebar_event_text 	= get_field('sidebar_event_text', 'option');
$sidebar_business_text 	= get_field('sidebar_business_text', 'option');
$sidebar_post_text 		= get_field('sidebar_post_text', 'option');
$trendingBlock = false;

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
if( (get_post_type() == 'post') && !(is_page('events')) ) {
	$title = 'Trending';
	$trendingBlock = true;
	// $qp = 'post';
	// $args = array(
	// 	'post_type'			=> $qp,
	// 	'posts_per_page'=> 6,
	// 	'post_status'		=> 'publish',	
	// 	'meta_key' 			=> 'views',
	// 	'orderby' 			=> 'post_date meta_value_num',
	// 	'order'					=> 'DESC'
	// );
} elseif( is_page('qcity-biz') ) {
	$title = 'Latest Business Articles';
	$qp = 'business_listing';
	$args = array(
			'post_type'			=> $qp,
			'posts_per_page' 	=> 6,
			'post_status'       => 'publish',	
	);
} elseif( is_tax() ) {
	$title = 'Black Business';
	$qp = 'black-business';
	$args = array(     
		        'category_name'     => 'black-business',        
		        'post_type'         => 'post',        
		        'post__not_in'      => array( $post_id ),
		        'post_status'       => 'publish',
		        'posts_per_page'    => 5,		       
	);
} elseif( (get_post_type() == 'page') && !( is_page('events') ) && !( is_page('business-directory') ) && !( is_page('media-gallery') ) ) {
	$title = 'Latest Stories';
	$qp = 'business_listing';
	$args = array(
			'post_type'			=> $qp,
			'posts_per_page' 	=> 6,
			'paged'             => 1,
			'post_status'       => 'publish',
	);
} elseif( (get_post_type() == 'page') && ( is_page('media-gallery') )  ) {
	$title = 'Trending';
	$trendingBlock = true;
} elseif( is_page('events') ) {
	$title = 'Entertainment';
	$qp = 'entertainment';
	$args = array(     
		        'category_name'     => 'Entertainment',        
		        'post_type'         => 'post',        
		        'post__not_in'      => array( $post_id ),
		        'post_status'       => 'publish',
		        'posts_per_page'    => 5,
		        'paged'             => 1		       
		    );
} elseif( is_page('business-directory') ){
	$title = 'Black Business';
	$qp = 'black-business';
	$args = array(     
		        'category_name'     => 'black-business',        
		        'post_type'         => 'post',        
		        'post__not_in'      => array( $post_id ),
		        'post_status'       => 'publish',
		        'posts_per_page'    => 5,
		        'paged'             => 1		       
	);
}

if( is_page('events') ) {
	$text = $sidebar_event_text;
} elseif( ( ( get_post_type() == 'page') &&  is_page('business-directory') ) || get_post_type() == 'business_listing'  ) {
	$text = $sidebar_business_text;
} else {
	$text = $sidebar_post_text;
}
?>

<!-- ARCHIVE WIDGETS -->
<div class="widget-area category-post">

<?php 
	// If is Sponsored Post

	$sponsors = get_field('sponsors');
	if($sponsors):
		$post = get_post($sponsors[0]->ID);
		$logo = get_field("logo", $post);
		$description = get_field("description", $post);
		$logo_link = get_field("logo_hyperlink", $post);
		// setup_postdata( $post );
		// get_template_part('ads/sponsor-header');
		// wp_reset_postdata();
	endif;
	// echo '<pre>';
	// print_r($sponsors);
	// echo '</pre>';

	
	$link = get_field("sponsorship_policy_link",39809);
	$link_text = get_field("sponsorship_policy_text",39809);
	?>


	<?php  if( ( (get_post_type() != 'post') ||  is_category() )  ): ?>

		<?php 
			$adList = array();
			$ads = get_field("trending_ads","option");  
			if($ads) {
	  		foreach($ads as $ad_id) {
	  			if( $adScript = get_field('ad_script',$ad_id) ) {
	  				$adList[] = $adScript;
	  			}
	  		}
	  	}
		?>

		<?php if ($adList) { ?>
  	<div class="sideBarAds">
  		<?php foreach ($adList as $ad) { ?>
  			<div class="adBox"><?php echo $ad ?></div>
  		<?php } ?>
  	</div>
  	<?php } ?>

	
		<?php
		/* SUBSCRIPTION FORM */
		include( locate_template('sidebar-subscription-form.php') );
		?>

		<?php
		$isTrending = ($trendingBlock) ? ' sb-trending-posts':'';
		if($trendingBlock) { 
			/* TRENDING POSTS */
			include( locate_template('template-parts/trending-posts-widget.php') );
		} else { 
			$wp_query = new WP_Query( $args );		
			if ($wp_query->have_posts()) { ?>
				<div class="next-stories<?php echo $isTrending; ?>">
					<h3><?php echo $title; ?></h3>
					<div class="sidebar-container">
						<?php while ($wp_query->have_posts()) : $wp_query->the_post();

							if( is_tax() ){
								get_template_part( 'template-parts/sidebar-black-biz-block');
							} else {
								get_template_part( 'template-parts/sidebar-block');
							}
							
						endwhile; wp_reset_postdata();  ?>
					</div>
					<div class="more">
						<a class="gray qcity-sidebar-load-more" data-trending="<?php echo ($trendingBlock) ? '1':'' ?>" data-page="1" data-action="qcity_sidebar_load_more" data-qp="<?php echo $qp; ?>" data-postid="<?php echo $post_id; ?>">
							<span class="load-text">Load More</span>
							<span class="load-icon"><i class="fas fa-sync-alt spin"></i></span>
						</a>
					</div>	
					</div>	
			<?php } ?>
				
			<?php } ?>

			



	<?php endif;  //if( (get_post_type() != 'post') ||  is_category() && ! $sponsors )  ?>

</div><!-- #secondary -->


