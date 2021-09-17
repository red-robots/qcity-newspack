 <?php
get_header(); 
$banner_image = get_field("banner_photo");
$video = get_field("video");
$description = get_field("description");
$tier_1_desc = get_field("tier_1_desc");
$tier_2_desc = get_field("tier_2_desc");
$tier_3_desc = get_field("tier_3_desc");
$tier_1_mail = get_field("tier_1_mail");
$tier_2_mail = get_field("tier_2_mail");
$tier_3_mail = get_field("tier_3_mail");
$tier_1_btn = get_field("tier_1_btn");
$tier_2_btn = get_field("tier_2_btn");
$tier_3_btn = get_field("tier_3_btn");
$tier_1_link = get_field("tier_1_btn_link");
$tier_2_link = get_field("tier_2_btn_link");
$tier_3_link = get_field("tier_3_btn_link");
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

			<section class="tiers membership-thirds pricing-grid">
				<div class="third plan">
					<?php echo $tier_1_desc; ?>
					<div class="btn ">
						<a class="yellow " href="<?php echo $tier_1_link; ?>">
							<?php echo $tier_1_btn; ?>
						</a>
					</div>	
					
				</div>
				<div class="third plan">
					<?php echo $tier_2_desc; ?>
					<div class="btn ">
						<a class="red" href="<?php echo $tier_2_link; ?>">
							<?php echo $tier_2_btn; ?>
						</a>
					</div>	
					
				</div>
				<div class="third plan">
					<?php echo $tier_3_desc; ?>
					<div class="btn">
						<a class="red" href="<?php echo $tier_3_link; ?>">
							<?php echo $tier_3_btn; ?>
						</a>
					</div>	
					
				</div>
			</section>

			<section class="gravityform">
				<div class="gravityform_form">
					<?php echo do_shortcode('[gravityform id="30" title="false"]');  ?>
				</div>				
			</section>

			<section class="mailing-address entry-content" >
					<?php echo $mail; ?>
			</section>

			<section class="member_lists">
				<h2><?php echo __( $member_list_title ); ?></h2>
                <?php if( $members ): ?>
				<div class="members">					
					<ul>
						<?php foreach($members as $member): ?>
							<li><?php echo __( $member['member_name'] ); ?></li>
						<?php endforeach; ?>
					</ul>
				</div>
                <?php endif; ?>
			</section>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php //get_sidebar(); ?>
</div>
<?php get_footer();
