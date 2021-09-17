<?php
/**
 * Template Name: Jobs (old layout)
 *
 * 
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ACStarter
 */

get_header(); 
get_template_part('template-parts/banner-jobs');
?>
<div class="wrapper">
	<div class="listing-header">
		<div class="content-area-title ">
			<header class="section-title ">
				<h1 class="dark-gray"><?php the_title(); ?></h1>
			</header>
		</div>
	</div>
</div>
<div class="wrapper">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<div class="listing_initial">

			<?php
			/*
				Jobs 
			*/
				$i = 0;
				$today = date('Ymd');
				$perPage = 10;
				$paged = ( get_query_var( 'pg' ) ) ? absint( get_query_var( 'pg' ) ) : 1;
				$wp_query = new WP_Query();
				$wp_query->query(array(
					'post_type'					=>'job',
					'posts_per_page'   	=> $perPage,
					'paged'			   			=> $paged,
					'orderby'          => 'date',
					'order'            => 'DESC'
			));
				if ($wp_query->have_posts())  { ?>
					<div class="jobs-page">
						<div class="biz-job-wrap">
						<?php while ($wp_query->have_posts()) : $wp_query->the_post(); 

								include(locate_template('template-parts/jobs-block.php')) ;

							endwhile; ?>
						</div>
					</div>

					<?php
          $total_pages = $wp_query->max_num_pages;
          if ($total_pages > 1){ ?>
              <div id="navigation" class="navigation navigation2 navigation-jobs">
                  <?php
                      $pagination = array(
                          'base' => @add_query_arg('pg','%#%'),
                          'format' => '?paged=%#%',
                          'current' => $paged,
                          'total' => $total_pages,
                          'prev_text' => __( '&laquo;', 'red_partners' ),
                          'next_text' => __( '&raquo;', 'red_partners' ),
                          'type' => 'list'
                      );
                      echo paginate_links($pagination);
                  ?>
              </div>
              <?php
          } ?>

				<?php } wp_reset_postdata(); ?>

			</div>
			
			<div class="listing_search">
				<div class="listing_search_result">				
				</div>				
			</div>

		</main><!-- #main -->
	</div><!-- #primary -->

	<?php get_sidebar(); ?>
</div>
<?php 
get_footer();
