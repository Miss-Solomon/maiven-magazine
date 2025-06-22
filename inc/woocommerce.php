<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package minerva
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)-in-3.0.0
 *
 */


function minerva_woocommerce_setup() {
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}

add_action( 'after_setup_theme', 'minerva_woocommerce_setup' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function minerva_woocommerce_scripts() {

	wp_enqueue_style( 'minerva-woocommerce-style',  MINERVA_CSS . '/woocommerce.css' );

	if ( class_exists( 'woocommerce' ) ) {
		wp_enqueue_style( 'minerva-woocommerce-style' );
	}
}
add_action( 'wp_enqueue_scripts', 'minerva_woocommerce_scripts' );


/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function minerva_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', 'minerva_woocommerce_active_body_class' );


/**
 * Product gallery thumnbail columns.
 *
 * @return integer number of columns.
 */
function minerva_woocommerce_thumbnail_columns() {
	return 4;
}
add_filter( 'woocommerce_product_thumbnails_columns', 'minerva_woocommerce_thumbnail_columns' );


/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function minerva_woocommerce_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => 4,
		'columns'        => 4,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'minerva_woocommerce_related_products_args' );


/**
 * Remove the breadcrumbs 
 */
add_action( 'init', 'minerva_wc_breadcrumbs' );
function minerva_wc_breadcrumbs() {
    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
	add_action( 'minerva_woocommerce_breadcrumb', 'woocommerce_breadcrumb' );
}


/**
 * Remove the product link 
 */
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );

remove_action( 'woocommerce_shop_loop_item_title','woocommerce_template_loop_product_title', 10 );
add_action('woocommerce_shop_loop_item_title', 'minerva_change_products_title', 10 );
function minerva_change_products_title() {
    echo '<h2 class="woocommerce-loop-product__title"><a href="'.get_the_permalink().'">' . get_the_title() . '</a></h2>';
}


/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'minerva_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function minerva_woocommerce_wrapper_before() {
		?>
		<div id="primary" class="content-area <?php minerva_shop_content_columns(); ?>">
			<main id="main" class="site-main" role="main">
			<?php
	}
}
add_action( 'woocommerce_before_main_content', 'minerva_woocommerce_wrapper_before' );

if ( ! function_exists( 'minerva_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function minerva_woocommerce_wrapper_after() {
			?>
			</main><!-- #main -->
		</div><!-- #primary -->
		<?php
	}
}
add_action( 'woocommerce_after_main_content', 'minerva_woocommerce_wrapper_after' );


/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
	<?php
		if ( function_exists( 'minerva_woocommerce_header_cart' ) ) {
			minerva_woocommerce_header_cart();
		}
	?>
 */

if ( ! function_exists( 'minerva_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 * @link https://docs.woocommerce.com/document/show-cart-contents-total/
	 */
	function minerva_woocommerce_cart_link_fragment( $fragments ) {
		global $woocommerce;
		ob_start();
		minerva_woocommerce_cart_link();

		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'minerva_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'minerva_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function minerva_woocommerce_cart_link() {
		?>
			<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'minerva' ); ?>">
				<i class="icofont-shopping-cart"></i>
				<?php
					$item_count_text = sprintf(
						/* translators: number of items in the mini cart. */
						_n( '%d', '%d', WC()->cart->get_cart_contents_count(), 'minerva' ),
						WC()->cart->get_cart_contents_count()
					);
				?>
				<span class="count"><?php echo esc_html( $item_count_text ); ?></span>
			</a>
		<?php
	}
}

if ( ! function_exists( 'minerva_woocommerce_header_cart' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function minerva_woocommerce_header_cart() {
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		?>
			<div id="minerva-header-cart-wrapper" class="minerva-header-cart-wrapper">
				<div class="header-cart-box">
					<?php minerva_woocommerce_cart_link(); ?>
				</div>

				<?php if( !is_cart() && !is_checkout() ) { ?>

				<div class="cart-inner">
					<?php
						$instance = array(
							'title' => '',
						);
						the_widget( 'WC_Widget_Cart', $instance );
					?>
				</div>

				<?php } ?>

				
			</div>
		<?php
	}
}



//Get layout shop page.
if ( ! function_exists( 'minerva_get_shop_layout' ) ) :
	function minerva_get_shop_layout() {
		// Get layout.
		
		$page_layout = minerva_get_option( 'shop_layout' );
		

		return $page_layout;
	}
endif;


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
if ( ! function_exists( 'minerva_shop_content_columns' ) ) :
	function minerva_shop_content_columns() {

		$shop_content_width = array();

		// Check if layout is one column.
		if ( 'right-sidebar' === minerva_get_shop_layout() && is_active_sidebar( 'shop-sidebar' ) ) {
			$shop_content_width[] = 'col-lg-8 col-sm-12';
		}elseif ('left-sidebar' === minerva_get_shop_layout() && is_active_sidebar( 'shop-sidebar' ) ) {
			$shop_content_width[] = 'col-lg-8 col-sm-12 woo-custom-left-sidebar';
		} else {
			$shop_content_width[] = 'col-lg-12 col-md-12 col-sm-12';
		}

		// return the $classes array
    	echo implode( ' ', $shop_content_width );
	}
endif;


/**
 * Register widget area for shop page.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function minerva_woocommerce_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Shop Sidebar', 'minerva' ),
        'id'            => 'shop-sidebar',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h5 class="widget-title shop-widget-heading">',
        'after_title'   => '</h5>',
    ) );
}
add_action( 'widgets_init', 'minerva_woocommerce_widgets_init' );

