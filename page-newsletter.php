<?php
/**
 * Template Name: Newsletter (new form)
 *
 */

get_header(); ?>
<div class="qcwrapper">
	<div id="primary" class="content-area-full newsletter-page-new">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				<div style="display:none;">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</div>
				<?php if ( get_the_content() ) { ?>
				<div class="entry-content"><?php the_content(); ?></div>
				<?php } ?>
			<?php endwhile;  ?>


			<?php if( $newsletter_form_code = get_field("newsletter_form_code") ) { ?>
			<div class="newsletter-form-code">
				<?php echo $newsletter_form_code; ?>
			</div>
			<?php } ?>

		</main><!-- #main -->
	</div><!-- #primary -->
</div>

<?php if ( $nDesc = get_field("newsletter_option_description") ) { ?>
<div id="newsletterTxtList" style="display:none">
	<?php foreach ($nDesc as $nd) { 
		if ($nd['text']) { echo '<div class="newsletter-desc option-description">'.$nd['text'].'</div>'; }
	} ?>
</div>	
<?php } ?>
<script>
	jQuery(document).ready(function($){
		$("#newsletter-options li").each(function(k,v){
			var target = $(this);
			if ( $('div.newsletter-desc').length>0 ) {
				if( typeof $('div.newsletter-desc').eq(k) !='undefined' && $('div.newsletter-desc').eq(k)!=null ) {
					$('div.newsletter-desc').eq(k).appendTo(target);
				}
			}
			target.find("label").show();
		});
	});
</script>
<?php get_footer();
