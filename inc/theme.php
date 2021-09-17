<?php
/**
 * Custom theme functions.
 *
 * 
 *
 * @package ACStarter
 */
  
// This theme uses a custom image size for featured images, displayed on "standard" posts.
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 624, 9999 ); // Unlimited height, soft crop
add_image_size('event',150,125,array('center','center'));
add_image_size('photo',800,556,array('center','top'));
add_image_size('thirds',400,278,array('center','top'));
add_image_size('small',250,9999 );


/*-------------------------------------
  
  Automatically insert add after paragraph # ...

---------------------------------------*/
// function insert_ad_block( $text ) {
//   $postType = get_post_type();
//   $on = get_field('automatic_ads', 'option');
//     if ( is_single() ) :
//       if( $postType == 'post' && $on[0] == 'On' ) {
//       // echo $on[0];
//         $ads_text = "<div class='googleadswrap'>
// <div id='div-gpt-ad-1565127901858-0'>
//   <script>
//     googletag.cmd.push(function() { googletag.display('div-gpt-ad-1565127901858-0'); });
//   </script>
// </div><div class='promote insert '>Sponsored</div></div>";

//         $split_by = "\n";
//         $insert_after = 6; //number of paragraphs

//         // make array of paragraphs
//         $paragraphs = explode( $split_by, $text);

//         // if array elements are less than $insert_after set the insert point at the end
//         $len = count( $paragraphs );
//         if (  $len < $insert_after ) $insert_after = $len;

//         // insert $ads_text into the array at the specified point
//         array_splice( $paragraphs, $insert_after, 0, $ads_text );

//         // loop through array and build string for output
//         foreach( $paragraphs as $paragraph ) {
//             $new_text .= $paragraph; 
//         }

//         return $new_text;
//     }
//     endif;

//     return $text;

// }
// add_filter('the_content', 'insert_ad_block');

//function stick_right_js()
//{
//    wp_enqueue_script( 'stick-right-post-js', get_template_directory_uri() . '/js/stick-right.js', array( 'wp-edit-post', 'wp-plugins', 'wp-i18n', 'wp-element' ), '1.0' );
//}
//add_action( 'admin_enqueue_scripts', 'stick_right_js' );

/*-------------------------------------
  
  Gutenburg Google Adword Block

---------------------------------------*/
// For preview on backend:
add_action( 'admin_enqueue_scripts', 'load_google_ad_admin' );
function load_google_ad_admin() {
  wp_enqueue_script( 'goolge_ad_wp_admin_js', 'https://www.googletagservices.com/tag/js/gpt.js', false, '1.0.0' );
}


function load_google_ad_admin_ind() {
  wp_enqueue_script( 'goolge_ad_wp_admin_css_min', get_template_directory_uri() . '/js/google.js', false, '1.0.0' );
}
add_action( 'admin_enqueue_scripts', 'load_google_ad_admin_ind' );



add_action('acf/init', 'acc_gut_ad_block_acf_728');
function acc_gut_ad_block_acf_728() {
  
  // check function exists
  if( function_exists('acf_register_block') ) {
    
    // register a testimonial block
    acf_register_block(array(
      'name'        => 'adblock728',
      'title'       => __('Ad Block 728 x 90'),
      'description'   => __('A custom Google Ad Block.'),
      'render_callback' => 'acf_gut_callback',
      'category'      => 'formatting',
      'icon'        => 'welcome-widgets-menus',
      'keywords'      => array( 'googlead' ),
      'mode'              => 'preview',
    ));
  }
}

add_action('acf/init', 'acc_gut_ad_block_acf_300');
function acc_gut_ad_block_acf_300() {
  
  // check function exists
  if( function_exists('acf_register_block') ) {
    
    // register a testimonial block
    acf_register_block(array(
      'name'        => 'adblock300',
      'title'       => __('Ad Block 300 x 250'),
      'description'   => __('A custom Google Ad Block.'),
      'render_callback' => 'acf_gut_callback',
      'category'      => 'formatting',
      'icon'        => 'welcome-widgets-menus',
      'keywords'      => array( 'googlead' ),
      'mode'              => 'preview',
    ));
  }
}

add_action('acf/init', 'acc_gut_ad_block_acf_600');
function acc_gut_ad_block_acf_600() {
  
  // check function exists
  if( function_exists('acf_register_block') ) {
    
    // register a testimonial block
    acf_register_block(array(
      'name'        => 'adblock600',
      'title'       => __('Ad Block 600 x 200'),
      'description'   => __('A custom Google Ad Block.'),
      'render_callback' => 'acf_gut_callback',
      'category'      => 'formatting',
      'icon'        => 'welcome-widgets-menus',
      'keywords'      => array( 'googlead' ),
      'mode'              => 'preview',
    ));
  }
}


