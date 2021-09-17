<?php
/* 
* PARSE.LY METADATA
* Visit: https://www.parse.ly/help/integration/jsonld 
*/
$ob = get_queried_object();
if ( is_singular() ) { 
$defaultAuthId = ( isset($ob->post_author) && $ob->post_author ) ? $ob->post_author:'';
$defaultAuthorName = '';
if($defaultAuthId) {
  $defaultAuthorName = get_the_author_meta('display_name',$defaultAuthId);
}
$img = get_field('story_image'); 
$thumbURL = ($img) ? $img['url'] : '';
$pagetitle = get_the_title();
$pageLink = get_permalink();
$guest_author =  get_field('author_name');
$authorName = ( $guest_author ) ? $guest_author : $defaultAuthorName;
$date = get_the_date('Y-m-d');
$post_id = get_the_ID();
$post_categories = get_the_category( $post_id );
$categories = '';
$tags = '';
$tag_list = get_the_tags($post_id);
$cat_count = ($post_categories) ? count($post_categories) : 0;
if($post_categories){
  
  $catName1 = htmlspecialchars_decode($post_categories[0]->name);
  $categories = $catName1;

  if($cat_count>1) {
    $catsArr = array();
    foreach($post_categories as $c) {
      $catName = htmlspecialchars_decode($c->name);
      $catName = str_replace("'"," ",$catName);
      $catName = str_replace('"','',$catName);
      $catsArr[] = '"'.$catName.'"';
    }
    $tags = ($catsArr) ? implode(",",$catsArr) : '';
  } 

  if($tag_list) {
    $tagsArr = array();
    foreach($tag_list as $t) {
      $tagStr = htmlspecialchars_decode($t->name);
      $tagStr = str_replace("'"," ",$tagStr);
      $tagStr = str_replace('"','',$tagStr);
      $tagsArr[] = '"'.$tagStr.'"';
    }
    $tags = ($tagsArr) ? implode(",",$tagsArr) : '';
  }
}

$type = 'WebPage';
if( is_single() ) {
  $type = 'Article';
  if( is_singular('post') ) {
    $type = 'NewsArticle';
  } else if( is_singular('event') ) {
    $type = 'Article';
  }
}

$authorName = ($authorName) ? '["'.$authorName.'"]':'""';
$tags = ($tags) ? '['.$tags.']':'""';
if($pagetitle) {
$pagetitle = htmlspecialchars_decode($pagetitle);
$pagetitle = str_replace("'"," ",$pagetitle);
$pagetitle = str_replace('"','',$pagetitle);
}

?>
<script type="application/ld+json">
<?php if( is_single() ) { ?>
{
  "@context": "https://schema.org",
  "@type": "<?php echo $type?>",
  "headline": "<?php echo $pagetitle?>",
  "url": "<?php echo $pageLink?>",
  "thumbnailUrl": "<?php echo $thumbURL?>",
  "datePublished": "<?php echo $date?>",
  "articleSection": "<?php echo $categories?>",
  "creator": <?php echo $authorName?>,
  "author": <?php echo $authorName?>,
  "keywords": <?php echo $tags?>
}
<?php } else if( is_page() ) { 
if (is_home() || is_front_page()) { 
  $pagetitle = get_bloginfo('name') . " - " . $pagetitle;
}
?>
{
  "@context": "https://schema.org",
  "@type": "<?php echo $type?>",
  "headline": "<?php echo $pagetitle?>",
  "url": "<?php echo $pageLink?>"
}
<?php } ?>
</script>
<?php } ?>

<?php if (is_archive()) { 
$archiveTitle = ( isset($ob->name) && $ob->name ) ? $ob->name : '';
if($archiveTitle) { 
$termLink = get_term_link($ob); ?>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebPage",
  "headline": "<?php echo $archiveTitle?>",
  "url": "<?php echo $termLink?>"
}
</script>
<?php } ?>
<?php } ?>
