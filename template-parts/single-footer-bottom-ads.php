<!--- Advertisements -->
<?php 
$singlePostAds = array();
$ads_bottom_list = array('story-zone-3','story-zone-4');
foreach ($ads_bottom_list as $ads_slug) { 
    $ads = get_ads_script($ads_slug);
    if( $ads ) { 
        $singlePostAds[] = $ads;
    }
}

if ($singlePostAds) { ?>
<!--- Story Zone 3 and Story Zone 4 -->
<div id="adverts" class="ad flexbox">
    <div class="fxdata">
        <?php foreach ($singlePostAds as $ad) {  ?>
            <?php if ( isset($ad['ad_script']) && $ad['ad_script'] ) { ?>
                <div class="desktop-version align-center txtwrap"><?php echo $ad['ad_script'] ?></div>
            <?php } ?>
        <?php } ?>
    </div>
</div>
<?php } ?>