<?php
$totalPost = get_count_stories();
$cat = get_field("story_main_page_url","option");
$storyPageLink = ($cat) ? get_term_link($cat) : '';
$story_powered_by_text = get_field("story_powered_by_text","option");
$story_sponsor_logo = get_field("story_sponsor_logo","option");
$story_sponsor_website = get_field("story_sponsor_website","option");
$story_main_title = get_field("story_main_title","option");
$single_post_comment_text = get_field('single_post_comment_text', 'option');
get_header(); ?>

<?php while ( have_posts() ) : the_post(); 
	$job_title = get_field("job_title");
	$location = get_field("location");
	$age = get_field("age");
	$info = array($job_title,$location,$age);
	$articles = get_field("story_article");
?>
<div class="new-page-fullwrap story-single-content">
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

			<div class="share-link">
				<?php if ($story_main_title) { ?>
				<span style="display:none;">
					<a href="<?php echo get_site_url() ?>/category/stories/" class="back"><i class="fas fa-share"></i> Back to <?php echo $story_main_title ?></a>
				</span>
				<?php } ?>

				<?php if ( do_shortcode('[sharethis-inline-buttons]') ) { ?>
				<a href="#" id="sharerLink"><i class="fas fa-share"></i> <span>Share</span></a>
				<div class="share">
					<div class="shareInner"><?php echo do_shortcode('[sharethis-inline-buttons]');?></div>
				</div>
				<?php } ?>
			</div>
		</div>
		<div class="arrow-down"><span></span></div>
	</div>

	<div class="new-page-content">

		<?php if ($totalPost>1 && $storyPageLink) { ?>
		<div class="story-view-all">
			<div class="story-view">
				<a href="<?php echo $storyPageLink ?>" id="viewAllStoriesBtn" class="viewAll"><span>View Other Posts</span></a>
			</div>
		</div>
		<?php } ?>
		

		<div class="new-page-wrapper">
			<div class="head">
				<h1 class="page-title"><?php the_title(); ?></h1>
				<?php if ( $info && array_filter($info) ) { ?>
				<div class="post-info">
					<?php echo implode('<span>&bull;</span>',array_filter($info)); ?>
				</div>	
				<?php } ?>
			</div>

			<?php if ($articles) { ?>
			<div class="articles-wrapper">
				<?php $i=1; foreach ($articles as $a) { 
					$title = $a['post_title'];
					$date =  $a['post_date'];
					$content = $a['post_content'];
					$images = $a['images'];
					$photos = ( isset($images['photos']) && $images['photos'] ) ? $images['photos']:"";
					$photo_caption = ( isset($images['caption']) && $images['caption'] ) ? $images['caption']:"";
					if($i==1) { ?>
					
					<article class="storypost first">
						<?php if ($photos) { 
						$countImg = count($photos); 
						$morepics = ($countImg>1) ? ' morepics':'';
						?>
						<div class="photo-wrap">
							<div class="spImages count<?php echo  $countImg?><?php echo $morepics?>">
								<?php foreach ($photos as $img) { ?>
									<div class="frame-photo">
										<img src="<?php echo $img['url'] ?>" alt="<?php echo $img['title'] ?>" class="story-image">
									</div>
								<?php } ?>
							</div>	
							<?php if ($photo_caption) { ?>
							<div class="photo-caption"><?php echo $photo_caption ?></div>	
							<?php } ?>
						</div>
						<?php } ?>

						<div class="story-wrapper">
							<?php if ($date) { ?>
								<div class="story-post-date"><span><?php echo $date ?></span></div>	
							<?php } ?>

							<?php if ($title) { ?>
								<h2 class="sptitle"><?php echo $title ?></h2>	
							<?php } ?>
							
							<?php if ($content) { ?>
								<div class="spcontent"><?php echo $content ?></div>	
							<?php } ?>	
						</div>

					</article>
					
					<?php } else { ?>

					<article class="storypost more">

						<div class="story-wrapper">
							<?php if ($date) { ?>
								<div class="story-post-date"><span><?php echo $date ?></span></div>	
							<?php } ?>

							<?php if ($title) { ?>
								<h2 class="sptitle"><?php echo $title ?></h2>	
							<?php } ?>
						</div>

						<?php if ($photos) { 
						$countImg = count($photos); 
						$morepics = ($countImg>1) ? ' morepics':''; ?>
						<div class="photo-wrap">
							<div class="spImages count<?php echo  $countImg?><?php echo $morepics?>">
								<?php foreach ($photos as $img) { ?>
									<div class="frame-photo">
										<img src="<?php echo $img['url'] ?>" alt="<?php echo $img['title'] ?>" class="story-image">
									</div>
								<?php } ?>
							</div>	
							<?php if ($photo_caption) { ?>
							<div class="photo-caption"><?php echo $photo_caption ?></div>	
							<?php } ?>
						</div>
						<?php } ?>

						
						<?php if ($content) { ?>
						<div class="story-wrapper">
							<div class="spcontent"><?php echo $content ?></div>
						</div>	
						<?php } ?>	
						

					</article>

					<?php } ?>
					
				<?php $i++; } ?>
			</div>	
			<?php } ?>
		</div>

		<?php if ( comments_open() || get_comments_number() ) { ?>
			<?php 
				$commentCount = get_comments_number();
				$commentText = ($commentCount>1) ? ' Comments':' Comment'; 
				$isCommentZero = ($commentCount==0) ? 'nocomments':'hascomments';
			?>
			<div class="story-wrapper">
				<div class="comments-section story-comments">
					<div class="comments-trigger">
						<div class="logo-holder" style="display:none;">
							<img src="<?php bloginfo('template_url'); ?>/images/qc-logo.png" alt="">
						</div>
						<div class="text-holder">
							<a href="#" id="commentInfoBtn"><span class="commentTxt"><span class="icon"><i class="far fa-comment"></i></span> <?php echo $commentCount.$commentText ?></span></a>
							
						</div>
					</div>

					<div class="comments-block <?php echo $isCommentZero ?>" style="display:block;">
						<?php 
							// If comments are open or we have at least one comment, load up the comment template.
							comments_template();			
						?>
					</div>			
				</div>
			</div>
		<?php }  ?>

	</div>
