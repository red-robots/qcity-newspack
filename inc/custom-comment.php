<?php
/*
*   Additional fields for comment section
*/

function qcity_comment_form_default_fields( $fields ) {
    // $commenter     = wp_get_current_commenter();
    // $user          = wp_get_current_user();
    // $user_identity = $user->exists() ? $user->display_name : '';
    $key = get_recaptcha_api_keys();
    $req           = get_option( 'require_name_email' );
    $aria_req      = ( $req ? " aria-required='true'" : '' );
    $html_req      = ( $req ? " required='required'" : '' );
    $html5         = current_theme_supports( 'html5', 'comment-form' ) ? 'html5' : false;
    $author_name = ( isset($commenter['comment_author']) && $commenter['comment_author'] ) ? $commenter['comment_author']:'';
    $author_email = ( isset($commenter['comment_author_email']) && $commenter['comment_author_email'] ) ? $commenter['comment_author_email']:'';
    
    $fields = [
        'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name', 'textdomain'  ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
                    '<input id="author" name="author" type="text" value="' . esc_attr($author_name) . '" size="30" maxlength="245"' . $aria_req . $html_req . ' /></p>',
        'email'  => '<p class="comment-form-email"><label for="email">' . __( 'Email', 'textdomain'  ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
                    '<input id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $author_email ) . '" size="30" maxlength="100" aria-describedby="email-notes"' . $aria_req . $html_req  . ' /></p>',
        /*'url'    => '<p class="comment-form-url"><label for="url">' . __( 'Website', 'textdomain'  ) . '</label> ' .
                    '<input id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" maxlength="200" /></p>',*/
        'city'  => '<p class="comment-form-city"><label for="city">' . __( 'City' ) . '</label> ' .
        '<input id="city" name="city" type="text" size="30" value="" /></p>',
        'phone' => '<p class="comment-form-phone"><label for="city">' . __( 'Daytime Phone' ) . ' </label> ' .
        '<input id="phone" name="phone" type="text" size="30" /></p>',     
        'comment_field' => '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment *', 'noun', 'textdomain' ) . '</label> <textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" aria-required="true" required="required"></textarea></p>',
        'recaptcha_field' => '<div id="gRecaptcha" class="g-recaptcha" data-sitekey="'.$key['site_key'].'"></div>',
    ];

    return $fields;
}
add_filter( 'comment_form_default_fields', 'qcity_comment_form_default_fields' );


function qcity_comment_form_defaults( $defaults ) {
    if( !is_user_logged_in() ) {
        if ( isset( $defaults[ 'comment_field' ] ) ) {
            $defaults[ 'comment_field' ] = '';
        }
    } 
    return $defaults;
}
add_filter( 'comment_form_defaults', 'qcity_comment_form_defaults', 10, 1 );



add_filter('comment_post','save_comment_meta_data');
function save_comment_meta_data( $comment_id ) {
    if ( ( isset( $_POST['phone'] ) ) && ( $_POST['phone'] != '') )
        $phone = wp_filter_nohtml_kses($_POST['phone']);
    add_comment_meta( $comment_id, 'phone', $phone );

    if ( ( isset( $_POST['city'] ) ) && ( $_POST['city'] != '') )
        $city = wp_filter_nohtml_kses($_POST['city']);
    add_comment_meta( $comment_id, 'city', $city );

    /* Notify */
    $comment = get_comment( $comment_id );
    $postid = $comment->comment_post_ID;
    notify_for_new_comment($comment_id,$postid);

    //$email_recipient = 'mailbag@qcitymetro.com';
    //$email_recipient = 'cathy@bellaworksweb.com';
    //$email_recipient = 'hermiebarit@gmail.com';
    //$comment = get_comment( $comment_id );
    //$postid = $comment->comment_post_ID;
    // if( $email_recipient ):
    //     $message = 'New comment on <a href="' . get_permalink( $postid ) . '">' .  get_the_title( $postid ) . '</a>';
    //     $message .= '<p>Name: '. $comment->comment_author .'</p>';
    //     $message .= '<p>Email: '. $comment->comment_author_email .'</p>';
    //     //$message .= '<p>Website: '. $comment->comment_author_url .'</p>';
    //     if( $city ){
    //         $message .= '<p>City: '. $city .'</p>';
    //     }
    //     if( $phone ){
    //         $message .= '<p>Daytime Phone: '. $phone .'</p>';
    //     }
    //     $message .= '<p>Content: '. $comment->comment_content .'</p>';
          
    //     add_filter( 'wp_mail_content_type', create_function( '', 'return "text/html";' ) );
    //     wp_mail( $email_recipient, 'New Comment from ' . $comment->comment_author, $message );
    // endif;
}