add_action('acf/init', 'acc_gut_newsletter_block');
function acc_gut_newsletter_block() {
  
  // check function exists
  if( function_exists('acf_register_block') ) {
    
    // register a testimonial block
    acf_register_block(array(
      'name'        => 'newsletter',
      'title'       => __('Newsletter Signup'),
      'description'   => __('Newletter Signup Block.'),
      'render_callback' => 'acf_gut_callback',
      'category'      => 'formatting',
      'icon'        => 'welcome-widgets-menus',
      'keywords'      => array( 'newsletter' ),
      'mode'              => 'preview',
    ));
  }
}


add_action('acf/init', 'acc_gut_custom_line_block');
function acc_gut_custom_line_block() {
  
  // check function exists
  if( function_exists('acf_register_block') ) {
    
    // register a testimonial block
    acf_register_block(array(
      'name'        => 'custom-line',
      'title'       => __('Qcity Custom Line'),
      'description'   => __('Qcity Custom Line'),
      'render_callback' => 'acf_gut_callback',
      'category'      => 'layout',
      'icon'        => 'welcome-widgets-menus',
      'keywords'      => array( 'custom-line' ),
      'mode'              => 'preview',
    ));
  }
}



function acf_gut_callback( $block ) {
  
  // convert name ("acf/adblock") into path friendly slug ("adblock")
  $slug = str_replace('acf/', '', $block['name']);
  
  // include a template part from within the "template-parts/block" folder
  if( file_exists( get_theme_file_path("/template-parts/block/content-{$slug}.php") ) ) {
    include( get_theme_file_path("/template-parts/block/content-{$slug}.php") );
  }
}

/*-------------------------------------
  Move JetPack Share
---------------------------------------*/
function jptweak_remove_share() {
    remove_filter( 'the_content', 'sharing_display',19 );
    remove_filter( 'the_excerpt', 'sharing_display',19 );
    if ( class_exists( 'Jetpack_Likes' ) ) {
        remove_filter( 'the_content', array( Jetpack_Likes::init(), 'post_likes' ), 30, 1 );
    }
}
 
add_action( 'loop_start', 'jptweak_remove_share' );

/*-------------------------------------
  Custom client login, link and title.
---------------------------------------*/
function my_login_logo() { ?>
<style type="text/css">
  body.login {
    background: #ececec;
  }
  body.login div#login h1 a {
    background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/images/logo.png');
    background-size: contain;
    width: 100%;
    height: 100px;
    margin-bottom: 10px;
  }
  .login #backtoblog, .login #nav {
    text-align: center;
  }
</style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

// Change Link
function loginpage_custom_link() {
  return get_site_url();
}
add_filter('login_headerurl','loginpage_custom_link');

/*-------------------------------------
  Favicon.
---------------------------------------*/
function mytheme_favicon() { 
 echo '<link rel="shortcut icon" href="' . get_bloginfo('stylesheet_directory') . '/images/favicon.ico" >'; 
} 
add_action('wp_head', 'mytheme_favicon');
// wordpress excerpt
function custom_excerpt_length( $length ) {
  return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
// Excerpt Function
function get_excerpt($count){
  // whatever you want to append on the end of the last word
  $words = '...';
  $excerpt = get_the_excerpt();
  $excerpt = strip_tags($excerpt);
  $excerpt = wp_trim_words($excerpt, $count, $words);
  $excerpt = strip_shortcodes($excerpt);
  return $excerpt;
}

// Title Function
function ac_get_title($count){
  // whatever you want to append on the end of the last word
  $postId = get_the_ID();
  $words = '...';
  $title = get_the_title($postId);
  $title = strip_tags($title);
  $title = substr($title, 0, $count);
  $title = $title . '...';
  return $title;
}

function change_post_menu_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'News';
    $submenu['edit.php'][5][0] = 'News';
    $submenu['edit.php'][10][0] = 'Add News';
    echo '';
}
function change_post_object_label() {
  global $wp_post_types;
  $labels = &$wp_post_types['post']->labels;
  $labels->name = 'News';
  $labels->singular_name = 'News';
  $labels->add_new = 'Add News';
  $labels->add_new_item = 'Add News';
  $labels->edit_item = 'Edit News';
  $labels->new_item = 'News';
  $labels->view_item = 'View News';
  $labels->search_items = 'Search News';
  $labels->not_found = 'No News found';
  $labels->not_found_in_trash = 'No News found in Trash';
  //$wp_post_types['post']->publicly_queryable = false;
}
add_action( 'init', 'change_post_object_label' );
add_action( 'admin_menu', 'change_post_menu_label' );
  
  
add_filter('gettext','custom_enter_title');

function custom_enter_title( $input ) {

    global $post_type;

    if( is_admin() && 'Enter title here' == $input && 'church_listing' == $post_type )
        return 'Church Name';

    return $input;
}
add_filter( 'acf/get_valid_field', 'change_input_labels');
function change_input_labels($field) {
//$formId = $_POST['acf']['id'];
/*$formId = $_POST['acf']['id'];
echo '<pre>';
print_r($formId);
echo '</pre>';*/
if( is_page(474) ) {
  if($field['name'] == '_post_title') {
    $field['label'] = 'Church Name';
  }
//}
}

if( is_page(219) ) {
  if($field['name'] == '_post_content') {
    $field['label'] = 'Business Details';
  }
//}
}

if( is_page(37205) ) {
    if($field['name'] == '_post_content') {
        $field['label'] = 'Tell us about your business';
      $field['instructions'] = 'What products or services do your offer? What makes your business special? No more than 150 words.';
    }
  if($field['name'] == '_post_title') {
    $field['label'] = 'Name of Business';
  }
//}
}
  //if($field['name'] == '_post_content') {
    //$field['label'] = 'Custom Content Title';
  //}
    
  return $field;
    
}
/*-------------------------------------------------------------------------------
  Custom Columns
-------------------------------------------------------------------------------*/

