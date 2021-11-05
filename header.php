<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Newspack
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<script defer src="<?php bloginfo( 'template_url' ); ?>/assets/svg-with-js/js/fontawesome-all.js"></script>
	<?php 
$stickyHeaderCode = get_field("stickyHeaderCode","option"); 
$stickyAdCode = get_field("stickyAdCode","option");
$stickyAdEnable = get_field("stickyAdEnable","option");
$is_sticky_on = ( isset($stickyAdEnable) && $stickyAdEnable=='on' ) ? true : false;
?>
<script async src="https://securepubads.g.doubleclick.net/tag/js/gpt.js"></script>
<script async='async' src='https://www.googletagservices.com/tag/js/gpt.js'></script>
<script>
  var googletag = googletag || {};
  googletag.cmd = googletag.cmd || [];
</script>
<?php if ($stickyHeaderCode) { echo $stickyHeaderCode; } ?>
<?php //get_template_part('parts/adcode-header'); ?>
<?php if( $ads_scripts = getHeaderScripts() ) { foreach($ads_scripts as $js) { echo $js; } } ?>
<script>
var ajaxURL = "<?php echo admin_url('admin-ajax.php'); ?>";
var assetsDIR = "<?php echo get_bloginfo("template_url") ?>/images/";
var currentURL = '<?php echo get_permalink();?>';
var params={};location.search.replace(/[?&]+([^=&]+)=([^&]*)/gi,function(s,k,v){params[k]=v});
var jobsCount = '<?php echo get_category_counter('job'); ?>';
var eventsCount = '<?php echo get_total_events_by_date(); ?>';
</script>
<!--
<script type="text/javascript"async src="https://launch.newsinc.com/js/embed.js" id="_nw2e-js"></script>
-->
<?php wp_head(); ?>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<?php 
$current_page_id = (is_page()) ? get_the_ID() : 0;
$ob = get_queried_object();
$current_term_id = ( isset($ob->term_id) && $ob->term_id ) ? $ob->term_id : '';
$current_term_name = ( isset($ob->name) && $ob->name ) ? $ob->name : '';
$current_term_slug = ( isset($ob->slug) && $ob->slug ) ? $ob->slug : '';
$electionCatId = get_field("elect_which_category","option");
$electionCatId = ($electionCatId) ? $electionCatId : '-1';
if ( get_post_type()=='story')  { 
$articles = get_field("story_article"); 
if($articles) {
  $story = $articles[0];
  $images = $story['images'];
  $text = ( isset($story['post_content']) && $story['post_content'] ) ? $story['post_content']:'';
  $content = ($text) ? shortenText(strip_tags($text),200," ","...") : '';
  $photos = ( isset($images['photos']) && $images['photos'] ) ? $images['photos']:"";
  $mainPic = ($photos) ? $photos[0] : '';
}
?>
<meta property="og:url"                content="<?php echo get_permalink(); ?>" />
<meta property="og:type"               content="article" />
<meta property="og:title"              content="<?php echo get_the_title(); ?>" />
<meta property="og:description"        content="<?php echo $content ?>" />
<?php if ($mainPic) { ?>
<meta property="og:image"              content="<?php echo $mainPic['url'] ?>" />
<?php } ?>
<?php } ?>
<style type="text/css">
html body.single-post .oakland-background.oakland-optin-visible.oakland-lightbox,
body.single-post .oakland-background.oakland-optin-visible.oakland-lightbox{display:none!important;}
.gform_wrapper ul li.gfield{clear: none !important;}
</style>

<?php 
if( $customHeadScripts = get_field("custom_scripts_inside_head","option") ) { 
  echo $customHeadScripts;
} ?>
</head>
<?php
$dd = date('d') - 1;
$day = str_pad($dd,2,'0',STR_PAD_LEFT);
$nexday = str_pad($dd+1,2,'0',STR_PAD_LEFT);
$dateToday = date('Ym') . $day;
$dateRange = '';
for($i=0; $i<3; $i++) {
  $d = $day + $i;
  $days = str_pad($d,2, '0', STR_PAD_LEFT);
  $comma = ($i>0) ? ',':'';
  $dateRange .= $comma . date('Ym'). $days;
}
$start_end = $dateToday . ',' . date('Ym') . $nexday;
$hasPoweredByLogo = ($current_page_id) ? get_page_with_top_logo($current_page_id) : '';
$bodyClass = ($hasPoweredByLogo) ? 'hasPoweredByLogo':'';
$is_member_page = false;
if( is_page() ) {
  $pageTemplate = get_page_template_slug($current_page_id);
  if($pageTemplate=="page-membership-new.php") {
    $is_member_page = true;
  }
}
// echo $is_member_page;
?>

<body <?php body_class($bodyClass); ?> data-today="<?php echo date('Ymd') ?>" data-dates="<?php echo $start_end ?>" data-range="<?php echo $dateRange ?>">
<?php

do_action( 'wp_body_open' );
do_action( 'before_header' );

// Header Settings
$header_simplified     = get_theme_mod( 'header_simplified', false );
$header_center_logo    = get_theme_mod( 'header_center_logo', false );
$show_slideout_sidebar = get_theme_mod( 'header_show_slideout', false );
$slideout_sidebar_side = get_theme_mod( 'slideout_sidebar_side', 'left' );
$header_sub_simplified = get_theme_mod( 'header_sub_simplified', false );

// Even if 'Show Slideout Sidebar' is checked, don't show it if no widgets are assigned.
if ( ! is_active_sidebar( 'header-1' ) ) {
	$show_slideout_sidebar = false;
}

// include(locate_template('template-parts/header/mobile.php'));
// include(locate_template('template-parts/header/desktop.php'));
get_template_part( 'template-parts/header/mobile', 'sidebar' );
get_template_part( 'template-parts/header/desktop', 'sidebar' );

if ( true === $header_sub_simplified && ! is_front_page() ) :
	get_template_part( 'template-parts/header/subpage', 'sidebar' );
endif;
?>

<div id="page" class="site">
	
	<?php //include(locate_template('parts/header-newspack.php'));?>
	<?php include(locate_template('parts/header-qcity.php'));?>

	<div id="content" class="site-content">
