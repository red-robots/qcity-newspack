<?php
/**
 * Template Name: Single Column
 */

get_header(); ?>
<div class="qcwrapper">
	<div class="content-area-single">
	<header class="entry-header toppage">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header>
		<!-- <header class="section-title ">
			<h1 class="dark-gray"><?php the_title(); ?></h1>
		</header> -->
	</div>
</div>
<div class="qcwrapper">
	<div id="primary" class="content-area-single">
		<main id="main" class="site-main" role="main">

			<div class="single-page">

				<?php
				if( have_posts() ):
					while ( have_posts() ) : the_post(); ?>
						<div class="entry-content">
							<?php the_content(); ?>
						</div>
					<?php endwhile; // End of the loop.
				endif; wp_reset_postdata();
				?>

			</div>

		</main><!-- #main -->
	</div><!-- #primary -->

</div>
<?php get_footer();
