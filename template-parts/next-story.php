<?php
	$post_id = get_the_ID();
	$sponsor_id = 0;
	$sponsors = get_field('sponsors');	
	if($sponsors):
		$sponsor = get_post($sponsors[0]->ID);
		$sponsor_id = $sponsor->ID;		
	endif;	

	$next = posts_have_sponsors($post_id, $sponsor_id);

	
	$tags = get_the_tags( $post->ID );
	$taglist = array();
	if( $tags ){
		foreach ($tags as $tag) {		
			$taglist[] = array(
					'term_id' 	=> $tag->term_id,
					'name'		=> 	$tag->name
			);
		}

		$tag_column = array_column($taglist, 'term_id');
		array_multisort($tag_column, SORT_ASC, $taglist);

		$tag = $taglist[0]['term_id'];
	}
	
	
	if( get_post_type() == 'business_listing'):
		$title = "Related Business";
	else:
		$title = "Related Articles";
	endif;

	
?>

<section class="next-story" >
	<header class="section-title " style="margin-top: 20px">
		<h2 class="dark-gray">Related Articles</h2>
	</header>
	<div class="qcwrapper">
		<?php 
				
			

			if( get_post_type() == 'business_listing'):

				// business_listing posts

				/*$terms = wp_get_post_terms( get_the_ID(), 'business_category' );			

				$args = array(
						'post_type' 		=> 'business_listing',
						'post_status'		=> 'publish',
						'posts_per_page' 	=> 3,
						'orderby'          	=> 'rand',
						//'category__in' 		=> array( $terms->term_id ),
						'tax_query' 		=> array(
												array(
											        'taxonomy' 			=> 'business_category',
											        'field' 			=> 'slug',
											        'terms' 			=> array( $terms[0]->slug ),
											        'include_children' 	=> false,
											        'operator' 			=> 'IN'
											    )
		 				)
				);*/

				$args = array(     
					        'category_name'     => 'black-business',        
					        'post_type'         => 'post',        
					        //'post__not_in'      => array( $post_id ),
					        'post_status'       => 'publish',
					        'posts_per_page'    => 3,
					        'orderby'          	=> 'rand',		       
				);

				$wp_query = new WP_Query($args);

				if( $wp_query->have_posts() ): 

					while( $wp_query->have_posts() ): $wp_query->the_post();
						get_template_part( 'template-parts/next-business' );
					endwhile;

				endif;

			else:

				// regular posts

				$post_id 	= get_the_ID();
			    $cat_ids 	= array();
			    $categories = get_the_category( $post_id );
			 
			    if ( $categories && !is_wp_error( $categories ) ) {			 
			        foreach ( $categories as $category ) {			 
			            array_push( $cat_ids, $category->term_id );			 
			        }			 
			    }


			
				if( is_object($next)) {
					$args = array(
					  	'p'         		=> $next->ID, 
					  	'post_type' 		=> 'post',
					  	'post_status'      	=> 'publish',
        				'posts_per_page' 	=> 3,
						'orderby'          	=> 'rand',
					);
				} elseif($sponsors) {
					$args = array(
					  	'category_name'    	=> 'offers-invites',        
	        			'post_type'        	=> 'post',        
	        			'post_status'      	=> 'publish',
	        			'posts_per_page' 	=> 3,
						'orderby'          	=> 'rand',
						'post__not_in'      => array( $post_id ),
					);
				} elseif($tag) {
					$args = array(				  	       
	        			'post_type'        	=> 'post',        
	        			'post_status'      	=> 'publish',
	        			'post__not_in'      => array( $post_id ),
	        			'posts_per_page' 	=> 3,
						'orderby'          	=> 'rand',
						'tag_id' 			=> $tag, 
						//'category__in'      => $cat_ids,
						
					);
				} else {
					$args = array(				  	       
	        			'post_type'        	=> 'post',        
	        			'post_status'      	=> 'publish',
	        			'post__not_in'      => array( $post_id ),
	        			'posts_per_page' 	=> 3,
						'orderby'          	=> 'rand',
						'category__in'      => $cat_ids,
						
					);
				}

				$wp_query = new WP_Query($args);
			
				if ($wp_query->have_posts()) : 
					while ($wp_query->have_posts()) : $wp_query->the_post(); 
						include( locate_template('template-parts/next-story-block.php', false, false) );
					endwhile;
				endif;
				wp_reset_postdata();

			endif; // get_post_type == 'business_listing'
		?>
		
		
	</div>	
</section>