<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ACStarter
 */

get_header(); 
get_template_part('template-parts/banner-jobs');
?>

<div class="qcwrapper">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<div class="archive_job_cat">
				<div class="archive_post_title">
					<div class="">
						<header class="section-title ">
							<h1 class="dark-gray"><?php the_archive_title(); ?></h1>
						</header>
					</div>
				</div>

				<div class="category-post">

					<?php if ($wp_query->have_posts()) : ?>
					<div class="jobs-page">
						<div class="biz-job-wrap">
						<?php while ($wp_query->have_posts()) : $wp_query->the_post(); 

								include(locate_template('template-parts/jobs-block.php')) ;

							endwhile; ?>
						</div>
					</div>
				<?php endif; wp_reset_postdata(); ?>

				</div>
			</div>

		</main><!-- #main -->
	</div><!-- #primary -->

	<?php get_sidebar(); ?>
</div>
<?php get_footer();
