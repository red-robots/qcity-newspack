<?php
/* Exclude posts from this category */
$excludeTerm = 'sponsored-post';
$excludeCat 	= get_category_by_slug($excludeTerm); 
$excludeCatID 	= ( isset($excludeCat->term_id) && $excludeCat->term_id ) ? $excludeCat->term_id : '';
$stickyPosts = get_option('sticky_posts');
$rightPostItems = get_stick_to_right_posts();
$postWithVideos = get_news_posts_with_videos();

if($postWithVideos) {
	$rightPostItems = array_merge($rightPostItems,$postWithVideos);
}

$featured_posts = array();
$mainArgs = array(
	'post_type'    => 'post',
	'posts_per_page'    => 1,
	'post_status'  => 'publish',
	'orderby'	=> 'date', 
	'order'		=> 'DESC',
);

if($rightPostItems) {
	$mainArgs['post__not_in'] = $rightPostItems;
}

if($excludeCatID) {
	$mainArgs['tax_query'] = array(
	    array(
	        'taxonomy' => 'category',
	        'field'    => 'id',
	        'terms'    => $excludeCatID,
	        'operator' => 'NOT IN'
	    )
	);
}


$bigPost = array();
if($stickyPosts) {
	$ids = '';
	arsort($stickyPosts);
	$mainPostId = $stickyPosts[0];
	$mainPost = get_post($mainPostId);
	if($mainPost) {
		$bigPost = $mainPost;
	}
} else {
	$mainPost = get_posts($mainArgs);
	if($mainPost) {
		$bigPost = $mainPost[0];
	}
}



