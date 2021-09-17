<?php
/**
 * Block Name: Newsletter Signup
 *
 * This is the template that displays the Google Ad block.
 */

$text = 'Have you signed up to receive our daily news and events listings?';
?>
<div class="side-offer">
	<p><?php echo $text; ?></p>
	<div class="btn">
		<a class="white" href="<?php bloginfo('url'); ?>/email-signup">Subscribe</a>
	</div>
</div>