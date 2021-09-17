<?php 
if(!is_single()) {
	global $wpdb;
	$limit = 3;
	$query = "SELECT p.* FROM ".$wpdb->prefix."posts p, ".$wpdb->prefix."postmeta m
	          WHERE p.ID=m.post_id AND m.meta_key='home_more_news' AND TRIM(IFNULL(m.meta_value,'')) <> '' AND p.post_status='publish' AND p.post_type='post'
	            ORDER BY p.ID DESC LIMIT " . $limit;
	$entries = $wpdb->get_results($query);
	if($entries) { ?>
	<div class="moreNewsSection">
		<div class="innerwrap">
			<div class="stitle">More News</div>
			<div class="entries">
				<div class="flexwrap">
					<?php foreach ($entries as $e) { 
						$postid = $e->ID;
						$posttitle = $e->post_title;
						$terms = get_the_terms($postid,'category');
						?>
						<div class="entry">
							<h4><a href="<?php echo get_permalink($postid); ?>" class="posttitle"><?php echo $posttitle; ?></a></h4>
							<?php if ($terms) { ?>
							<div class="terms">
								<?php $i=1; foreach ($terms as $term) {
									$comma = ($i>1) ? ', ':'';  
									$termName = $term->name;
									$termLink = get_term_link($term);
									?>
									<span><?php echo $comma ?><a href="<?php echo $termLink ?>"><?php echo $termName ?></a></span>
								<?php $i++; } ?>
							</div>	
							<?php } ?>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
	<?php } ?>
<?php } ?>
