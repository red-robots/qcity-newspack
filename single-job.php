<!-- single-job.php -->
<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package ACStarter
 */

get_header(); 

?>

<div class="qcwrapper">
	<div id="primary" class="content-area job-details-page">
		<main id="main" class="site-main" role="main">

			<div class="single-job-page">

				<?php
				while ( have_posts() ) : the_post(); 
					
				?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header event">
						<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
						<div class="company-logo">
							<?php $image = get_field('image');
							$company_name = get_field("company_name");
							if( $company_name == '' ) {
 								$company_name = get_the_excerpt();
							}


							?>
						</div>
					</header><!-- .entry-header -->

					<?php if (function_exists('wpp_get_views')):?>
						<div class="data"> 
							<header>
								<h2><?php echo $company_name;?></h2>
							</header>
							<div class="extras">
								<div class="date">Posted:&nbsp;<?php echo get_the_date(); ?></div><!--.date-->
								<div class="views">
									Views:&nbsp;<?php echo wpp_get_views( get_the_ID() );?>
								</div><!--.views-->
							</div>
							
						</div><!--.data-->
					<?php endif;?>

					<?php 
					$job_description = get_field("job_description");
					if($job_description):?>
						<div class="copy">
							<?php echo $job_description; ?>
						</div><!--.copy-->
					<?php endif;?>	


					<?php 
					$how_to_apply = get_field("how_to_apply");
					$application_direct = get_field("application_direct");
					$application_email = get_field("application_email");?>
					<?php if(strcmp($how_to_apply,"direct")==0&&$application_direct):?>
						<div class="application button">
							<a class="button" href="<?php echo $application_direct;?>" target="_blank">
								Apply
							</a>
						</div><!--.application-->
					<?php elseif($application_email):?>
						<div class="application button application-email">
							<a class="button" href="mailto:<?php echo $application_email;?>">
								Email Resume
							</a>
						</div><!--.application-->
					<?php endif;

					$mailto_subject 	= get_field("mailto_subject",48778);
					$mailto_body 		= get_field("mailto_body",48778);
					$mailto_button_text = get_field("mailto_button_text",48778);

					if( $mailto_body && $mailto_button_text && $mailto_subject ):?>
						<div class="mail button email-friend">
							<a class="button" href="mailto:?subject=<?php echo str_replace(" ","%20",$mailto_subject);?>&amp;body=<?php echo str_replace(" ","%20",$mailto_body);?>%20<?php echo get_permalink();?>"><?php echo $mailto_button_text;?></a>
						</div>
					<?php endif;?>

					<?php $args = array(
						'post_type'=>'job',
						'posts_per_page' => -1,
						'orderby'=>'name',
						'order'=>'DESC'
					);
					$posts = get_posts($args);
					$index = array_search($post,$posts);
					if($index !== false && count($posts)>1):?>
						<div class="clear"></div>
						<nav class="nav-single">
							<!--<h3 class="assistive-text"><?php _e( 'Post navigation', 'twentytwelve' ); ?></h3> -->
							
							<?php if(count($posts) >2):?>								
								<?php $previous_index = $index > 0 ? $index -1 : count($posts) -1;?>
								<div class="nav-previous">
									<h4 class="show">Previous Job</h4>
									<a href="<?php echo get_the_permalink($posts[$previous_index]);?>">										
										<?php echo $posts[$previous_index]->post_title;?>
									</a>
								</div>
							<?php endif;?>

							<?php $next_index = $index < (count($posts) -1) ? $index +1 : 0; ?>
							<div class="nav-next">
								<h4 class="show">Next Job</h4>
								<a href="<?php echo get_the_permalink($posts[$next_index]);?>"><?php echo $posts[$next_index]->post_title;?>
								</a>
							</div>

						</nav><!-- .nav-single -->
					<?php endif;?>
				<?php endwhile; // end of the loop.?>


				<?php get_template_part('template-parts/sharethis-socialmedia'); ?>
					
				</article><!-- #post-## -->

				
			</div>


		</main><!-- #main -->
	</div><!-- #primary -->
	

	<div class="widget-area job-post" style="padding-top: 22px;">
    	<?php
			$post_id = get_the_ID();
			$title = 'Black Business';
			$qp = 'black-business';
			$args = array(     
			      'category_name'     => 'black-business',        
			      'post_type'         => 'post',        
			      'post__not_in'      => array( $post_id ),
			      'post_status'       => 'publish',
			      'posts_per_page'    => 5,		       
			);
    	
		$wp_query = new WP_Query( $args );	

		if ($wp_query->have_posts()) : ?>
			<div class="next-stories">
				<h3><?php echo $title; ?></h3>
				<div class="sidebar-container">
					<?php while ($wp_query->have_posts()) : $wp_query->the_post();

						get_template_part( 'template-parts/sidebar-black-biz-block');
						
					endwhile; wp_reset_postdata();  ?>
				</div>
				<div class="more">
					<a class="gray qcity-sidebar-load-more" data-page="1" data-action="qcity_sidebar_load_more" data-qp="<?php echo $qp; ?>" data-postid="<?php echo $post_id; ?>">
						<span class="load-text">Load More</span>
						<span class="load-icon"><i class="fas fa-sync-alt spin"></i></span>
					</a>
				</div>	
		<?php endif; ?>
	</div>

</div>
<?php 
get_footer();
