<div class="biz-dir" style="">
	<header class="section-title ">
		<h2 class="dark-gray">Business Directory</h2>
	</header>
	<?php
	/*
		Biz Directory.
	*/

	$i = 0;
	$wp_query = new WP_Query();
	$wp_query->query(array(
		'post_type'			=>'business_listing',
		'posts_per_page' 	=> 6,
		'post_status'   	=> 'publish',
		//'paged' => $paged,
	));
	if ($wp_query->have_posts()) : ?>
	<div class="">
		<table class="business-directory-table">
	    <?php while ($wp_query->have_posts()) : $wp_query->the_post(); $i++; 
		    	if( $i == 2 ) {
		    		$cl = 'even';
		    		$i = 0;
		    	} else {
		    		$cl = 'odd';
		    	}

		    	$phone 		= get_field('phone');
		    	$website 	= get_field('website');
	    ?>
			    <tr class="row <?php echo $cl; ?>">
			    	<td><?php the_title(); ?></td>
			    	<?php if( !(is_front_page())  ): ?>
			    	<td><?php echo $phone; ?></td>
			    	<?php endif; ?>
			    	<td>
			    		<a href="<?php echo $website ?>" target="_blank">View Website</a>
			    	</td>
			    </tr>
			    
	    <?php endwhile; ?>	
	    </table>
	</div>    
	<?php endif; wp_reset_postdata(); ?>
	<div class="more">
    	<?php if( is_front_page() && is_home() ): ?>
			<a href="/business-directory/" class="red">See More</a>
		<?php else: ?>		    		
	    	<a class="red qcity-business-directory-load-more" data-page="1" data-action="qcity_business_directory_load_more" >
	    		<span class="load-text">Load More</span>
				<span class="load-icon"><i class="fas fa-sync-alt spin"></i></span>
	    	</a>
    	<?php endif; ?>
    </div>
</div>