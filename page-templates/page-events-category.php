<?php
/**
 * Template Name: Events Category
 *
 * 
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ACStarter
 */

get_header(); 
get_template_part('template-parts/banner-events');
?>
<div class="wrapper">
	<div class="listing-header">
		<div class="content-area-title">
			<header class="section-title ">
				<h2 class="dark-gray">Sponsored</h2>
			</header>
		</div>
	</div>
</div>
<div class="wrapper">
	<div id="primary" class="content-area">
		<main id="main" class="site-main " role="main">

			<div class="events_page">
				<div class="listing_initial">
		

				<div class="mt-4 pt-5">

					<header class="section-title ">
						<h2 class="dark-gray">More Happenings</h2>
					</header>

					<div class="qcity-news-container">

					<?php
					/*
						The Rest of the Events 
					*/
						$i = 0;
						$today = date('Ymd');
						$wp_query = new WP_Query();
						$wp_query->query(array(
							'post_type'			=>'event',
							'post_status'		=>'publish',
							'posts_per_page' 	=> 18,
							'meta_query' 		=> array(
													array(
												        'key'		=> 'event_date',
												        'compare'	=> '>=',
												        'value'		=> $today,
												    ),
						    ),
						    /*'tax_query' => array(
								array(
									'taxonomy' => 'event_category', // your custom taxonomy
									'field' => 'slug',
									'terms' => array( '' ) // the terms (categories) you created
								)
							)*/
					));
						if ($wp_query->have_posts()) : ?>
							<section class="events">
							<?php while ($wp_query->have_posts()) : $wp_query->the_post(); 
								
									include( locate_template('template-parts/sponsored-block.php') );

								endwhile; ?>
							</section>
						<?php endif; wp_reset_postdata(); ?>

						</div>

						<div class="more ">	
						 	<a class="red qcity-load-more" data-page="1" data-action="qcity_events_load_more" >		
						 		<span class="load-text">Load More</span>
								<span class="load-icon"><i class="fas fa-sync-alt spin"></i></span>
						 	</a>
						</div>
					</div>

				</div>	

			<div class="listing_search">
					<div class="listing_search_result">				
					</div>				
			</div>

		</div>
		
			
		</main><!-- #main -->
	</div><!-- #primary -->

	<?php get_sidebar(); ?>
</div>
<?php 
get_footer();
