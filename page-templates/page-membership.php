 <?php
/**
 * Template Name: Membership
 */

get_header(); 
$banner_image = get_field("banner_photo");
$video = get_field("video");
$description = get_field("description");
// $tier_1_desc = get_field("tier_1_desc");
// $tier_2_desc = get_field("tier_2_desc");
// $tier_3_desc = get_field("tier_3_desc");
// $tier_1_mail = get_field("tier_1_mail");
// $tier_2_mail = get_field("tier_2_mail");
// $tier_3_mail = get_field("tier_3_mail");
// $tier_1_btn = get_field("tier_1_btn");
// $tier_2_btn = get_field("tier_2_btn");
// $tier_3_btn = get_field("tier_3_btn");
// $tier_1_link = get_field("tier_1_btn_link");
// $tier_2_link = get_field("tier_2_btn_link");
// $tier_3_link = get_field("tier_3_btn_link");
$mail = get_field("mailing_address");
$member_list_title = get_field('member_list_title');
$members = get_field('members');

?>
<div class="wrapper">
	<div class="content-area-single">
	<header class="entry-header toppage">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header>
	</div>
</div>
<div class="wrapper">
	<div id="primary" class="content-area-single">
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post(); ?>
				<div class="entry-content">
					<?php the_content(); ?>
					<?php echo $description; ?>
				</div><!-- entry-content -->
			<?php endwhile; // End of the loop.
			?>

			<?php if( $tiers = get_field('tiersContent') ) { ?>
			<section class="tiers membership-thirds pricing-grid tier-flexible-content">
				<div class="tiers-content">
				<?php foreach ($tiers as $d) { 
					$tier_title = $d['title'];
					$tier_image = $d['image'];
					$tier_description = $d['description'];
					$tier_button_name = $d['button_name'];
					$tier_button_link = $d['button_link'];
					$tier_link_target = ( isset($d['newtab'][0]) && $d['newtab'][0]=='yes' ) ? '_blank':'_self';
					$tier_button_color = ($d['button_color'] && $d['button_color']=='gold') ? 'gold':'default';
					if(($tier_image || $tier_description) || ($tier_button_name && $tier_button_link) ) { ?>
					<div class="tier-info type-<?php echo $tier_button_color ?>">
						<div class="inner">
							<?php if ($tier_image) { ?>
							<figure class="tier-feat-image">
								<img src="<?php echo $tier_image['url'] ?>" alt="<?php echo $tier_image['title'] ?>" class="tier-image">
							</figure>	
							<?php } ?>

							<?php if ($tier_description) { ?>
							<div class="tier-text"><?php echo $tier_description ?></div>
							<?php } ?>

							<?php if ($tier_button_name && $tier_button_link) { ?>
							<div class="tier-button">
								<a href="<?php echo $tier_button_link ?>" target="<?php echo $tier_link_target ?>" class="tier-btn <?php echo $tier_button_color ?>"><?php echo $tier_button_name ?></a>
							</div>
							<?php } ?>
						</div>
					</div>
					<?php } ?>
				<?php } ?>
				</div>
			</section>
			<?php } ?>

			<?php if ( do_shortcode('[gravityform id="30" title="false"]') ) { ?>
			<section class="gravityform">
				<div class="gravityform_form">
					<?php echo do_shortcode('[gravityform id="30" title="false"]');  ?>
				</div>				
			</section>
			<?php } ?>

			<?php if ($mail) { ?>
			<section class="mailing-address entry-content" >
				<?php echo $mail; ?>
			</section>
			<?php } ?>
			
			<?php if( $members ) { ?>
			<section class="member_lists">
				<h2><?php echo __( $member_list_title ); ?></h2>
				<div class="members">					
					<ul>
						<?php foreach($members as $member): ?>
							<li><?php echo __( $member['member_name'] ); ?></li>
						<?php endforeach; ?>
					</ul>
				</div>
			</section>
			<?php } ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php //get_sidebar(); ?>
</div>
<?php get_footer();
