<?php 
    $img            = get_field('image');
    $jobTitle       = get_field("job_title");
    $companyName    = get_field("company_name");

if($img){
    $image = $img['url'];
} elseif( has_post_thumbnail() ){
    $image = get_the_post_thumbnail('thirds');
} else {
    $image = get_template_directory_uri() . '/images/default.png';
}

 ?>
<article class="story-block jobs_category" style="text-align: left">
    <a href="<?php echo get_the_permalink(); ?>">
    <div class="photo" style="background-image: url('<?php echo $image; ?>');">
    </div> 
    </a>   
    <div class="desc" style="padding: 0 20px;">
        <h3><?php echo get_the_title(); ?></h3>        
        
        <?php if($companyName):  ?>
        <div><span class="bold">Company:</span> <?php echo esc_html($companyName); ?></div>
        <?php endif; ?>
        <div><span class="bold">Date:</span> <?php echo get_the_date(); ?></div>        
        <div class="">
            <a href="<?php echo get_the_permalink(); ?>" class="bold">View Post</a>
        </div>
    </div>
    
</article>
