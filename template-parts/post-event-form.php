<?php 
$pageID = get_page_id_by_template('page-templates/page-events-new'); 
$eventSubmission = get_field("event_submission_form",$pageID); 
if($eventSubmission) { 
	$es_shortcode = '[gravityform id="'.$eventSubmission.'" title="false" description="false" ajax="true"]'; 
		if( do_shortcode($es_shortcode) ) { ?>
		<div class="eventSubmissionForm esformPopUp">
			<div class="formInner">
				<a href="#" id="closeEsPopup"><span>x</span></a>
				<?php echo do_shortcode($es_shortcode); ?>
			</div>
		</div>
		<div class="esformbackdrop"></div>
	<?php } ?>
<?php } ?>