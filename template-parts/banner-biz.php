<?php 

$args = array(
	'pagename' 		=> 'business-directory',
	'post_status'	=> 'publish',
);

$query = new WP_Query( $args );

if ( $query->have_posts() ) : 

    while ( $query->have_posts() ) : $query->the_post();

        $img                = get_field('story_image');
        $imgMob             = get_field('story_image_mobile');
        $add_business       = get_field('add_your_business');
        $add_business_link  = get_field('add_business_link');
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
                <h1 class="biz">Find a QCity local business.</h1>
                <div class="row-2">
                    
                    <div class="banner-button find">All Categories
                    <?php 
                    $terms = get_terms( array(
                        'taxonomy' => 'business_category',
                        'hide_empty' => false,
                    ) );
                        if( is_array($terms) && !empty($terms) ):?>
                                <ul>
                                    <?php foreach($terms as $term):?>
                                        <li>
                                            <a href="<?php echo get_term_link($term->term_id);?>"><?php echo strtoupper($term->name); ?></a> 
                                        </li>
                                    <?php endforeach;?>
                                </ul>
                            <?php endif; wp_reset_postdata();?>
                    </div>
                    <div class="search mobile_hide search_form_banner">
                        <form  method="get" class="biz" id="form_search">
                            <input class="searchfield" type="text" name="search_text" id="search"  />
                            <input type="hidden" class="post_type" name="type" value="business_listing">
                            <input class="searchicon" type="image" alt="Search" src="<?php bloginfo( 'template_url' ); ?>/images/search.png" />
                        </form>
                    </div>  
                </div><!--.row-1-->
                <a href="<?php echo ($add_business_link) ? $add_business_link : '';  ?>"><?php echo ($add_business) ? $add_business : ''; ?></a>

                <div class="bottom">
                    <div class="btn">
                        <a  href="<?php bloginfo('url'); ?>/business-directory/business-directory-sign-up/">Post A Business</a>
                    </div>
                    <div class="btn">
                        <div class="banner-button find">Find a Business
                        <?php 
                        /*$terms = get_terms( array(
                            'taxonomy' => 'business_category',
                            'hide_empty' => false,
                        ) );*/
                            if( is_array($terms) && !empty($terms) ):?>
                                    <ul>
                                        <?php foreach($terms as $term):?>

                                            <?php //if( have_content( $term->term_id ) ): ?>
                                                <li>
                                                    <a href="<?php echo get_term_link($term->term_id);?>"><?php echo esc_attr($term->name); ?></a> 
                                                </li>
                                            <?php //endif; ?>
                                        <?php endforeach;?>
                                    </ul>
                                <?php endif; wp_reset_postdata(); ?>
                        </div>
                    </div>
                    <div class="btn">
                        <a href="<?php bloginfo('url'); ?>/about-business-directory/">More Info</a>
                    </div>
                </div>
            </div>
        </div>


<?php
    endwhile;


endif;
wp_reset_postdata();