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
	<?php wp_head(); ?>
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

get_template_part( 'template-parts/header/mobile', 'sidebar' );
get_template_part( 'template-parts/header/desktop', 'sidebar' );

if ( true === $header_sub_simplified && ! is_front_page() ) :
	get_template_part( 'template-parts/header/subpage', 'sidebar' );
endif;
?>

<div id="page" class="site">
	
	<?php //get_template_part('parts/header-newspack'); ?>
	<?php get_template_part('parts/header-qcity'); ?>

	<div id="content" class="site-content">
