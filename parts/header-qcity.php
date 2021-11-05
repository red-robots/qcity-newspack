<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'acstarter' ); ?></a>

  <?php if (!$is_member_page) { ?>
	<header id="masthead" class="site-header " role="banner" >

    <div class="mobile-stick" id="fixed" >
      <div class="wrapper-header ">
        <div class="logo">
        	<a href="<?php bloginfo('url'); ?>" style="background: transparent;">
          	<img src="<?php bloginfo('template_url'); ?>/images/qc-logo.png" alt="<?php bloginfo('name'); ?>">
          </a>
        </div>

        <?php
        $instagram = get_field("instagram_link_short","option"); 
        $headerBtnLink = get_field("header_button_mobile_view","option");
        $headerBtnTarget = ( isset($headerBtnLink['target']) && $headerBtnLink['target'] ) ? $headerBtnLink['target'] : '_self';
        if($headerBtnLink) { ?>
        <div class="newsletter-link" >
            <a href="<?php echo $headerBtnLink['url']?>" target="<?php echo $headerBtnTarget ?>" class="news-letter-btn btn2"><?php echo $headerBtnLink['title']?></a>
        </div>
        <?php } ?>
    </div>

          <?php  
          $topSubscribe = get_field("topSubscribe","option");
          $subscribeText = ( isset($topSubscribe['subscribe_text']) && $topSubscribe['subscribe_text'] ) ? $topSubscribe['subscribe_text']:'';
          $subscribeButton = ( isset($topSubscribe['subscribe_button']) && $topSubscribe['subscribe_button'] ) ? $topSubscribe['subscribe_button']:'';
          $subscribeName = ( isset($subscribeButton['title']) && $subscribeButton['title'] ) ? $subscribeButton['title']:'';
          $subscribeURL = ( isset($subscribeButton['url']) && $subscribeButton['url'] ) ? $subscribeButton['url']:'';
          $subscribeTarget = ( isset($subscribeButton['target']) && $subscribeButton['target'] ) ? $subscribeButton['target']:'_self';
          $redButton = get_field("mainNavRedButton","option");
          $redButtonName = ( isset($redButton['title']) && $redButton['title'] ) ? $redButton['title'] : '';
          $redButtonLink = ( isset($redButton['url']) && $redButton['url'] ) ? $redButton['url'] : '';
          $redButtonTarget = ( isset($redButton['target']) && $redButton['target'] ) ? $redButton['target'] : '_self';
          $customMenuLink = '';
          if($redButtonName && $redButtonLink) {
            $customMenuLink = '<li class="menu-item red-button-link"><a href="'.$redButtonLink.'" target="'.$redButtonTarget.'" class="headerRedBtn redbutton">'.$redButtonName.'</a></li>';
          }
          $mobileJoinBtn = get_field("mainNavRedButtonMobile","option");
          $mobileRedBtnName = ( isset($mobileJoinBtn['title']) && $mobileJoinBtn['title'] ) ? $mobileJoinBtn['title'] : '';
          $mobileRedBtnLink = ( isset($mobileJoinBtn['url']) && $mobileJoinBtn['url'] ) ? $mobileJoinBtn['url'] : '';
          $mobileRedBtnTarget = ( isset($mobileJoinBtn['target']) && $mobileJoinBtn['target'] ) ? $mobileJoinBtn['target'] : '_self';
          $mobile_join_button  = '';
          if($mobileRedBtnName && $mobileRedBtnLink) {
            $mobile_join_button = '<a href="'.$mobileRedBtnLink.'" target="'.$mobileRedBtnTarget.'" class="mobile-join-btn">'.$mobileRedBtnName.'</a>';
          }
          ?>
          <?php if ($subscribeText || $subscribeButton) { ?>
          <section class="red-band">
            <div class="qcwrapper">
              <?php echo $subscribeText ?>
              <?php if ($subscribeButton) { ?>
                <a href="<?php echo $subscribeURL ?>" target="<?php echo $subscribeTarget ?>" class="topSubscribeBtn"><?php echo $subscribeName ?></a>
              <?php } ?>
            </div>
          </section>
          <?php } ?>

	        <div class="mainnav-wrap">
	        	<div class="wrapper-mnav">
					<nav id="site-navigation" class="main-navigation " role="navigation">
                        
						<div class="qcwrapper" >
                            
							<div class="burger">
							  <span></span>
							</div>
							<?php 
                wp_nav_menu( 
                  array( 
                    'theme_location' => 'primary-menu', 
                    // 'theme_location' => 'primary', 
                    'menu_id' => 'primary-menu', 
                    'menu_class'=>'desktop-version nav1 dd-menu',
                    'echo' => true,
                    'items_wrap' => '<ul id="primary-menu" class="with-custom-link %2$s">%3$s'.$customMenuLink.'</ul>'
                  )
                ); 
							//newspack_primary_menu();
              ?>
              <?php //get_search_form(); ?>
						</div>
					</nav><!-- #site-navigation -->
				</div>
			</div>
			<nav class="mobilemenu">
				<div class="mobilemain">
					<?php //wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); 
            wp_nav_menu( 
              array( 
                'theme_location' => 'primary-menu', 
                    // 'theme_location' => 'primary', 
                'menu_id' => 'primary-menu', 
                'menu_class'=>'mobile-version',
                'echo' => true,
                'items_wrap' => $mobile_join_button . '<ul id="primary-menu" class="with-custom-link %2$s">%3$s</ul>'
              )
            ); 
          ?>
				</div>
				<?php wp_nav_menu(array('theme_location'=>'burger','menu_class'=>'main','container'=>'ul')); ?>
			</nav>

    </div>      
	
	</header><!-- #masthead -->
  <?php } ?>