?>
<section class="stickies-new stickyPostsTop">

	<?php /* BIG POST */ ?>
	<?php if($bigPost) { 
		$mainID = $bigPost->ID;
		$content = $bigPost->post_content;
		$title = $bigPost->post_title;
		$date = $bigPost->post_date;
		$content = apply_filters("the_content",$content);
		$postdate = get_the_date('F d, Y',$mainID);
		$img  = get_field('story_image',$mainID);	
		$authorID = $bigPost->post_author;
		$guest_author 	=  get_field('author_name',$mainID); 
		$author_default = get_the_post_author($authorID);
		$post_author = ($guest_author) ? $guest_author : $author_default;
		$postedByArr = array($post_author,$postdate);
		$postedBy = ($postedByArr && array_filter($postedByArr) ) ? implode(" <span class='sep'>|</span> ", array_filter($postedByArr) ) : '';
		$bigPostLink = get_permalink($mainID);
		$featured_posts[] = $mainID;
		?>
		<div class="left stickLeft">
			<div class="inside">
				<article id="post-<?php echo $mainID; ?>" class="big-post">
					<div class="bigPhoto">
					<?php if( has_post_thumbnail($bigPost) ) {  ?>
						<?php echo get_the_post_thumbnail($mainID);  ?>
					<?php } elseif( $img ) { ?>
						<img src="<?php echo $img['sizes']['photo']; ?>" alt="<?php echo $img['alt']; ?>">
					<?php } else { ?>
						<img src="<?php bloginfo('stylesheet_directory'); ?>/images/default.png">
					<?php } ?>
					</div>
					<div class="info">	
						<div class="innerTxt">		
							<h3><?php echo $title; ?></h3>
							<div class="desc">
								<?php echo get_the_excerpt($mainID); ?>
							</div>
							<?php if ($postedBy) { ?>
							<div class="by">By <?php echo $postedBy; ?></div>
							<?php } ?>
						</div>	
					</div>
					<div class="article-link"><a href="<?php echo $bigPostLink; ?>"></a></div>
				</article>
			</div>
		</div>
	<?php } ?>


	<?php /* RIGHT POSTS */ ?>
	<div class="right stickRight">
	<?php 
		$maxPosts = 3;
		$theRightPosts = array();
		$rightArgs = array(
			'post_type'    => 'post',
			'posts_per_page'    => $maxPosts,
			'post_status'  => 'publish',
			'orderby'	=> 'date', 
			'order'		=> 'DESC',
		);

		if($excludeCatID) {
			$rightArgs['tax_query'] = array(
			    array(
			        'taxonomy' => 'category',
			        'field'    => 'id',
			        'terms'    => $excludeCatID,
			        'operator' => 'NOT IN'
			    )
			);
		}

		$excludeItems = array();
		if($featured_posts) {
			if($postWithVideos) {
				$excludeItems = array_merge($featured_posts,$postWithVideos);
			} else {
				$excludeItems = $featured_posts;
			}
		} else {
			$excludeItems = $postWithVideos;
		} 

		if($excludeItems) {
			$rightArgs['post__not_in'] = $excludeItems;
		}
		

		/* Get post that is set `Stick on Right Side` */
		$rightArgs['meta_query'] = array(
							        array(
							            'key'		=> 'custom_meta_post_visibility',
							            'value' 	=> '1',
							            'compare' 	=> '=',
							        )
							    );	

		$rightPosts = get_posts($rightArgs);
		$right_items = array();
		if($rightPosts) {
			$rightPostsCount = count($rightPosts);
			$stickToRightPosts = array();

			/* If posts total is less than the maximum, get the latest posts */
			if($rightPostsCount < $maxPosts) {
				
				$missing = $maxPosts - $rightPostsCount;
				$postsNum = ($missing==0) ? $maxPosts : $missing;
				
				$rightIDs = gettheids($rightPosts);
				$excludeIDs = array();
				if($rightIDs) {
					$excludeIDs = array_unique(array_merge($featured_posts,$rightIDs));
				} else {
					$excludeIDs = $featured_posts;
				}

				if($excludeIDs) {
					if($postWithVideos) {
						$excludeIDs = array_unique(array_merge($excludeIDs,$postWithVideos));
					}
				}

				if($rightPosts) {
					foreach($rightPosts as $r) {
						$x = $r->ID;
						$right_items[$x] = $r;
					}
				}
				
				/* Overwrite arguments */
				unset($rightArgs['meta_query']); /* Remove the meta query */
				$rightArgs['posts_per_page'] = $postsNum;
				if($excludeIDs) {
					$rightArgs['post__not_in'] = $excludeIDs;
				}
				$recentPosts = get_posts($rightArgs);
				if($recentPosts) {
					foreach($recentPosts as $recent) {
						$j = $recent->ID;
						$right_items[$j] = $recent;
					}
				}

			} else {
				if($rightPosts) {
					foreach($rightPosts as $r) {
						$x = $r->ID;
						$right_items[$x] = $r;
					}
				}
			}
			
		} else {
			unset($rightArgs['meta_query']);
			$rightArgs['posts_per_page'] = $maxPosts; 
			$recentPosts = get_posts($rightArgs);
			if($recentPosts) {
				foreach($recentPosts as $recent) {
					$j = $recent->ID;
					$right_items[$j] = $recent;
				}
			}
		}
		
		
		if($right_items) { ?>
			<?php foreach ($right_items as $e) { 
				$right_id = $e->ID;
				$r_title = $e->post_title;
				$pagelink = get_permalink($right_id);
				$img 	= get_field('story_image',$right_id);
				$video 	= get_field('video_single_post',$right_id);
				$embed = '';
				if( $video ) {
					$embed = youtube_setup($video);
				}
				$featured_posts[] = $right_id;
				$placeholder = get_template_directory_uri() . '/images/right-image-placeholder.png';
				$default_image = get_template_directory_uri() . '/images/default.png';
				$thumbId = get_post_thumbnail_id($right_id);
				$text = get_the_excerpt($right_id);
				$excerpt  = shortenText($text,100,' ','...');

				$rpostdate = get_the_date('F d, Y',$right_id);
				$authorID = $e->post_author;
				$guest_author 	=  get_field('author_name',$right_id); 
				$author_default = get_the_post_author($authorID);
				$post_author = ($guest_author) ? $guest_author : $author_default;
				$postedByArr = array($post_author,$rpostdate);
				$postedBy = ($postedByArr && array_filter($postedByArr) ) ? implode(" <span class='sep'>|</span> ", array_filter($postedByArr) ) : '';
				?>
				<article class="story-block stickRightBlock">
					<div class="inside">
						<div class="textwrap">
							<div class="photo story-home-right">
								<?php if( $embed ) { ?>	
									<iframe class="video-homepage"  src="<?php echo $embed; ?>"></iframe>
								<?php } elseif( has_post_thumbnail($e) ) { ?>	
									<a href="<?php echo $pagelink; ?>" class="postThumb">
										<?php 
										$xImg = wp_get_attachment_image_src($thumbId,'large');
										echo get_the_post_thumbnail($right_id); ?>
										<span class="imagebox" style="background-image:url('<?php echo $xImg[0]?>');"></span>
									</a>
								<?php } else { ?>	
									<a href="<?php echo $pagelink; ?>" class="postThumb">
										<span class="imagebox" style="background-image:url('<?php echo $default_image?>');"></span>
										<img src="<?php echo $default_image ?>" alt="">
									</a>
								<?php } ?>	
								<img src="<?php echo $placeholder ?>" alt="" aria-hidden="true" class="placeholder">	
							</div>

							<div class="desc">
								<div class="inner">
									<h3 class="ptitle"><a href="<?php echo $pagelink; ?>"><?php echo $r_title; ?></a></h3>	
									<div class="excerpt"><?php echo $excerpt; ?></div>
									<?php if ($postedBy) { ?>
									<div class="by">By <?php echo $postedBy; ?></div>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				</article>
			<?php } ?>
		<?php } ?>
	</div>
</section>
