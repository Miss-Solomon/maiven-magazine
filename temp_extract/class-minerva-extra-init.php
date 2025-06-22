<?php
/**
 * @package Minerva
 * @sicne 1.0.0
 * */

if (!class_exists('Minerva_Extra_Init')){

	class Minerva_Extra_Init{

	//instance
	protected static $instance;

	public function __construct() {
		//plugin_assets
		add_action('wp_enqueue_scripts',array($this,'plugin_assets'));
		//plugin admin assets
		add_action('admin_enqueue_scripts',array($this,'plugin_admin_assets'));
		//load plugin dependency files
		self::load_plugin_dependency_files();
	}

	/**
	 * getInstance()
	 * @since 1.0.0
	 * */
	public static function getInstance(){
		if (null == self::$instance){
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * plugin_assets()
	 * @since 1.0.0
	 * */
	public function plugin_assets(){
		self::load_plugin_css();
		self::load_plugin_js();
	}
	/**
	 * plugin_admin_assets()
	 * @since 1.0.0
	 * */
	public function plugin_admin_assets(){
		self::load_plugin_admin_css();
		self::load_plugin_admin_js();
	}

	/**
	 * load plugin css
	 * @since 1.0.0
	 * */
	public function load_plugin_css(){
		
		
		
	}
	/**
	 * load plugin js
	 * @since 1.0.0
	 * */
	public function load_plugin_js(){
		
	
		
	}
	/**
	 * load plugin admin css
	 * @since 1.0.0
	 * */
	public function load_plugin_admin_css(){

	}
	/**
	 * load plugin admin js
	 * @since 1.0.0
	 * */
	public function load_plugin_admin_js(){

	}

	/**
	 * load_plugin_dependency_files()
	 * @since 1.0.0
	 * */
	public function load_plugin_dependency_files(){

		if ( file_exists(MINERVA_EXTRA_LIB.'/codestar-framework/codestar-framework.php') ) {
			require_once  MINERVA_EXTRA_LIB.'/codestar-framework/codestar-framework.php';
		}
		
		// if ( file_exists(MINERVA_EXTRA_ELEMENTOR.'/class-elementor-widgets-init.php') ) {
		// 	require_once  MINERVA_EXTRA_ELEMENTOR.'/class-elementor-widgets-init.php';
		// }
		
		

		if ( file_exists(MINERVA_EXTRA_ELEMENTOR.'/class-elemntor-widgets-alt.php') ) {
			require_once  MINERVA_EXTRA_ELEMENTOR.'/class-elemntor-widgets-alt.php';
		}
		
		if ( file_exists(MINERVA_EXTRA_WIDGETS.'/recent-posts-widget.php') ) {
			require_once  MINERVA_EXTRA_WIDGETS.'/recent-posts-widget.php';
		}
		
		if ( file_exists(MINERVA_EXTRA_WIDGETS.'/category-list-widget-img.php') ) {
			require_once  MINERVA_EXTRA_WIDGETS.'/category-list-widget-img.php';
		}
		
		

	}

	}//end class
}

if ( class_exists('Minerva_Extra_Init')){
	Minerva_Extra_Init::getInstance();
}