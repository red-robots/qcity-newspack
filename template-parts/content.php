<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ACStarter
 */
//$storyImage = get_field( 'story_image' );
$post_type = get_post_type();
$mod = the_modified_date('M j, Y', '', '', false);
$the_post_id = get_the_ID();
$guest_author 	= get_field('author_name') ;
$hide_ads 		= get_field('hide_ads');
$chooseAuthor 	= get_field( 'choose_author');

/* Author Photo */
$authorPhoto  	= null;		
$size         	= 'thumbnail';
$imgObj = '';
$imgSrc = '';
$aDesc = '';
$authorLinkOpen = '';
$authorLinkClose = '';
$hideAuthorPic = get_field("hide_author_photo");
$hidePic = ( isset($hideAuthorPic[0]) && $hideAuthorPic[0]=='yes' ) ? true : false;

if(!$guest_author) {
	$aName = get_the_author_meta('display_name');
	$aDesc = get_the_author_meta('description');
	$imgObj = '';
	$photoHelper = get_bloginfo('template_url') . '/images/square.png';
	$authorID = '';			
	if($chooseAuthor) {
		$authorID   = $chooseAuthor['ID'];
		$authorPhoto = get_field( 'custom_picture', 'user_' . $authorID );
	} else {
		$authorID = get_the_author_meta('ID');
		$authorPhoto = get_field('custom_picture','user_'.get_the_author_meta('ID'));
	}
	
	if($authorID) {
		$authorLinkOpen = '<a href="'.get_author_posts_url($authorID).'">';
		$authorLinkClose = '</a>';
	}

	$imgObj = ($authorPhoto) ? wp_get_attachment_image_src($authorPhoto, $size):'';
	$imgSrc = ($imgObj) ? $imgObj[0] : '';
}
if(empty($chooseAuthor)) {
	$imgObj = '';
	$imgSrc = '';
} 

$single_post_comment_text = get_field('single_post_comment_text', 'option');
$show_comment = ( isset($_GET['unapproved']) && isset($_GET['moderation-hash']) ) ? true : false;

$categories = get_the_category($the_post_id);
$is_sponsored_post = false;
if($categories) {
	foreach($categories as $c) {
		$slug = $c->slug;
		if($slug=='sponsored-post') {
			$is_sponsored_post = true;
		}
	}
}

if( !defined('HIDE_ADS') ){
	define('HIDE_ADS', $hide_ads);
}

// echo '<pre>';
// print_r($hide_ads);
// echo '</pre>';
?>


