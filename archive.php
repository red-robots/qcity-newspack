<?php
if( have_posts() ):
  the_post(); rewind_posts();
endif;

if( get_post_type() == 'event' ):
	include( TEMPLATEPATH . '/archive-event-category.php');
elseif( get_post_type() == 'job' ):
    include( TEMPLATEPATH . '/archive-job_cat.php');
else:
	include( TEMPLATEPATH . '/archive-post.php');
endif;