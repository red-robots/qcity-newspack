<section class="next-story">
	<header class="section-title ">
		<h2 class="dark-gray">Next Story</h2>
	</header>
	<div class="qcwrapper">
		<?php 
		$theID = get_the_ID();
		wp_reset_postdata();

		$wp_query = new WP_Query();
		$wp_query->query(array(
			'post_type'=>'post',
			'posts_per_page' => 1,
			// 'post__not_in' => $theID,
			'ignore_sticky_posts' => 1,
			'tax_query' => array(
				array(
					'taxonomy' => 'category', // your custom taxonomy
					'field' => 'slug',
					'terms' => 'offers-invites'
				)
			),
		));
		if ($wp_query->have_posts()) : while ($wp_query->have_posts()) : $wp_query->the_post(); 
			include( locate_template('template-parts/story-block.php', false, false) );
		endwhile;
		endif;
		wp_reset_postdata();
		?>
		<div class="more">
			<a href="#">Load More</a>
		</div>
	</div>
</section>