<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">

		<div class="content-single-page">		
			<?php
			if ( 'post' === get_post_type() ) : ?>
				<div class="entry-meta metacol <?php echo ($imgObj) ? 'has-custom-author':'author-default'?>">	
					<?php if( $imgObj ) { ?>
					<div class="authorPicMeta">
						<?php echo $authorLinkOpen ?>
							<?php if ($imgSrc) { ?>
							<span class="pic" style="background-image:url('<?php echo $imgSrc ?>')"></span>
							<?php } else { ?>
								<span class="nopic"><i class="fas fa-user nopicIcon"></i></span>
							<?php } ?>
							<img src="<?php echo $photoHelper ?>" alt="" class="helper">
						<?php echo $authorLinkClose ?>
					</div>
					<?php } ?>
					<div class="nameAndDate">
						<div class="authorName">By <?php echo $authorLinkOpen ?><?php echo ( $guest_author ) ? $guest_author : get_the_author(); ?><?php echo $authorLinkClose ?></div>
						<div class="postDate"><?php echo get_the_date(); ?></div>
					</div>
				</div><!-- .entry-meta -->
			<?php endif; ?>
		</div>
	</header><!-- .entry-header -->

	<div class="entry-content entry-content-v2">
		<div class="content-single-page">
		<?php
			the_content( sprintf(
						 //translators: %s: Name of current post.
						 wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'acstarter' ), array( 'span' => array( 'class' => array() ) ) ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					) );
		?>
		</div>
	</div><!-- .entry-content -->

	<div class="content-single-page">

		<?php /* SOCIAL MEDIA SHARE */ ?>
		<?php get_template_part('template-parts/sharethis-socialmedia'); ?>
		
		
		<?php /* For Mobile View Only */ ?>
		<div id="mobileBlocks" class="mobile-visible-section">
			<div id="trendingBlock" class="mobileBlock"></div>
			<!-- <div id="sponsoredContentBlock" class="mobileBlock"></div>
			<div id="relatedArticlesBlock" class="mobileBlock"></div>
			<div id="sponsoredByBlock" class="mobileBlock"></div>
			<div id="westSideConnectBlock" class="mobileBlock"></div> -->
		</div>

		<footer class="entry-footer">

			<?php if ($is_sponsored_post) { ?>

				<?php get_template_part( 'template-parts/sponsored-by-info'); ?>
				
			<?php } else { ?>

				<?php if( $aDesc ) { ?>
					<div class="author-block">
						<div class="authorData">
						
							<div class="pic-and-bio hidepic">
								<div class="authorPhoto <?php echo ($imgSrc) ? 'haspic':'nopic'; ?>">
									<a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">
										<?php if ($imgSrc) { ?>
										<span class="pic" style="background-image:url('<?php echo $imgSrc ?>')"></span>
										<?php } else { ?>
											<i class="fas fa-user nopicIcon"></i>
										<?php } ?>
										<img src="<?php echo $photoHelper ?>" alt="" class="helper">
									</a>
								</div>

								<div class="authorNameBio">
									<a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" class="name">
										<span class="authorName">
											<?php echo $aName; ?>
										</span>
									</a>

									<?php if ($aDesc) { ?>
									<div class="authorBio">
										<?php echo $aDesc; ?>
									</div>
									<?php } ?>
								</div>
							</div>
							
						</div>
					</div>
				<?php } ?>

			<?php } ?>

			<?php if ( comments_open() || get_comments_number() ) { ?>
				<?php 
					$commentCount = get_comments_number();
					$commentText = ($commentCount>1) ? ' Comments':' Comment'; 
					$isCommentZero = ($commentCount==0) ? 'nocomments':'hascomments';
				?>
				<div class="comments-section">
					<div class="comments-trigger">
						<div class="logo-holder" style="display:none;">
							<img src="<?php bloginfo('template_url'); ?>/images/qc-logo.png" alt="">
						</div>
						<div class="text-holder">
							<div style="display:none;">
								<p><?php echo $single_post_comment_text; ?>  <a id="commentBtn" class="click_class" >Click here</a></p>
							</div>
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
			<?php }  ?>

			<?php if( has_tag() ) { ?>
				<div class="tags">	
					 <?php echo get_the_tag_list(
					 	'<span class="title">This Story is Tagged: </span> ',
					 	', '
					 ); ?>
				</div>
			<?php } ?>


			<?php /*===== SUBSCRIPTION FORM =====*/ ?>
			<?php get_template_part('template-parts/news-post-newsletter') ?>
			<?php /*===== end of SUBSCRIPTION FORM =====*/ ?>


			<?php 
			$postid = get_the_ID();
			$postTerms = get_the_terms($postid,'category');
			$is_sponsored = array();
			if($postTerms) {
				foreach($postTerms as $p) {
					$slug = $p->slug;
					if($slug=='sponsored-post') {
						$is_sponsored[] = $p;
					}
				}
			}
			?>

			<div class="post-bottom-widgets">
				<div class="flexwrap">
					<?php get_template_part( 'template-parts/trending-posts-widget-bottom');	?>

					<?php if ( function_exists('rp4wp_children') ) { ?>
						<?php rp4wp_children(); ?>
					<?php } ?>
				</div>
			</div>

			<?php //get_template_part( 'template-parts/sponsored-paid');
				get_template_part( 'template-parts/sponsored-content-widget');
			?>

		</footer><!-- .entry-footer -->
	</div>

</article><!-- #post-## -->
<style type="text/css">
	body.single .subscribe-form-single .gform_wrapper {
		padding: 0;
    	background: transparent;
	}
	body.single .subscribe-form-single .gform_wrapper .gform_body {
	    width: 78%;
	    float: left;
	}
	body.single .subscribe-form-single .gform_wrapper .gform_footer {
	    margin: 0;
	    float: right;
	}
</style>



