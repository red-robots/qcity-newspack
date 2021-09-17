<div class="bottom">
	<div class="btn">
		<a class="popup" href="#submit-an-event">Post an Event</a>
	</div>
	<div class="btn">
		<div class="banner-button find"><span class="banner-button-text">Event Categories</span>
		<?php 
		$terms = get_terms( array(
		    'taxonomy' => 'event_cat',
		    'hide_empty' => false,
		) );
		// echo '<pre>';
		// print_r($terms);
		// echo '</pre>';
			if(is_array($terms)&&!empty($terms)):?>
                    <ul>
                        <?php foreach($terms as $term):?>
                            <li>
                                <a href="<?php echo get_term_link($term->term_id);?>"><?php echo $term->name;?></a> 
                            </li>
                        <?php endforeach;?>
                    </ul>
                <?php endif;?>
		</div>
	</div>
	<div class="btn">
		<a href="">Events This Weekend</a>
	</div>
</div>