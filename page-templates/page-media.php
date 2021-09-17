<?php
/**
 * Template Name: Media Template
 *
 * 
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ACStarter
 */

get_header(); 

?>
<div class="wrapper">
	<div class="archive_post_title">
		<div class="content-area-title">
			<header class="section-title ">
				<h2 class="dark-gray">Media Gallery</h2>
			</header>
		</div>
	</div>
</div>

<div class="wrapper">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<div class="category-post">		
			
			
				<?php 

				$args = array(
						'post_type' 		=> 'gallery',
						'post_status' 	    => 'publish',
						'posts_per_page' 	=> 10,
				);

				$wp_query = new WP_Query( $args );


				if ( $wp_query->have_posts() ) : 
					$i=0;
					/* Start the Loop */
					echo '<div class="second-row ">';
						while ( $wp_query->have_posts() ) : $wp_query->the_post(); 						
								get_template_part( 'template-parts/story-block-media' );
						endwhile;
					echo '</div>';

					pagi_posts_nav();

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif; ?>

			</div>

		</main><!-- #main -->
	</div><!-- #primary -->

	<?php get_sidebar(); ?>
</div>
<?php get_footer();
