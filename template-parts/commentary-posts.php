<?php
$termName = 'commentaries';
//$termName = 'commentary';
$args = array(
  'post_type'				=>'post',
  'post_status'			=> 'publish',       
  'posts_per_page'	=> 3,
  'orderby'   => 'ID',
 	'order' 		=> 'DESC',
  'tax_query'				=> array(
			array(
			  'taxonomy' => 'category',
			  'field'    => 'slug',
			  'terms'    => $termName,
			  'operator' => 'IN'
			)
  	)
);
$square = get_bloginfo("template_url") . "/images/square.png";
$gravatar = get_bloginfo("template_url") . "/images/gravatar.png";
$commentaries = new WP_Query($args);
if ( $commentaries->have_posts() )  { ?>
<div class="commentaries-section">
	<div class="stitle">Opinions</div>
	<div class="flexwrap">
		<?php  while ( $commentaries->have_posts() ) :  $commentaries->the_post(); ?>
			<?php
				$authorID = get_the_author_meta('ID');
				$custom_author = get_field('choose_author');
				$authorName = '';
				$avatarURL = '';
				if($custom_author) {
					$avatarURL = get_avatar_url($custom_author['ID']);
					$arrs = array($custom_author['user_firstname'],$custom_author['user_lastname']);
					$authorName = implode(' ',array_filter($arrs));
				} else {
					$fname = get_the_author_meta( 'first_name' , $authorID ); 
					$lname = get_the_author_meta( 'last_name' , $authorID ); 
					$arrs = array($fname,$lname);
					if($arrs && array_filter($arrs)) {
						$authorName = implode(' ',array_filter($arrs));
					} else {
						$authorName = get_the_author_meta( 'display_name' , $authorID );
					}
					$avatarURL = get_avatar_url($authorID);
				}
				$picBg = ($avatarURL) ? ' style="background-image:url('.$avatarURL.')"':'';
			?>
			<div class="entry-block">
				<a href="<?php echo get_permalink(); ?>" class="inner">
					<span class="titlediv">
						<h4 class="ptitle"><?php the_title(); ?></h4>
						<?php if ($authorName) { ?>
						<span class="by">
							<span>Written by: <?php echo ucwords($authorName); ?></span>
						</span>
						<?php } ?>
					</span>
					<span class="photodiv">
						<span class="pic"<?php echo $picBg ?>>
							<img src="<?php echo $square ?>" alt="" aria-hidden="true" class="helper">
						</span>
					</span>
				</a>
			</div>
		<?php endwhile; wp_reset_postdata(); ?>
	</div>
</div>
<?php } ?>


