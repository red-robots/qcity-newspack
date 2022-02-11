<?php 
$terms = (get_post_type()=='post') ? get_the_terms(get_the_ID(),'category') : '';
$poweredByInfo = array();
if($terms) {
  foreach($terms as $term) {
    $poweredbyLogo = '';
    $poweredbyText = '';
    $poweredbyURL = '';
    $poweredbyDescription = '';
    $sponsor = get_field('catSponsor', $term);
    if($sponsor) {
      $poweredbyText = ( isset($sponsor['label']) && $sponsor['label'] ) ? $sponsor['label'] : '';
      if( isset($sponsor['sponsor']) && $sponsor['sponsor'] ) {
        $sp_id = $sponsor['sponsor'];
        $poweredbyLogo = get_field('logo',$sp_id);
        $poweredbyURL = get_field('logo_hyperlink',$sp_id);
        $poweredbyDescription = get_field('description',$sp_id);
      }
    }
    if($poweredbyLogo) {
      $poweredByInfo[] = array(
        'term_id'=>$term->term_id,
        'term_name'=>$term->name,
        'poweredbyLogo'=>$poweredbyLogo,
        'poweredbyURL'=>$poweredbyURL,
        'poweredbyText'=>$poweredbyText,
        'poweredbyDescription'=>$poweredbyDescription
      );
    }
  }
}

if($poweredByInfo) { 
$poweredby_logo = $poweredByInfo[0]['poweredbyLogo'];
$poweredby_link = $poweredByInfo[0]['poweredbyURL'];
$poweredby_label = $poweredByInfo[0]['poweredbyText'];
$poweredby_description = $poweredByInfo[0]['poweredbyDescription'];
  if ($poweredby_logo) { ?>
  <div class="sponsoredDataDiv sponsorInfo">
    <div class="sponsoredInfoBox">
      <div class="sponsored-by">
        <div class="sponsor-sidebar-wrapper">
          <h2>Sponsored By:</h2>

          <?php if ($poweredby_logo) { ?>
          <div class="sponsor-logo">
            <?php if ($poweredby_link) { ?>
              <a href="<?php echo $poweredby_link ?>" target="_blank">
                <img src="<?php echo $poweredby_logo['url'] ?>" alt="<?php echo $poweredby_logo['title'] ?>" />
              </a> 
            <?php } else { ?>
              <img src="<?php echo $poweredby_logo['url'] ?>" alt="<?php echo $poweredby_logo['title'] ?>" />
            <?php } ?>
          </div>
          <?php } ?>
          
          <?php if ($poweredby_description) { ?>
          <div class="description"><?php echo $poweredby_description ?></div>
          <?php } ?>

          <div class="policy-link">
            <a href="<?php echo get_site_url() ?>/ethics-sponsorship-policy/" target="_blank">Read our Sponsorship Policy</a>
          </div>
        </div>
      </div>
    </div>

    <div class="sponsoredInfoWrap">
      <div class="sponsoredInfo">This content was paid for by an advertiser and created by QCity Metro's marketing team. Our reporters were not involved in that process.</div>
    </div>

  </div>
  <?php } ?>
<?php } ?>

