<?php
	$image = "";
	if( has_post_thumbnail() ) {
		$image = get_the_post_thumbnail_url();
	} else { 
		$image = get_template_directory_uri() . '/images/default.png';
	}

	$height = ( is_archive() ) ? ' height: 200px' : '';

	//var_dump($image);
?>

<article class="story-block">
	<div class="photo story-image" style="background-image: url('<?php echo $image; ?>'); height: 220px; " >
		
	</div>
	<h3><?php the_title(); ?></h3>
	<div class="by">
		<?php echo get_the_date(); ?>
	</div>
	<div class="article-link"><a href="<?php the_permalink(); ?>"></a></div>
</article>