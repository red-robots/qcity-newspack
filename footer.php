<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ACStarter
 */
$facebook = get_field('facebook_link', 'option');
$instagram = get_field('instagram_link', 'option');
$twitter = get_field('twitter_link', 'option');
?>

    </div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="wrapper">

			<section class="footer-section">

				<div class="logo-footer desktop-version" style="padding-left:20px">
					<img src="<?php bloginfo('stylesheet_directory'); ?>/images/logo-footer.png">
				</div>
				<div class="footer-nav">
					<div class="footer-main-nav">
						<?php wp_nav_menu( array( 'theme_location' => 'footer' ) ); ?>
					</div>
					<div class="footer-submenu-nav">
						<?php wp_nav_menu(array('theme_location'=>'burger','menu_class'=>'main','container'=>'ul')); ?>
					</div>				
				</div><!-- .site-info -->
				<div class="social">
					<div class="desktop-version">
						<h3 >Follow Us</h3>
					</div>				
					<?php if($facebook){ ?>
						<a href="<?php echo $facebook; ?>"><i class="fab fa-facebook-square fa-2x"></i></a>
					<?php } ?>
					<?php if($instagram){ ?>
						<a href="<?php echo $instagram; ?>"><i class="fab fa-instagram fa-2x"></i></a>
					<?php } ?>
					<?php if($twitter){ ?>
						<a href="<?php echo $twitter; ?>"><i class="fab fa-twitter-square fa-2x"></i></a>
					<?php } ?>
				</div>

				<?php  
          $topSubscribe = get_field("topSubscribe","option");
          $subscribeText = ( isset($topSubscribe['subscribe_text_footer']) && $topSubscribe['subscribe_text_footer'] ) ? $topSubscribe['subscribe_text_footer']:'';
          $subscribeText = ($subscribeText) ? str_replace('>','',$subscribeText):'';
          $subscribeButton = ( isset($topSubscribe['subscribe_button']) && $topSubscribe['subscribe_button'] ) ? $topSubscribe['subscribe_button']:'';
          $subscribeName = ( isset($subscribeButton['title']) && $subscribeButton['title'] ) ? $subscribeButton['title']:'';
          $subscribeURL = ( isset($subscribeButton['url']) && $subscribeButton['url'] ) ? $subscribeButton['url']:'';
          $subscribeTarget = ( isset($subscribeButton['target']) && $subscribeButton['target'] ) ? $subscribeButton['target']:'_self';
        ?>

        <?php if ($subscribeText || $subscribeButton) { ?>
				<div class="footer-newsletter desktop-version">
					<h3><?php echo $subscribeText ?></h3>
					<?php if ($subscribeButton) { ?>
					<div class="footBtnDiv">
						<a class="btn" href="<?php echo $subscribeURL ?>" target="<?php echo $subscribeTarget ?>"><?php echo $subscribeName ?></a>
					</div>
					<?php } ?>
				</div>
				<?php } ?>
				
			</section>

			


		</div><!-- wrapper -->
		<div class="site-footer-overlay"></div>
	</footer><!-- #colophon -->
</div><!-- #page -->


<?php
get_template_part('template-parts/popups');
get_template_part('template-parts/signup-mobile-version');
wp_footer(); 
?>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-7229521-1', 'auto');
  ga('send', 'pageview');

</script>
<!-- Facebook Pixel Code -->
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '186461841925459');
  fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=186461841925459&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->

<script type="text/javascript">
jQuery(document).ready(function($){
  $('.broadstreet-zone-container').addClass('align-center');  
	if ($(window).width() < 767) {

      // When the user scrolls the page, execute myFunction
      //window.onscroll = function() {myFunction()};

      // Get the header
      var header = document.getElementById("fixed");
       header.classList.add("sticky");

      // Get the offset position of the navbar
      var sticky = 0;

      // Add the sticky class to the header when you reach its scroll position. Remove "sticky" when you leave the scroll position
      function myFunction() {
        if (window.pageYOffset > sticky) {
          header.classList.add("sticky");
        } else {
          header.classList.remove("sticky");
        }
      }

  }
});
</script>

</body>
</html>
