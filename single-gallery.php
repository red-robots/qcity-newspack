<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package ACStarter
 */

	get_header(); 
	$img 	= get_field('story_image');
	$video 	= get_field('video_single_post');

	$sponsors 	= get_field('sponsors');	
	$photos 	= get_field('photos');
	//var_dump($photos);
?>

<div class="qcwrapper" style="background-color: white">
	
	<div id="primary" class="content-area" style="<?php echo ($sponsors) ? '': ' margin: 0 auto; float:none; '; ?>">
		
		<div class="single-page">
			
			<div  style="margin-bottom: 20px;">
				<div class="category "><?php get_template_part('template-parts/primary-category'); ?></div>
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				<?php //the_excerpt(); ?>
			</div>
			

			 <div class="flexslider">
			  <ul class="slides">
			  	<?php foreach( $photos as $photo):  ?>
			    <li>
			      <img src="<?php echo $photo['photo']['url']; ?>" />
			    </li>
			    <?php $i++; endforeach; ?>
			  </ul>
			</div>

		</div>


		<main id="main" class="site-main" role="main">
			<div class="qcwrapper" >

				<div class="single-page">

					<?php
					//while ( have_posts() ) : the_post();

						get_template_part( 'template-parts/content', get_post_format() );

					//endwhile; // End of the loop.

					?>

				</div>
			</div>

		<?php //get_template_part('template-parts/next-story'); ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php ($sponsors) ? get_sidebar() : ''; ?>
</div>
<?php 
get_footer();
