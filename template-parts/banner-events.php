<?php
if( is_archive() ) {
	$img = get_field('story_image','54'); // Page = Events
	$imgMob = get_field('story_image_mobile','54');
} else {
	$img = get_field('story_image');
	$imgMob = get_field('story_image_mobile');
}

$keyword = ( isset($_GET['srch']) && $_GET['srch'] ) ? $_GET['srch'] : '';
$posttype = ( isset($_GET['type']) && $_GET['type'] ) ? $_GET['type'] : '';
$paged = ( get_query_var( 'pg' ) ) ? absint( get_query_var( 'pg' ) ) : 1;
?>

<div class="banner">
	<picture>
		<source media="(max-width: 600px)"
	            srcset="<?php echo $imgMob['url']; ?>" alt="<?php echo $imgMob['alt']; ?>">
	    <source media="(min-width: 601px)"
	            srcset="<?php echo $img['url']; ?>" alt="<?php echo $img['alt']; ?>">
	    <img src="<?php echo $img['url']; ?>" alt="<?php echo $img['alt']; ?>">
	</picture>
	<div class="banner-info">
		<div class="titles">
			<h1>Whats Happening, Charlotte</h1>
			<div class="sub">The Qcity's Going Out Guide</div>
		</div>
		<div class="row-2">
			
			
			<div class="search search_form_banner">
				<!-- <form  method="get" class="biz" id="form_search">
				    <input class="searchfield" type="text" name="search_text" id="search"  />
				    <input type="hidden" class="post_type" name="type" value="event">
				    <input class="searchicon" type="image" alt="Search" src="<?php //bloginfo( 'template_url' ); ?>/images/search.png" />
				</form> -->
				<form  method="get" class="biz" id="form_search_event">
				    <input class="searchfield" type="text" name="srch" />
				    <input type="hidden" name="type" value="event">
				    <input type="hidden" id="current_page_field" name="current_page" value="<?php echo $paged ?>">
				    <input type="hidden" id="base_url_field" name="base_url" value="<?php echo get_permalink() ?>">
				    <input class="searchicon" type="image" alt="Search" src="<?php bloginfo( 'template_url' ); ?>/images/search.png" />
				</form>
			</div>	

		</div><!--.row-2-->
		<?php get_template_part('template-parts/event-btn'); ?>
	</div>
</div>