function my_page_columns($columns)
{
  $columns = array(
    'cb' => '<input type="checkbox" />',
    'title'   => 'Title',
    //'thumbnail' =>  'Thumbnail',
    'event'   => 'Event Date',
    'bella_views'=>'Views'
    //'author'  =>  'Author',
    //'date'    =>  'Date',
  );
  return $columns;
}

function my_custom_columns($column, $post_id)
{
  global $post;
  if($column == 'event')
  {
      $date = DateTime::createFromFormat('Ymd', get_field('event_date'));
      $startDateSubmitted = get_field('event_start_date_submitted'); 
      
      /*echo '<pre>';
      print_r($startDateSubmitted);*/
      
      if( $date != '' ) {
        echo $date->format('M/d/Y');
      }  else {
        echo 'No Date, or Pending'; 
      }

  } elseif ($column == 'thumbnail'){
    
    $image = get_field('event_image');
    $imageSubmitted = get_field('event_image_submitted'); 
    
    if( $imageSubmitted != '' ) {
      $myUrl = $imageSubmitted; 
    } elseif( $image != '' ) {
      $myUrl = $image['sizes']['thumbnail'];  
    } else {
      $myUrl = '';
    }
    
    if( $myUrl != '' ) {
      echo '<img src="'. $myUrl .'" />';
    } else {
      echo 'no image with this event';  
    }
  } elseif($column == "bella_views") {
    echo intval(get_post_meta($post_id,'views',true));

  }
}

add_action("manage_event_posts_custom_column", "my_custom_columns",10,2);
add_filter("manage_edit-event_columns", "my_page_columns");

/*-------------------------------------------------------------------------------
  Sortable Columns
-------------------------------------------------------------------------------*/

function my_column_register_sortable( $columns )
{
  $columns['event'] = 'event';
  $columns['bella_views'] = 'slice';
  return $columns;
}

add_filter("manage_edit-event_sortable_columns", "my_column_register_sortable" );
/* -----------------------------------------------------------------------------
    Pre get posts sort for sortable views
--------------------------------------------------------------------------------*/
add_action( 'pre_get_posts', 'bella_views_orderby' );
function bella_views_orderby( $query ) {
    if( ! is_admin() )
        return;
 
    $orderby = $query->get( 'orderby');
 
    if( 'slice' == $orderby ) {
        $query->set('meta_key','views');
        $query->set('orderby','meta_value_num');
    }
}
/*-------------------------------------------------------------------------------
  Sanatize the ACF form inputs

-------------------------------------------------------------------------------*/

// but not if admin because of Ads and Analytics
if( !is_admin() ) :
  function my_kses_post( $value ) {
    
    // is array
    if( is_array($value) ) {
    
      return array_map('my_kses_post', $value);
    
    }
    
    
    // return
    return wp_kses_post( $value );

  }

  add_filter('acf/update_value', 'my_kses_post', 10, 1);
endif;
/*-------------------------------------
  Custom WYSIWYG Styles
---------------------------------------*/
function acc_custom_styles($buttons) {
  array_unshift($buttons, 'styleselect');
  return $buttons;
}
add_filter('mce_buttons_2', 'acc_custom_styles');
/*
* Callback function to filter the MCE settings
*/
 
function my_mce_before_init_insert_formats( $init_array ) {  
 
// Define the style_formats array
  $style_formats = array(  
    // Each array child is a format with it's own settings
    array(  
      'title' => 'Alternate Title',  
      'block' => 'span',  
      'classes' => 'alternate-title',
      'wrapper' => true,
      
    ),
    array(  
      'title' => 'Q',  
      'block' => 'span',  
      'classes' => 'drop-q',
      'wrapper' => true,
      
    ),
    array(  
      'title' => 'Q Large',  
      'block' => 'span',  
      'classes' => 'drop-q-large',
      'wrapper' => true,
      
    ),
    array(  
      'title' => 'Q XL',  
      'block' => 'span',  
      'classes' => 'drop-q-xl',
      'wrapper' => true,
      
    )
  );  
  // Insert the array, JSON ENCODED, into 'style_formats'
  $init_array['style_formats'] = json_encode( $style_formats );  
  return $init_array;  
  
} 
// Attach callback to 'tiny_mce_before_init' 
add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' ); 
// Add styles to WYSIWYG in your theme's editor-style.css file
function my_theme_add_editor_styles() {
    add_editor_style( 'editor-style.css' );
}
add_action( 'init', 'my_theme_add_editor_styles' );


