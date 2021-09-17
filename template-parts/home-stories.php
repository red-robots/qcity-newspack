<?php
$show_stories = get_field("show_stories_to_homepage","option");
$is_show_stories = ($show_stories=='on' ) ? true : false;

$cat = get_field("story_main_page_url","option");
$storyPageLink = ($cat) ? get_term_link($cat) : '';
$story_main_title = get_field("story_main_title","option");
$story_page_description = get_field("story_page_description","option");
$poweredByTxt = get_field("story_powered_by_text","option");
$sponsorLogo = get_field("story_sponsor_logo","option");
$sponsorWebsite = get_field("story_sponsor_website","option");
$linkOpen = '';
$linkClose = '';
if($sponsorWebsite) {
    $linkOpen = '<a href="'.$sponsorWebsite.'" target="_blank">';
    $linkClose = '</a>'; 
}
if($is_show_stories) { ?>

<div class="home-stories-feed">
    <div class="home-stories-inner">
        <div class="inner">
            <?php if ($sponsorLogo) { ?>
            <div class="sponsorBy">
                <?php echo $linkOpen ?>
                <?php if ($poweredByTxt) { ?>
                <span class="pb"><?php echo $poweredByTxt ?></span>
                <?php } ?>
                <?php if ($sponsorLogo) { ?>
                <img src="<?php echo $sponsorLogo['url'] ?>" alt="<?php echo $sponsorLogo['title'] ?>" class="sponsorLogo" />
                <?php } ?>
                <?php echo $linkClose ?>
            </div>   
            <?php } ?>

            <?php if ($story_main_title || $story_page_description) { ?>
            <div class="titlediv">
                <?php if ($story_main_title) { ?>
                <h1><?php echo $story_main_title ?></h1>
                <?php } ?>
                <?php if ($story_page_description) { ?>
                <div class="description"><?php echo $story_page_description ?></div>
                <?php } ?>
            </div>
            <?php } ?>


            <?php
            $placeholder = get_bloginfo("template_url") . "/images/square.png";
            $args = array(
                'posts_per_page'    => 4,
                'post_type'         => 'story',
                'post_status'       => 'publish',
                'orderby'           => 'ID',
                'order'             => 'DESC',
            );
            $posts = new WP_Query($args);
            if ( $posts->have_posts() ) { ?>
            <div class="story-posts">
                <div id="homeStories" class="flexwrap hideOnMobile">
                    <?php while ( $posts->have_posts() ) : $posts->the_post(); 
                        $thumbnail_photo = get_field("thumbnail_photo");
                        $story_description = get_field("story_description");
                        $title = get_the_title();
                        $bg = ($thumbnail_photo) ? ' style="background-image:url('.$thumbnail_photo['url'].')"':'';
                        $pagelink = get_permalink();
                    ?>
                        <div class="story">
                            <div class="photo <?php echo ($thumbnail_photo) ? 'hasphoto':'nophoto'; ?>">
                                <a href="<?php echo $pagelink ?>" class="link imgdiv"<?php echo $bg ?>>
                                    <img src="<?php echo $placeholder ?>" alt="" aria-hidden="true">
                                    <span class="title">
                                        <span class="name"><?php echo $title ?></span>
                                        <?php if ($story_description) { ?>
                                        <span class="desc"><?php echo $story_description ?></span>
                                        <?php } ?>
                                    </span>
                                </a>
                            </div>
                        </div>

                    <?php endwhile; wp_reset_postdata(); ?>
                </div>

                <div id="homeStoriesMobile" class="flexwrap showOnMobile" style="display:none;">
                    <?php while ( $posts->have_posts() ) : $posts->the_post(); 
                        $thumbnail_photo = get_field("thumbnail_photo");
                        $story_description = get_field("story_description");
                        $title = get_the_title();
                        $bg = ($thumbnail_photo) ? ' style="background-image:url('.$thumbnail_photo['url'].')"':'';
                        $pagelink = get_permalink();
                    ?>
                        <div class="story">
                            <div class="photo <?php echo ($thumbnail_photo) ? 'hasphoto':'nophoto'; ?>">
                                <a href="<?php echo $pagelink ?>" class="link imgdiv"<?php echo $bg ?>>
                                    <img src="<?php echo $placeholder ?>" alt="" aria-hidden="true">
                                    <span class="title">
                                        <span class="name"><?php echo $title ?></span>
                                        <?php if ($story_description) { ?>
                                        <span class="desc"><?php echo $story_description ?></span>
                                        <?php } ?>
                                    </span>
                                </a>
                            </div>
                        </div>

                    <?php endwhile; wp_reset_postdata(); ?>
                </div>


                <?php if ($storyPageLink) { ?>
                <div class="buttondiv">
                    <a href="<?php echo $storyPageLink ?>" class="moreBtn">Read More</a>
                </div>
                <?php } ?>
            </div>
            <?php } ?>

        </div>
    </div>
</div>
<?php } ?>