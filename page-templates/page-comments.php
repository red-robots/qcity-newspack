<?php
/**
 * Template Name: Comment Page
 * 
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package ACStarter
 */

get_header(); ?>

<div class="wrapper">
    <div class="content-area-single">       
        <header class="entry-header toppage">
            <h1 class="entry-title">Comments</h1>   
        </header>

        <div class="comment_holder">
            <div class="comment-form">
                        <h2 class="comments-wrapper-heading"> Leave a comment </h2>
                        <form id="commentform" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
                          <div class="commentform-element">                            
                            <input class="input-fields" id="author" name="author" type="text" placeholder="Full Name" value=""/>
                          </div>
                          <div class="commentform-element">                            
                            <input class="input-fields" id="email" name="email" type="text" placeholder="Email" value=""/>
                          </div>
                          <div class="commentform-element">                            
                            <textarea id="comment" class="input-fields" placeholder="Message" name="comment" cols="40" rows="6"></textarea>
                          </div>
                            <input name="submit" class="form-submit-button"  type="submit" id="submit-comment" value="Post comment">
                            <input type="hidden" name="comment_post_ID" value="22" id="comment_post_ID">
                            <input type="hidden" name="comment_parent" id="comment_parent" value="0">
                        </form>
             </div>
            <?php

            /*
            comments_template();

            $comments_args = array(
                    // Change the title of send button 
                    'label_submit' => __( 'Send', 'textdomain' ),
                    // Change the title of the reply section
                    'title_reply' => __( 'Write a Reply or Comment', 'textdomain' ),
                    // Remove "Text or HTML to be displayed after the set of comment fields".
                    'comment_notes_after' => '',
                    // Redefine your own textarea (the comment body).
                    'comment_field' => '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) . '</label><br /><textarea id="comment" name="comment" aria-required="true"></textarea></p>',
            );
            comment_form( $comments_args ); */
            ?>
        </div>
    </div>
</div>

<?php
get_footer(); 