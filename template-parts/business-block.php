<?php 
$placeholder = get_template_directory_uri() . '/images/right-image-placeholder.png';
$img    = get_field('business_photo');
$phone  = get_field('phone');
$email  = get_field('email');
$email  = antispambot($email);
$address = get_field('address');
$summary = get_field('description');

if($img){
    $image = $img['url'];
} elseif( has_post_thumbnail() ){
    $image = get_the_post_thumbnail('thirds');
} else {
    $image = get_template_directory_uri() . '/images/default.png';
}

 ?>
<article class="story-block business_category" style="text-align: left">
    <a href="<?php echo get_the_permalink(); ?>">
    <div class="photo" style="background-image: url('<?php echo $image; ?>');">
       <img src="<?php echo $placeholder ?>" alt="" aria-hidden="true" class="image-helper">
    </div> 
    </a>   
    <div class="desc" style="padding: 0 20px;">
        <h3><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h3> 
        <?php if($summary):  ?>
        <div><span class="italic"><?php echo $summary; ?></span> </div>     
        <?php endif; ?>  
        <?php if($phone):  ?>
            <div><span class="bold">Phone:</span> <?php echo esc_html($phone); ?></div>
        <?php endif; ?>
        <?php if($email):  ?>
        <div><span class="bold">Email:</span> <a href="mailto:<?php echo antispambot(strtolower($email), 1); ?>"><?php echo esc_html(strtolower($email)); ?></a></div>
        <?php endif; ?>
        <div class="">
            <a href="<?php echo get_the_permalink(); ?>" class="bold">More Info</a>
        </div>
    </div>
    
</article>
