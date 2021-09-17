<?php
/**
 * Template Name: Two Column
 */

get_header(); 

$rightCol = get_field('right_content');
$pClass = '';
if( is_page('contact-us') ) {
	$pClass = 'contact';
}
?>
<div class="wrapper">
	<div class="two-column-page">
		<header class="entry-header toppage">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</header>
	</div>	
</div>
<div class="wrapper">
	
	<div id="primary" class="left">
		<main id="main" class="site-main" role="main">

			<div class="two-column-page">
			
				<?php
				while ( have_posts() ) : the_post(); ?>
					<div class="entry-content ">
						<?php the_content(); ?>
					</div>
				<?php endwhile; // End of the loop.
				?>

			</div>

		</main><!-- #main -->
	</div><!-- #primary -->
	<div class="right">
		<div class="entry-content <?php echo $pClass; ?>">
			<?php echo $rightCol; ?>
		</div>
	</div>

</div>
<?php get_footer();
