<?php
/**
 *  Create shortcode for forms
 * 
    [bartag foo="foo-value"]
 */
// 
function sponsored_events_shortcode( $atts ) {
	ob_start();
	// echo 'works';
	$day = date('d');
	$day2 = $day - 1;
	$day_plus = sprintf('%02s', $day);
	$today = date('Ym') . $day_plus;

	$wp_query = new WP_Query();
	$wp_query->query(array(
	'post_type'=>'event',
	'posts_per_page' => 3,
	'tax_query' => array(
		array(
			'taxonomy' => 'event_category', 
			'field' => 'slug',
			'terms' => array( 'premium' ) 
		)
	),
	'order' => 'ASC',
	'meta_key' => 'event_date',
	'orderby' => 'meta_value_num',
	'meta_query' => array(
		array(
			'key' => 'event_date',
			'compare' => '>=',
			'value'	=> $today,
		),		
	),
));
	if ($wp_query->have_posts()) : ?>
		<div class="wp-block-newspack-blocks-homepage-articles sponsored-events-col wpnbha is-grid columns-3 show-image image-alignbehind ts-2 is-3 is-landscape sponsored-events-col has-text-align-left">
			<div data-posts data-post-id="">
		<?php while ($wp_query->have_posts()) : $wp_query->the_post(); 
			$id = get_the_ID();
			// $startDate = get_field('event_date');
			// $endDate = get_field('end_date');
			// $startTime = get_field('event_start_time');
			// $endTime = get_field('event_end_time');
			$date 		= get_field("event_date", false, false);
			$date 		= new DateTime($date);
			$img = get_field('event_image');
		?>
		
				<article data-post-id="<?php echo $id; ?>" class="sp-event-sc tag-homepage-sponsored-event type-event post-has-image">
					<a href="<?php the_permalink(); ?>">
					<figure class="post-thumbnail">
						
							<img width="400" height="400" src="<?php echo $img['url']; ?>?resize=400%2C300&ssl=1" class="attachment-newspack-article-block-landscape-small size-newspack-article-block-landscape-small wp-post-image jetpack-lazy-image jetpack-lazy-image--handled" alt loading="eager" object-fit="cover" data-lazy-loaded="1" sizes="(max-width: 400px) 100vw, 400px">
						
					</figure>
					<div class="entry-wrapper">
						<h2 class="entry-title">
							<?php the_title(); ?>
							<div class="event-fp-date">
								<p class="event-date-sc">
									<?php echo $date->format('l'); ?>, <?php echo $date->format('F j, Y'); ?>
								</p>
							</div>
						</h2>
					</div>
					</a>
				</article>
			
<?php endwhile; ?>
		</div>
	</div>
<?php endif;
	// Spit everythng out
	return ob_get_clean();
}

add_shortcode( 'sponsored_events', 'sponsored_events_shortcode' );