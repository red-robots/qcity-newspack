<?php
/**
 * Template Name: Church Listings
 */

get_header();
get_template_part('template-parts/banner-church');
?>
<div class="wrapper">
	<div class="listing-header">
		<div class="content-area-title">
			<header class="section-title ">
				<h2 class="dark-gray">All Churches</h2>
			</header>
		</div>
	</div>
</div>
<div class="wrapper">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<div class="church-listing-page">
				<div class="listing_initial">

				<?php
				/*
					Church listing
				*/
					$i = 0;
					$today = date('Ymd');
					$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
					$wp_query = new WP_Query();
					$wp_query->query(array(
										'post_type'			=> 'church_listing',
										'post_status'       => 'publish',
										'posts_per_page' 	=> 15,
										'order' 			=> 'ASC',
										'orderby' 			=> 'title',
										'paged'				=> $paged
					));
					if ($wp_query->have_posts()) : ?>
						<section class="church-list">
						<?php while ( $wp_query->have_posts() ) : ?>
							<?php $wp_query->the_post();

								include(locate_template('template-parts/church.php')) ;

							endwhile; 

							pagi_posts_nav();

							?>
						</section>
					<?php endif; wp_reset_postdata(); ?>

				</div>

				<div class="listing_search">
					<div class="listing_search_result">				
					</div>				
				</div>


			</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar('church'); ?>
</div>
<?php get_footer();