/*-------------------------------------
  Relavanssi Search for ACF Relationship field or post object
---------------------------------------*/
add_filter('relevanssi_admin_search_ok', 'rlv_acf_related_search');
function rlv_acf_related_search($search_ok) {
    if (defined("DOING_AJAX")) $search_ok = false;
    return $search_ok;
}

/*-------------------------------------

  Filters the Plugin, "WordPress Popular Posts"

  Takes ACF field 'post_expire' won't show posts past their expire date.

---------------------------------------*/
add_filter('wpp_query_posts','my_date_checker');
function my_date_checker($result){
  $return = array();
    $max = count($result);
    $count = 0;
    for($i=0;$i<$max;$i++):
      $today = intval(date('Ymd'));
      $postDate = intval(get_field('post_expire', $result[$i]->id ));
      if($postDate > $today || $postDate == '' ){
        $return[] = $result[$i];
        $count++;
        if($count===4)break;
      } else continue;
    endfor;
  return $return; 
}


/**
 * Save ACF image field to post Featured Image
 * @uses Advanced Custom Fields Pro
 */
add_action( 'acf/save_post', 'tsm_save_image_field_to_featured_image', 10 );
function tsm_save_image_field_to_featured_image( $post_id ) {
 
    // Bail if not logged in or not able to post
    // if ( ! ( is_user_logged_in() || current_user_can('publish_posts') ) ) {
    //     return;
    // }
 
    // Bail early if no ACF data
    if( empty($_POST['acf']) ) {
        return;
    }
 
    // ACF image field key
    $image = $_POST['acf']['field_55e5f132f7189'];
 
    // Bail if image field is empty
    if ( empty($image) ) {
        return;
    }
 
    // Add the value which is the image ID to the _thumbnail_id meta data for the current post
    add_post_meta( $post_id, '_thumbnail_id', $image );
 
}

//adding post format support
add_theme_support( 'post-formats', array( 'video' ) );

function bella_signup_embed( $atts ) {
  $header_text = get_field("email_signup_header",21613);
  $copy = get_field("email_signup_copy",21613);
  $button_text = get_field("email_signup_button_text",21613);
  $link = get_the_permalink( 21613);
  return '<div class="signup-embed">
    <div class="col-2">
      <a href="'.$link.'">'.$button_text.'</a>
    </div>
    <div class="col-1">
      <div class="title">'.$header_text.'</div>
      <div class="copy">'.$copy.'</div>
    </div>
    <div class="clear"></div>
  </div><!--.signup-embed-->';
}
add_shortcode( 'signup-embed', 'bella_signup_embed' );

function bella_video_title($title, $id){
  if($id){
    if(has_post_format( 'video', $id)){
      $title .= '&nbsp;<i class="fa fa-play-circle-o"></i>';
    }
  }
  return $title;
}
add_filter( 'the_title', 'bella_video_title', 10, 2 );


/* from https://code.tutsplus.com/tutorials/guide-to-creating-your-own-wordpress-editor-buttons--wp-30182 */
add_action( 'init', 'bella_buttons' );
function bella_buttons() {
    add_filter( "mce_external_plugins", "bella_add_buttons" );
    add_filter( 'mce_buttons', 'bella_register_buttons' );
}
function bella_add_buttons( $plugin_array ) {
    $plugin_array['bella'] = get_template_directory_uri() . '/js/bella-tinymce-plugin.js';
    return $plugin_array;
}
function bella_register_buttons( $buttons ) {
    array_push( $buttons, 'signup' ); // dropcap', 'recentposts
    return $buttons;
}
add_action('admin_head','bella_hide_publish_events');
function bella_hide_publish_events(){
  global $post;
  if(strcmp(get_post_type($post),"event")===0||strcmp(get_post_type($post),"business_listing")===0||strcmp(get_post_type($post),"job")===0){
    add_filter( 'publicize_checkbox_default',  '__return_false'  );
  }
}
function bella_acf_prepare_field( $field ) {
  if(is_page('post-a-job')){
    $field['label'] = "Job Title - Company Name";
    $field['instructions'] = "Please enter the job title followed by a dash and the company name";    
  }
  return $field;   
}
add_filter('acf/prepare_field/name=_post_title', 'bella_acf_prepare_field');

/*-------------------------------------
	Adds Options page for ACF.
---------------------------------------*/
if( function_exists('acf_add_options_page') ) {acf_add_options_page();}


/*-------------------------------------
  Move Yoast to the Bottom
---------------------------------------*/
function yoasttobottom() {
  return 'low';
}
add_filter( 'wpseo_metabox_prio', 'yoasttobottom');

/*-------------------------------------
  Add a last and first menu class option
---------------------------------------*/

function ac_first_and_last_menu_class($items) {
  foreach($items as $k => $v){
    $parent[$v->menu_item_parent][] = $v;
  }
  foreach($parent as $k => $v){
    $v[0]->classes[] = 'first';
    $v[count($v)-1]->classes[] = 'last';
  }
  return $items;
}
add_filter('wp_nav_menu_objects', 'ac_first_and_last_menu_class');
/*-------------------------------------



 Limit File Size in Media Uploader




---------------------------------------*/
define('WPISL_DEBUG', false);

