<?php  
$widget_title = get_field('home_foot_widget_title','option');
$foot_images = get_field('home_foot_images','option');
?>
<div class="biz-dir home-widget-footer">
	<?php if ($widget_title) { ?>
	<header class="section-title ">
		<h2 class="dark-gray"><?php echo $widget_title ?></h2>
	</header>
	<?php } ?>

	<?php if ($foot_images) { $count = count($foot_images); ?>
	<div class="home-widget-images <?php echo ($count>1) ? 'images-med':'images-full' ?>">
		<ul class="hw-list">
			<?php $n=1; foreach ($foot_images as $e) { 
				$image = $e['image'];
				$link = $e['link'];
				$target = ( isset($e['newtab'][0]) && $e['newtab'][0]=='yes' ) ? '_blank' : '_self';
				$open_link = ($link) ? '<a href="'.$link.'" target="'.$target.'">':'';
				$close_link = ($link) ? '</a>':'';
				if($image) { 
					$first = ($n==1) ? 'first':'';?>
				<li class="<?php echo $first ?>">
					<?php echo $open_link; ?><img src="<?php echo $image['url'] ?>" alt="<?php echo $image['title'] ?>"><?php echo $close_link; ?>
				</li>
				<?php $n++; } ?>
			<?php } ?>
		</ul>
	</div>
	<?php } ?>
</div>