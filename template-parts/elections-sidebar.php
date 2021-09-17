<?php 
$elect_quicklinks = get_field("elect_quicklinks","option");
if ($elect_quicklinks) { ?>
	<?php $elect_widget_title = get_field("elect_widget_title","option"); ?>
	<aside id="e-quick-links" class="quick-links">
		<div class="inside">
			<h3 class="q-title"><?php echo $elect_widget_title ?></h3>
			<ul class="qlinks">
			<?php foreach ($elect_quicklinks as $q) { 
				$eq = $q['link'];
				if($eq) {
					$target = ( isset($eq['target']) && $eq['target'] ) ? $eq['target'] : '_self'; ?>
					<li><a href="<?php echo $eq['url'] ?>" target="<?php echo $target; ?>"><?php echo $eq['title'] ?></a></li>
				<?php } ?>
			<?php } ?>
			</ul>
		</div>
	</aside>	
<?php } ?>