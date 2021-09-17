<?php
/**
 * Template Name: Events (new layout)
 *
 */
get_header(); 
$page_id = get_the_ID();
$the_page_id =  get_the_ID();
$currentCategory = ( isset($_GET['category']) && $_GET['category'] ) ? $_GET['category'] : '';
$filter = ( isset($_GET['filter']) && $_GET['filter']=='thisweekend' ) ? $_GET['filter'] : '';
$paged = ( get_query_var( 'pg' ) ) ? absint( get_query_var( 'pg' ) ) : 1;
$currentURL = get_permalink();
$currentCatName = '';
$breadcrumb_current = '';

if($filter) {
	$currentURL .= '?filter='.$filter;
}
if($currentCategory) {
	$currentURL = get_permalink() . '?category='.$currentCategory;
	$currentCatArrs = get_term_by('slug',$currentCategory,'event_cat');
	$currentCatName = ($currentCatArrs) ? $currentCatArrs->name : '';
	$breadcrumb_current = $currentCatName;
}
$custom_page_title = '';
$postPerPage = 27;

$day = date('d');
$day2 = $day - 1;
$day_plus = sprintf('%02s', $day);
$today = date('Ym') . $day_plus;
?>

<div id="primary" class="content-area page-with-poweredby page-job-new pageEventsNew">
	<main id="main" class="site-main" role="main">
		<?php while ( have_posts() ) : the_post(); ?>
			<?php  
				$poweredby = get_field("poweredby");
				$logo = get_field("top_logo");
				$logo_website = get_field("top_logo_website"); 
				$link_open = '';
				$link_close = '';
				if($logo_website) {
					$link_open = '<a href="'.$logo_website.'" target="_blank">';
					$link_close = '</a>';
				}

				$subtitle = get_field("subtitle"); 
				$lastModified = get_the_modified_date('F j, Y h:i a');
				// if($subtitle) {
				// 	$subtitle = str_replace("{{","<u>",$subtitle);
				// 	$subtitle = str_replace("}}","</u>",$subtitle);
				// }

				$views = '';
				$views_display = '';
				if(function_exists('the_views')) {
					ob_start();
					the_views(); 
					$views = ob_get_contents();
					ob_clean();
					if($views) {
						$views = preg_replace('/[^0-9.]+/', '', $views);
					}
				} 
				if($views) { 
					ob_start(); ?>
					<span class="visitor-counter">
						<span>
							<em class="e1">Visitor Count</em>
							<em class="e2"><?php echo number_abbr($views); ?></em>
						</span>
					</span>
				<?php 
					$views_display = ob_get_contents();
					ob_end_clean(); 
				} 

				$main_page_title = ( get_field("alt_page_title") ) ? get_field("alt_page_title") : get_the_title();
			?>

			<?php if ($logo) { ?>
			<div class="sponsored-logo">
				<div class="wrapper">
					<span class="logo-img">
						<?php if ($poweredby) { ?>
						<span class="poweredby"><?php echo $poweredby ?></span>	
						<?php } ?>
						<?php echo $link_open ?>
						<img src="<?php echo $logo['url'] ?>" alt="<?php echo $logo['title'] ?>">
						<?php echo $link_close ?>
					</span>
				</div>
			</div>	
			<?php } ?>
			<header class="title-bar-gray">
				<div class="wrapper">
					<h1 class="t1"><?php echo $main_page_title; ?></h1>
					<?php if ($subtitle) { ?>
					<h2 class="t2"><?php echo $subtitle ?></h2>	
					<?php } ?>

					<?php if ($views_display) { ?>
						<?php echo $views_display ?>
					<?php } ?>
				</div>
			</header>

	<?php endwhile; ?>

			<?php $buttons = get_field("cta_buttons"); ?>
			<div class="entry-content">
				<div class="wrapper">
					
					<?php /* BUTTONS */ ?>
					<?php include( locate_template('template-parts/event-btn.php') ); ?>

					<?php if ($filter || $currentCategory) { ?>
					<div class="events-breadcrumbs" style="display:none">
						<a href="<?php echo get_permalink() ?>">&larr; View All Events</a>
					</div>	
					<?php } ?>

					<div class="single-page-event-wrapper fw-left">

						<div id="processing-data" class="fw-left"><span class="load-icon-2"><i class="fas fa-sync-alt spin"></i></span></div>

						<?php /* FILTER BY EVENTS THIS WEEKEND */ ?>
						<?php if ($filter) { ?>
							<?php 
							$this_saturday = date("F dS, Y", strtotime('this Saturday')); /* outputs May 22nd, 2021 */
							$this_sunday = date("F dS, Y", strtotime('this Sunday')); /* outputs May 23rd, 2021 */

							$friday = date("Y-m-d", strtotime('this Friday'));
							$saturday = date("Y-m-d", strtotime('this Saturday'));
							$sunday = date("Y-m-d", strtotime('this Sunday'));

							$todayDayName = date('l');
							$satSun = array('Saturday','Sunday');
							$compareValues = array($friday,$saturday,$sunday);
							if( in_array($todayDayName, $satSun) ) {
								$compareValues = array($saturday,$sunday);
							}

							$this_weekend = array(
								'post_type'				=>'event',
								'post_status'			=>'publish',
								'posts_per_page' 	=> $postPerPage,
								'paged'			   		=> $paged,
								'order' 					=> 'ASC',
								'meta_key' 				=> 'event_date',
								'orderby'     		=> 'meta_value_num',
								'meta_query'			=> array(
											array(
												'key'     => 'event_date',
												'value'   => $compareValues,
												'compare' => 'IN',
												'type'    => 'DATE'
											)
										)
							);

							$this_weekend_events = new WP_Query($this_weekend); ?>

							<div id="primary" class="content-area-event more-happenings-section fw-left filtered-events">
									<main id="main" class="site-main" role="main">

										<?php if ($custom_page_title) { ?>
										<header class="section-title ">
											<h1 class="dark-gray"><?php echo $custom_page_title ?></h1>
										</header>
										<?php } ?>

										<div class="page-event-list">
											<?php if ( $this_weekend_events->have_posts() )  { ?>
											<div class="listing_initial more-events-section">
												<div class="qcity-news-container">
													<div class="eventListWrap">
														<section class="events more-events-posts">
															<?php while ($this_weekend_events->have_posts()) : $this_weekend_events->the_post(); 
																	$date 		= get_field("event_date", false, false);
																	$date 		= new DateTime($date);
																	$enddate 	= get_field("end_date", false, false);
																	$enddate 	= ( !empty($enddate) ) ? new DateTime($enddate) : $date;

																	$date_start 	= strtotime($date->format('Y-m-d'));
																	$date_stop 		= strtotime($enddate->format('Y-m-d'));
																	$now 			= strtotime(date('Y-m-d'));
																	include( locate_template('template-parts/sponsored-block.php') );
																endwhile; ?>
														</section>
													</div>
												</div>
												<div id="more-posts-hidden" style="display:none;"><?php /* DO NOT DELETE!! THIS WILL BE USED AS CONTAINER FOR NEXT SET OF ITEMS FROM LOAD MORE BUTTON */ ?></div>

												<?php
					                $total_pages = $this_weekend_events->max_num_pages;
					                if ($total_pages > 1){ ?>

				                    <div id="more-bottom-button" class="more">	
														 	<a href="#" id="viewMorePosts" class="red" data-permalink="<?php echo $currentURL; ?>" data-next-page="2" data-total-pages="<?php echo $total_pages; ?>">		
														 		<span class="load-text">Load More</span>
																<span class="load-icon"><i class="fas fa-sync-alt spin"></i></span>
														 	</a>
														</div>

				                    <?php
					            	} ?>

											</div>
											<?php } else { ?>
											<div class="listing_initial more-events-section">
												<p><strong><i>There are no events this weekend.</i></strong></p>
											</div>
											<?php } ?>
										</div>

										<div class="newsLetterBottom mtop"><?php include( locate_template('template-parts/events-newsletter-box.php') ); ?></div>
									</main>
							</div>

						<?php } else { ?>

							<?php /* FILTER BY CATEGORY */ ?>
							<?php if ($currentCategory) { ?>

								<?php
									$startingJan = date('Ym') . "01";
									$cat_args = array(
										'post_type'			=>'event',
										'paged'			   	=> $paged,
										'post_status'		=> 'publish',
										'posts_per_page'=> $postPerPage,
										'order' 				=> 'ASC',
										'meta_key' 			=> 'event_date',
										'orderby'     	=> 'meta_value_num',
										'meta_query' 		=> array(
											array(
												'key'			=> 'event_date',
												'compare'	=> '>=',
												'value'		=> $startingJan,
											)		
										),
										'tax_query' => array(
											array(
												'taxonomy' 	=> 'event_cat', 
												'field' 		=> 'slug',
												'terms' 		=> array($currentCategory) 
											)
										)
									);
									
									$postsByCategory = new WP_Query($cat_args); ?>

									<div id="primary" class="content-area-event more-happenings-section fw-left">
											<main id="main" class="site-main" role="main">

												<?php if ($currentCatName) { ?>
												<header class="section-title">
													<h1 class="dark-gray"><?php echo $currentCatName ?></h1>
												</header>
												<?php } ?>

												<div class="page-event-list">
													<?php if ($postsByCategory->have_posts()) { ?>
													<div class="listing_initial more-events-section">
														<div class="qcity-news-container">
															<div class="eventListWrap">
																<section class="events more-events-posts">
																	<?php while ($postsByCategory->have_posts()) : $postsByCategory->the_post(); 
																			$date 		= get_field("event_date", false, false);
																			$date 		= new DateTime($date);
																			$enddate 	= get_field("end_date", false, false);
																			$enddate 	= ( !empty($enddate) ) ? new DateTime($enddate) : $date;

																			$date_start 	= strtotime($date->format('Y-m-d'));
																			$date_stop 		= strtotime($enddate->format('Y-m-d'));
																			$now 			= strtotime(date('Y-m-d'));
																			include( locate_template('template-parts/sponsored-block.php') );
																		endwhile; ?>
																</section>
															</div>
														</div>
														<div id="more-posts-hidden" style="display:none;"><?php /* DO NOT DELETE!! THIS WILL BE USED AS CONTAINER FOR NEXT SET OF ITEMS FROM LOAD MORE BUTTON */ ?></div>

														<?php
							                $total_pages = $postsByCategory->max_num_pages;
							                if ($total_pages > 1){ ?>

							                    <div id="more-bottom-button" class="more">	
																	 	<a href="#" id="viewMorePosts" class="red" data-permalink="<?php echo $currentURL; ?>" data-next-page="2" data-total-pages="<?php echo $total_pages; ?>">		
																	 		<span class="load-text">Load More</span>
																			<span class="load-icon"><i class="fas fa-sync-alt spin"></i></span>
																	 	</a>
																	</div>
							                    <?php
							            	} ?>

													</div>
													<?php } else { ?>
														<div class="listing_initial more-events-section">
															<p><strong><i>Sorry, there are no posts on this category.</i></strong></p>
														</div>
													<?php } ?>
												</div>

												<div id="listing-search-result" class="listing_search" style="margin-bottom: 20px; padding: 0 0 40px;">
													<div class="listing_search_result"></div>				
												</div>

												<div class="newsLetterBottom"><?php include( locate_template('template-parts/events-newsletter-box.php') ); ?></div>
												
											</main>
									</div>

								
							<?php } else { ?>

								<div id="page-events-container" class="single-page-event">

									<?php
									/* SPONSORED EVENTS */
									$postID = array();
									$i = 0;
									
									$args = array(
										'post_type'			=>'event',
										'post_status'		=>'publish',
										'posts_per_page' 	=> -1,
										'order' 			=> 'ASC',
										'meta_key' 		=> 'event_date',
										'orderby'     => 'meta_value_num',
										'meta_query' 		=> array(
											array(
												'key'		=> 'event_date',
												'compare'	=> '>=',
												'value'		=> $today,
											),		
										),
										'tax_query' => array(
											array(
												'taxonomy' 	=> 'event_category', 
												'field' 	=> 'slug',
												'terms' 	=> array( 'premium' ) 
											)
										)
									);

									$sponsored = new WP_Query($args);
									if ($sponsored->have_posts()) { ?>
									<div id="sponsored-events-section" class="qcity-sponsored-container">
										<header class="section-title ">
											<h1 class="dark-gray">Sponsored</h1>
										</header>
										<div class="eventListWrap">
											<section class="events">
												<?php while ($sponsored->have_posts()) : $sponsored->the_post(); 
													$date 		= get_field("event_date", false, false);
													$date 		= new DateTime($date);
													$enddate 	= get_field("end_date", false, false);
													$enddate 	= ( !empty($enddate) ) ? new DateTime($enddate) : $date;

													$date_start 	= strtotime($date->format('Y-m-d'));
													$date_stop 		= strtotime($enddate->format('Y-m-d')); 
													$postID[] = get_the_ID();
													include( locate_template('template-parts/sponsored-block.php') );
												endwhile; ?>
											</section>
										</div>
									</div>
									<?php } ?>

									<?php include( locate_template('template-parts/events-newsletter-box.php') ); ?>

									<?php 
									/* MORE EVENTS */
									$i = 0;
									$events = array();
									$more_args = array(
										'post_type'			=>'event',
										'paged'			   	=> $paged,
										'post_status'		=> 'publish',
										'posts_per_page'=> $postPerPage,
										'order' 				=> 'ASC',
										'meta_key' 			=> 'event_date',
										'orderby'     	=> 'meta_value_num',
										'meta_query' 		=> array(
											array(
												'key'			=> 'event_date',
												'compare'	=> '>=',
												'value'		=> $today,
											),		
										)
									);

									if($postID) {
										$more_args['post__not_in'] = $postID;
									}
									$more_events = new WP_Query($more_args);
									?>

									<div id="primary" class="content-area-event more-happenings-section fw-left">
											<main id="main" class="site-main" role="main">

												<?php if ( $more_events->have_posts() )  { ?>
												<header class="section-title qcity-more-happen">
													<h1 class="dark-gray">More Happenings</h1>
												</header>
												<?php } ?>

												<div class="page-event-list">
													<?php if ( $more_events->have_posts() )  { ?>
													<div class="listing_initial more-events-section">
														<div class="qcity-news-container">
															<div class="eventListWrap">
																<section class="events more-events-posts">
																	<?php while ($more_events->have_posts()) : $more_events->the_post(); 
																			$date 		= get_field("event_date", false, false);
																			$date 		= new DateTime($date);
																			$enddate 	= get_field("end_date", false, false);
																			$enddate 	= ( !empty($enddate) ) ? new DateTime($enddate) : $date;

																			$date_start 	= strtotime($date->format('Y-m-d'));
																			$date_stop 		= strtotime($enddate->format('Y-m-d'));
																			$now 			= strtotime(date('Y-m-d'));
																			include( locate_template('template-parts/sponsored-block.php') );
																		endwhile; ?>
																</section>
															</div>
														</div>
														<div id="more-posts-hidden" style="display:none;"><?php /* DO NOT DELETE!! THIS WILL BE USED AS CONTAINER FOR NEXT SET OF ITEMS FROM LOAD MORE BUTTON */ ?></div>

														<?php
							                $total_pages = $more_events->max_num_pages;
							                if ($total_pages > 1){ ?>

							                    <div id="more-bottom-button" class="more">	
																	 	<a href="#" id="load-more-action" class="red" data-permalink="<?php echo $currentURL; ?>" data-next-page="2" data-total-pages="<?php echo $total_pages; ?>">		
																	 		<span class="load-text">Load More</span>
																			<span class="load-icon"><i class="fas fa-sync-alt spin"></i></span>
																	 	</a>
																	</div>

							                    <?php
							            	} ?>

													</div>
													<?php } ?>
												</div>

												<div id="listing-search-result" class="listing_search" style="margin-bottom: 20px; padding: 0 0 40px;">
													<div class="listing_search_result"></div>				
												</div>
											</main>
									</div>

								</div>

							<?php } ?>

							<div id="search-result-pagination"><?php /* DO NOT DELETE!! THIS WILL BE USED FOR AJAX PAGINATION */ ?></div>

						<?php } ?>
					</div>


				</div>
			</div>
		
	</main>
