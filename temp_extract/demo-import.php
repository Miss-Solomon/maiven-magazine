<?php 
/*
* @packge Minerva Extra
* @since 1.0.0
 */
function minerva_import() { 
  return array(
  
    array(
      'import_file_name'             => __('Main Demo','minerva-extra'),
      'page_title'                   => __('Import Demo Data','minerva-extra'),
      'local_import_file'            => MINERVA_EXTRA_ROOT_PATH.'/demo/demo-data.xml',
      'local_import_widget_file'     => MINERVA_EXTRA_ROOT_PATH.'/demo/widget.wie',
      'local_import_customizer_file' =>  MINERVA_EXTRA_ROOT_PATH.'/demo/minerva-customizer.dat',
	  'import_preview_image_url'     => 'https://splendidwebz.com/demo-img/minerva.png',
      'import_notice'                => __( 'This import maybe finish on 2-3 minutes', 'minerva-extra' ),
	  'preview_url'                  => 'https://gossip-themes.com/minervawp',

  ),    
  

);
}
add_filter( 'pt-ocdi/import_files', 'minerva_import' );


add_action( 'pt-ocdi/after_import',  'minerva_after_import' );

if(!function_exists( 'minerva_after_import')):
function minerva_after_import($selected_import) {
	
if ( 'Demo' === $selected_import['import_file_name'] ) {

	$main_menu = get_term_by('name', 'Main Nav', 'nav_menu');

    set_theme_mod( 'nav_menu_locations', array(
        'primary' => $main_menu->term_id,
     ) );

	//Set Front page

	$front_page_id = get_page_by_title( 'Home' );
	$blog_page_id  = get_page_by_title( 'Blog' );

	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $front_page_id->ID );
	update_option( 'page_for_posts', $blog_page_id->ID );
	
}}
endif;