require_once ('wpisl-options.php');

class WP_Image_Size_Limit {

  public function __construct()  {  
      add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array($this, 'add_plugin_links') );
      add_filter('wp_handle_upload_prefilter', array($this, 'error_message'));
  }  

  public function add_plugin_links( $links ) {
    return array_merge(
      array(
        'settings' => '<a href="' . get_bloginfo( 'wpurl' ) . '/wp-admin/options-media.php?settings-updated=true#wpisl-limit">Settings</a>'
      ),
      $links
    );
  }

  public function get_limit() {
    $option = get_option('wpisl_options');

    if ( isset($option['img_upload_limit']) ){
      $limit = $option['img_upload_limit'];
    } else {
      $limit = $this->wp_limit();
    }

    return $limit;
  }

  public function output_limit() {
    $limit = $this->get_limit();
    $limit_output = $limit;
    $mblimit = $limit / 1000;


    if ( $limit >= 1000 ) {
      $limit_output = $mblimit;
    }

    return $limit_output;
  }

  public function wp_limit() {
    $output = wp_max_upload_size();
    $output = round($output);
    $output = $output / 1000000; //convert to megabytes
    $output = round($output);
    $output = $output * 1000; // convert to kilobytes

    return $output;

  }

  public function limit_unit() {
    $limit = $this->get_limit();

    if ( $limit < 1000 ) {
      return 'KB';
    }
    else {
      return 'MB';
    }

  }

  public function error_message($file) {
    $size = $file['size'];
    $size = $size / 1024;
    $type = $file['type'];
    $is_image = strpos($type, 'image');
    $limit = $this->get_limit();
    $limit_output = $this->output_limit();
    $unit = $this->limit_unit();

    if ( ( $size > $limit ) && ($is_image !== false) ) {
       $file['error'] = 'Image files must be smaller than '.$limit_output.$unit;
       if (WPISL_DEBUG) {
        $file['error'] .= ' [ filesize = '.$size.', limit ='.$limit.' ]';
       }
    }
    return $file;
  }

  public function load_styles() {
    $limit = $this->get_limit();
    $limit_output = $this->output_limit();
    $mblimit = $limit / 1000;
    $wplimit = $this->wp_limit();
    $unit = $this->limit_unit();


    ?>
    <!-- .Custom Max Upload Size -->
    <style type="text/css">
    .after-file-upload {
      display: none;
    }
    <?php if ( $limit < $wplimit ) : ?>
    .upload-flash-bypass:after {
      content: 'Maximum image size: <?php echo $limit_output . $unit; ?>.';
      display: block;
      margin: 15px 0;
    }
    <?php endif; ?>

    </style>
    <!-- END Custom Max Upload Size -->
    <?php
  }


}
$WP_Image_Size_Limit = new WP_Image_Size_Limit;
add_action('admin_head', array($WP_Image_Size_Limit, 'load_styles'));


/**
 * Gutenberg scripts and styles
 * @link https://www.billerickson.net/block-styles-in-gutenberg/
 */
function be_gutenberg_scripts() {

  wp_enqueue_script(
    'be-editor', 
    get_stylesheet_directory_uri() . '/js/editor.js', 
    array( 'wp-blocks', 'wp-dom' ), 
    filemtime( get_stylesheet_directory() . '/js/editor.js' ),
    true
  );
}
add_action( 'enqueue_block_editor_assets', 'be_gutenberg_scripts' );
/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function tabor_setup() {
        // Add support for editor styles.
          add_theme_support( 'editor-styles' );
          // Enqueue editor styles.
        add_editor_style( 'editor-style.css' );
}
add_action( 'after_setup_theme', 'tabor_setup');

/*

  Functions from old theme for Jobs Counter

*/

add_action( 'wp_ajax_bella_get_jobs_count', 'bella_ajax_get_jobs_count' );
add_action( 'wp_ajax_nopriv_bella_get_jobs_count', 'bella_ajax_get_jobs_count' );
function bella_ajax_get_jobs_count() {
  $today = date('Ymd');
  $args = array(
    'post_type'=>'job',
    'posts_per_page'=>-1,
    'post_status'=>'publish',
    'meta_query' => array(
      'relation' => 'OR',
      array(
        'key' => 'post_expire',
        'value' => $today,
        'compare' => '>'
      ),
      array(
        'key' => 'post_expire',
        'value' => '',
        'compare' => '='
      ),
      array(
        'key' => 'post_expire',
        'compare' => 'NOT EXISTS'
      ),
    )
  );
  $query = new WP_Query($args);
  $response    = array(
    'what'   => 'count',
    'action' => 'bella_get_jobs_count',
    'data'   => $query->post_count,
  );
  $xmlResponse = new WP_Ajax_Response( $response );
  $xmlResponse->send();
  die( 0 );
}

