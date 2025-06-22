<?php
/*
Plugin Name: Minerva Extra
Plugin URI: https://gossipthemes.com/minerva-extra
Description: This is a helper plugin for Minerva Theme.
Author: Gossip Themes
Version: 1.0
Author URI: https://gossipthemes.com
*/

/**  Related Theme Type */

global $related_theme_type;
$related_theme_type = array('Minerva','Minerva Child');
//define current theme name
$current_theme = !empty( wp_get_theme() ) ? wp_get_theme()->get('Name') : '';
define('CURRENT_THEME_NAME',$current_theme);


/*
 * Define Plugin Dir Path
 * @since 1.0.0
 * */
define('MINERVA_EXTRA_SELF_PATH','minerva-extra/minerva-extra.php');
define('MINERVA_EXTRA_ROOT_PATH',plugin_dir_path(__FILE__));
define('MINERVA_EXTRA_ROOT_URL',plugin_dir_url(__FILE__));
define('MINERVA_EXTRA_LIB',MINERVA_EXTRA_ROOT_PATH.'/lib');
define('MINERVA_EXTRA_INC',MINERVA_EXTRA_ROOT_PATH .'/inc');
define('MINERVA_EXTRA_ADMIN',MINERVA_EXTRA_INC .'/admin');
define('MINERVA_EXTRA_ADMIN_ASSETS',MINERVA_EXTRA_ROOT_URL .'inc/admin/assets');
define('MINERVA_EXTRA_CSS',MINERVA_EXTRA_ROOT_URL .'assets/css');
define('MINERVA_EXTRA_JS',MINERVA_EXTRA_ROOT_URL .'assets/js');
define('MINERVA_EXTRA_ELEMENTOR',MINERVA_EXTRA_INC .'/elementor');
define('MINERVA_EXTRA_SHORTCODES',MINERVA_EXTRA_INC .'/shortcodes');
define('MINERVA_EXTRA_WIDGETS',MINERVA_EXTRA_INC .'/widgets');

/** Plugin version **/
define('MINERVA_CORE_VERSION','1.0.0');

//initial file
include_once ABSPATH .'wp-admin/includes/plugin.php';

if ( is_plugin_active(MINERVA_EXTRA_SELF_PATH) ) {

	if ( !in_array(CURRENT_THEME_NAME,$GLOBALS['related_theme_type']) && file_exists(MINERVA_EXTRA_INC .'/cs-framework-functions.php') ) {
		
		require_once MINERVA_EXTRA_INC .'/cs-framework-functions.php';
		
	}

	//plugin core file include
	
	if ( file_exists(MINERVA_EXTRA_INC .'/class-minerva-extra-init.php') ) {
		require_once MINERVA_EXTRA_INC .'/class-minerva-extra-init.php';
	}
	
	//Demo data import 
	
	if ( file_exists(MINERVA_EXTRA_INC .'/demo-import.php') ) {
		require_once MINERVA_EXTRA_INC .'/demo-import.php';
	}
	
}


//*** Post sharing function ***//

if ( ! function_exists( 'minerva_social_sharing' ) ) :
  /**
   * Prints HTML with meta information for the categories, tags and comments.
   */
  function minerva_social_sharing() {

      
            echo '<div class="post-meta-right-social">';

           echo '<a class="face social-list__link" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=' .get_the_permalink(). '" title="Facebook"><i class="fab fa-facebook-f"></i></a>';

           echo '<a class="twit social-list__link" target="_blank" href="https://twitter.com/intent/tweet?text=' .get_the_title(). '&url=' .get_the_permalink(). '" title="Twitter"><i class="fab fa-twitter"></i></a>';

           echo '<a class="pint social-list__link" target="_blank" href="https://www.pinterest.com/pin/create/button/?url=' .get_the_permalink(). '&description=' .get_the_title(). '" title="Pinterest"><i class="fab fa-pinterest-p"></i></a>';

           echo '<a class="linked social-list__link" target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=' .get_the_permalink(). '&title=' .get_the_title(). '&summary=' .esc_url( get_home_url('/') ). '&source=' .get_bloginfo( 'name' ). '" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>';


            echo '</div>';

  };

