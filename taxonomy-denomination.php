<?php
/**
 * Template Name: Church Listings
 */

get_header();
get_template_part('template-parts/banner-church');
$obj=get_queried_object();
// echo '<pre>';
// print_r($obj);
// echo '</pre>';
?>
<div class="qcwrapper">
	<div class="listing-header">
		<div class="content-area-title">
			<header class="section-title ">
				<h2 class="dark-gray"><?php echo $obj->name; ?></h2>
			</header>
		</div>
	</div>
</div>
<div class="qcwrapper" style="margin-top:20px">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<div class="church-listing-page">

				<div class="listing_initial">

				<?php
				/*
					Denomination 
				*/
					if ( have_posts() ) : ?>
					<section class="church-list">
						<?php while ( have_posts() ) : the_post();

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
