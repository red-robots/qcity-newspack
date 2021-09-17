<?php
/**
 * Template Name: Jobs (new layout)
 *
 */
get_header(); 
$page_id = get_the_ID(); 
$job_category = ( isset($_GET['category']) && $_GET['category'] ) ? $_GET['category'] : '';
?>

<div id="primary" class="content-area page-with-poweredby page-job-new">
	<main id="main" class="site-main" role="main">
		<?php while ( have_posts() ) : the_post(); ?>
			<?php  
				$poweredby = get_field("poweredby");
				$logo = get_field("top_logo");
				$logo_website = get_field("top_logo_website"); 
				$link_open = '';
				$link_close = '';
				if($logo_website) {
					$link_open = '<a href="'.$logo_website.'" target="_blank">';
					$link_close = '</a>';
				}

				$subtitle = get_field("subtitle"); 
				$lastModified = get_the_modified_date('F j, Y h:i a');
				// if($subtitle) {
				// 	$subtitle = str_replace("{{","<u>",$subtitle);
				// 	$subtitle = str_replace("}}","</u>",$subtitle);
				// }

				$views = '';
				$views_display = '';
				if(function_exists('the_views')) {
					ob_start();
					the_views(); 
					$views = ob_get_contents();
					ob_clean();
					if($views) {
						$views = preg_replace('/[^0-9.]+/', '', $views);
					}
				} 
				if($views) { 
					ob_start(); ?>
					<span class="visitor-counter">
						<span>
							<em class="e1">Visitor Count</em>
							<em class="e2"><?php echo number_abbr($views); ?></em>
						</span>
					</span>
				<?php 
					$views_display = ob_get_contents();
					ob_end_clean(); 
				} 

				$main_page_title = ( get_field("alt_page_title") ) ? get_field("alt_page_title") : get_the_title();
			?>

			<?php if ($logo) { ?>
			<div class="sponsored-logo">
				<div class="qcwrapper">
					<span class="logo-img">
						<?php if ($poweredby) { ?>
						<span class="poweredby"><?php echo $poweredby ?></span>	
						<?php } ?>
						<?php echo $link_open ?>
						<img src="<?php echo $logo['url'] ?>" alt="<?php echo $logo['title'] ?>">
						<?php echo $link_close ?>
					</span>
				</div>
			</div>	
			<?php } ?>
			<header class="title-bar-gray">
				<div class="qcwrapper">
					<h1 class="t1"><?php echo $main_page_title; ?></h1>
					<?php if ($subtitle) { ?>
					<h2 class="t2"><?php echo $subtitle ?></h2>	
					<?php } ?>

					<?php if ($views_display) { ?>
						<?php echo $views_display ?>
					<?php } ?>
				</div>
			</header>

	<?php endwhile; ?>

			<?php $buttons = get_field("cta_buttons"); ?>
			<div class="entry-content">
				<div class="qcwrapper">
					
					<?php /* BUTTONS */ ?>
					<?php if ($buttons) { ?>
					<div class="pageCTAButtons">
						<ul class="flex">
						<?php $ctr=1; foreach ($buttons as $e) {
						if( $b = $e['button'] ) { 
							$btnId = strtolower(sanitize_title($b['title']));  
							$firstBtn = ($ctr==1) ? ' first':'';
							?>
							<li class="jbtn<?php echo $firstBtn ?>">
								<a id="<?php echo $btnId ?>" href="<?php echo $b['url'] ?>" target="<?php echo ( isset($b['target']) && $b['target'] ) ? $b['target'] : '_SELF'; ?>" class="jobctabtn"><?php echo $b['title'] ?></a>
								<?php if ($b['url']=='#findjob') { ?>
									<?php 
									/* Find Jobs Dropdown */
									$terms = get_terms( array(
								    'taxonomy' 		=> 'job_cat',
								    'orderby' => 'name',
    								'order' => 'ASC',
								    'hide_empty' 	=> true,
									));
									if( is_array($terms) && !empty($terms) ) { ?>
									<div data-for="<?php echo $btnId ?>" class="jobCategories dropdownList">
										<ul class="cats">
											<?php foreach($terms as $term) { 
												//$termLink = get_term_link($term->term_id);
												$catSlug = $term->slug;
												$termLink = get_permalink() . '?category=' . $catSlug;
												$isActive = ($job_category==$catSlug) ? ' active':'';
												?>
                      	<li class="catlink<?php echo $isActive ?>"><a href="<?php echo $termLink;?>"><?php echo $term->name;?></a></li>
                      <?php } ?>
										</ul>
									</div>	
									<?php } ?>
								<?php } ?>
							</li>
							<?php $ctr++; } ?>
						<?php } ?>
						</ul>
					</div>	
					<?php } ?>

					<?php  

					$i = 0;
					$today = date('Ymd');
					$perPage = 10;
					$paged = ( get_query_var( 'pg' ) ) ? absint( get_query_var( 'pg' ) ) : 1;
					$wp_query = new WP_Query();
					$args = array(
						'post_type'				=>'job',
						'posts_per_page'	=> $perPage,
						'paged'						=> $paged,
						'orderby'					=> 'date',
						'order'						=> 'DESC'
					);
					
					if($job_category) {
						$args['tax_query'] = array(
				        array (
			            'taxonomy' => 'job_cat',
			            'field' => 'slug',
			            'terms' => $job_category,
				        )
					    );
					}
					$wp_query->query($args);
					if ($wp_query->have_posts())  { ?>
						<div class="jobs-page">
							<div class="biz-job-wrap">
							<?php while ($wp_query->have_posts()) : $wp_query->the_post(); 

									include(locate_template('template-parts/jobs-block.php')) ;

								endwhile; wp_reset_postdata(); ?>
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
					<?php } ?>


					<?php
					$newsletterForm = get_field("jobpage_newsletter",$page_id);
					$newsletter_title = get_field("newsletter_title",$page_id);
					$newsletter_text = get_field("newsletter_text",$page_id);
					if($newsletterForm) {
						$gravityFormId = $newsletterForm;
						$gfshortcode = '[gravityform id="'.$gravityFormId.'" title="false" description="false" ajax="true"]';
					 	if( do_shortcode($gfshortcode) ) { ?>
					 		<div class="jobpageNewsletter">
								<div class="form-subscribe-blue">
									<div class="form-inside">
									<?php if ($newsletter_title) { ?>
										<h3 class="gfTitle"><?php echo $newsletter_title ?></h3>
									<?php } ?>
									<?php if ($newsletter_text) { ?>
										<div class="gftxt"><?php echo $newsletter_text ?></div>
									<?php } ?>
									<?php echo do_shortcode($gfshortcode); ?>
									</div>
								</div>
							</div>
						<?php } ?>
					<?php } ?>
				</div>
			</div>
		
	</main>
</div>



<script type="text/javascript">
jQuery(document).ready(function($){
	if( $(".jobpageNewsletter").length>0 ) {
		var jobcount = ( $(".biz-job-wrap .job").length>0 ) ? $(".biz-job-wrap .job").length : 0;
		if( $(".biz-job-wrap .job").length>0 ) {
			var i = 1;
			if(jobcount==8) {
				$(".biz-job-wrap .job").each(function(){
					var target = $(this);
					if(i==4) {
						$(".jobpageNewsletter").insertAfter(target).addClass("show");
					}
					i++;
				});
			} 
			else if(jobcount>8) {
				$(".biz-job-wrap .job").each(function(){
					var target = $(this);
					if(i==5) {
						$(".jobpageNewsletter").insertAfter(target).addClass("show");
					}
					i++;
				});
			} else {
				var lastList = $(".biz-job-wrap .job").last();
				$(".jobpageNewsletter").insertAfter(lastList).addClass("show");
			}
		}
	}
});
</script>
<?php 
get_footer();
