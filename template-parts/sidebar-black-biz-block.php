<?php
$img        = get_field('story_image');
if( $img ){
   $image = $img['url'];
} elseif ( has_post_thumbnail() ) {
    $image = get_the_post_thumbnail_url();    
} else {
    $image = get_template_directory_uri() . '/images/default.png';
}
   
//var_dump($image);

?>

<article class="small">
    <a href="<?php the_permalink(); ?>">
        <div class="img">
            <img src="<?php echo $image; ?>" alt="">
        </div>
        <div class="xtitle">
            <?php the_title(); ?>
        </div>
    </a>
</article>