<?php
// $dateToday = date('Ymd'); 
// $dateViewed = ( isset($_COOKIE['qcitysubcribeview']) && $_COOKIE['qcitysubcribeview'] ) ? $_COOKIE['qcitysubcribeview'] : '';
 
// $show_subscription = true;
// if($dateViewed) {
// 	if($dateViewed==$dateToday) {
// 		$show_subscription = false;
// 	} else {
// 		$show_subscription = true;
// 	}
// } else {
// 	$show_subscription = true;
// }

$sm_title = get_field("subscriptionMobTitle","option");
$sm_text = get_field("subscriptionMobText","option");
$sm_button = get_field("subscriptionMobButtonName","option");
$sm_link = get_field("subscriptionMobButtonLink","option");
?>

<?php if ($sm_title || $sm_text) { ?>
	<div id="mobileSignUpBox" class="mobileSubscribe" style="display:none;">
		<div class="inner">
			<?php if ($sm_title) { ?>
			<h2 class="mtitle"><?php echo $sm_title ?></h2>
			<?php } ?>

			<?php if ($sm_text) { ?>
			<div class="smText"><?php echo $sm_text ?></div>
			<?php } ?>

			<?php if ($sm_button && $sm_link) { ?>
			<div class="msbutton">
				<a href="<?php echo $sm_link ?>" class="signUpBtn"><?php echo $sm_button ?></a>
			</div>
			<?php } ?>
		</div>
		<a id="closeSubscribe"><span>x</span></a>
	</div>
<?php } ?>