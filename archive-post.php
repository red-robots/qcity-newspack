<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ACStarter
 */

get_header(); 
$obj = get_queried_object();
$current_term_id = ( isset($obj->term_id) && $obj->term_id ) ? $obj->term_id : '';
$current_term_name = ( isset($obj->name) && $obj->name ) ? $obj->name : '';
$current_term_slug = ( isset($obj->slug) && $obj->slug ) ? $obj->slug : '';
$whichCatId = get_field("elect_which_category","option");

if($current_term_slug=='stories') {

	get_template_part('template-parts/content-category-stories');

} else { ?>

	<?php if($whichCatId==$current_term_id) { ?>

		<?php get_template_part('template-parts/content-category-elections'); ?>

	<?php } else { ?>

		<?php get_template_part('template-parts/banner-category'); ?>

		<div class="qcwrapper">
			<div class="archive_post_title">
				<div class="content-area-title">
					<header class="section-title ">
						<h1 class="dark-gray"><?php single_cat_title();//the_archive_title(); ?></h1>
					</header>
				</div>
			</div>
		</div>
		<div class="qcwrapper">
			<div id="primary" class="content-area">
				<main id="main" class="site-main" role="main">

					<div class="category-post">		

						<?php if ( have_posts() ) : ?>
							<?php
							$i=0;
							/* Start the Loop */
							while ( have_posts() ) : the_post(); 
								if( !is_paged() ) : $i++;
									if( $i == 1 ) {
										get_template_part( 'template-parts/story-first-block' );
										echo '<div class="second-row ">';
										
									} else {
										get_template_part( 'template-parts/story-block-category' );
									}
								else : $i++;
									if( $i == 1 ) {
										echo '<div class="second-row ">';
									}
									get_template_part( 'template-parts/story-block-category' );
								endif;

								get_template_part( 'template-parts/separator');

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

	<?php } ?>

<?php } ?>

<?php get_footer();
