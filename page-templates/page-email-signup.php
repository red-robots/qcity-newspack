<?php
/**
 * Template Name: Email Signup
 */

get_header(); ?>
<div class="wrapper">
	<div class="content-area-single">
		<div class="mobile-view">
			<header class="entry-header toppage">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</header>				
		</div>
	
	</div>
</div>
<div class="wrapper">
	<div id="primary" class="content-area-single">
		<main id="main" class="site-main" role="main">

			<div class="mobile-view">

			<?php
			while ( have_posts() ) : the_post(); ?>
				<div class="entry-content">
					<?php 

						the_content(); 

						the_field('email_signup_code');

					?>
				</div>
			<?php endwhile; // End of the loop.
			?>

			</div>

		</main><!-- #main -->
	</div><!-- #primary -->

</div>
<?php get_footer();
