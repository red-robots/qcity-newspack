<?php

$footer_title_article_middle = get_field('footer_title_article_middle', 'option');
$footer_title_article_right = get_field('footer_title_article_right', 'option');
$post_id = get_the_ID();
// $excludedPosts = get_trending_articles(5);
// $trend = ($excludedPosts) ? count($excludedPosts) : 0;
// $excludedPosts[$trend] = $post_id;
$excludeItems2 = array();
?>

<section class="home-bottom single-article-bottom">
	
     <?php /* NOT WORKING!! */ ?>
	<!-- <div class="jobs desktop-version">		
        <script async src="https://modules.wearehearken.com/qcitymetro/embed/4551.js"></script>
	</div> -->

    <?php include(locate_template( 'template-parts/single-footer-bottom-west-connect.php' )); ?>

    <?php /* NOT WORKING!! */ ?>
    <!-- <div class="jobs mobile-version">      
        <script async src="https://modules.wearehearken.com/qcitymetro/embed/4551.js"></script>
    </div> -->
	
	<?php include(locate_template( 'template-parts/single-footer-bottom-trending.php' )); ?>

    <?php include(locate_template( 'template-parts/single-footer-bottom-ads.php' )); ?>

</section>