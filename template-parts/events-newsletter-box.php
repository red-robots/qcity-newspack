<?php if( isset($the_page_id) && $the_page_id ) {
	
	$newsletterForm = get_field("jobpage_newsletter",$the_page_id);
	$newsletter_title = get_field("newsletter_title",$the_page_id);
	$newsletter_text = get_field("newsletter_text",$the_page_id);
	if($newsletterForm) {
		$gravityFormId = $newsletterForm;
		$gfshortcode = '[gravityform id="'.$gravityFormId.'" title="false" description="false" ajax="true"]';
	 	if( do_shortcode($gfshortcode) ) { ?>
	 		<div class="jobpageNewsletter" style="display:block;">
				<div class="form-subscribe-blue">
					<div class="form-inside">
					<?php if ($newsletter_title) { ?>
						<h3 class="gfTitle"><?php echo $newsletter_title ?></h3>
					<?php } ?>
					<?php if ($newsletter_text) { ?>
						<div class="gftxt"><?php echo $newsletter_text ?></div>
					<?php } ?>
					<?php echo do_shortcode($gfshortcode); ?>
					</div>
				</div>
			</div>
		<?php } ?>
	<?php } ?>

<?php } ?>