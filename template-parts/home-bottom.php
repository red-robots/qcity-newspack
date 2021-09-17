<section class="home-bottom">
	<!-- Sponsors -->
		


	<div class="jobs">
		<header class="section-title ">
			<h2 class="dark-gray">Jobs</h2>
		</header>

		

		<?php
		/*
			Jobs.
		*/
			$wp_query = new WP_Query();
			$wp_query->query(array(
				'post_type'=>'job',
				'posts_per_page' => 2,
				'paged' => $paged,
			));
			if ($wp_query->have_posts()) : ?>
			<div class="biz-job-wrap">
			    <?php while ($wp_query->have_posts()) : $wp_query->the_post(); 
			    $img = get_field('image');
			    $jobTitle = get_field("job_title");
				$companyName = get_field("company_name");
			    ?>
			    	<div class="job">			    		
			    		<div class="home-job-info">
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
			    <div class="more">
			    	<a class="red" href="<?php bloginfo('url'); ?>/job-board">See More</a>
			    </div>
			<?php endif; wp_reset_postdata(); ?>

	</div>
	
	<?php 
		// get_template_part('template-parts/business-directory-footer'); 
		get_template_part('template-parts/home-bottom-widget'); 
	?>
	
		<!--- Advertisements -->
		<div class="ad" style="display:none; text-align: center;">
	    <div class="desktop-version align-center">
	    	<!-- Business Directory Home -->
	        <?php $ads_bottom = get_ads_script('business-directory-home'); 
	            echo $ads_bottom['ad_script'];
	        ?>   
	        <!-- /1009068/inline_3 hard coded <div id='div-gpt-ad-inline_3'> <script> googletag.cmd.push(function() { googletag.display('div-gpt-ad-inline_3'); }); </script> </div>-->              
	    </div>
	    <!-- Business Directory Home -->
		</div>

    <div class="mobile-version hearken" style="display:none!important">
    	<?php if( $right_rail = get_ads_script('right-rail') ) {  ?>
			<div class="mobile-bottom-ads">
				<?php echo $right_rail['ad_script']; ?>
					<!-- /1009068/inline_1 hard coded 
					<div id='div-gpt-ad-inline_1'> <script> googletag.cmd.push(function() { googletag.display('div-gpt-ad-inline_1'); }); </script> </div>-->
					</div>
    	    </div>

				</div>
    	<?php } ?>
    </div>

    <div class="mobile-version" style="margin-top: 20px; text-align: center"> <!-- Business Directory Home -->
    	<?php $biz_dir =  get_ads_script('business-directory-home'); echo $biz_dir['ad_script']  ?>    
    	<!-- /1009068/inline_3 hard coded 
    	<div id='div-gpt-ad-inline_3'> <script> googletag.cmd.push(function() { googletag.display('div-gpt-ad-inline_3'); }); </script> </div>  -->          
    </div> <!-- Business Directory Home -->


    <?php /* SUBSCRIPTION FORM */ ?>
    <div class="ad" style="display: inline-block; text-align: center;">
    <?php get_template_part('template-parts/subscription/west-side'); ?>
  	</div>

</section>