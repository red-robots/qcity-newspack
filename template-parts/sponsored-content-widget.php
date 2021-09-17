<?php
global $post;
$currentId = $post->ID;
$numdays = -1; /* days past plus today */
$perpage = 15;
$sponsors = get_sponsored_posts('offers-invites+sponsored-post',$numdays,$perpage,1);
$sponsor_section_title = 'Sponsored Content';
$default = get_template_directory_uri() . '/images/right-image-placeholder.png';
$logoBW = get_template_directory_uri() . '/images/bw.png';
if($sponsors) { shuffle($sponsors); ?>
<section class="c-sponsor-block c-sponsor-block--filled sponsor-paid-wrapper">
  <div class="c-sponsor-block__text sponsor-col-paid-fullwidth">
    <div class="c-sponsor-block__label t-uppercase t-lsp-b has-text-gray-dark t-size-xs has-xxs-btm-marg sponsored-title">
      <strong><?php echo $sponsor_section_title ?></strong>
    </div>  
    <div class="sponsor-posts-container">
    <?php $i=1; foreach ($sponsors as $k=>$id) { 
      if($currentId==$id) {
        unset($sponsors[$k]);
      }
      $post = get_post($id);
      if($post) { 
        $first = ($i==1) ? ' show':''; 
        $featImage =  ( has_post_thumbnail($id) ) ? wp_get_attachment_image_src( get_post_thumbnail_id($id), 'large') : '';
        $bgImg = ($featImage) ? $featImage[0] : $default;
        $hasImage  = ( has_post_thumbnail($id) ) ? ' has-image':' no-image';
        $sponsorCompanies = get_field('sponsors',$id);
        $info = get_field("spcontentInfo","option");
        if($info) {
            $i_title = $info['title'];
            $i_text = $info['text'];
            $i_display = ($info['display'] && $info['display']=='on') ?  true : false;
        } else {
            $i_title = '';
            $i_text = '';
            $i_display = '';
        }
        $sponsorsList = '';
        if($sponsorCompanies) {
            $n=1; foreach($sponsorCompanies as $s) {
                $comma = ($n>1) ? ', ':'';
                $sponsorsList .= $comma . $s->post_title;
                $n++;
            }
        }
        $excerpt = ($post->post_content) ? shortenText(strip_tags($post->post_content),140," ","...") : '';
        $excerpt = ($excerpt) ? trim( str_replace('Sponsored by:','',$excerpt) ) : '';
      ?>
      <div id="post-<?php echo $id?>" class="c-sponsor-block-mainwrap paid-sponsor-info v<?php echo $i ?> <?php echo $first.$hasImage ?>">
        <div class="c-sponsor-block__main">
          <?php if ($sponsorsList) { ?>
          <div class="sponsored-name"><?php echo $sponsorsList ?></div>
          <?php } ?>
          
          <h3 class="c-sponsor-block__headline c-sponsor-block__static-text t-lh-s has-xxxs-btm-marg"><a target="_parent" href="<?php echo get_the_permalink($id);  ?>" class="has-text-black-off has-text-hover-black"><?php echo $post->post_title ?></a></h3>
          <p class="c-sponsor-block-excerpt"><?php echo $excerpt; ?></p>
        </div>
        
        <?php if ($featImage) { ?>
        <div class="sponsor-col-paid sponsor-col-image">
          <a target="_parent" href="<?php echo get_the_permalink($id);  ?>" class="c-sponsor-image-link bglink">
            <span class="bg" style="background-image:url('<?php echo $bgImg?>');"></span>
            <img src="<?php echo $default; ?>" alt="" aria-hidden="true">
            <?php if ($featImage) { ?>
            <?php echo get_the_post_thumbnail($id,'thirds', array('class' => 'l-width-full c-sponsor-block__image')); ?>
            <?php } ?>
          </a>
        </div>
        <?php } ?>
      </div>
      <?php $i++; } ?>
    <?php } ?>
    </div>
  </div>
</section>
<?php } ?>