</div>

<?php get_template_part('template-parts/post-event-form'); ?>

<script type="text/javascript">
jQuery(document).ready(function($){
	
	if( $("h1.dark-gray").length>0 ) {
		var articleTitle = $("h1.dark-gray").length;
		if(articleTitle==1) {
			$(".jobpageNewsletter").insertAfter('#page-events-container').addClass("bottom");
		} 
	}

	var ctr=2;
	$(document).on("click","#viewMorePosts",function(e){
		e.preventDefault();
		var n = ctr++;
		var total = $(this).attr("data-total-pages");
		var baseURL = $(this).attr("data-permalink");
		baseURL += '&pg=' + n;

		if(n<=total) {
			$("#more-bottom-button .load-text").hide();
			$("#more-bottom-button .load-icon").show();
			setTimeout(function(){
				$("#more-bottom-button .load-text").show();
				$("#more-bottom-button .load-icon").hide();
			},1000);
		}

		$("#more-posts-hidden").load(baseURL+" .more-events-posts",function(e){
			var result = $("#more-posts-hidden").html();
			var nomore = '<div style="text-align:center;color:#969696;font-size:12px;">No more post to load!</div>';
			if(result) {
				$("#more-posts-hidden .more-events-posts .story-block").addClass("animated fadeIn");
				var resultList = $("#more-posts-hidden .more-events-posts").html();
				$(".qcity-news-container .more-events-posts").append(resultList);
				
				if(n==total) {
					$("#more-bottom-button").html(nomore);
				} 
			} else {
				$("#more-bottom-button").html(nomore);
			}
		});
	});
	
});
</script>
<?php 
get_footer();
