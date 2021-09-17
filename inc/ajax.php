<?php

/*
*   QCity
*/

add_action('wp_ajax_nopriv_qcity_load_more', 'qcity_load_more');
add_action('wp_ajax_qcity_load_more', 'qcity_load_more');

function qcity_load_more(){

    $base_post = $_POST['basepoint'];
    $excludeIds = ( isset($_POST['postID']) && $_POST['postID'] ) ? explode(",",$_POST['postID']) : '';
    $paged      = $_POST['page'] + 1;
    $perpage    = 6;
    //$cat_id     = get_category_by_slug( 'sponsored-post' );
    $cat_id     = getTermId('sponsored-post');
    $offset     =  $base_post;    
    $getdate    = getdate();
    $exclude_cat = ( isset($_POST['exclude_cat']) && $_POST['exclude_cat'] ) ? explode(",",$_POST['exclude_cat']):'';
    $excludeCategories = array();

    /* Query by today year and last year */
    $date_query = array(
        'relation' => 'OR',
        array(
            'year' => $getdate["year"]-1,
        ),
        array(
            'year' => $getdate["year"],
        )
    );

    $not_in_categories = array('sponsored-post','commentaries');
    $args = array(
            'post_type'             => 'post',
            'post_status'           => 'publish',
            'paged'                 => $paged,
            'posts_per_page'        => $perpage,
            'date_query'            => $date_query,
            'tax_query' => array (
                array(
                    'taxonomy' => 'category',
                    'terms' => $not_in_categories,
                    'field' => 'slug',
                    'operator' => 'NOT IN',
                    'include_children' => true
                )
            ),
            'meta_query' => array(
                'relation' => 'OR',
                array(
                    'key' => 'home_more_news',
                    'compare' => 'NOT EXISTS',
                    'value' => 'null'
                ),
                array(
                    'key' => 'home_more_news',
                    'compare' => '=',
                    'value' => ''
                )
            )
        );

    // if($cat_id) {
    //     $args['category__not_in'] = $cat_id;
    // }

    if($exclude_cat) {
        foreach($exclude_cat as $catid) {
            $excludeCategories[] = $catid;
        }
    }
    if($cat_id) {
        $index = ($excludeCategories) ? count($excludeCategories) : 0;
        $excludeCategories[$index] = $cat_id;
    }

    if($excludeCategories && array_filter($excludeCategories)) {
        $args['category__not_in'] = array_filter($excludeCategories);
    }

    if($excludeIds){
        $args['post__not_in'] = $excludeIds;
    }

    $query = new WP_Query( $args );    
   
    if( $query->have_posts() ):

        while( $query->have_posts() ): $query->the_post();

            include( locate_template('template-parts/story-block.php', false, false) );   

            get_template_part( 'template-parts/separator');  

            $base_post++;       

        endwhile;

        wp_reset_postdata();

    else:    

        echo 0;

    endif;

    

    die();
}

/*
*   AJAX Call for Events Load more
*/

add_action('wp_ajax_nopriv_qcity_events_load_more', 'qcity_events_load_more');
add_action('wp_ajax_qcity_events_load_more', 'qcity_events_load_more');

function qcity_events_load_more(){

    $paged      = $_POST['page'] + 1;
    $today      = date('Ymd');
    $postID     = $_POST['postID'];
    $perpage    = $_POST['perPage'];
    $base_post  = $_POST['basepoint'];
    $offset     =  $base_post;

    $query = new WP_Query( array(
        'post_type'         => 'event',
        'post_status'       => 'publish',
        'paged'             => $paged,
        'order'             => 'ASC',
        'meta_key'          => 'event_date',
        'orderby'           => 'event_date',
        'posts_per_page'    => $perpage,
        'post__not_in'      => explode(',', $postID),
        'offset'            => $offset ,
        'meta_query'        => array(
                                'relation' => 'OR',
                                array(
                                    'key'       => 'event_date',
                                    'compare'   => '>=',
                                    'value'     => $today,
                                ),
                                array(
                                    'key'       => 'end_date',
                                    'compare'   => '>=',
                                    'value'     => $today,
                                ),
        ),        
    ));    
   
    if( $query->have_posts() ):
        echo '<section class="events">';
        while( $query->have_posts() ): $query->the_post();

            $img    = get_field('event_image');
            $date   = get_field("event_date", false, false);
            $date   = new DateTime($date);
            $enddate = get_field("end_date", false, false);
            $enddate = new DateTime($enddate);

            include( locate_template('template-parts/sponsored-block.php') );            

        endwhile;
        echo '</section>';
    else:    

        echo 0;

    endif;

    wp_reset_postdata();

    die();
}