endif;

/** Add Contact Methods in the User Profile **/
function minerva_user_contact_methods( $user_contact ) {
	
    $user_contact['facebook']   = esc_html__( 'Facebook Profile Link', 'minerva' );
    $user_contact['twitter']    = esc_html__( 'Twitter Profile', 'minerva' );
    $user_contact['instagram']  = esc_html__( 'Instagram', 'minerva' ); 
	$user_contact['pinterest']  = esc_html__( 'Pinterest', 'minerva' );
	$user_contact['youtube']    = esc_html__( 'Youtube Profile', 'minerva' );
	
    return $user_contact; 
};
add_filter( 'user_contactmethods', 'minerva_user_contact_methods' );

function minerva_theme_author_box() {

    global $post;

    $theme_author_markup = '';
    // Get author's display name - NB! changed display_name to first_name. Error in code.
    $display_name = get_the_author_meta( 'display_name', $post->post_author );

    // If display name is not available then use nickname as display name
    if ( empty( $display_name ) )
    $display_name = get_the_author_meta( 'nickname', $post->post_author );

    // Get author's biographical information or description
    $user_description   = get_the_author_meta( 'user_description', $post->post_author );
    
    $user_facebook      = get_the_author_meta('facebook', $post->post_author);
    $user_twitter       = get_the_author_meta('twitter', $post->post_author);
    $user_instagram     = get_the_author_meta('instagram', $post->post_author);
	$user_pinterest     = get_the_author_meta('pinterest', $post->post_author);
	$user_youtube       = get_the_author_meta('youtube', $post->post_author);

    // Get link to the author archive page
    $user_posts = get_author_posts_url( get_the_author_meta( 'ID' , $post->post_author));
    if ( ! empty( $display_name ) )
    // Author avatar - - the number 90 is the px size of the image.
    $theme_author_markup .= '<div class="author-thumb">' . get_avatar( get_the_author_meta('ID') , 200 ) . '</div>';
    $theme_author_markup .= '<div class="theme_author_Info">';
    $theme_author_markup .= '<h6 class="theme_author_Title">' . esc_html__('About Author', 'minerva'). '</h6>';
    $theme_author_markup .= '<h4 class="theme_author__Name">' . $display_name . '</h4>';
    $theme_author_markup .= '<p class="theme_author__Description">' . get_the_author_meta( 'description' ). '</p>';
    $theme_author_markup .= '<div class="theme_author_Socials">';


	// Check if author has Twitter in their profile
	
    if ( ! empty( $user_facebook ) ) {
        $theme_author_markup .= ' <a href="' . $user_facebook .'" target="_blank" rel="nofollow" title="Facebook"><i class="fab fa-facebook-f"></i> </a>';
    }
	
	    
    if ( ! empty( $user_twitter ) ) {
        $theme_author_markup .= ' <a href="' . $user_twitter .'" target="_blank" rel="nofollow" title="Twitter"><i class="fab fa-twitter"></i> </a>';
    }
	
	if ( ! empty( $user_instagram ) ) {
        $theme_author_markup .= ' <a href="' . $user_instagram .'" target="_blank" rel="nofollow" title="Instagram"><i class="fab fa-instagram"></i> </a>';
    }
	
	if ( ! empty( $user_pinterest ) ) {
        $theme_author_markup .= ' <a href="' . $user_pinterest .'" target="_blank" rel="nofollow" title="Pinterest"><i class="fab fa-linkedin-in"></i> </a>';
    }

    if ( ! empty( $user_youtube ) ) {
        $theme_author_markup .= ' <a href="' . $user_youtube .'" target="_blank" rel="nofollow" title="Youtube"><i class="fab fa-youtube"></i> </a>';
    }

    $theme_author_markup .= '</div></div>';

    // Pass all this info to post content 
    echo '<div class="author_bio__Wrapper" >' . $theme_author_markup . '</div>';
}



