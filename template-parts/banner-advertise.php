<?php

	$img 			= get_field('banner_image');
	$imgMob 		= get_field('banner_image_mobile');
	$banner_title 	= get_field('banner_title');

?>

<div class="banner">
	<picture>
		<source media="(max-width: 600px)"
	            srcset="<?php echo esc_url($imgMob['url']); ?>" alt="<?php echo $imgMob['alt']; ?>">
	    <source media="(min-width: 601px)"
	            srcset="<?php echo esc_url($img['url']); ?>" alt="<?php echo $img['alt']; ?>">
	    <img src="<?php echo esc_url($img['url']); ?>" alt="<?php echo $img['alt']; ?>">
	</picture>
	<div class="banner-info">
		<h1 class="biz"><?php echo __( $banner_title ); ?></h1>
		
	</div>
</div>