/*
*       Business Directory Main page
*/

add_action('wp_ajax_nopriv_qcity_business_load_more', 'qcity_business_load_more');
add_action('wp_ajax_qcity_business_load_more', 'qcity_business_load_more');

function qcity_business_load_more(){
    $paged = $_POST['page'] + 1;

    $query = new WP_Query( array(        
        'post_type'         => 'business_listing',
        'post_status'       => 'publish',
        'paged'             => $paged,
        //'posts_per_page'    => 6,
    ));

    if( $query->have_posts() ):
        echo '<section class="sponsored">';
        while ( $query->have_posts()): $query->the_post(); 

            get_template_part( 'template-parts/business-block' );

        endwhile;
        echo '</section>';
    else:    

        echo 0;

    endif;

    wp_reset_postdata();

    die();

}

/*
*   Business Diretory Load More footer
*/

add_action('wp_ajax_nopriv_qcity_business_directory_load_more', 'qcity_business_directory_load_more');
add_action('wp_ajax_qcity_business_directory_load_more', 'qcity_business_directory_load_more');

function qcity_business_directory_load_more()
{
    $paged = $_POST['page'] + 1;

    $query = new WP_Query( array(        
        'post_type'         => 'business_listing',
        'post_status'       => 'publish',
        'paged'             => $paged,
        'posts_per_page'    => 6,
    ));

    if( $query->have_posts() ):

        while ( $query->have_posts()): $query->the_post(); $i++; 
            
            if( $i == 2 ) {
                $cl = 'even';
                $i = 0;
            } else {
                $cl = 'odd';
            }

            $phone      = get_field('phone');
            $website    = get_field('website');

            echo '<tr class="row ' . $cl.'">
                        <td>'. get_the_title() .'</td>';
                   echo '<td>'. $phone .'</td>';
                   echo '<td>
                            <a href="'. $website.'" target="_blank">View Website</a>
                        </td>
                    </tr>';

        endwhile;

    else:    

        echo 0;

    endif;

    wp_reset_postdata();

    die();
}

/*
*   Sidebar Load More
*/

add_action('wp_ajax_nopriv_qcity_sidebar_load_more', 'qcity_sidebar_load_more');
add_action('wp_ajax_qcity_sidebar_load_more', 'qcity_sidebar_load_more');

