<?php
	$image = "";
	if( has_post_thumbnail() ) {
		$image = get_the_post_thumbnail_url();
	} else { 
		$image = get_template_directory_uri() . '/images/default.png';
	}

	//var_dump($image);
?>

<div class="next-story-block">
	<div style="margin-bottom: 10px">

		<div class="photo " >		
			<a href="<?php the_permalink(); ?>">
				<?php if( has_post_thumbnail() ) {
						the_post_thumbnail('thirds');
					} else { 
						$image = get_template_directory_uri() . '/images/default.png';
						?>
						<img src="<?php echo $image; ?>">
				<?php }  ?>
			</a>		
		</div>
		
		<div class="desc">
			<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			<div class="desc-text">
				<div>
					By: <?php the_author(); ?>
				</div>			
				 <span class="desktop-version"><?php echo get_the_date(); ?></span>
			</div>			
		</div>	

	</div>
</div>