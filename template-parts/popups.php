<!-- 

	Newsletter Signup popup

-->
<div class="newsletter">
	<div class="close">X</div>
	<div class="nothanks">no thanks</div>
	<div id="mc_form_pop">
		<h2>Your Source.<br>
		Your Voice.
		</h2>
		<span id="success_message" style="display:none;">
			<div style="text-align:center;">Thanks for signing up!</div>
		</span>
		<p>Delivering the latest from Qcitymetro right to your inbox.</p>
		<div class="modal-signup">
			<a href="<?php bloginfo('url'); ?>/email-signup">Sign Up</a>
		</div>
	</div><!-- mc_form_pop -->
</div><!-- newsletter -->


<div style="display: none;">
	<div id="submit-an-event" class="popup-form">
		<?php echo do_shortcode('[gravityform id="20" title="false" description="false"]'); ?>
	</div>
</div>