function qcity_sidebar_load_more()
{
    $paged      = $_POST['page'] + 1;
    $qp         = $_POST['qp'];
    $post_id    = $_POST['postid'];
    $is_trending = ( isset($_POST['trending']) && $_POST['trending'] ) ? $_POST['trending'] : '';

    if( $qp == 'entertainment' ){
        $args = array(     
                'category_name'     => 'Entertainment',        
                'post_type'         => 'post',        
                'post__not_in'      => array( $post_id ),
                'post_status'       => 'publish',
                'posts_per_page'    => 5,    
                'paged'             => $paged          
            );
    } elseif ( $qp == 'black-business' ){

        $args = array(     
                    'category_name'     => 'black-business',        
                    'post_type'         => 'post',        
                    'post__not_in'      => array( $post_id ),
                    'post_status'       => 'publish',
                    'posts_per_page'    => 5,    
                    'paged'             => $paged          
                );

    } else {
        $args = array(
            'post_type'         => $qp,
            'posts_per_page'    => 6,
            'post_status'       => 'publish',
            'paged'             => $paged   
        );
    }

    if($is_trending) {
        $args['meta_key'] = 'views';
        $args['orderby'] = 'post_date meta_value_num';
        $args['order'] = 'DESC';

        $trendingEntries = get_posts($args);
        $listOrders = array();
        foreach($trendingEntries as $e) {
            $id = $e->ID;
            $views = get_post_meta($id,'views',true);
            $listOrders[$id] = $views;
        } 
        arsort($listOrders);

        $i=1; foreach($listOrders as $pid=>$v) {
            $img  = get_field('event_image',$pid);
            $image = get_template_directory_uri() . '/images/default.png';
            $altImg = '';
            if( $img ){
              $image = $img['url'];
              $altImg = ( isset($img['title']) && $img['title'] ) ? $img['title']:'';
            } elseif ( has_post_thumbnail($pid) ) {
                $thumbid = get_post_thumbnail_id($pid);
                $image = get_the_post_thumbnail_url($pid);
                $altImg = get_the_title($thumbid);
            } 
            $viewsCount = get_post_meta($pid,'views',true);
            $postDate = get_the_date('d/m/Y',$pid);
            $pagelink = get_permalink($pid);
            $posttitle = get_the_title($pid); ?>
            <article data-postdate="<?php echo $postDate ?>" data-views="<?php echo $viewsCount ?>" class="small">
                <a href="<?php echo $pagelink; ?>">
                    <div class="img">
                        <img src="<?php echo $image; ?>" alt="<?php echo $altImg; ?>">
                    </div>
                    <div class="xtitle"><?php echo $posttitle; ?></div>
                </a>
            </article>
        <?php $i++; } wp_reset_postdata(); ?>
    
    <?php } else {

        $query = new WP_Query( $args );

        if( $query->have_posts() ):

            while( $query->have_posts() ): $query->the_post();
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

                if( $qp == 'black-business' ){
                    get_template_part( 'template-parts/sidebar-black-biz-block');
                } else { ?>

                    <?php //get_template_part( 'template-parts/sidebar-block'); ?>

                    <article data-group="page<?php echo $paged?>" data-postdate="<?php echo $postDate ?>" data-views="<?php echo $viewsCount ?>" id="<?php echo $viewsCount ?>" class="small">
                        <a href="<?php the_permalink(); ?>">
                            <div class="img">
                                <img src="<?php echo $image; ?>" alt="">
                            </div>
                            <div class="xtitle"><?php the_title(); ?></div>
                        </a>
                    </article>

                
                <?php
                }

            endwhile;

        else:

            echo 0;

        endif;
        wp_reset_postdata();

    }

    die();
}


/*
*   Search for Church
*/

add_action('wp_ajax_nopriv_qcity_church_search', 'qcity_church_search');
add_action('wp_ajax_qcity_church_search', 'qcity_church_search');

function qcity_church_search()
{
    $value  = sanitize_text_field($_GET['search_keyword']);
    $type   = sanitize_text_field($_GET['post_type']);

    if( empty($value) ){
        return;
    }

    $args = array(
        'post_type'         => $type, 
        'post_status'       => 'publish',
        'order'             => 'ASC',
        'orderby'           => 'title',
        'posts_per_page'    => -1,
        's'                 => $value        
    );

    $query = new WP_Query($args);

    $churchlist     = array();
    $search_result  = '';

    if( $query->have_posts() ):
        if( $type == 'church_listing' ){
            echo '<section class="church-list">';
        } elseif( $type == 'event' ){
            echo '<section class="events" style="margin-bottom: 30px">';
        } elseif( $type == 'business_listing' ){
            echo '<section class="sponsored">';
        } elseif( $type == 'job' ){
            echo '<div class="jobs-page">
                        <div class="biz-job-wrap">';
        }
        
        while( $query->have_posts() ): $query->the_post();

            switch ($type) {
                case "church_listing":
                    include(locate_template('template-parts/church.php')) ;
                    break;
                case "event":
                    include( locate_template('template-parts/sponsored-block.php') );
                    break;
                case "business_listing":
                    get_template_part( 'template-parts/business-block' );
                    break;
                case "job":
                    include(locate_template('template-parts/jobs-block.php')) ;
                    break;    
                default:
                    get_template_part( 'template-parts/story-block');
            }

        endwhile;
        pagi_posts_nav();

        if( $type == 'job' ){
            echo '</div></div>';
        } else {
            echo '</section>';  
        }
            

    else:

        echo 0;

    endif;

    wp_reset_postdata();

    die();

    
}





