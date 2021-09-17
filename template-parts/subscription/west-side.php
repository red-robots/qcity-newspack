<?php
$homeSBFormTitle = get_field("homeSBFormTextTitle","option");
$homeSBFormText = get_field("homeSBFormTextContent","option");
$homeGravityFormId = get_field("homeSBFormShortcode","option");
if ($homeGravityFormId) {
    $gfshortcode = '[gravityform id="'.$homeGravityFormId.'" title="false" description="false" ajax="true"]'; 
    if( do_shortcode($gfshortcode) ) { ?>   
    <div class="home-sb-subscribe-form">
        <div class="form-inside">
        <?php if ($homeSBFormTitle) { ?>
            <h3 class="gfTitle"><?php echo $homeSBFormTitle ?></h3>
        <?php } ?>
        <?php if ($homeSBFormText) { ?>
            <div class="gftxt"><?php echo $homeSBFormText ?></div>
        <?php } ?>
        <?php echo do_shortcode($gfshortcode); ?>
        </div>
    </div>
    <?php } ?>
<?php } ?>