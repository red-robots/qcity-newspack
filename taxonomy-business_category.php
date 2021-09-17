<?php 
get_header(); 
$ob = get_queried_object();
$page_title = $ob->name;
?>
<div id="primary" class="content-area-full map-page top-logo-page taxonomy-business-directory">
	<main id="main" class="site-main" role="main">

		<?php 
			$poweredby = get_field("bd_poweredby","option");
			$logo = get_field("bd_top_logo","option");
			$logo_website = get_field("bd_top_logo_website","option"); 
			$link_open = '';
			$link_close = '';
			if($logo_website) {
				$link_open = '<a href="'.$logo_website.'" target="_blank">';
				$link_close = '</a>';
			}

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
				<span class="postViews business-map-counter">
					<span>
						<em class="e1">Visitor Count</em>
						<em class="e2"><?php echo $views ?></em>
					</span>
				</span>
			<?php 
				$views_display = ob_get_contents();
				ob_end_clean(); 
			}  
		?>
		<?php if ($logo) { ?>
		<div class="top-logo">
			<div class="qcwrapper">
				<span class="logo-img">
					<?php if ($poweredby) { ?>
					<span class="poweredby"><?php echo $poweredby ?></span>	
					<?php } ?>
					<?php echo $link_open ?>
					<img src="<?php echo $logo['url'] ?>" alt="<?php echo $logo['title'] ?>">
					<?php echo $link_close ?>
				</span>
				<?php echo $views_display; ?>
			</div>
		</div>	
		<?php } ?>

		<div class="map-div title-gray-bg">
			<div class="qcwrapper mapwrapper">
			
				<?php 
				$subtitle = get_field("bd_subtitle"); 
				if($subtitle) {
					$subtitle = str_replace("{{","<u>",$subtitle);
					$subtitle = str_replace("}}","</u>",$subtitle);
				} ?>

				<div class="titlediv">
					<?php echo $views_display; ?>
					<h1 class="t1"><?php echo $page_title; ?></h1>
					<?php if ($subtitle) { ?>
					<h2 class="t2"><?php echo $subtitle ?></h2>	
					<?php } ?>
				</div>
				
			</div>
		</div>

		<?php 
		$sidebar_buttons = get_field("bd_sidebar_buttons","option"); 
		$subscription_text = get_field("bd_subscription_text","option"); 
		$subscription_button = get_field("bd_subscription_button","option"); 
		$content_class = ( $sidebar_buttons && ($subscription_text || $subscription_button) ) ? 'half':'full';

		$args = array(
			'post_type' 			=> 'business_listing',
			'posts_per_page' 	=> -1,
			'post_status'			=> 'publish',
			'orderby' 				=> 'title',
			'order' 					=> 'ASC', 
			'tax_query' 			=> array( 
				array(
					'taxonomy' 		=> $ob->taxonomy,
					'field' 			=> 'term_id',
					'terms' 			=> array( $ob->term_id ),
				)
			)
		);

		$query = new WP_Query( $args );
		?>

		<div class="entry-content biz-directory <?php echo $content_class ?>">
			<div class="qcwrapper">
				<div class="breadcrumb">
					<a href="<?php echo get_site_url() ?>/business-directory/">&larr; Back to Business Directory</a>
				</div>
				<div class="leftcol">
					
					<?php if ($query->have_posts()) : ?>
					<div class="business-listings-wrapper">
						<div class="table">
				    <?php $i=1; while ($query->have_posts()) : $query->the_post();  
				    	$phone 			= get_field('phone');
				    	$website 		= get_field('website');
				    	$address 		= get_field('address');
				    	$title 			= get_the_title();
				    	$bob 				= get_field('black_owned_business');
				    	$row_class 	=  ($i%2==0) ? 'even':'odd';
			    		?>
						  <div class="tbl-row <?php echo $row_class ?> <?php echo ($bob) ? 'hasbob':'nobob' ?>">
						  	<div class="company dd">
						  		<div class="cname"><?php echo $title ?></div>
						  		<?php if ($address) { ?>
						  		<div class="hide-desktop maddress"><span class="address-icon"><i class="fa fa-home" aria-hidden="true"></i></span> <?php echo $address ?></div>
						  		<?php } ?>
						  		<?php if ($phone) { ?>
						  		<div class="hide-desktop mphone"><span class="phone-icon"><i class="fa fa-phone" aria-hidden="true"></i></span> <?php echo $phone ?></div>
						  		<?php } ?>
						  		<?php if ($website) { ?>
						  		<div class="hide-desktop mwebsite"><span class="site-icon"><i class="fa fa-globe" aria-hidden="true"></i></span> <a href="<?php echo $website ?>" target="_blank">View Website</a></div>
						  		<?php } ?>
						  	</div>
						  	<div class="address dd"><?php echo ($address) ? nl2br($address):'' ?></div>
						  	<div class="phone dd"><?php echo $phone ?></div>
						  	<div class="website dd">
						  		<?php if ($website) { ?>
						  		<a href="<?php echo $website ?>" target="_blank">View Website</a>
						  		<?php } ?>
						  	</div>
						  	<!-- <div class="bob dd"><?php //echo ($bob) ? 'BOB':'' ?></div> -->
						  </div>
				    <?php $i++; endwhile; ?>
				    </div>	
				  </div>
					<?php endif; wp_reset_postdata(); ?>

				</div>

				<?php if ( $sidebar_buttons || ($subscription_text || $subscription_button) ) { ?>
				<div class="rightcol">
					<div id="sticky-helper" class="helper"></div>
					<div class="sb-inner-wrap sbsticky">
						<?php include( locate_template('sidebar-business-directory.php')); ?>
					</div>
				</div>
				<?php } ?>
				
			</div>
			
		</div>


	</main><!-- #main -->
</div><!-- #primary -->
<?php 
get_footer();
