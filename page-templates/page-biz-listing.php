<?php
/**
 * Template Name: Qcity Biz Listing
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
	<div class="content-area-title">
		<header class="section-title ">
			<h1 class="dark-gray"><?php the_title(); ?></h1>
		</header>
	</div>
</div>
<div class="wrapper">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			/*
				Business Listing per Category 


			*/
				$args = array(
					'post_type'=>'business_listing',
					'posts_per_page' => 5,
				);

				$today = date('Ymd');
				$wp_query = new WP_Query();
				$wp_query->query(array(
				'post_type'=>'job',
				'posts_per_page' => 5,
				// 'meta_query' => array(
				// 	array(
				//         'key'		=> 'event_date',
				//         'compare'	=> '<=',
				//         'value'		=> $today,
				//     ),
			 //    ),
			));
				if ($wp_query->have_posts()) : ?>
				<div class="jobs-page">
					<div class="biz-job-wrap">
					<?php while ($wp_query->have_posts()) : $wp_query->the_post(); 
						// $img = get_field('event_image');
						// $date = get_field("event_date", false, false);
						// $date = new DateTime($date);
						// $enddate = get_field("end_date", false, false);
						// $enddate = new DateTime($enddate);
					 	$img = get_field('image');
				    	$jobTitle = get_field("job_title");
						$companyName = get_field("company_name");
						?>
						
							<div class="job">
					    		<div class="img">
					    			<img src="<?php echo $img['url']; ?>"  alt="<?php echo $img['alt']; ?>">
					    		</div>
					    		<div class="info">
					    			<h3><?php the_title(); ?></h3>
					    			<h4><?php echo $companyName; ?></h4>
					    			<div class="date"><?php echo get_the_date(); ?></div>
					    		</div>
					    		<div class="view">
					    			<div class="viewlink">
					    				<a href="<?php the_permalink(); ?>">View Post</a>
					    			</div>
					    		</div>
					    	</div>

						<?php endwhile; ?>
					</div>
				</div>
				<?php endif; ?>

			

		</main><!-- #main -->
	</div><!-- #primary -->

	<?php get_sidebar(); ?>
</div>
<?php 
get_footer();
