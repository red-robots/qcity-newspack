<div class="subscribe-wrap home-mission-bar">
	<div class="subscribe">
		<?php echo ($subscribe_text) ? $subscribe_text : '';  ?> 
        <?php if($subscribe_button_name): ?>
        <a href="<?php echo ($subscribe_link) ? $subscribe_link : '';  ?>" class="subscribe_btn"><?php echo ($subscribe_button_name) ? $subscribe_button_name : '';  ?></a>
        <?php endif; ?>
	</div>
</div>