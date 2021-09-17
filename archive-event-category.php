<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ACStarter
 */

get_header(); 
get_template_part('template-parts/banner-category');
?>

<div class="qcwrapper">

	<div class="single-page-event">

		<?php get_template_part('template-parts/event-btn'); ?>

		<header class="section-title ">
			<h1 class="dark-gray"><?php the_archive_title(); ?></h1>
		</header>

		<div id="primary" class="content-area-event">
			<main id="main" class="site-main" role="main">
				<div class="main-inner">

					<div class="listing_initial">

						<div class="qcity-news-container">

							<?php if ( have_posts() ) : ?>
					
								<section class="events">
								<?php
								
								while ( have_posts() ) : the_post(); 
									
									include( locate_template('template-parts/sponsored-block.php') );

								endwhile;

								echo '</section>';

								pagi_posts_nav();

							endif; wp_reset_postdata(); ?>

						</div>
					</div>
				</div>


			</main><!-- #main -->
		</div><!-- #primary -->

	</div>

</div>

<?php get_template_part('template-parts/post-event-form'); ?>
<?php get_footer();
