<?php
/**
 * Template Name: Membership Page (new layout)
 */
get_header(); ?>
<div id="primary" class="content-area-full generic-page new-membership-page">
	<main id="main" class="site-main qcwrapper" role="main">
		<div class="logo">
    	<a href="<?php bloginfo('url'); ?>" style="background: transparent;">
      	<img src="<?php bloginfo('template_url'); ?>/images/qc-logo.png" alt="<?php bloginfo('name'); ?>">
      </a>
    </div>
		<?php while ( have_posts() ) : the_post(); ?>

			<h1 class="page-title" style="display:none;"><?php the_title(); ?></h1>
			<?php if ( get_the_content() ) { ?>
			<div class="page-entry-content"><?php the_content(); ?></div>	
			<?php } ?>

			<?php 
			$form_text = get_field("form_text"); 
			$donations_label = get_field("donations_label"); 
			$donation_bottom_text = get_field("donation_bottom_text"); 
			$donation_amounts = get_field("donation_amounts"); 
			// $membershipForm = get_field("gty_membership_form"); 
			// $gfshortcode = '';
			// if($membershipForm) {
			// 	$gfshortcode = '[gravityform id="'.$membershipForm.'" title="false" description="false" ajax="true"]';
			// }
			if($form_text || $donation_bottom_text || $donation_amounts) { ?>	
				<div class="membership-form-wrap">
					<div class="form-inner">
						<?php if ($form_text) { ?>
						<div class="form-text"><?php echo $form_text ?></div>	
						<?php } ?>
						<?php if ($donations_label) { ?>
							<p class="formLabel"><?php echo $donations_label ?></p>
						<?php } ?>
						<?php if ($donation_amounts) { ?>
						<div class="donations">
							<ul>
							<?php foreach ($donation_amounts as $d) { 
								$default = ( isset($d['default']) && $d['default'] ) ? true : false;
								$link = ($d['link']) ? $d['link'] : '#';
								$amount = ($d['amount']) ? preg_replace("/\s+/", " ", $d['amount']) : "";
								$amountstr  = ( $amount && preg_replace("/\s+/", "", $amount) ) ? strtolower(preg_replace("/\s+/", "-", $amount)) : "";
								$is_other = false;
								if (strpos($amountstr, 'other-amount') !== false) {
								  $is_other = true;
								}
								$button_class = ($default) ? ' default':'';
								$button_class .= ($is_other) ? ' other':' amount';
								$target = ' target="_blank" ';
								if($link=="#") {
									$link = "javascript:void(0)";
									$target = '';
								}
								?>
								<li>
									<a href="<?php echo $link ?>"<?php echo $target ?>class="tier-btn amount-btn <?php echo $button_class ?>"><?php echo $amount ?></a>
								</li>
							<?php } ?>
							</ul>
						</div>
						<?php } ?>
					
						<?php if ($donation_bottom_text) { ?>
						<div class="donation-bottom-text">
							<?php echo $donation_bottom_text ?>
						</div>	
						<?php } ?>
					</div>
				</div>

				
			<?php } ?>

			
		
		<?php endwhile; ?>

	</main><!-- #main -->
</div><!-- #primary -->
<script>
jQuery(document).ready(function($){
	$(".donations a.tier-btn").click(function(){
		$(".donations a.tier-btn").removeClass("default").not(this);
		$(this).addClass("default");
	});
});	
</script>
<?php get_footer();
