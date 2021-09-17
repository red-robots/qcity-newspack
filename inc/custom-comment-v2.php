<?php  
$key = get_recaptcha_api_keys();
$site_key = $key['site_key'];
?>
<div class="comment-respond">
  <form action="<?php echo get_site_url(); ?>/wp-comments-post.php" method="post" id="commentform" class="comment-form" novalidate="">
    <p class="comment-before">Editors will review your comment, which may be shared in our Morning Brew newsletter.</p>

    <p class="comment-form-author">
      <label for="author">Name <span class="required">*</span></label>
      <input id="author" name="author" type="text" value="" size="30" maxlength="245" aria-required="true" required="required">
    </p>

    <p class="comment-form-email">
      <label for="email">Email <span class="required">*</span></label>
      <input id="email" name="email" type="email" value="" size="30" maxlength="100" aria-required="true" required="required">
    </p>

    <p class="comment-form-city">
      <label for="city">City</label>
      <input id="city" name="city" type="text" size="30" value="">
    </p>

    <p class="comment-form-phone">
      <label for="city">Daytime Phone</label>
      <input id="phone" name="phone" type="text" size="30">
    </p>

    <p class="comment-form-comment">
    	<label for="comment">Comment *</label>
    	<textarea name="comment" id="comment" rows="10"></textarea>
    </p>
    
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <div class="g-recaptcha" data-sitekey="<?php echo $site_key ?>"></div>

    <p class="form-submit">
      <input name="submit" type="submit" id="submit" value="Post Comment">
      <input type="hidden" name="comment_post_ID" value="" id="comment_post_ID">
      <input type="hidden" name="comment_parent" id="comment_parent" value="0">
    </p>
  </form>

</div>
