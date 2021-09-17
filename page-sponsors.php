<?php
/**
 * Template Name: Sponsors Page 
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ACStarter
 */

get_header(); ?>
<div class="qcwrapper">
	<div class="content-area-single">
	<header class="entry-header toppage">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header>		
	</div>
</div>
<div class="qcwrapper">
	<div id="primary" class="content-area-single">
		<main id="main" class="site-main" role="main">
			<?php
			while ( have_posts() ) : the_post(); ?>
				<div class="entry-content">
					<?php the_content(); ?>
				</div>
			<?php 
			endwhile; // End of the loop.
			wp_reset_postdata();
			?>

			
			<section class="biz-cats">
				
				<?php
					$args = array(
						'post_type' 		=> 'sponsor',
						'post_status'  		=> 'publish',
						'posts_per_page'   	=> -1,
					);

					$query = new WP_Query($args);

					if( $query->have_posts() ):

						while ( $query->have_posts()) : $query->the_post();

							if( $i == 2 ) {
					    		$cl = 'even';
					    		$i = 0;
					    	} else {
					    		$cl = 'odd';
					    	}
							
							$logo 			= get_field('logo');
							$sponsor_site 	= get_field('logo_hyperlink');
							$displays		= get_field('display_to_public');

							if( $displays == 'yes' ):

								if($logo):
									$url 	= $logo['url'];
									$link 	= $logo['link'];
									//$title 	= $query->get_the_title();
							?>
							  
							  <div class="cat">
								<a href="<?php echo ($sponsor_site) ? $sponsor_site : '#'; ?>" target="_blank">
									<div class="icon">
										<img src="<?php echo $url; ?>" alt="">
									</div>
									<h2><?php the_title();  ?></h2>
								</a>
							</div>
							    
							
						<?php 
								endif; // logo
							endif; // display

						endwhile;

					endif;
					wp_reset_postdata();
					
				?>	
				
			</section>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php //get_sidebar(); ?>
</div>
<?php get_footer();
