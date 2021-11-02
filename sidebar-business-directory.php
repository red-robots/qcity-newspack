<?php
$sidebar_buttons = get_field("bd_sidebar_buttons","option"); 
$subscription_text = get_field("bd_subscription_text","option"); 
$subscription_button = get_field("bd_subscription_button","option");
$mobile_view = ( isset($mobile_class) && $mobile_class ) ? $mobile_class : 'desktop';
if ( $sidebar_buttons || ($subscription_text || $subscription_button) ) { ?>
<div class="faq-sb-boxes <?php echo $mobile_view ?>">

	<?php if ($sidebar_buttons) { ?>
		<div class="sbbuttons">
			<?php foreach ($sidebar_buttons as $button) {
				$b =  $button['button'];
				$btnName = ( isset($b['title']) && $b['title'] ) ? $b['title'] : ''; 
				$btnLink = ( isset($b['url']) && $b['url'] ) ? $b['url'] : ''; 
				$btnTarget = ( isset($b['target']) && $b['target'] ) ? $b['target'] : '_self'; 
				if($btnName && $btnLink) { ?>
				<div class="button"><a href="<?php echo $btnLink ?>" target="_blank"><?php echo $btnName ?></a></div>
				<?php } 
			} ?>
		</div>
		<?php } ?>


		<?php if ($subscription_text || $subscription_button) { ?>
		<div class="subscription">
			<?php if ($subscription_text) { ?>
			<div class="text"><?php echo $subscription_text ?></div>	
			<?php } ?>
			<?php if ($subscription_button) { 
				$s_btnName = $subscription_button['title'];
				$s_btnLink = $subscription_button['url'];
				$s_btnTarget = ( isset($subscription_button['target']) && $subscription_button['target'] ) ? $subscription_button['target'] : '_self';
				if($s_btnName && $s_btnLink) { ?>
				<div class="sub-button">
					<a href="<?php echo $s_btnLink ?>" target="_blank"><?php echo $s_btnName ?></a>
				</div>	
				<?php } ?>
			<?php } ?>
		</div>
	<?php } ?> 

</div>
<?php } ?> 

