<?php /* TOP BUTTONS */
$pageID = get_page_id_by_template('page-templates/page-events-new'); 
$buttons = get_field("cta_buttons",$pageID);
$currentCategory = ( isset($_GET['category']) && $_GET['category'] ) ? $_GET['category'] : '';
$filter = ( isset($_GET['filter']) && $_GET['filter']=='thisweekend' ) ? $_GET['filter'] : '';

$selectedTermID = '';
if( is_archive() ) {
	$obj = get_queried_object();
	$selectedTermID = ( isset($obj->term_id) && $obj->term_id ) ? $obj->term_id : '';
}


if( !isset($currentCatName) ) {
	$currentCatName = '';
}
if( !isset($currentCategory) ) {
	$currentCategory = '';
}
?>
<?php if ($buttons) { ?>
<div class="pageCTAWrap">
	<div class="pageCTAButtons">
		<ul class="flex">
		<?php $ctr=1; foreach ($buttons as $e) {
		if( $b = $e['button'] ) { 
			$btnId = strtolower(sanitize_title($b['title']));  
			$firstBtn = ($ctr==1) ? ' first':'';
			if($b['title'] && $b['url']) { ?>
				<li class="jbtn<?php echo $firstBtn ?>">
					<a id="<?php echo $btnId ?>" href="<?php echo $b['url'] ?>" target="<?php echo ( isset($b['target']) && $b['target'] ) ? $b['target'] : '_SELF'; ?>" class="jobctabtn"><?php echo $b['title'] ?></a>
					<?php 
					if (strpos($b['url'], "thisweekend") !== false) { 
						if($filter) {
							$custom_page_title = $b['title'];
							$currentCatName = $b['title'];
						}
					}
					?>
					<?php if ($b['url']=='#eventcategories') { ?>
						<?php 
						/* Find Jobs Dropdown */
						$terms = get_terms( array(
					    'taxonomy' 		=> 'event_cat',
					    'orderby' => 'name',
							'order' => 'ASC',
					    'hide_empty' 	=> true
						));
						if( is_array($terms) && !empty($terms) ) { ?>
						<div data-for="<?php echo $btnId ?>" class="jobCategories dropdownList">
							<ul class="cats">
								<?php foreach($terms as $term) {
									$cat_term_id = $term->term_id; 
									$catSlug = $term->slug;
									$termLink = get_term_link($term->term_id);
									// if( is_single() ) {
									// 	$termLink = get_site_url() . '/events/?category=' . $catSlug;
									// } else {
									// 	$termLink = get_permalink() . '?category=' . $catSlug;
									// }
									$isActive = ($selectedTermID && $selectedTermID==$cat_term_id) ? ' active':'';
									?>
	              	<li class="catlink<?php echo $isActive;?>"><a href="<?php echo $termLink;?>"><?php echo $term->name;?></a></li>
	              <?php } ?>
							</ul>
						</div>
						<?php } ?>
					<?php } ?>
				</li>
				<?php $ctr++; } ?>
			<?php } ?>
		<?php } ?>
		</ul>
	</div>
</div>
<?php } ?>