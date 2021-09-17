<?php
/**
 * Block Name: Testimonial
 *
 * This is the template that displays the Google Ad block.
 */

// get image field (array)
$adblock = get_field_object('field_5d2e0d5b3e9e0');

// create id attribute for specific styling
$id = 'adblock-' . $block['id'];

// create align class ("alignwide") from block setting ("wide")
$align_class = $block['align'] ? 'align' . $block['align'] : '';

?>
<div id="<?php echo $id; ?>" class="googleadswrap" >
	<?php //echo $adblock; ?>
	<!-- /1009068/In-Story_Gutenbers -->
	<!-- <div id='div-gpt-ad-1563293411913-0' style='width: 728px; height: 90px;'class="googleads"> -->
	<div id='div-gpt-ad-1563293411913-0' class="googleads">
	  <script>
	    googletag.cmd.push(function() { googletag.display('div-gpt-ad-1563293411913-0'); });
	  </script>
	</div>
	<div class="promote">
			Sponsored
	</div>
</div>
<style type="text/css">
	/*#<?php //echo $id; ?> {
		background: ;
		color: ;
	}*/
</style>