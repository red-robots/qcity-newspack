<?php
$whichCatId = get_field("elect_which_category","option");
$queried = get_queried_object();
$current_term_id = ( isset($queried->term_id) && $queried->term_id ) ? $queried->term_id : '';
$current_term_name = ( isset($queried->name) && $queried->name ) ? $queried->name : '';
$current_term_slug = ( isset($queried->slug) && $queried->slug ) ? $queried->slug : '';
$current_term_link = get_term_link($queried);
if($whichCatId==$current_term_id) {
  $term = get_term($whichCatId);
  $page_term = $term->slug;
  //$paged3 = ( get_query_var( 'cg' ) ) ? absint( get_query_var( 'cg' ) ) : 1;
  $paged3 = ( isset($_GET['cg']) && $_GET['cg'] ) ? $_GET['cg'] : 1;

  $day = date('d');
  $day2 = $day - 1;
  $day_plus = sprintf('%02s', $day2);
  $today = date('Ym') . $day_plus;
  // $perpage = 3;
  $args = array(
    'post_type'       =>'post',
    'post_status'     =>'publish',
    'orderby'         => 'rand',
    'order'           => 'ASC',
    'posts_per_page'  => 3,
    'paged'           => $paged3,
    'meta_query'      => array(
        array(
          'key'       => 'video_single_post',
          'compare'   => '!=',
          'value'     => '',
        )     
    ),
    'tax_query'       => array(
      array(
        'taxonomy'    => 'category', 
        'field'       => 'slug',
        'terms'       => array($page_term) 
      )
    )
  );

  //$placeholder = THEMEURI . "images/video-helper.png";
  $placeholder = THEMEURI . "images/rectangle.png";
  $entries = new WP_Query($args);
  if ( $entries->have_posts() ) { ?>
    <div class="carouselWrapper">
      <section class="post-carousel-slider variable slider">

        <?php $i=1; while ( $entries->have_posts() ) : $entries->the_post(); ?>
          <?php
          $pid = get_the_ID();
          $title = get_the_title();
          $post_date = get_the_date();
          $excludePosts[] = get_the_ID();
          $videoLink = get_field("video_single_post"); 
          $youtubeLink = ($videoLink) ? youtube_setup($videoLink):'';
          $youtubeID = '';
          $video_image_src = '';
          if($youtubeLink) {
            $parts = explode("/embed/",$youtubeLink);
            $youtubeID = (isset($parts[1]) && $parts[1]) ? $parts[1] : '';
            if($youtubeID) {
              $video_image_src = 'https://i.ytimg.com/vi/'.$youtubeID.'/maxresdefault.jpg';
            }
          }
          ?>
          <div class="c-slide-item" data-postid="<?php echo $pid;?>">
            <div class="c-entry">
              <div class="wrap">
                <div class="frame">
                  <iframe class="video-iframe-elections"  src="<?php echo $youtubeLink; ?>"></iframe>
                  <img src="<?php echo $placeholder ?>" alt="" aria-hidden="true" class="placeholder">
                </div>
                <div class="ctxt info">
                  <h3 class="title"><?php echo $title ?></h3>
                  <?php if ( get_the_excerpt() ) { ?>
                  <p class="excerpt"><?php echo get_the_excerpt(); ?></p>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
        <?php $i++; endwhile; wp_reset_postdata(); ?>

      </section>
    </div>

  <?php } ?>

<?php } ?>



