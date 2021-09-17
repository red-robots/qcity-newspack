<?php
$img  = get_field('event_image');
if( $img ){
    $image = $img['url'];
} elseif ( has_post_thumbnail() ) {
    $image = get_the_post_thumbnail_url();    
} else {
    $image = get_template_directory_uri() . '/images/default.png';
}
$viewsCount = get_post_meta( get_the_ID(), 'views', true );
$postDate = get_the_date('d/m/Y');
?>

<article data-group="page1" data-postdate="<?php echo $postDate ?>" data-views="<?php echo $viewsCount ?>" id="<?php echo $viewsCount ?>" class="small">
    <a href="<?php the_permalink(); ?>">
        <div class="img">
            <img src="<?php echo $image; ?>" alt="">
        </div>
        <div class="xtitle">
            <?php the_title(); ?>
        </div>
    </a>
</article>