function notify_for_new_comment($comment_id,$postid) {
    $email_recipient = get_field("notify_for_comment","option");
    if($email_recipient) {
        if( $comment = get_comment( $comment_id ) ) {
            $postid = $comment->comment_post_ID;
            $subject = 'New Comment from ' . $comment->comment_author;
            
            $message = 'New comment on <strong><a href="' . get_permalink( $postid ) . '">' .  get_the_title( $postid ) . '</a></strong><br>';
            $message .= '<p>Name: '. $comment->comment_author .'<br>';
            $message .= 'Email: '. $comment->comment_author_email .'<br>';
            $message .= 'City: '. $city .'<br>';
            $message .= 'Daytime Phone: '. $phone .'<br>';
            $message .= '</p>';
            $message .= 'Content:<br>'. $comment->comment_content;
            
            add_filter( 'wp_mail_content_type', create_function( '', 'return "text/html";' ) );
            $is_sent = wp_mail( $email_recipient,$subject,$message );
            return ($is_sent) ? true : false;
        }
    }   
}


add_filter( 'preprocess_comment', 'verify_comment_meta_data' );
function verify_comment_meta_data( $commentdata ) {
    $key = get_recaptcha_api_keys();
    $secretKey = $key['secret_key']; 
    $comment_post_ID = ( isset($_POST['comment_post_ID']) && $_POST['comment_post_ID'] ) ? $_POST['comment_post_ID'] : 0;
    //$redirectURL = get_permalink($comment_post_ID);
    if( is_user_logged_in() ) {
        return $commentdata;
    } else {
        if( isset($_POST['g-recaptcha-response']) && $_POST['g-recaptcha-response'] ) {
            $captcha=$_POST['g-recaptcha-response'];
            $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
            $response = file_get_contents($url);
            $responseKeys = json_decode($response,true);
            // should return JSON with success as true
            if($responseKeys["success"]) {
                return $commentdata;
            } else {
                $msgTxt = 'Failed to validate reCaptcha. Please try again.';
                ob_start();
                get_template_part("template-parts/comment-error");
                $error_message = ob_get_contents();
                ob_end_clean();
                $error_message = str_replace('{%ERROR_MESSAGE%}',$msgTxt,$error_message);
                exit($error_message);
            }
        } else {
            $msgTxt = 'Please enter reCaptcha.';
            ob_start();
            get_template_part("template-parts/comment-error");
            $error_message = ob_get_contents();
            ob_end_clean();
            $error_message = str_replace('{%ERROR_MESSAGE%}',$msgTxt,$error_message);
            exit($error_message);
        }
    }
}

function comment_error_template($message) {

}


add_action( 'edit_comment', 'extend_comment_edit_metafields' );
function extend_comment_edit_metafields( $comment_id ) {
    //if( ! isset( $_POST['extend_comment_update'] ) || ! wp_verify_nonce( $_POST['extend_comment_update'], 'extend_comment_update' ) ) return;

    if ( ( isset( $_POST['phone'] ) ) && ( $_POST['phone'] != ’) ) :
    $phone = wp_filter_nohtml_kses($_POST['phone']);
    update_comment_meta( $comment_id, 'phone', $phone );
    else :
    delete_comment_meta( $comment_id, 'phone');
    endif;

    if ( ( isset( $_POST['city'] ) ) && ( $_POST['city'] != ’) ):
    $city = wp_filter_nohtml_kses($_POST['city']);
    update_comment_meta( $comment_id, 'city', $city );
    else :
    delete_comment_meta( $comment_id, 'city');
    endif;
}


if( isset($_GET['action']) && $_GET['action']=='editcomment' ) {
function action_admin_footer( $array ) { 
    $comment_id = ( isset($_GET['c']) && $_GET['c'] ) ? $_GET['c'] : '';
    if($comment_id) {
        $phone = get_comment_meta( $comment_id, 'phone', true );
        $city = get_comment_meta( $comment_id, 'city', true );
        $author_ip = get_comment_author_IP($comment_id);
        ?>
        <script>
        jQuery(document).ready(function($){
            var info_container = $("#namediv");
            var city = '<?php echo $city;?>';
            var phone = '<?php echo $phone;?>';
            var author_ip = '<?php echo $author_ip;?>';
            var fields = '<tr><td class="first"><label for="phone">Daytime Phone:</label></td><td><input type="text" id="phone" name="phone" value="'+phone+'"></td></tr>';
                fields += '<tr><td class="first"><label for="city">City:</label></td><td><input type="text" id="city" name="city" value="'+city+'"></td></tr>';
                fields += '<tr><td class="first"><label for="authorip">User IP:</label></td><td><input type="text" value="'+author_ip+'" disabled></td></tr>';
            $("#namediv .editcomment tbody").append(fields);
        });
        </script>
    <?php
    }
}; 
add_action( 'admin_footer', 'action_admin_footer', 10, 1 ); 
}

function get_recaptcha_api_keys() {
    $key['site_key'] = get_field("reCAPTCHASiteKey","option");
    $key['secret_key'] = get_field("reCAPTCHASecretKey","option");
    return $key;
}

