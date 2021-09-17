<?php
/**
 * Template Name: About Us
 */
get_header(); ?>
<div id="primary" class="content-area-full generic-page">
	<main id="main" class="site-main" role="main">
		<div class="qcwrapper">
			<?php while ( have_posts() ) : the_post(); ?>

				<h1 class="page-title"><?php the_title(); ?></h1>
				<?php if ( get_the_content() ) { ?>
				<div class="page-entry-content"><?php the_content(); ?></div>	
				<?php } ?>

				<?php if( $rowContent = get_field("imageAndText") ) { ?>
				<?php $section_title = get_field("section_title") ?>
				<div class="text-and-image-div">
					<?php if ($section_title) { ?>
					<h2 class="section-title"><?php echo $section_title ?></h2>	
					<?php } ?>
					<?php $i=1; foreach ($rowContent as $row) { 
						$image = $row['image'];
						$title = $row['title'];
						$title2 = $row['title2'];
						$text = $row['text'];
						$row_class = ($image && ($title || $text)) ? 'half':'full';
						if($image || ($title || $text)) { $isfirst = ($i==1) ? ' first':''; ?>
						<div class="infoblock <?php echo $row_class.$isfirst ?>">
							<div class="flexwrap">
								<?php if ($image) { ?>
								<div class="imagecol">
									<img src="<?php echo $image['url'] ?>" alt="<?php echo $image['title'] ?>" />
								</div>	
								<?php } ?>

								<?php if ($title || $text) { ?>
								<div class="textcol">
									<?php if ($title || $title2) { ?>
									<div class="heading">
										<?php if ($title) { ?>
											<h2><?php echo $title ?></h2>
										<?php } ?>
										<?php if ($title2) { ?>
											<p class="t2"><?php echo $title2 ?></p>
										<?php } ?>
									</div>	
									<?php } ?>
									<?php if ($text) { ?>
									<div class="text">
										<?php echo $text ?>
									</div>	
									<?php } ?>
								</div>	
								<?php } ?>
							</div>
						</div>
						<?php $i++; } ?>
					<?php } ?>
				</div>
				<?php } ?>

			<?php endwhile; ?>
		</div>
		
	</main><!-- #main -->
</div><!-- #primary -->
<?php get_footer();
