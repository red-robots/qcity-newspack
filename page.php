<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Newspack
 */

get_header();
?>
<div class="qcwrapper">
	<section id="primary" class="content-area-full">
		<main id="qcmain" class="site-main">
			<?php

			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				// Template part for large featured images.
				if ( in_array( newspack_featured_image_position(), array( 'large', 'behind', 'beside', 'above' ) ) ) :
					get_template_part( 'template-parts/post/large-featured-image' );
				else :
				?>

					<header class="entry-header">
						<?php get_template_part( 'template-parts/header/entry', 'header' ); ?>
					</header>

				<?php endif; ?>

				<div class="main-content-full">
					<?php

					// Place smaller featured images inside of 'content' area.
					if ( 'small' === newspack_featured_image_position() ) :
						newspack_post_thumbnail();
					endif;

					get_template_part( 'template-parts/content/content', 'page' );

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						newspack_comments_template();
					}
					?>
				</div><!-- .main-content -->

			<?php
			endwhile; // End of the loop.
			//get_sidebar();
			?>

		</main><!-- #main -->
	</section><!-- #primary -->
</div>
<?php
get_footer();
