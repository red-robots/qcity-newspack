<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package ACStarter
 */

get_header(); 

$sidebar_event_text = get_field('sidebar_event_text', 'option');

$img        = get_field('event_image');

if( $img ){
    $image = $img['url'];
} elseif ( has_post_thumbnail() ) {
    $image = get_the_post_thumbnail('thirds');
    //var_dump($image);
} else {
    $image = get_template_directory_uri() . '/images/default.png';
}

?>

<style>

      @media screen and (min-width: 768px) {

        .sidebar-event {
          width: 25%;
          height: 25vh;
          min-height: 700px;
          /*overflow: auto;*/
          position: -webkit-sticky;
          position: sticky;
          top: 20%;
        }

        .main-event {
            width: 70%;           
            display: flex;
            flex-direction: column;
        }       
        .wrapper-event {
            display: flex;
            justify-content: space-between;
        }

      }

      

      @media screen and (max-width: 767px) {

        .wrapper-event {
            display: flex;
            flex-direction: column;
        }


        .sidebar-event {          
          min-height: 200px;
          background-color: white;
          overflow: auto;          
          position: relative;
          margin-top: 0;
        }

        .main-event {           
            min-height: 100%;
            display: block;            
        }

        code, pre {
            display: block;
        }
        .event-details{
        	background-color: white;
        	padding: 0 6px;
        }

      }
  </style>

