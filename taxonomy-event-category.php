<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ACStarter
 */

get_header(); 
//get_template_part('template-parts/banner-biz');
$ob = get_queried_object();

$add_business = get_field('add_your_business');
$add_business_link = get_field('add_business_link');

//var_dump($add_business);

?>

<div class="qcwrapper">
	<header class="page-header biz">		
		<h1><?php echo $ob->name; ?></h1>
		<?php
			//the_archive_title( '<h1 class="page-title">', '</h1>' );
			the_archive_description( '<div class="taxonomy-description">', '</div>' );
		?>
	</header><!-- .page-header -->
	<div class="featured_business">
		<header class="section-title ">
			<h2 class="dark-gray">All Events</h2>
			<div class="biz-submit">
				<a href="/business-directory/business-directory-sign-up/">Submit your business</a>
			</div>
		</header>
	</div>
	<div class="clear"></div>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) : ?>
			<div class="qcity-news-container">
				<section class="events">
					<?php
					/* Start the Loop */
					while ( have_posts() ) : the_post();

						include( locate_template('template-parts/sponsored-block.php') );

					endwhile;

					wp_reset_postdata(); ?>
				
				</section>

			</div>
			
			

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
</div>
<?php get_footer();
