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
$chooseAuthor 	= get_field( 'choose_author' );
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


?>


<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">

		<div class="content-single-page">		
			<?php
			if ( 'post' === get_post_type() ) : ?>
				<div class="entry-meta">				
					<div class="authorName">By <?php echo ( $guest_author ) ? $guest_author : get_the_author(); ?> </div>
					<div class="postDate"><?php echo get_the_date(); ?></div>
				</div><!-- .entry-meta -->
			<?php endif; ?>
		</div>
	</header><!-- .entry-header -->

	<div class="entry-content">
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

	<?php if( $subscribeCode = get_field("singleSubscriptionCode","option") ) { ?>
		<div class="ctctSubscribeForm"><div class="formWrap"><?php echo $subscribeCode ?></div></div>
	<?php } ?>

	<div class="content-single-page">

		<?php /* SOCIAL MEDIA SHARE */ ?>
		<?php if ( do_shortcode('[sharethis-inline-buttons]') ) { ?>
		<div id="shareThisPost" class="share new-share-buttons">
			<?php echo do_shortcode('[sharethis-inline-buttons]'); ?>
		</div>
		<?php } ?>

		<?php if ( comments_open() || get_comments_number() ) : ?>

		<div class="comments-section">
			<div class="comments-trigger">
				<div class="logo-holder">
					<img src="<?php bloginfo('template_url'); ?>/images/qc-logo.png" alt="">
				</div>
				<div class="text-holder">
					<p><?php echo $single_post_comment_text; ?>  <a id="commentBtn" class="click_class" >Click here</a></p>
				</div>
			</div>

			<div class="comments-block" style="display:block;">
				<?php 
					// If comments are open or we have at least one comment, load up the comment template.
					comments_template();			
				?>
			</div>			
		</div>
		<?php endif;  ?>

		<?php if( has_tag() ): ?>
		<div class="tags">	
			 <?php echo get_the_tag_list(
			 	'<span class="title">This Story is Tagged: </span> ',
			 	', '
			 ); ?>
		</div>
		<?php endif; ?>
		
		
		<?php /* For Mobile View Only */ ?>
		<div id="mobileBlocks" class="mobile-visible-section">
			<div id="trendingBlock" class="mobileBlock"></div>
			<div id="sponsoredContentBlock" class="mobileBlock"></div>
			<div id="relatedArticlesBlock" class="mobileBlock"></div>
			<div id="westSideConnectBlock" class="mobileBlock"></div>
		</div>

		<footer class="entry-footer">

			<?php if ($is_sponsored_post) { ?>
				<div class="sponsoredInfoBox"></div>
			<?php } else { ?>
				<?php if( $chooseAuthor ): ?>
					<div class="author-block">
						<?php 
							$aName 			= get_the_author_meta('display_name');
							$aDesc 			= get_the_author_meta('description');
							$size         	= 'thumbnail';
							$authorPhoto  	= null;							
						?>
						<a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">
							<div class="left">						
								<div class="photo">
									<?php 
									if ( $chooseAuthor != '' ):
										$authorID   = $chooseAuthor['ID'];
										$authorPhoto = get_field( 'custom_picture', 'user_' . $authorID );
									else:
										$authorPhoto = get_field('custom_picture','user_'.get_the_author_meta('ID'));
									endif;
									if ( $authorPhoto ):
										echo wp_get_attachment_image( $authorPhoto, $size );
									endif; //  if photo  ?>
								</div>
							</div>
							<div class="info">
								<h3><?php echo $aName; ?></h3>
								<?php echo $aDesc; ?>
							</div>
						</a>
					</div>
				<?php endif; ?>
			<?php } ?>

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

			if($is_sponsored) {
				$info = get_field("spcontentInfo","option");
        if($info) {
            $i_title = $info['title'];
            $i_text = $info['text'];
            $i_display = ($info['display'] && $info['display']=='on') ?  true : false;
        } else {
            $i_title = '';
            $i_text = '';
            $i_display = '';
        } ?>	
			
				<?php if ($i_display && $i_text) { ?>
	       <div class="sponsoredInfoWrap">
	       		<div class="sponsoredInfo"><?php echo $i_text ?></div>
	       </div>
	      <?php } ?>
      <?php } ?>


			<?php if ( function_exists('rp4wp_children') ) { ?>
				<?php rp4wp_children(); ?>
			<?php } ?>

			<?php get_template_part( 'template-parts/sponsored-paid'); ?>
		</footer><!-- .entry-footer -->
	</div>

</article><!-- #post-## -->