<div class="wrapper smaller-screen" style="position: relative;">
	<header class="section-title ">
		<h1 class="dark-gray">Events</h1>
	</header>
	<div class="event-butts">
		<?php get_template_part('template-parts/event-btn'); ?>
	</div>

	<div style="clear:both;"></div>

	<div class="wrapper-event">
		<div id="primary" class="content-area main-event">
			<main id="main" class="site-main" role="main">
				<div class="wrapper">

					
				        <div class="single-page1">
							<?php //if( has_post_thumbnail() ){ ?>
								<div class="story-image">
									<div class="event-image">
										<img src="<?php echo $image; ?>" alt="">
									</div>			
								</div>
							<?php //} ?>

						<?php
						while ( have_posts() ) : the_post(); 
							$startDate = DateTime::createFromFormat('Ymd', get_field('event_date'));
							$endDate = DateTime::createFromFormat('Ymd', get_field('end_date'));
							$start = get_field('event_start_time');
							$end = get_field('event_end_time');
							$contact = get_field('event_contact');
							$email = get_field('event_email');
							$phone = get_field('phone');
							$cost = get_field('cost_of_event');
							$venueName = get_field('name_of_venue');
							$location = get_field('venue_address');
							$tickets = get_field('link_for_tickets_registration');
							$weblink = get_field('website_link');
							$details = get_field('details');
							$postId = get_the_ID();
							$eventCat = get_the_terms( $postId, 'event_cat' );
							$eventCategory = $eventCat[0]->name;
							$image = get_field('event_image'); 
							$size = 'large';
							$thumb = $image['sizes'][ $size ];
							$eventType = get_field('event_type');
						?>

						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<header class="entry-header event">
								<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
								<div class="date">
									<?php 
									// Date
									if ( $endDate != '' ) { 
										echo $startDate->format('l, F j, Y') . ' - ' . $endDate->format('m/d/Y');
									} elseif( $startDate != '' ) { 
										echo ' ' . $startDate->format('l, F j, Y');
									} elseif( $endDateSubmitted != '' ) {
										echo $startDateSubmitted;
									} else {
										echo $startDateSubmitted . ' - ' . $endDateSubmitted;
									}
									?>
								</div>
							</header><!-- .entry-header -->

							<div class="entry-content">
								<?php echo $details; ?>
								<?php the_content(); ?>
								<?php if(strcmp(get_field("culture_block"),"yes")===0):?>
									<div class="culture-text">This is a Culture Blocks event, sponsored by <a href="https://www.artsandscience.org/" target="_blank">Arts &amp; Science Council</a>. Culture for All!</div><!--.culture-text-->
									<a href="https://www.artsandscience.org/programs/for-community/culture-blocks/asc-culture-blocks-upcoming-events/" target="_blank">
										<img src="<?php echo get_template_directory_uri()."/images/culture-blocks.jpg";?>" alt="Culture Blocks">
			 						</a>
								<?php elseif(strcmp(get_field("charlotte_works_block"),"yes")===0):?>
									<div class="culture-text">This is a Charlotte Works event. Careers4All!</div><!--.culture-text-->
									<a href="https://www.artsandscience.org/programs/for-community/culture-blocks/asc-culture-blocks-upcoming-events/" target="_blank">
										<img src="<?php echo get_template_directory_uri()."/images/charlotte-works-logo.jpg";?>" alt="Charlotte Works">
			 						</a>
			 					<?php endif;?>
							</div><!-- .entry-content -->


							<div class="share desktop-version">
								<?php get_template_part('template-parts/sharethis-socialmedia'); ?>
							</div>

							<?php 
							$subscribe_text = $sidebar_event_text;  
							$subscribe_text = '';
							if ($subscribe_text) { ?>
							<footer class="entry-footer desktop-version">
								<div class="side-offer">
								<p><?php echo $subscribe_text; ?></p>
								<div class="btn">
									<a class="white" href="<?php bloginfo('url'); ?>/email-signup">Subscribe</a>
								</div>
								</div>
							</footer><!-- .entry-footer -->
							<?php } ?>

							<?php 
							$the_page_id = get_page_id_by_template('page-templates/page-events-new');
							include( locate_template('template-parts/events-newsletter-box.php') ); ?>

						</article><!-- #post-## -->

						<?php endwhile; // End of the loop. ?>
					</div>

					
				        
				    

				</div> <!-- wrapper -->
			</main> <!-- main -->
		</div> <!--  primary  -->

		<div class="sidebar-event">
            <div class="event-details" id="sidebar-event1">
				<div >
					<?php if( $venueName != '' ) { ?>
			        	<div class="detail-title">Venue</div>
			        	<div class="detail-info"><?php echo $venueName; ?></div>
			        <?php } ?>

			    	<?php if( $location != '' ) { ?>
				    	<div class="detail-title">Address</div>
				        <div class="detail-info"><?php echo $location; ?></div>
			        <?php } ?>
			        
			        <?php if( $start != '' ) { ?>
				        <div class="detail-title">Start Time</div>
				        <div class="detail-info">
				        <?php echo $start; ?></div>
			        <?php } ?>
			        
			        <?php if( $end != '' ) { ?>
				        <div class="detail-title">End Time</div>
				        <div class="detail-info"><?php echo $end; ?></div>
			        <?php } ?>
			        
			        <?php if( $cost != '' ) { ?>
				        <div class="detail-title">Cost</div>
				        <div class="detail-info"><?php echo $cost; ?></div>
			        <?php } ?>
			        <?php if( $eventCat != '' ) { ?>
				        <div class="detail-title">Event Category</div>
				        <div class="detail-info">
			        	<!-- uses yoast primary category -->
			        	<?php get_template_part('inc/primary-category-event'); ?>
			        </div>
			        <?php } ?>
			        <?php if( $tickets != '' ) { ?>
			        	<div class="fe-website btn event_website">
			        		<a class="red" target="_blank" href="<?php echo $tickets; ?>">Tickets/Registration</a>
			        	</div>
			        <?php } ?>
			        
			        <?php if( $weblink != '' ) { ?>
			        	<div class="fe-website btn event_website">
			        		<a class="red" target="_blank" href="<?php echo $weblink; ?>">Visit Website</a>
			        	</div>
			        <?php }   ?>

			        	<div class="share mobile-version" style="margin-top:30px">
								<?php get_template_part('template-parts/sharethis-socialmedia'); ?>
								</div>

							
						<footer class="entry-footer mobile-version">
							<?php 
							$text = 'Have you signed up to receive our daily news and events listings?'; 
							?>
							<div class="side-offer">
								<p><?php echo $text; ?></p>
								<div class="btn">
									<a class="white" href="<?php bloginfo('url'); ?>/email-signup">Subscribe</a>
								</div>
							</div>
						</footer><!-- .entry-footer -->
				</div>
		    	
			</div>
    </div> <!-- sidebar-event -->
	
	</div> <!--  wrapper-event -->
	
	
</div>

<?php get_template_part('template-parts/post-event-form'); ?>

<?php 
get_footer();
