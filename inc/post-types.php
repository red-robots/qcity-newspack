<?php
/* Custom Post Types */
//DASH ICONS = https://developer.wordpress.org/resource/dashicons/
add_action('init', 'js_custom_init', 1);
function js_custom_init() {
    $post_types = array(
        array(
            'post_type' => 'event',
            'menu_name' => 'Events',
            'plural'    => 'Faculties',
            'single'    => 'Event',
            'supports'  => array('title','editor','custom-fields','thumbnail')
        ),
        array(
            'post_type' => 'business_listing',
            'menu_name' => 'Business Listings',
            'plural'    => 'Business Listings',
            'single'    => 'Business Listing',
            'supports'  => array('title','editor')
        ),
        array(
            'post_type' => 'church_listing',
            'menu_name' => 'Church Listings',
            'plural'    => 'Church Listings',
            'single'    => 'Church Listing',
            'supports'  => array('title','editor')
        ),
        array(
            'post_type' => 'gallery',
            'menu_name' => 'Photo Galleries',
            'plural'    => 'Photo Galleries',
            'single'    => 'Photo Gallery',
            'supports'  => array('title','editor', 'thumbnail')
        ),
        array(
            'post_type' => 'ad',
            'menu_name' => 'Ads',
            'plural'    => 'Ads',
            'single'    => 'Ad',
            'supports'  => array('title','editor')
        ),
        array(
            'post_type' => 'sponsor',
            'menu_name' => 'Sponsors',
            'plural'    => 'Sponsors',
            'single'    => 'Sponsor',
            'supports'  => array('title','editor')
        ),
        array(
            'post_type' => 'column',
            'menu_name' => 'Columns',
            'plural'    => 'Columns',
            'single'    => 'Column',
            'supports'  => array('title','editor')
        ),
        array(
            'post_type' => 'job',
            'menu_name' => 'Jobs',
            'plural'    => 'Jobs',
            'single'    => 'Job',
            'supports'  => array('title','editor')
        ),
        array(
            'post_type' => 'story',
            'menu_name' => 'Stories',
            'plural'    => 'Stories',
            'single'    => 'Story',
            'supports'  => array('title','editor','comments','comments')
        ),
    );
    
    if($post_types) {
        foreach ($post_types as $p) {
            $p_type = ( isset($p['post_type']) && $p['post_type'] ) ? $p['post_type'] : ""; 
            $single_name = ( isset($p['single']) && $p['single'] ) ? $p['single'] : "Custom Post"; 
            $plural_name = ( isset($p['plural']) && $p['plural'] ) ? $p['plural'] : "Custom Post"; 
            $menu_name = ( isset($p['menu_name']) && $p['menu_name'] ) ? $p['menu_name'] : $p['plural']; 
            $menu_icon = ( isset($p['menu_icon']) && $p['menu_icon'] ) ? $p['menu_icon'] : "dashicons-admin-post"; 
            $supports = ( isset($p['supports']) && $p['supports'] ) ? $p['supports'] : array('title','editor','custom-fields','thumbnail'); 
            $taxonomies = ( isset($p['taxonomies']) && $p['taxonomies'] ) ? $p['taxonomies'] : array(); 
            $parent_item_colon = ( isset($p['parent_item_colon']) && $p['parent_item_colon'] ) ? $p['parent_item_colon'] : ""; 
            $menu_position = ( isset($p['menu_position']) && $p['menu_position'] ) ? $p['menu_position'] : 20; 
            
            if($p_type) {
                
                $labels = array(
                    'name' => _x($plural_name, 'post type general name'),
                    'singular_name' => _x($single_name, 'post type singular name'),
                    'add_new' => _x('Add New', $single_name),
                    'add_new_item' => __('Add New ' . $single_name),
                    'edit_item' => __('Edit ' . $single_name),
                    'new_item' => __('New ' . $single_name),
                    'view_item' => __('View ' . $single_name),
                    'search_items' => __('Search ' . $plural_name),
                    'not_found' =>  __('No ' . $plural_name . ' found'),
                    'not_found_in_trash' => __('No ' . $plural_name . ' found in Trash'), 
                    'parent_item_colon' => $parent_item_colon,
                    'menu_name' => $menu_name
                );
            
            
                $args = array(
                    'labels' => $labels,
                    'public' => true,
                    'publicly_queryable' => true,
                    'show_ui' => true, 
                    'show_in_menu' => true, 
                    'show_in_rest' => true,
                    'query_var' => true,
                    'rewrite' => true,
                    'capability_type' => 'post',
                    'has_archive' => false, 
                    'hierarchical' => false, // 'false' acts like posts 'true' acts like pages
                    'menu_position' => $menu_position,
                    'menu_icon'=> $menu_icon,
                    'supports' => $supports
                ); 
                
                register_post_type($p_type,$args); // name used in query
                
            }
            
        }
    }
}
// Add new taxonomy, make it hierarchical (like categories)
add_action( 'init', 'ii_custom_taxonomies', 0 );
function ii_custom_taxonomies() {
        $posts = array();
        $posts = array(
            array(
                'post_type' => 'sponsor',
                'menu_name' => 'Sponsor Type',
                'plural'    => 'Sponsor Types',
                'single'    => 'Sponsor Type',
                'taxonomy'  => 'sponsor_category',
                'slug'      => array('slug' => 'sponsor-type', 'with_front' => false)
            ),
            array(
                'post_type' => 'event',
                'menu_name' => 'Event Type',
                'plural'    => 'Event Types',
                'single'    => 'Event Type',
                'taxonomy'  => 'event_category',
                'slug'      => array('slug' => 'event-type', 'with_front' => false)
            ),
            array(
                'post_type' => 'event',
                'menu_name' => 'Event Category',
                'plural'    => 'Event Category',
                'single'    => 'Event Category',
                'taxonomy'  => 'event_cat',
                'slug'      => array('slug' => 'event-category', 'with_front' => false)
            ),
            array(
                'post_type' => 'business_listing',
                'menu_name' => 'Business Type',
                'plural'    => 'Business Type',
                'single'    => 'Business Type',
                'taxonomy'  => 'business_category',
                'slug'      => array('slug' => 'business-category', 'with_front' => false)
            ),
            array(
                'post_type' => 'business_listing',
                'menu_name' => 'Classifications',
                'plural'    => 'Classifications',
                'single'    => 'Classification',
                'taxonomy'  => 'business_classification',
                'slug'      => array('slug' => 'business-classification', 'with_front' => false)
            ),
            array(
                'post_type' => 'church_listing',
                'menu_name' => 'Denomination',
                'plural'    => 'Denomination',
                'single'    => 'Denomination',
                'taxonomy'  => 'denomination',
                'slug'      => array('slug' => 'denomination', 'with_front' => false)
            ),
            array(
                'post_type' => 'church_listing',
                'menu_name' => 'Size',
                'plural'    => 'Size',
                'single'    => 'Size',
                'taxonomy'  => 'size',
                'slug'      => array('slug' => 'size', 'with_front' => false)
            ),
            array(
                'post_type' => 'job',
                'menu_name' => 'Category',
                'plural'    => 'Category',
                'single'    => 'Category',
                'taxonomy'  => 'job_cat',
                'slug'      => array('slug' => 'job-category', 'with_front' => false)
            ),
            array(
                'post_type' => 'job',
                'menu_name' => 'Level',
                'plural'    => 'Level',
                'single'    => 'Level',
                'taxonomy'  => 'level',
                'slug'      => array('slug' => 'level', 'with_front' => false)
            )
        );
    
    if($posts) {
        foreach($posts as $p) {
            $p_type = ( isset($p['post_type']) && $p['post_type'] ) ? $p['post_type'] : ""; 
            $single_name = ( isset($p['single']) && $p['single'] ) ? $p['single'] : "Custom Post"; 
            $plural_name = ( isset($p['plural']) && $p['plural'] ) ? $p['plural'] : "Custom Post"; 
            $menu_name = ( isset($p['menu_name']) && $p['menu_name'] ) ? $p['menu_name'] : $p['plural'];
            $taxonomy = ( isset($p['taxonomy']) && $p['taxonomy'] ) ? $p['taxonomy'] : "";
            $rewrite_slug = ( isset($p['slug']) && $p['slug'] ) ? $p['slug'] : array( 'slug' => $taxonomy );
            
            
            if( $taxonomy && $p_type ) {
                $labels = array(
                    'name' => _x( $menu_name, 'taxonomy general name' ),
                    'singular_name' => _x( $single_name, 'taxonomy singular name' ),
                    'search_items' =>  __( 'Search ' . $plural_name ),
                    'popular_items' => __( 'Popular ' . $plural_name ),
                    'all_items' => __( 'All ' . $plural_name ),
                    'parent_item' => __( 'Parent ' .  $single_name),
                    'parent_item_colon' => __( 'Parent ' . $single_name . ':' ),
                    'edit_item' => __( 'Edit ' . $single_name ),
                    'update_item' => __( 'Update ' . $single_name ),
                    'add_new_item' => __( 'Add New ' . $single_name ),
                    'new_item_name' => __( 'New ' . $single_name ),
                  );
              register_taxonomy($taxonomy,array($p_type), array(
                'hierarchical' => true,
                'labels' => $labels,
                'show_ui' => true,
                'show_in_rest' => true,
                'show_admin_column' => true,
                'query_var' => true,
                'rewrite' => $rewrite_slug,
              ));
            }
            
        }
    }
}
