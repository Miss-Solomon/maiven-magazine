<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

$minerva_logo = minerva_get_option( 'theme_logo' );
$minerva_logo_id = isset($minerva_logo['id']) && !empty($minerva_logo['id']) ? $minerva_logo['id'] : '';
$minerva_logo_url = isset( $minerva_logo[ 'url' ] ) ? $minerva_logo[ 'url' ] : '';
$minerva_logo_alt = get_post_meta($minerva_logo_id,'_wp_attachment_image_alt',true);


$minerva_header_search = minerva_get_option('search_bar_enable', true);
$subscribe_btn_enable = minerva_get_option('subscribe_btn_enable', false);

$subscribe_btn_text = minerva_get_option('subscribe_btn_text');
$subscribe_btn_link = minerva_get_option('subscribe_btn_link');

$header_panel_nav = minerva_get_option('header_panel_nav');



?>

<header id="theme-header-one" class="theme_header__main header-style-two">
	
	<div class="theme-header-area">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-2 col-md-12">
					
					<div class="header-left-content">
	
					<?php if($header_panel_nav == true) :?>
					<div class="header_panel_nav_wrap">
                        <div class="lv-header-bar-1">
                            <div class="panel-bar-box">
                                <span class="lv-header-bar-line lv-header-bar-line-1"></span>
                                <span class="lv-header-bar-line lv-header-bar-line-2"></span>
                                <span class="lv-header-bar-line lv-header-bar-line-3"></span>
                            </div>
                        </div>
                    </div>
					<?php endif; ?>

					<div class="logo theme-logo">
					<?php  
					if ( has_custom_logo() || !empty( $minerva_logo_url ) ) {
						if( isset( $minerva_logo['url'] ) && !empty( $minerva_logo_url ) ) { 
							?>
								<a href="<?php echo esc_url( site_url('/')) ?>" class="logo">
									<img class="img-fluid" src="<?php echo esc_url( $minerva_logo_url ); ?>" alt="<?php echo esc_attr( $minerva_logo_alt  ) ?>">
								</a>
						    <?php 
						} else {
							 the_custom_logo();
						}

					} else {
						printf('<h1 class="text-logo"><a href="%1$s">%2$s</a></h1>',esc_url(site_url('/')),esc_html(get_bloginfo('name')));
					}
					?>
					</div>

					</div>

				</div>
				
				<div class="col-lg-9 col-md-12 nav-design-one">
					<div class="nav-menu-wrapper">
						<div class="nav-wrapper-one">
							<div class="minerva-responsive-menu"></div>
							<div class="mainmenu">
								<?php
									wp_nav_menu( array(
										'theme_location' => 'primary',
										'container' => 'nav',
										'container_class' => 'nav-main-wrap',
										'menu_class' => 'theme-main-menu',
										'menu_id'        => 'primary-menu',
										'fallback_cb'  => 'minerva_fallback_menu',
										//'fallback_cb' => false,
										'walker' => new MinervaNavWalker(),
									) );
								?>

							</div>
						</div>
					</div>	
				</div>
				

				<div class="col-lg-1">
					<div class="header-right-content text-right">
					
						<?php if($minerva_header_search == true) :?>
						<div class="header-search-box">
							<a href="#" class="search-box-btn"><i class="icofont-search-1"></i></a>
						</div>
						<?php endif; ?>
						
						<?php if($subscribe_btn_enable == true) :?>
						<div class="header-signup-btn">
							<a href="<?php echo esc_url($subscribe_btn_link); ?>" target="_blank"><?php echo esc_html($subscribe_btn_text); ?></a>
						</div>
						<?php endif; ?>
						

					</div>
				</div>


			</div>
		</div>

		<div class="header-divider-one"></div>

		
	</div>
</header>


<!-- Panel Nav Content -->
<div class="minerva-custom-panel-menu-wrapper">
    <div class="minerva-custom-panel-box-wrap">
        <div class="minerva-custom-panel-box-effect text-right">
            <div class="minerva-custom-panel-close">
                <span class="minerva-custom-panelclose-letter"><?php esc_html_e( 'Close', 'minerva' ); ?><i class="ri-close-fill"></i></span>
            </div>
        </div>
        <div class="panel-nav-widgets-content-wrapper">
            <?php if ( is_active_sidebar( 'panel-nav' ) ): ?>
            <div class="panel_nav_Widget">
                <?php dynamic_sidebar( 'panel-nav' ); ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<div class="overlay"></div>
<!-- Panel Nav Content End -->


<div class="body-overlay" id="body-overlay"></div>

<!-- search popup area start -->
<div class="search-popup" id="search-popup">
	<form role="search" method="get" id="searchform" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<div class="form-group">
			<input type="text" class="search-input" value="<?php echo get_search_query(); ?>" name="s" id="s" placeholder="<?php esc_attr_e('Search.....','minerva'); ?>" required />
		</div>
			<button type="submit" id="searchsubmit" class="search-button submit-btn"><i class="icofont-search-1"></i></button>
	</form>							
</div>
<!-- search Popup end-->