add_action( 'wp_ajax_bella_get_events_count', 'bella_ajax_get_events_count' );
add_action( 'wp_ajax_nopriv_bella_get_events_count', 'bella_ajax_get_events_count' );
function bella_ajax_get_events_count() {
  global $wpdb;

  $today = date('Ymd');
  // $prepare_string = "SELECT DISTINCT ID FROM $wpdb->posts LEFT JOIN $wpdb->postmeta ON ( $wpdb->posts.ID = $wpdb->postmeta.post_id ) LEFT JOIN $wpdb->postmeta AS mt1 ON ( $wpdb->posts.ID = mt1.post_id ) WHERE ( ( $wpdb->postmeta.meta_key = 'event_date' AND $wpdb->postmeta.meta_value >= %d ) OR ( ( $wpdb->postmeta.meta_key = 'event_date' AND $wpdb->postmeta.meta_value < %d ) AND ( mt1.meta_key = 'end_date' AND mt1.meta_value >= %d ) ) OR ( $wpdb->postmeta.meta_key = 'event_date' AND $wpdb->postmeta.meta_value = '' ) )";


  $prepare_string = "
      SELECT DISTINCT ID 
      FROM        $wpdb->posts 
      LEFT JOIN   $wpdb->postmeta ON ( $wpdb->posts.ID = $wpdb->postmeta.post_id ) 
      LEFT JOIN   $wpdb->postmeta AS mt1 ON ( $wpdb->posts.ID = mt1.post_id ) 
      WHERE       ( ( $wpdb->postmeta.meta_key = 'event_date' AND $wpdb->postmeta.meta_value >= %d ) 
      OR          ( ( $wpdb->postmeta.meta_key = 'event_date' AND $wpdb->postmeta.meta_value < %d ) 
      AND         ( mt1.meta_key = 'end_date' AND mt1.meta_value >= %d ) ) 
      OR          ( $wpdb->postmeta.meta_key = 'event_date' AND $wpdb->postmeta.meta_value = '' ) )
      AND         $wpdb->posts.post_status = 'publish'
  ";


  $prepare_args = array();
  array_unshift($prepare_args,$today);
  array_unshift($prepare_args,$today);
  array_unshift($prepare_args,$today);
  array_unshift($prepare_args,$prepare_string);
  $results = $wpdb->get_results( call_user_func_array(array($wpdb, "prepare"),$prepare_args) );
  $count = 0;
  if($results):
    $count = count($results);
  endif;
  $response    = array(
    'what'   => 'count',
    'action' => 'bella_get_events_count',
    'data'   => $count,
  );
  $xmlResponse = new WP_Ajax_Response( $response );
  $xmlResponse->send();
  die( 0 );
}

function bella_acf_save_post( $post_id )
{
  $direct = get_field("application_direct", $post_id);
  $email = get_field("application_email", $post_id);
  if((!empty($direct)||!empty($email))&&!is_admin()):
    wp_redirect('https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=RTGB4KW6XD2GN'); 
    exit;
  endif;
}
add_action('acf/save_post', 'bella_acf_save_post', 100,1);

//More posts - first for logged in users, other for not logged in
add_action('wp_ajax_bella_ajax_next_event', 'bella_ajax_next_event');
add_action('wp_ajax_nopriv_bella_ajax_next_event', 'bella_ajax_next_event');

