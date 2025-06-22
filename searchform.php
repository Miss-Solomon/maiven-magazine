<?php
/**
 * The template for displaying search form
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package minerva
 */
 
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <input type="text" class="search-field" placeholder="<?php esc_attr_e( 'Search here...', 'minerva' ); ?>" value="<?php echo get_search_query(); ?>" name="s" required>
    <button type="submit" class="search-submit">
        <i class="fa fa-search"></i>
    </button>
</form>
