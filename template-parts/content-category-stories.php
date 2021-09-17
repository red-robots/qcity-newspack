<?php
$story_powered_by_text = get_field("story_powered_by_text","option");
$story_sponsor_logo = get_field("story_sponsor_logo","option");
$story_sponsor_website = get_field("story_sponsor_website","option");
?>
<div class="new-page-fullwrap">
	<div class="top-page">
		<div class="pageWrap">
			<div class="sponsor-info">
				<?php if ($story_powered_by_text) { ?>
				<div class="poweredbytext"><?php echo $story_powered_by_text ?></div>	
				<?php } ?>
				<?php if ($story_sponsor_logo) { ?>
				<div class="sponsor-logo">
					<?php if ($story_sponsor_website) { ?>
						<a href="<?php echo $story_sponsor_website ?>" target="_blank"><img src="<?php echo $story_sponsor_logo['url'] ?>" alt="<?php echo $story_sponsor_logo['title'] ?>"></a>
					<?php } else { ?>
						<img src="<?php echo $story_sponsor_logo['url'] ?>" alt="<?php echo $story_sponsor_logo['title'] ?>">
					<?php } ?>
				</div>	
				<?php } ?>
			</div>

		</div>
		<div class="arrow-down"><span></span></div>
	</div>

	<?php  
	$story_main_title = get_field("story_main_title","option");
	$story_page_description = get_field("story_page_description","option");
	?>
	<div class="new-page-content">
		<div class="new-page-wrapper">
			<div class="page-heading">
				<?php if ($story_main_title) { ?>
					<p class="main-title"><?php echo $story_main_title ?></p>
				<?php } ?>
				<?php if ($story_page_description) { ?>
					<div class="main-text"><?php echo $story_page_description ?></div>
				<?php } ?>
			</div>

			<?php
			$placeholder = get_bloginfo("template_url") . "/images/square.png";
			$args = array(
				'posts_per_page'   => -1,
				'post_type'        => 'story',
				'post_status'      => 'publish',
				'paged'			   => $paged
				);
			$posts = new WP_Query($args);
			if ( $posts->have_posts() ) { ?>
			<div class="story-posts">
				<div class="flexwrap">
					<?php while ( $posts->have_posts() ) : $posts->the_post(); 
						$thumbnail_photo = get_field("thumbnail_photo");
						$story_description = get_field("story_description");
						$title = get_the_title();
						$bg = ($thumbnail_photo) ? ' style="background-image:url('.$thumbnail_photo['url'].')"':'';
						$pagelink = get_permalink();
					?>
						<div class="story">
							<div class="photo <?php echo ($thumbnail_photo) ? 'hasphoto':'nophoto'; ?>">
								<a href="<?php echo $pagelink ?>" class="link imgdiv"<?php echo $bg ?>>
									<img src="<?php echo $placeholder ?>" alt="" aria-hidden="true">
									<span class="title"><span class="txt"><?php echo $title ?></span></span>
								</a>
								<?php if ($story_description) { ?>
								<div class="short-desc"><?php echo $story_description ?></div>	
								<?php } ?>
							</div>
						</div>

					<?php endwhile; wp_reset_postdata(); ?>
				</div>
			</div>
			<?php } ?>

		</div>
	</div>

</div>

