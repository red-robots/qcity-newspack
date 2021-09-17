<?php if( $sponsors = get_field('sponsors') ) { 
global $wpdb;
$row = $sponsors[0];
$post_id = $row->ID;
$logo = get_field("logo", $post_id);
$description = get_field("description", $post_id);
$logo_link = get_field("logo_hyperlink", $post_id);
$link = '';
$link_text = '';

/* Query SPONSORS page ID */
$query = "SELECT p.ID FROM ".$wpdb->prefix."posts p LEFT JOIN ".$wpdb->prefix."postmeta m 
					ON p.ID=m.post_id WHERE p.post_name='sponsors' AND p.post_type='page' AND p.post_status='publish' AND m.meta_key='sponsorship_policy_link' AND m.meta_value>0";
$result = $wpdb->get_row($query);
$sponsors_page_id = ($result) ? $result->ID : '';
if($sponsors_page_id) {
	$link = get_field("sponsorship_policy_link",$sponsors_page_id);
	$link_text = get_field("sponsorship_policy_text",$sponsors_page_id);
}

$sponsorLinkOpen = ($logo_link) ? '<a href="'.$logo_link.'" target="_blank">':'';
$sponsorLinkClose = ($logo_link) ? '</a>':'';
?>
<div class="sponsoredDataDiv">
	<div class="sponsoredInfoBox">
		<div class="sponsored-by">
			<div class="sponsor-sidebar-wrapper">
				<h2>Sponsored By:</h2>
				<?php if($logo) { ?>
					<div class="sponsor-logo">
					<?php echo $sponsorLinkOpen; ?>
						<img src="<?php echo $logo['url'];?>" alt="<?php echo $logo['alt'];?>">
					<?php echo $sponsorLinkClose; ?>
					</div>
				<?php } ?>

				<?php if($description) { ?>
					<div class="description">
						<?php echo $description;?>
					</div>
				<?php } ?>

				<?php if($link && $link_text) { ?>
					<div class="policy-link">
						<a href="<?php echo $link;?>" target="_blank"><?php echo $link_text;?></a>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>

		<?php  $info = get_field("spcontentInfo","option");
      if($info) {
          $i_title = $info['title'];
          $i_text = $info['text'];
          $i_display = ($info['display'] && $info['display']=='on') ?  true : false;
      } else {
          $i_title = '';
          $i_text = '';
          $i_display = '';
      } ?>	
		
			<?php if ($i_display && $i_text) { ?>
       <div class="sponsoredInfoWrap">
       		<div class="sponsoredInfo"><?php echo $i_text ?></div>
       </div>
      <?php } ?>

</div>
<?php } ?>