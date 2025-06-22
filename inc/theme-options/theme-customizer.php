<?php

/*
 * Theme Customize Options
 * @package minerva
 * @since 1.0.0
 * */

if ( !defined('ABSPATH') ){
	exit(); // exit if access directly
}

if (class_exists('CSF') ){
	$prefix = 'minerva';

	CSF::createCustomizeOptions($prefix.'_customize_options');


	/*-------------------------------------
     ** Color Settings
     -------------------------------------*/
    CSF::createSection($prefix . '_customize_options', array(
		'id' => 'theme_settings', // Set a unique slug-like ID
        'title' => esc_html__('Minerva Color Settings', 'minerva') ,
        'priority' => 10,
        'fields' => array(

            array(
                'type' => 'subheading',
                'content' => '<h3>' . esc_html__('Choose Theme Color', 'minerva') . '</h3>',
            ) ,

            array(
                'id' => 'theme_main_color',
                'type' => 'color',
                'title' => esc_html__('Theme Main Color', 'minerva') ,
                'default' => '#000',
            ) ,
			

            array(
                'id' => 'theme_preloader_bg',
                'type' => 'color',
                'title' => esc_html__('Set Preloader Background Color', 'minerva') ,
                'default' => '#fff',
				'output'      => '#preloader',
				'output_mode' => 'background-color'
				
            ) ,
			
			array(
                'id' => 'theme_body_bg',
                'type' => 'color',
                'title' => esc_html__('Body Background Color', 'minerva') ,
                'default' => '#fff',
				'output'      => 'body',
				'output_mode' => 'background-color'
				
            ) ,

            array(
                'id' => 'theme_body_text',
                'type' => 'color',
                'title' => esc_html__('Body Text Color', 'minerva') ,
                'default' => '#4E4E4E',
				'output'      => 'body',
				'output_mode' => 'color'
            ) ,
				

        )

    ));






}//endif