</div>
<?php endwhile; ?>

<?php /* Sponsor Info */ 
$sponsorSite = get_field("story_sponsor_website","option");
$sponsor = get_field("sponsor_text_bottom_page","option");
$s_title = ( isset($sponsor['title']) && $sponsor['title'] ) ? $sponsor['title'] : '';
$s_description = ( isset($sponsor['description']) && $sponsor['description'] ) ? $sponsor['description'] : '';
$s_logo = ( isset($sponsor['logo']) && $sponsor['logo'] ) ? $sponsor['logo'] : '';
if($s_description || $s_logo) { ?>
<div class="storySponsoredBy">
	<div class="wrapInner">
		<?php if ($s_title) { ?>
		<h2 class="ssbtitle"><?php echo $s_title ?></h2>	
		<?php } ?>
		
		<?php if ($s_logo) { ?>
		<div class="ssblogo">
			<?php if ($sponsorSite) { ?>
				<a href="<?php echo $sponsorSite ?>" target="_blank"><img src="<?php echo $s_logo['url'] ?>" alt="<?php echo $s_logo['title'] ?>"></a>
			<?php } else { ?>
				<img src="<?php echo $s_logo['url'] ?>" alt="<?php echo $s_logo['title'] ?>">
			<?php } ?>
		</div>	
		<?php } ?>

		<?php if ($s_description) { ?>
		<div class="ssbtext"><?php echo $s_description ?></div>	
		<?php } ?>
	</div>
</div>
<?php } ?>

<div id="otherPostPopUp"><div id="innerContent"></div><a href="#" id="closeStoriesModal"><span>x</span></a></div>
<script>
jQuery(document).ready(function($){
	var story_category_page = $("#viewAllStoriesBtn").attr("href");
	$(document).on("click","#viewAllStoriesBtn",function(e){
		e.preventDefault();
		$("#otherPostPopUp").addClass("animated fadeIn");
		$("#otherPostPopUp .new-page-wrapper").addClass("animated fadeInDown");
		$("body").addClass("modal-open");
	});
	$("#otherPostPopUp #innerContent").load(story_category_page +" .new-page-wrapper",function(){
		$("#closeStoriesModal").on("click",function(e){
			e.preventDefault();
			$("#otherPostPopUp").removeClass("animated fadeIn");
			$("#otherPostPopUp .new-page-wrapper").removeClass("animated fadeInDown");
			$("body").removeClass("modal-open");
		});
	});

 	$(window).scroll(function(){ 
  	var height = $(window).scrollTop();  //getting the scrolling height of window
		if(height  > 100) {
			$("body").addClass('sticky-sponsor');
		} else{
			$("body").removeClass('sticky-sponsor');
		}
	});

});
</script>
<?php 
get_footer();
