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
		'posts_per_page' 	=> 7,
		'post_status'   	=> 'publish',
		'orderby' 			=> 'rand',
		'tax_query' => array(
							array(
						        'taxonomy' => 'business_classification',
						        'field' => 'slug',
						        'terms' => array( 'featured' ),
						        'include_children' => false,
						        'operator' => 'IN'
						    )
		 				)		
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
			    	<td>
			    		<a href="<?php echo get_the_permalink() ?>" >More Info</a>
			    	</td>
			    </tr>
			    
	    <?php endwhile; ?>	
	    </table>
	</div>

	<div class="more">    	
			<a href="<?php bloginfo('url'); ?>/business-directory/" class="red">See More</a>
    </div>

	<?php else: ?>   
	
	<div>No Posts available</div>
	
    <?php endif; wp_reset_postdata(); ?>
</div>