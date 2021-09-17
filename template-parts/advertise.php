<?php
$ads_image              = $ads['ads_image'];
$ads_title              = $ads['ads_title'];
$ads_description        = $ads['ads_description'];
$ads_price              = $ads['ads_price'];
$ads_button_text        = $ads['ads_button_text'];
$ads_button_link        = $ads['ads_button_link'];

//var_dump($ads);
?>


<div class="advertise">
    <div class="img_holder" style="background-image: url('<?php echo esc_url($ads_image['url'] ); ?>');">      
    </div>
    <div class="info">
        <h2><?php echo __( $ads_title ); ?></h2>
        <p><?php echo sanitize_text_field($ads_description); ?></p>
        <?php if( $ads_price ): ?>
        <p>Price: <strong> $ <?php echo __( $ads_price ); ?></strong></p>
        <?php endif; ?>
		
    </div><!-- featured event content -->
    <div class="btn"><a class="yellow full" target="_blank" href="<?php echo esc_url( $ads_button_link ); ?>"><?php echo __( $ads_button_text ); ?></a></div>
</div><!-- featured event -->