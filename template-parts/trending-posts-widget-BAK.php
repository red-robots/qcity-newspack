<?php
$placeholder = get_template_directory_uri() . '/images/rectangle.png';
$perpage = 5;
$entries = get_trending_articles($perpage);
if ($entries) { ?>
  <aside id="widget-singleSidebar" class="widget-singleSidebar">  	
  	<div id="widget-trending-post">

	  	<div class="trending-sidebar-wrap">
				<div id="sbContent">
					<div class="sbWrap">
						<h3 class="sbTitle">Trending</h3>
						<ol class="trending-entries">
							<?php $i=1; foreach($entries as $pid) {
								$img  = get_field('event_image',$pid);
								$image = '';
								$altImg = '';
								if( $img ){
								  $image = $img['url'];
								  $altImg = ( isset($img['title']) && $img['title'] ) ? $img['title']:'';
								} elseif ( has_post_thumbnail($pid) ) {
									$thumbid = get_post_thumbnail_id($pid);
								  $image = get_the_post_thumbnail_url($pid);
								  $altImg = get_the_title($thumbid);
								} 
								$viewsCount = get_post_meta($pid,'views',true);
								$postDate = get_the_date('d/m/Y',$pid);
								$pagelink = get_permalink($pid);
								$posttitle = get_the_title($pid); ?>
								<li class="entry" data-pid="<?php echo $pid ?>" data-postdate="<?php echo $postDate ?>" data-views="<?php echo $viewsCount ?>">
									<?php if ($i==1) { ?>
										<?php if ($image) { ?>
										<div class="trendImg">
											<a href="<?php echo $pagelink; ?>"><img src="<?php echo $image ?>" alt="<?php echo $altImg; ?>"></a>
										</div>	
										<?php } ?>
									<?php } ?>
									<p class="headline"><a href="<?php echo $pagelink; ?>"><?php echo $posttitle; ?></a></p>
								</li>
							<?php $i++; } ?>
						</ol>
					</div>
				</div>
			</div>

		</div>
  </aside>
<?php } ?>
