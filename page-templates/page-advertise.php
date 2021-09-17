<?php
/**
 * Template Name: Advertise Listings
 */

get_header();

$banner_section = get_field('banner_section');
$advertisements = get_field('advertisements');

get_template_part('template-parts/banner-advertise');
?>

<div class="wrapper">
	<div id="primary" class="content-area-single">
		<main id="main" class="site-main" role="main">

			<div class="advertise_section">
				<?php echo $banner_section; ?>
			</div>

			<div class="advertise-listing-page">
				<div class="listing_initial">
					<?php if( $advertisements ): ?>
					<section class="advertise-list">
						<?php
							foreach( $advertisements as $ads ):
								include(locate_template('template-parts/advertise.php')) ;
							endforeach;
						?>
					</section>
					<?php endif; ?>
				</div>

				<div class="listing_search">
					<div class="listing_search_result">				
					</div>				
				</div>


			</div>

		</main><!-- #main -->
	</div><!-- #primary -->


</div>
<?php get_footer();
