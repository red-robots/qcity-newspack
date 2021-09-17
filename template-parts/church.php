<?php
$location          = get_field( 'address' );
$email             = get_field( 'email' );
$phone             = get_field( 'phone' );
$website           = get_field( 'website' );
$category          = get_field( 'category' );
$termsDenomination = wp_get_post_terms( $post->ID, 'denomination' );
$termsSize         = wp_get_post_terms( $post->ID, 'size' );

$denomination      = get_field('denomination');
$membership        = get_field('membership');


$trimmedAdd = "";
if($location != '') {
	$address    = $location['address'];
	$us         = ', United States';
	$trimmedAdd = str_replace( $us, '', $address );
}
?>


<div class="church">
    <div class="info">
        <h2><?php the_title(); ?></h2>
		<?php if ( $trimmedAdd != '' ) { ?>
            <div class="fe-location"><?php echo $trimmedAdd; ?></div>
		<?php } ?>
		<?php if ( $phone != '' ) { ?>
            <div class="fe-start"><?php echo $phone; ?></div>
		<?php } ?>
		<?php if ( !empty($termsDenomination) ) { ?>
            <div class="fe-start">
                <strong>Denomination:</strong> <?php echo $termsDenomination[0]->name; ?></div>
		<?php } ?>
		<?php if ( !empty($termsSize) ) { ?>
            <div class="fe-start"><strong>Size:</strong> <?php echo $termsSize[0]->name; ?>
            </div>
		<?php } ?>
    </div><!-- featured event content -->
    <div class="btn"><a class="yellow full" target="_blank" href="<?php echo ($website) ? $website : ''; ?>">Visit Website</a></div>
</div><!-- featured event -->