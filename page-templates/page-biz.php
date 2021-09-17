<?php
/**
 * Template Name: Qcity Biz
 *
 * 
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ACStarter
 */

get_header(); 
get_template_part('template-parts/banner-biz');
?>
<div class="wrapper">
	<div class="listing-header">
		<div class="content-area-title">
			<header class="section-title ">
				<h2 class="dark-gray">Find a Business by Category</h2>
			</header>
		</div>
	</div>
</div>
<div class="wrapper">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<div class="listing_initial">

			<section class="biz-cats">

			<?php				

				if( have_posts() ):

					while ( have_posts() ) : the_post();

						$business_category = array();
						$terms = get_terms('business_category');

					    foreach ($terms as $category) {
					    	if( $category->count > 0 ):

					    		$icon = get_field('icon', $category);

						    	$business_category[] = array(
						    				'name' 	=> $category->name,
						    				'url' 	=> get_term_link($category->term_id),
						    				'icon'	=> $icon['url']
						    	);
					    	endif;
					    }

					    array_multisort($business_category, SORT_ASC, $terms);
											
						include( locate_template('template-parts/business-categories.php'));

					endwhile; // End of the loop.

				endif;
				wp_reset_postdata();
			?>

			</section>

			</div>

			<div class="listing_search">
				<div class="listing_search_result">				
				</div>				
			</div>

		</main><!-- #main -->
	</div><!-- #primary -->

	<?php get_sidebar(); ?>
</div>
<?php 
get_footer();
