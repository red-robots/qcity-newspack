<?php
    $img            = get_field('image');
    $jobTitle       = get_field("job_title");
    $companyName    = get_field("company_name");
?>

<div class="job">
    <div class="img">
        <?php if($img): ?>
            <img src="<?php echo $img['url']; ?>"  alt="<?php echo $img['alt']; ?>">
        <?php else: ?>
            <img src="<?php bloginfo('stylesheet_directory'); ?>/images/default.png">
        <?php endif; ?>
    </div>
    <div class="info">
        <h3><?php the_title(); ?></h3>
        <h4><?php echo $companyName; ?></h4>
        <div class="date"><?php echo get_the_date(); ?></div>
    </div>
    <div class="view">
        <div class="viewlink">
            <a href="<?php the_permalink(); ?>">View Post</a>
        </div>
    </div>
</div>