/*
*   Counter of Main Menu for Jobs and Events
*/

function get_category_counter( $category ){  
    
    if( $category == 'event' ) {

        $today = date('Ymd');
        $args = array(
                'post_type'   => $category,
                'post_status' => 'publish',
                'meta_query' => array(
                        array(
                            'key'       => 'event_date',
                            'compare'   => '>=',
                            'value'     => $today,
                        ),
                ),
        ); 

        $loop = new WP_Query( $args );        

        $total = $loop->found_posts;
   

    } else {

        $count      = wp_count_posts( $category );
        $total      = $count->publish;

    }

   return $total;
}

/*
*   Checking the post have sponsor
*/

function posts_have_sponsors($post_id, $sponsor_id)
{
    $next_id        = 0;
    $post_arr       = array();
    $sponsor_arr    = array();

    $args = array(     
        'category_name'     => 'Offers & Invites',        
        'post_type'         => 'post',        
        'post__not_in'      => array( $post_id ),
        'post_status'       => 'publish',
        'posts_per_page'    => 1,
        'meta_query'        => array(
                                array(
                                    'key' => 'sponsors', 
                                    'value' => '"' . $sponsor_id . '"', 
                                    'compare' => 'LIKE'
                                )
                            )
    );

    $posts_array = get_posts( $args );

    return ($posts_array) ? $posts_array[0] : 0;
    
}


/*
*   Getting All Categories
*/

function get_business_category_items(){
    //$args = array('number' => '-1',);
    $terms = get_terms('business_category');
   //asort($terms);
    $name = array_column($terms, 'name');

    array_multisort($name, SORT_ASC, $terms);
    return $terms;
}

function get_sponsor_paid(){
        $args = array(     
            'category_name'     => 'Offers & Invites',        
            'post_type'         => 'post',        
            'post_status'       => 'publish',
            'posts_per_page'    => 1,
            'orderby'           => 'rand', 
        );

        $wp_query = new WP_Query($args);

        return $wp_query;
}


add_filter( 'get_the_archive_title', function ($title) {    
    if ( is_category() ) {    
            $title = single_cat_title( '', false );    
        } elseif ( is_tag() ) {    
            $title = single_tag_title( '', false );    
        } elseif ( is_author() ) {    
            $title = '<span class="vcard">' . get_the_author() . '</span>' ;    
        } elseif ( is_tax() ) { //for custom post types
            $title = sprintf( __( '%1$s' ), single_term_title( '', false ) );
        }    
    return $title;    
});


function qcity_get_terms($postID, $term){

    $terms_list = wp_get_post_terms($postID, $term);
    $output = '';

    $i = 0;
    foreach( $terms_list as $term){ 
        $i++;
        if( $i == 1){
            $output .= '<a href="'. get_term_link($term) .'">'. $term->name .'</a>';
        }
        //$output .= '<a href="'. get_term_link($term) .'">'. $term->name .'</a>';
    }

    return $output;

}

/*==============================
 * Search Events via Ajax
 * Created by: Lisa - 09.19.2020
 *============================== */
add_action('wp_ajax_nopriv_my_ajax_search_event', 'my_ajax_search_event');
add_action('wp_ajax_my_ajax_search_event', 'my_ajax_search_event');
function my_ajax_search_event() {
    $keyword  = ( isset($_REQUEST['srch']) && $_REQUEST['srch'] ) ? sanitize_text_field($_REQUEST['srch']) : '';
    $posttype  = ( isset($_REQUEST['type']) && $_REQUEST['type'] ) ? sanitize_text_field($_REQUEST['type']) : '';
    $paged  = ( isset($_REQUEST['current_page']) && $_REQUEST['current_page'] ) ? $_REQUEST['current_page'] : 1;
    $base_url  = ( isset($_REQUEST['base_url']) && $_REQUEST['base_url'] ) ? $_REQUEST['base_url'] : 1;
    $more_button  = ( isset($_REQUEST['more_button']) && $_REQUEST['more_button'] ) ? $_REQUEST['more_button'] : '';
    $response['result'] = '';
    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        $vars = array(
            'keyword'=>$keyword,
            'post_type'=>$posttype,
            'paged'=>$paged,
            'base_url'=>$base_url,
            'more_button'=>$more_button
        );
        $output = get_search_result_event($vars);
        $response['result'] = $output;
        echo json_encode($response);
    }
    else {
      header("Location: ".$_SERVER["HTTP_REFERER"]);
    }
    die();
}


