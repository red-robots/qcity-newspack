<?php
$ob = get_queried_object();
$current_term_id = ( isset($ob->term_id) && $ob->term_id ) ? $ob->term_id : '';
$current_term_slug = ( isset($ob->slug) && $ob->slug ) ? $ob->slug : '';
$electionCatId = get_field("elect_which_category","option");
$electionCatId = ($electionCatId) ? $electionCatId : '-1';
$current_page_id = (is_page()) ? get_the_ID() : 0;
$template = no_top_ads($current_page_id);
$show_ads = true;
if($template) {
  $show_ads = false;
}

if( is_home() || is_front_page() ) {
  
  if( $adsZone1 = get_ads_script('leaderboard-ad-home') ) { ?>
    <?php if ( isset($adsZone1['ad_script']) && $adsZone1['ad_script'] ) { ?>
    <!--- AD ZONE 1 --> 
    <div id="ads-zone-1" class="ads_home_leaderboard">
      <?php echo $adsZone1['ad_script'] ?>
    </div>
    <?php } ?>
  <?php }

} else {

  $default_zone_ad_slug = 'leaderboard-ad-home';
  $comment_info = 'AD ZONE 1';
  if($current_term_slug=='health') {
    $default_zone_ad_slug = 'health-zone-1';
    $comment_info = 'HEALTH ZONE 1';
  }

  if( is_single() ) {
    $post_id = get_the_ID();
    $show_ads = true;

    if ( is_singular( 'post' ) ) {
      $terms = get_the_terms($post_id,'category');
      if($terms) {
        foreach($terms as $t) {
          if($t->slug=='health') {
            $default_zone_ad_slug = 'health-zone-1';
            $comment_info = 'HEALTH ZONE 1';
            break;
          }
        }
      }

    } 
    else if( is_singular( 'event' ) ) {
      $default_zone_ad_slug = 'event-zone-1';
      $comment_info = 'EVENT ZONE 1';
    }
    
  }

  if( $show_ads ) {



    if($electionCatId!=$current_term_id) { ?>
      
      <?php if ( $ads_header = get_ads_script($default_zone_ad_slug) ) { ?>
        <?php if ( isset($ads_header['ad_script']) && $ads_header['ad_script'] ) { ?>
        <?php echo '<!-- ' . $comment_info .' -->'; ?>
        <div data-ad-zone="<?php echo $default_zone_ad_slug ?>" class="ads_home_leaderboard">
          <?php echo $ads_header['ad_script'] ?>
        </div>
        <?php } ?>
      <?php } ?>

    <?php } ?>

  <?php } ?>

<?php } ?>