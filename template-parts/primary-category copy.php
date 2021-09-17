<?php
$queried = get_queried_object();
$current_term_id = ( isset($queried->term_id) && $queried->term_id ) ? $queried->term_id : '';
$current_term_name = ( isset($queried->name) && $queried->name ) ? $queried->name : '';
$current_term_slug = ( isset($queried->slug) && $queried->slug ) ? $queried->slug : '';
$current_term_link = get_term_link($queried);

$yourTaxonomy = 'category';

//Fill in your custom taxonomy here
$yourTaxonomy = 'category';
// $yourTaxonomy = 'event_cat';

$postId = get_the_ID();


// SHOW YOAST PRIMARY CATEGORY, OR FIRST CATEGORY
$category = get_the_terms( $postId, $yourTaxonomy );
$useCatLink = true;



// If post has a category assigned.
if ($category){
	$category_display = '';
	$category_link = '';
	if ( class_exists('WPSEO_Primary_Term') )
	{
		// Show the post's 'Primary' category, if this Yoast feature is available, & one is set
		if( get_post_type() == 'event' ){
			$wpseo_primary_term = new WPSEO_Primary_Term( 'event_cat', get_the_id() );
		} else {
			$wpseo_primary_term = new WPSEO_Primary_Term( 'category', get_the_id() );
		}
		$wpseo_primary_term = $wpseo_primary_term->get_primary_term();
		$term = get_term( $wpseo_primary_term );

		//print_r($term);	

		if (is_wp_error($term)) { 
			// Default to first category (not Yoast) if an error is returned
			$category_display = $category[0]->name;
			$category_link = get_bloginfo('url') . '/' . 'event-category/' . $category[0]->slug;
			echo '<!-- error - slug='.$category[0]->slug.' -->';
		} else { 
			// Yoast Primary category
			$category_display = $term->name;
			$category_link = get_term_link( $term->term_id );
			echo '<!-- no error, but no link? -->';
		}
	} 
	else {
		// Default, display the first category in WP's list of assigned categories
		$category_display = $category[0]->name;
		$category_link = get_term_link( $category[0]->term_id );
	}
	// Display category
	if ( !empty($category_display) ){

		$finalCatName = '';
		$catLink = '';
		foreach($category as $cat) {
			$catSlug = $cat->slug;
			if( $catSlug == 'sponsored-post') {
				$finalCatName = $cat->name;
				$catLink = get_term_link($cat);
				break;
			}
		}

		if($finalCatName && $catLink) {
			$category_link = $catLink;
			$category_display = $finalCatName;
		}

	    if ( $useCatLink == true && !empty($category_link) ){

	   //  	if( is_archive() ) {
				// 	echo '<a href="'.$current_term_link.'" class="catname">'.$current_term_name.'</a>';
				// } else {
				// 	echo '<a href="'.$category_link.'" class="catname">'.$category_display.'</a>';
				// }

				echo '<a href="'.$category_link.'" class="catname">'.$category_display.'</a>';

	    } else {
			echo $category_display;
	    }
	}
	
}

$category = get_the_category( $id );
// echo $category[0]->cat_name; 

//echo $category_display;

/*
echo '<!-- ';
echo '<pre>';
print_r($category);
echo '</pre>';
echo ' -->';
*/