function bella_ajax_next_event() {

  global $wpdb;

    $today = date('Ymd');
  $future = null;
  if(isset($_POST['date'])&&!empty($_POST['date'])):
    $add = null;
    if(strcmp($_POST['date'],'today')==0):
      $add = 'P1D';
    elseif(strcmp($_POST['date'],'week')==0):
      $add = 'P7D';
    elseif(strcmp($_POST['date'],'month')==0):
      $add = 'P1M';
    elseif(strcmp($_POST['date'],'year')==0):
      $add = 'P1Y';
    elseif(strcmp($_POST['date'],'weekend')==0):
      $start = new DateTime('NOW');
      $start->modify('friday this week');
      $today = $start->format('Ymd');
      $enddate = new DateTime('NOW');
      $enddate->modify('monday next week');
      $future = $enddate->format('Ymd');
    endif;
    if($add!==null):
      $enddate = new DateTime('NOW');
      $enddate->add(new DateInterval($add));
      $future = $enddate->format('Ymd');
    endif;//if add not null
  endif;//if for date set

  $args = array(
    'post_type'=>'event',
    'posts_per_page' => -1,
    'orderby'=>'meta_value',
    'meta_key'=>'event_date',
    'post_status'=>'publish',
    'order'=>'ASC'
  );
  if(isset($_POST['tax'])&&!empty($_POST['tax'])&&isset($_POST['term'])&&!empty($_POST['term'])):
    $args['tax_query']=array(array(
      'taxonomy'=>$_POST['tax'],
      'field'=>'slug',
      'terms'=>$_POST['term']
    ));
  endif;
  $post__in = array();
  if($future!==null):
    //old queries for reference (didn't work generated from wordpress)

    //LEFT JOIN qcqcq_postmeta ON ( qcqcq_posts.ID = qcqcq_postmeta.post_id ) LEFT JOIN qcqcq_postmeta AS mt1 ON ( qcqcq_posts.ID = mt1.post_id ) LEFT JOIN qcqcq_postmeta AS mt2 ON ( qcqcq_posts.ID = mt2.post_id ) LEFT JOIN qcqcq_postmeta AS mt3 ON ( qcqcq_posts.ID = mt3.post_id ) LEFT JOIN qcqcq_postmeta AS mt4 ON (qcqcq_posts.ID = mt4.post_id AND mt4.meta_key = 'event_date' ) LEFT JOIN qcqcq_postmeta AS mt5 ON ( qcqcq_posts.ID = mt5.post_id )

    //AND ( ( ( qcqcq_postmeta.meta_key = 'event_date' AND qcqcq_postmeta.meta_value >= '20180419' ) AND ( mt1.meta_key = 'event_date' AND mt1.meta_value < '20180420' ) ) OR ( ( mt2.meta_key = 'event_date' AND mt2.meta_value < '20180419' ) AND ( mt3.meta_key = 'end_date' AND mt3.meta_value >= '20180420' ) ) OR mt4.post_id IS NULL OR ( mt5.meta_key = 'event_date' AND mt5.meta_value = '' ) )

    $prepare_string = "SELECT DISTINCT ID FROM $wpdb->posts LEFT JOIN $wpdb->postmeta ON ( $wpdb->posts.ID = $wpdb->postmeta.post_id ) LEFT JOIN $wpdb->postmeta AS mt1 ON ( $wpdb->posts.ID = mt1.post_id ) WHERE ( ( ( $wpdb->postmeta.meta_key = 'event_date' AND $wpdb->postmeta.meta_value >= %d ) AND ( $wpdb->postmeta.meta_key = 'event_date' AND $wpdb->postmeta.meta_value < %d ) ) OR ( ( $wpdb->postmeta.meta_key = 'event_date' AND $wpdb->postmeta.meta_value < %d ) AND ( mt1.meta_key = 'end_date' AND mt1.meta_value >= %d ) ) )";
    
    $prepare_args = array();
    array_unshift($prepare_args,$future);
    array_unshift($prepare_args,$today);
    array_unshift($prepare_args,$future);
    array_unshift($prepare_args,$today);
    array_unshift($prepare_args,$prepare_string);
    $results = $wpdb->get_results( call_user_func_array(array($wpdb, "prepare"),$prepare_args) );
    if($results):
      foreach($results as $result):
        $post__in[] = $result->ID;
      endforeach;
    else:
      $post__in[] = -1;
    endif;
  else: 
    //old queries for reference (generated from wordpress, worked, but bad)

    //LEFT JOIN qcqcq_postmeta ON ( qcqcq_posts.ID = qcqcq_postmeta.post_id ) LEFT JOIN qcqcq_postmeta AS mt1 ON (qcqcq_posts.ID = mt1.post_id AND mt1.meta_key = 'event_date' )
    //AND ( ( qcqcq_postmeta.meta_key = 'event_date' AND qcqcq_postmeta.meta_value >= '20180419' ) OR mt1.post_id IS NULL OR ( qcqcq_postmeta.meta_key = 'event_date' AND qcqcq_postmeta.meta_value = '' ) )*/
      
    $prepare_string = "SELECT DISTINCT ID FROM $wpdb->posts LEFT JOIN $wpdb->postmeta ON ( $wpdb->posts.ID = $wpdb->postmeta.post_id ) LEFT JOIN $wpdb->postmeta AS mt1 ON ( $wpdb->posts.ID = mt1.post_id ) WHERE ( ( $wpdb->postmeta.meta_key = 'event_date' AND $wpdb->postmeta.meta_value >= %d ) OR ( ( $wpdb->postmeta.meta_key = 'event_date' AND $wpdb->postmeta.meta_value < %d ) AND ( mt1.meta_key = 'end_date' AND mt1.meta_value >= %d ) ) OR ( $wpdb->postmeta.meta_key = 'event_date' AND $wpdb->postmeta.meta_value = '' ) )";
    
    $prepare_args = array();
    array_unshift($prepare_args,$today);
    array_unshift($prepare_args,$today);
    array_unshift($prepare_args,$today);
    array_unshift($prepare_args,$prepare_string);
    $results = $wpdb->get_results( call_user_func_array(array($wpdb, "prepare"),$prepare_args) );
    if($results):
      foreach($results as $result):
        $post__in[] = $result->ID;
      endforeach;
    else:
      $post__in[] = -1;
    endif;
  endif;
  if(isset($_POST['search'])&&!empty($_POST['search'])):
    $temp__in = array();
    $prepare_string = "SELECT ID FROM $wpdb->posts WHERE post_title LIKE '%%%s%%' AND post_type = 'event' ";
    $prepare_string .= "UNION SELECT object_id FROM $wpdb->term_relationships as r INNER JOIN $wpdb->terms as t ON t.term_id = r.term_taxonomy_id WHERE t.name LIKE '%%%s%%'";
    $prepare_args[] = $_POST['search'];
    array_unshift($prepare_args,$_POST['search']);
    array_unshift($prepare_args,$prepare_string);
    $results = $wpdb->get_results(  call_user_func_array(array($wpdb, "prepare"),$prepare_args));
    if($results):
      foreach($results as $result):
        if(in_array($result->ID,$post__in)):
          $temp__in[] = $result->ID;
        endif;
      endforeach;
    endif;
    if(empty($temp__in)):
      $temp__in = array(-1);
    endif;
    $post__in = $temp__in;
  endif;
  if(isset($_POST['category'])&&!empty($_POST['category'])):
    $args['meta_query'] = array(
      'key'     => 'category',
      'value'   => '"'.$_POST['category'].'"',
      'compare' => 'LIKE'
    );
  endif;
  $args['post__in']= $post__in;

    $count_results = 0;

    $query_results = new WP_Query( $args );

  $results_html = '';
    //Results found
    if ( $query_results->have_posts() ) {


        //Start "saving" results' HTML
    ob_start();
    
    $i=0;
    $skip = 0;
        while ( $query_results->have_posts() ) { 
      $query_results->the_post();
      
      if( ! empty( $_POST['post_offset'] ) ) {
        if($skip++<intval($_POST['post_offset'])){
          continue; //skip all offset posts
        }
      } 
      if($i>=6) break; //end loop after returning 6

      $date = get_field("event_date");
      $display_date = null;
      if($date):
        $display_date = (new DateTime($date))->format('l, F j, Y');
      endif;
      $venue = get_field("name_of_venue");
      $image = get_field("event_image");?>
      <div class="tile blocks <?php if($i%3==0) echo "first";?> <?php if(($i+1)%3==0) echo "last";?>">
        <div class="inner-wrapper">
          <div class="row-1">
            <a href="<?php echo get_permalink();?>">
              <?php if($image):?>
                <img src="<?php echo $image['sizes']['medium'];?>" alt="<?php echo $image['alt'];?>">
              <?php endif;?>
              <h2><?php the_title();?></h2>
              <?php if($display_date):?>
                <div class="date">
                  <?php echo $display_date;?>
                </div><!--.date-->
              <?php endif;
              if($venue):?>
                <div class="venue">
                  <?php echo $venue;?>
                </div><!--.venue-->
              <?php endif;?>
            </a>
          </div><!--.row-1-->
          <div class="row-2 bottom-blocks">
            <div class="col-1">
              <?php $culture_block = get_field("culture_block");
              $premium_terms = get_the_terms(get_the_ID(),"event_category");
              if(strcmp($culture_block,'yes')==0):?>
                <div class="culture">
                  <div class="circle">
                    ?
                  </div><!--.circle-->
                  <a href="https://www.artsandscience.org/programs/for-community/culture-blocks/asc-culture-blocks-upcoming-events/" target="_blank">
                    <img src="<?php echo get_template_directory_uri()."/images/culture-blocks-title.jpg";?>" alt="Culture Blocks">
                  </a>
                  <?php $desc = get_field("culture_block_rollover",54);
                  if($desc):?>
                    <div class="rollover">
                      <?php echo $desc;?> 
                    </div><!--.rollover-->
                  <?php endif;?>
                  <div class="clear"></div>
                </div><!--.culture-->
              <?php elseif(!is_wp_error($premium_terms)&&is_array($premium_terms)&&!empty($premium_terms)):
                //foreach($premium_terms as $term):
                  //if($term->term_id==36):?>
                    <!-- <div class="featured">
                      Featured
                    </div> -->
                    <?php //break;
                  //endif;?>
                <?php //endforeach;?>
              <?php endif;?>
              <?php
                                $esl = get_field('event_sponsor_logo');
                                $esll = get_field('event_sponsor_logo_link');

                                if( $esl != '') {


                                ?>
                                <!-- we have a sponsor -->
                                    <div class="event-sponsor-logo">
                                        <a target="_blank" href="<?php echo $esll; ?>"><img src="<?php echo $esl['url']; ?>"></a>
                                    </div>
                                 <?php } ?>
            </div><!--.col-1-->
            <?php $terms = wp_get_post_terms( get_the_ID(), 'event_cat' );
            if(!is_wp_error($terms) && is_array($terms)&&!empty($terms)):?>
              <div class="col-2">
                <a href="<?php echo get_term_link($terms[0]->term_id,'event_cat');?>">
                  <?php echo $terms[0]->name;?> 
                </a>
              </div><!--.col-2-->
            <?php endif;?>
          </div><!--.row-2-->
        </div><!--.inner-wrapper-->
      </div>
    <?php $i++;
    }    
    
        $count_results = $i;
        //"Save" results' HTML as variable
        $results_html = ob_get_clean();  
    }

    //Build ajax response
    $response = array();

    //1. value is HTML of new posts and 2. is total count of posts
    array_push ( $response, $results_html, $count_results );
    echo json_encode( $response );

    //Always use die() in the end of ajax functions
    die();  
}