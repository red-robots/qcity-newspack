<?php
if( is_tax() ) {
	$img = get_field('story_image','19'); // Page = Church Directory
	$imgMob = get_field('story_image_mobile','19');
} else {
	$img = get_field('story_image');
	$imgMob = get_field('story_image_mobile');
}
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
		<h1 class="biz">Find a QCity Church.</h1>
		<div class="row-2">
			
			<div class="banner-button find">All Denominations
			<?php 
			$terms = get_terms( array(
			    'taxonomy' => 'denomination',
			    'hide_empty' => false,
			) );
				if(is_array($terms)&&!empty($terms)):?>
                        <ul>
                            <?php foreach($terms as $term):?>
                                <li>
                                    <a href="<?php echo get_term_link($term->term_id);?>"><?php echo $term->name;?></a> 
                                </li>
                            <?php endforeach;?>
                        </ul>
                    <?php endif;?>
			</div>
			<div class="search mobile_hide search_form_banner">
				<form   method="get" class="biz form_search" role="search" id="form_search">
				    <input class="searchfield" type="text" name="search_text" id="search_church" />
				    <input type="hidden" class="post_type" name="type" value="church_listing">				    
				    <input class="searchicon" type="image" alt="Search" src="<?php bloginfo( 'template_url' ); ?>/images/search.png" />
				</form>
			</div>	
		</div><!--.row-1-->
		<a href="<?php bloginfo('url'); ?>/church-directory/church-directory-sign-up/">Add your Church To This Directory</a>
	</div>
</div>