<?php
$post_id = get_the_ID();
$formID = get_field("newsletterFormPost","option");
$default = get_field("enableNewsletterPost","option");
$has_default = ( isset($default[0]) && $default[0]=='yes' ) ? true : false;
$assignedCategories = get_field("newsletterTextsPost","option");
$terms = get_the_terms($post_id,"category");
$cat_ids = array();
$customTitle = '';
$customText = '';
if($terms) {
	foreach($terms as $t) {
		$id = $t->term_id;
		$cat_ids[] = $id;
	}
}
if($assignedCategories) {
	foreach($assignedCategories as $a) {
		$title = $a['title'];
		$text = $a['text'];
		if( $categories = $a['category'] ) {
			foreach($categories as $catid) {
				if( $cat_ids && in_array($catid,$cat_ids) ) {
					$customTitle = $title;
					$customText = $text;
				}
			}
		}
	}
}

$has_custom_message = false;

if ( $customTitle || $customText ) { 
	if($formID) { 
		$gfshortcode = '[gravityform id="'.$formID.'" title="false" description="false" ajax="true"]';
		if( do_shortcode($gfshortcode) ) { 
			$has_custom_message = true; ?>
		<div class="subscribe-form-single generic-form" style="margin-top: 20px;">
			<div class="formDiv default">
				<div class="form-subscribe-blue">
					<div class="form-inside">
					<?php if ($customTitle) { ?>
						<h3 class="gfTitle"><?php echo $customTitle ?></h3>
					<?php } ?>
					<?php if ($customText) { ?>
						<div class="gftxt"><?php echo $customText ?></div>
					<?php } ?>
					<?php echo do_shortcode($gfshortcode); ?>
					</div>
				</div>
			</div>
		</div>
		<?php 
		}
	}
	?>
<?php } ?>


<?php if ( !$has_custom_message && $has_default ) { 
	$defaultFormId = get_field("default_newsletterform_post","option");
	$defaultTitle = get_field("default_title_post","option");
	$defaultText = get_field("default_text_post","option");
	if($defaultFormId) {
		$defaultForm = '[gravityform id="'.$defaultFormId.'" title="false" description="false" ajax="true"]';
		if( do_shortcode($defaultForm) ) { ?>
		<div class="subscribe-form-single default-form" style="margin-top: 20px;">
			<div class="form-subscribe-blue">
				<div class="form-inside">
					<?php if ($defaultTitle) { ?>
						<h3 class="gfTitle"><?php echo $defaultTitle ?></h3>
					<?php } ?>
					<?php if ($defaultText) { ?>
						<div class="gftxt"><?php echo $defaultText ?></div>
					<?php } ?>
					<?php echo do_shortcode($defaultForm); ?>
				</div>
			</div>
		</div>
		<?php } ?>
	<?php } ?>
<?php } ?>