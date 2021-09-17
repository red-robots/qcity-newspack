<?php
$placeholder = get_template_directory_uri() . '/images/rectangle.png';
$perpage = 5;
//$entries = get_trending_articles($perpage);
if( do_shortcode('[wpp range="last5days" thumbnail_width=300 thumbnail_height=200 limit=5 stats_views=0 order_by="views"]') ) { ?>
  <aside id="widget-singleSidebar" class="widget-singleSidebar">  	
  	<div id="widget-trending-post">

	  	<div class="trending-sidebar-wrap">
				<div id="sbContent">
					<div class="sbWrap">
						<h3 class="sbTitle">Trending</h3>
						<?php echo do_shortcode('[wpp range="last24hours" thumbnail_width=300 thumbnail_height=200 limit=5 stats_views=0 order_by="views"]'); ?>
					</div>
				</div>
			</div>

		</div>
  </aside>
<?php } ?>
