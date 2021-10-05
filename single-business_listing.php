<!-- single-business_listing.php -->
<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package ACStarter
 */

	get_header(); 
	get_template_part('template-parts/banner-biz');

	$photo 			= get_field('business_photo');
	$description 	= get_field('description');
	$email 			= get_field('email');
	$phone 			= get_field('phone');
	$website 		= get_field('website');
	$address  		= get_field('address');
	
	//print_r($address);
?>

<div class=qcwrapper" style="background-color: white">
	
	<div id="primary" class="content-area-full" style="margin: 0 auto; float:none;">

		<main id="main" class="site-main" role="main">
			<div class="qcwrapper" >

				<div class="listing_initial">

					<div class="single-page">
						<div class="content-single-page">
							<div  style="margin-bottom: 20px;">				
								<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>			
							</div>
						</div>
					</div>

					<div class="single-page">	
						<div class="content-single-page">
							<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
								<div class="featured_image" >	
									<img src="<?php echo $photo['sizes']['photo']; ?>" alt="">	
								</div>

								<div class="business-content">	
									<?php if($address): ?>
							            <div><span >Address:</span> <a href="https://www.google.com.ph/maps/place/<?php echo urlencode($address['address']); ?>" target="_blank"><?php echo str_replace(", United States","", $address['address']); ?></a></div>
							        <?php endif; ?>		
							        <?php if($phone): ?>				
										<div><span>Phone:</span> <?php echo esc_html($phone); ?></div>
									<?php endif; ?>
									<?php if($email): ?>
										<div><span>Email: </span> <a href="mailto:<?php echo antispambot(strtolower($email), 1); ?>"><?php echo strtolower($email); ?></a></div>
									<?php endif; ?>
									<?php if($website): ?>
										<div><a href="<?php echo $website; ?>" target="_blank"><strong>View Website</strong></a></div>
									<?php endif; ?>
								</div>
								<div class="entry-content">
									<?php get_template_part( 'template-parts/line-separator'); ?>
									<?php
										the_content( sprintf(
											/* translators: %s: Name of current post. */
											wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'acstarter' ), array( 'span' => array( 'class' => array() ) ) ),
											the_title( '<span class="screen-reader-text">"', '"</span>', false )
										) );
									?>
								</div><!-- .entry-content -->

								<div class="share">
									<?php get_template_part('template-parts/sharethis-socialmedia'); ?>
								</div>
								
							</article><!-- #post-## -->		

							<?php get_template_part('template-parts/next-story'); ?>

						</div><!-- content-single-page -->							
					</div> <!-- single-page -->

				</div>

				

			</div>

		

		</main><!-- #main -->
	</div><!-- #primary -->


</div>
<?php 
get_footer();