function get_search_result_event($var) {

    $keyword = ( isset($var['keyword']) && $var['keyword'] ) ? $var['keyword'] : '';
    $posttype = ( isset($var['post_type']) && $var['post_type'] ) ? $var['post_type'] : '';
    $paged = ( isset($var['paged']) && $var['paged'] ) ? $var['paged'] : '';
    $base_url = ( isset($var['base_url']) && $var['base_url'] ) ? $var['base_url'] : '';
    $more_button = ( isset($var['more_button']) && $var['more_button'] ) ? $var['more_button'] : '';

    $day = date('d');
    $day_plus = $day - 1;
    $today = date('Ym') . $day_plus;
    $per_page = 27;
    $articles = '';
    $total_pages = '';
    $total_result = '';
    $next_page = $paged + 1;
    $paginate = '';

    if($keyword && $posttype) {

        $args = array(
            'post_type'         =>$posttype,
            's'                 =>$keyword,
            'posts_per_page'    => $per_page,
            'paged'             => $paged,
            'post_status'       =>'publish',
            'order'             => 'ASC',
            'orderby'           => 'post_title',
        );

        /* Uncommenting the `meta_query` will list the current and future event posts */
        // $args['meta_query'] = array(
        //         array(
        //             'key'       => 'event_date',
        //             'compare'   => '>=',
        //             'value'     => $today,
        //         )
        //     );
        // $args['meta_key'] = 'event_date';
        // $args['orderby'] = 'meta_value_num';

        $result = new WP_Query($args);
        if ( $result->have_posts() )  { 
            $total_pages = $result->max_num_pages;
            $total_result = $result->found_posts;

            ob_start();

            while ($result->have_posts()) : $result->the_post(); 
                $date       = get_field("event_date", false, false);
                $date       = new DateTime($date);
                $enddate    = get_field("end_date", false, false);
                $enddate    = ( !empty($enddate) ) ? new DateTime($enddate) : $date;

                $date_start     = strtotime($date->format('Y-m-d'));
                $date_stop      = strtotime($enddate->format('Y-m-d'));
                $now            = strtotime(date('Y-m-d'));
                $more_result_class = ( isset($more_button) && $more_button ) ? $more_button : '';
                include( locate_template('template-parts/sponsored-block.php') );
            endwhile;
            $articles = ob_get_contents();
            ob_end_clean();

            
            ob_start();
            if ($total_pages > 1){
                if($paged==$total_pages) {  ?>
                    <div id="load-more-result" class="fw-left more">
                        <div class="sectionWrap">
                            <div class="end-post-text">No more post to load!</div>
                        </div>
                    </div>
                <?php } else { ?>
                    <div id="load-more-result" class="fw-left more">
                        <div class="sectionWrap">
                            <a href="#" id="load-more-result-btn" class="red" data-permalink="<?php echo $base_url; ?>" data-type="<?php echo $posttype ?>" data-keyword="<?php echo $keyword?>" data-next-page="<?php echo $next_page?>" data-total-pages="<?php echo $total_pages; ?>">        
                                <span class="load-text">Load More</span>
                                <span class="load-icon"><i class="fas fa-sync-alt spin"></i></span>
                            </a>
                        </div>
                    </div>
                <?php } 
            }
            $paginate = ob_get_contents();
            ob_end_clean();
        }

    }

    $response['posts'] = $articles;
    $response['count'] = $total_result;
    $response['total_pages'] = $total_pages;
    $response['next_page'] = $next_page;
    $response['paginate'] = $paginate;
    $response['base_url'] = $base_url;

    return $response;
}


