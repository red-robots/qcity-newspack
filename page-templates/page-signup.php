<?php
/**
 * Template Name: Sign Up Page
 */

get_header(); 
$packages = get_field('packages');

?>
<div class="wrapper">
	<div class="content-area-single">
	<header class="entry-header toppage">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header>
		<!-- <header class="section-title ">
			<h1 class="dark-gray"><?php the_title(); ?></h1>
		</header> -->
	</div>
</div>
<div class="wrapper">
	<div id="primary" class="content-area-single">
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post(); ?>
				<div class="entry-content">
					<?php the_content(); ?>
				</div><!-- entry-content -->
			<?php endwhile; // End of the loop.
			?>

		<?php /*if( $packages ): ?>
			<section class="tiers membership-thirds pricing-grid signup">

				<?php foreach( $packages as $package): 

					$title 	= $package['package_title'];
					$desc 	= $package['package_details'];

					?>
					<?php if( $title ): ?>
					<div class="third plan">
						<h3><?php echo $title; ?></h3>
						<?php echo $desc; ?>						
					</div>
					<?php endif; ?>
				<?php endforeach; ?>
				
			</section>
		<?php endif;  */ ?>
			

		</main><!-- #main -->
	</div><!-- #primary -->

<?php //get_sidebar(); ?>
</div>
<?php get_footer();
