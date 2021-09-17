<?php 

$args = array(
	'pagename' 		=> 'job-board',
	'post_status'	=> 'publish',
);

$query = new WP_Query( $args );

if ( $query->have_posts() ) : 

    while ( $query->have_posts() ) : $query->the_post();

    	$title      = get_field('banner_title_text');
		$subtitle   = get_field('banner_subtitle_text');
		$img 		= get_field('story_image');
		$imgMob 	= get_field('story_image_mobile');
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
					<h1><?php echo $title; ?></h1>
					<div class="sub"><?php echo $subtitle; ?></div>
				</div>
				<div class="row-2">
					
					<div class="search search_form_banner">
						<form  method="get" class="biz" id="form_search">
						    <input class="searchfield" type="text" name="search_text" id="search"  />
						    <input type="hidden" class="post_type" name="type" value="job">
						    <input class="searchicon" type="image" alt="Search" src="<?php bloginfo( 'template_url' ); ?>/images/search.png" />
						</form>
					</div>	

				</div><!--.row-2-->
				<div class="bottom">
					<div class="btn">
						<a class="pop" href="<?php bloginfo('url'); ?>/post-a-job">Post a Job</a>
					</div>
					<div class="btn">
						<div class="banner-button find">Find a Job
						<?php 
						$terms = get_terms( array(
						    'taxonomy' 		=> 'job_cat',
						    'hide_empty' 	=> false,
						) );
							if( is_array($terms) && !empty($terms) ):?>
			                        <ul>
			                            <?php foreach($terms as $term):?>

			                            	<?php if( have_content( $term->term_id ) ): ?>
				                                <li>
				                                    <a href="<?php echo get_term_link($term->term_id);?>"><?php echo $term->name;?></a> 
				                                </li>
			                            	<?php endif; ?>
			                            <?php endforeach;?>
			                        </ul>
			                    <?php endif;?>
						</div>
					</div>
					<div class="btn">
						<a href="<?php bloginfo('url'); ?>/why-this-jobs-board-matters/">More Info</a>
					</div>
				</div>
			</div>
		</div>

<?php
    endwhile;


endif;
wp_reset_postdata();
