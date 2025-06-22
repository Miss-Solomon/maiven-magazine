<?php
/*
 * Theme Options
 * @package Minerva
 * @since 1.0.0
 * */

if ( !defined('ABSPATH') ){
    exit(); // exit if access directly
}

if( class_exists( 'CSF' ) ) {

  //
  // Set a unique slug-like ID
  $prefix = 'minerva';

  //
  // Create options
  CSF::createOptions( $prefix.'_theme_options', array(
    'menu_title' => esc_html__('Theme Option','minerva'),
    'menu_slug'  => 'minerva-theme-option',
    'menu_type' => 'menu',
    'enqueue_webfont'         => true,
    'show_footer' => false,
    'framework_title'      => esc_html__('Minerva Theme Options','minerva'),
  ) );

  //
  // Create a section
  CSF::createSection( $prefix.'_theme_options', array(
    'title'  => esc_html__('General','minerva'),
    'icon'  => 'fa fa-wrench',
    'fields' => array(

		array(
			'type' => 'subheading',
			'content' => '<h3>' . esc_html__('Site Logo', 'minerva') . '</h3>',
		) ,
			
		array(
			'id' => 'theme_logo',
			'title' => esc_html__('Main Logo','minerva'),
			'type' => 'media',
			'library' => 'image',
			'desc' => esc_html__('Upload Your Static Logo Image on Header Static', 'minerva')
		), 
		
		
		array(
			'id' => 'logo_width',
			'type' => 'slider',
			'title' => esc_html__('Set Logo Width','minerva'),
			'min' => 0,
			'max' => 300,
			'step' => 1,
			'unit' => 'px',
			'default' => 102,
			'desc' => esc_html__('Set Logo Width in px. Default Width 184px.', 'minerva') ,
		) ,
		
	  
      array(
        'type' => 'subheading',
        'content' =>'<h3>'.esc_html__('Preloader','minerva').'</h3>'
      ),
	  
	  
      array(
        'id' => 'preloader_enable',
        'title' => esc_html__('Enable Preloader','minerva'),
        'type' => 'switcher',
        'desc' => esc_html__('Enable or Disable Preloader', 'minerva') ,
        'default' => true,
      ),
	  
      array(
        'type' => 'subheading',
        'content' =>'<h3>'.esc_html__('Back Top Options','minerva').'</h3>'
      ),
	  
	  
      array(
        'id' => 'back_top_enable',
        'title' => esc_html__('Scroll Top Button','minerva'),
        'type' => 'switcher',
        'desc' => esc_html__('Enable or Disable scroll button', 'minerva') ,
        'default' => true,
      ),

    )
  ) );

  /*-------------------------------------------------------
     ** Entire Site Header  Options
   --------------------------------------------------------*/
  
    CSF::createSection( $prefix.'_theme_options', array(
    'title'  => esc_html__('Header','minerva'),
    'id' => 'header_options',
    'icon' => 'fa fa-header',
    'fields' => array(
      array(
        'type' => 'subheading',
        'content' =>'<h3>'.esc_html__('Choose Layout','minerva').'</h3>'
      ),
        //
        // nav select
       array(
            'id' => 'nav_menu',
            'type' => 'image_select',
            'title' => esc_html__('Select Header Navigation Style','minerva'),
            'options' => array(
                'nav-style-one' => MINERVA_IMG . '/admin/header-style/style1.png',
                'nav-style-two' => MINERVA_IMG . '/admin/header-style/style2.png',
            ),
			
            'default' => 'nav-style-one'
        ),
	
	         	
		
	array(
        'type' => 'subheading',
        'content' =>'<h3>'.esc_html__('Header Options','minerva').'</h3>'
    ),
	  
		  array(
			'id' => 'search_bar_enable',
			'title' => esc_html__('Search Bar Display','minerva'),
			'type' => 'switcher',
			'desc' => esc_html__('Enable or Disable Search Bar', 'minerva') ,
			'default' => true,
		  ),
	  
		  array(
			'id' => 'subscribe_btn_enable',
			'title' => esc_html__('Show Subscribe Button','minerva'),
			'type' => 'switcher',
			'desc' => esc_html__('Enable or Disable Subscribe Button', 'minerva') ,
			'default' => true,
		  ),
	  
		array(
			'id'         => 'subscribe_btn_text',
			'type'       => 'text',
			'title'      => esc_html__('Subscribe Button Text', 'minerva') ,
			'default'    => esc_html__('Subscribe', 'minerva') ,
			'desc'       => esc_html__('Type Subscribe Button Text', 'minerva') ,
			'dependency' => array( 'subscribe_btn_enable', '==', 'true' ),
		),
	
		array(
			'id'         => 'subscribe_btn_link',
			'type'       => 'text',
			'title'      => esc_html__('Subscribe Button Link', 'minerva') ,
			'default'    => esc_html__('#', 'minerva') ,
			'desc'       => esc_html__('Type Subscribe Button Link', 'minerva') ,
			'dependency' => array( 'subscribe_btn_enable', '==', 'true' ),
		),
		
		array(
			'id' => 'header_panel_nav',
			'title' => esc_html__('Header Panel Menu','minerva'),
			'type' => 'switcher',
			'desc' => esc_html__('You can show/hide header panel menu bar','minerva'),
			'default' => false,
		),

	  

    )
  ));
  
   
    /*-------------------------------------
     ** Typography Options
     -------------------------------------*/
    CSF::createSection($prefix . '_theme_options', array(
        'title' => esc_html__('Typography', 'minerva') ,
		'id' => 'typography_options',
		'icon' => 'fa fa-font',
        'fields' => array(

            array(
                'type' => 'subheading',
                'content' => '<h3>' . esc_html__('Body Font', 'minerva') . '</h3>'
            ) ,

            array(
                'id' => 'body-typography',
                'type' => 'typography',
                'output' => 'body',
                'default' => array(
					'color' => '#000',
                    'font-family' => 'Red Hat Display',
                    'font-weight' => '400',
                    'font-size' => '17',
                    'line-height' => '24',
					'letter-spacing' => false,
                    'subset' => 'latin-ext',
                    'type' => 'google',
                    'unit' => 'px',
                ) ,

            ) ,

            array(
                'type' => 'subheading',
                'content' => '<h3>' . esc_html__('Heading Font', 'minerva') . '</h3>'
            ) ,

            array(
                'id' => 'heading-typo',
                'type' => 'typography',
                'output' => 'h1,h2,h3,h4,h5,h6',
                'default' => array(
                    'color' => '#000000',
                    'font-family' => 'Red Hat Display',
                    //'font-weight' => '600',
                    'subset' => 'latin-ext',
                    'type' => 'google',
                ) ,
                'extra-styles' => array(
                    '300',
                    '400',
					'600',
                    '700',
					'800',
                    '900'
                ) ,
            ) ,


        )
    ));

  /*-------------------------------------------------------
     ** Pages and Template
   --------------------------------------------------------*/

   // blog optoins
    CSF::createSection( $prefix.'_theme_options', array(
    'title'  => esc_html__('Blog','minerva'),
    'id' => 'blog_page',
    'icon' => 'fa fa-bookmark',
    'fields' => array(
      array(
        'type' => 'subheading',
        'content' =>'<h3>'.esc_html__('Blog Options','minerva').'</h3>'
      ),
	  
	  	array(
			'id'         => 'blog_title',
			'type'       => 'text',
			'title'      => esc_html__('Blog Page Title','minerva'),
			'default'    => esc_html__('Blog Page','minerva'),
			'desc'       => esc_html__('Type Blog Page Title','minerva'),
		),
		
		array(
			'id' => 'page-spacing-blog',
			'type' => 'spacing',
			'title' => esc_html__('Blog Page Spacing','minerva'),
			'output' => '.main-container.blog-spacing',
			'output_mode' => 'padding', // or margin, relative
			'default' => array(
				'top' => '80',
				'right' => '0',
				'bottom' => '80',
				'left' => '0',
				'unit' => 'px',
			) ,
		) ,
		
		array(
			'id' => 'blog_breadcrumb_enable',
			'title' => esc_html__('Breadcrumb', 'minerva') ,
			'type' => 'switcher',
			'desc' => esc_html__('Enable Breadcrumb', 'minerva') ,
			'default' => true,
		) ,
			
		

	 
    )
  ));
  
  
    // category 
	
  CSF::createSection( $prefix.'_theme_options', array(
    'title'  => esc_html__('Category','minerva'),
    'id' => 'cat_page',
    'icon' => 'fa fa-list-ul',
    'fields' => array(
      array(
        'type' => 'subheading',
        'content' => '<h3>' . esc_html__('Theme Category Options. You can Customize Each Catgeory by Editing Individually.', 'minerva') . '</h3>'
      ),
       array(
			'id' => 'minerva_cat_layout',
            'type' => 'image_select',
            'title' => esc_html__('Select Category Layout','minerva'),
            'options' => array(
                'catt-one' => MINERVA_IMG . '/admin/page/style1.png',
                'catt-two' => MINERVA_IMG . '/admin/page/style2.png',
            ),
            'default' => 'catt-one'
        ),
		
		array(
			'id' => 'page-spacing-category',
			'type' => 'spacing',
			'title' => esc_html__('Category Page Spacing','minerva'),
			'output' => '.main-container.cat-page-spacing',
			'output_mode' => 'padding', // or margin, relative
			'default' => array(
				'top' => '80',
				'right' => '0',
				'bottom' => '80',
				'left' => '0',
				'unit' => 'px',
			) ,
		) ,


    )
  ));
  
  

  // blog single optoins
    CSF::createSection( $prefix.'_theme_options', array(
    'title'  => esc_html__('Single','minerva'),
    'id' => 'single_page',
    'icon' => 'fa fa-pencil-square-o',
    'fields' => array(
      array(
        'type' => 'subheading',
        'content' =>'<h3>'.esc_html__('Blog Single Page Option','minerva').'</h3>'
      ),
	  
       array(
            'id' => 'minerva_single_blog_layout',
            'type' => 'image_select',
            'title' => esc_html__('Select Single Blog Style','minerva'),
            'options' => array(
                'single-one' => MINERVA_IMG . '/admin/page/blog-1.png',
                'single-two' => MINERVA_IMG . '/admin/page/blog-2.png',
            ),
            'default' => 'single-one'
        ),
		
		array(
			'id' => 'page-spacing-single',
			'type' => 'spacing',
			'title' => esc_html__('Single Blog Spacing','minerva'),
			'output' => '.single-one-bwrap',
			'output_mode' => 'padding', // or margin, relative
			'default' => array(
				'top' => '40',
				'right' => '0',
				'bottom' => '80',
				'left' => '0',
				'unit' => 'px',
			) ,
		) ,
		
		array(
			'id'         => 'blog_prev_title',
			'type'       => 'text',
			'title'      => esc_html__('Previous Post Text','minerva'),
			'default'    => esc_html__('Previous Post','minerva'),
			'desc'       => esc_html__('Type Previous Post Link Title','minerva'),
		),
		
		array(
			'id'         => 'blog_next_title',
			'type'       => 'text',
			'title'      => esc_html__('Next Post Text','minerva'),
			'default'    => esc_html__('Next Post','minerva'),
			'desc'       => esc_html__('Type Next Post Link Title','minerva'),
		),
			
		array(
			'id' => 'blog_single_cat',
			'title' => esc_html__('Show Catgeory','minerva'),
			'type' => 'switcher',
			'desc' => esc_html__('Show Category Name','minerva'),
			'default' => true,
		),
		
		array(
			'id' => 'blog_single_author',
			'title' => esc_html__('Show Author','minerva'),
			'type' => 'switcher',
			'desc' => esc_html__('Single Post Author','minerva'),
			'default' => true,
		),

		array(
			'id' => 'blog_nav',
			'title' => esc_html__('Show Navigation','minerva'),
			'type' => 'switcher',
			'desc' => esc_html__('Post Navigation','minerva'),
			'default' => true,
		),
		
		array(
			'id' => 'blog_tags',
			'title' => esc_html__('Show Tags','minerva'),
			'type' => 'switcher',
			'desc' => esc_html__('Show Post Tags','minerva'),
			'default' => true,
		),
		
		array(
			'id' => 'blog_related',
			'title' => esc_html__('Show Related Posts','minerva'),
			'type' => 'switcher',
			'desc' => esc_html__('Related Posts','minerva'),
			'default' => true,
		),
		
		array(
			'id' => 'blog_views',
			'title' => esc_html__('Show Post Views','minerva'),
			'type' => 'switcher',
			'desc' => esc_html__('Post views','minerva'),
			'default' => false,
		),

		array(
			'id' => 'blog_social',
			'title' => esc_html__('Show Social Share Box','minerva'),
			'type' => 'switcher',
			'desc' => esc_html__('Social Share Box','minerva'),
			'default' => false,
		),

		
    )
  ));
    

/*-------------------------------------------------------
   ** Woocommerce  Options
--------------------------------------------------------*/
    
  CSF::createSection( $prefix.'_theme_options', array(
    'title'  => esc_html__('Shop','minerva'),
    'id' => 'cat_page',
    'icon' => 'fa fa-pencil-square-o',
    'fields' => array(
      array(
        'type' => 'subheading',
        'content' => '<h3>' . esc_html__('Shop Layout', 'minerva') . '</h3>'
      ),
      
      
        array(
            'id' => 'shop_layout',
            'type' => 'image_select',
            'title' => esc_html__('Shop Layout','minerva'),
            'options' => array(
             
                'right-sidebar' => MINERVA_IMG . '/admin/header-style/R.png',
                'left-sidebar' => MINERVA_IMG . '/admin/header-style/L.png',
                'no-sidebar' => MINERVA_IMG . '/admin/header-style/D.png',
            ),
            
            'default' => 'right-sidebar'
        ),


        )
    ));

  /*-------------------------------------------------------
       ** Footer  Options
  --------------------------------------------------------*/
  CSF::createSection( $prefix.'_theme_options', array(
    'title'  => esc_html__('Footer','minerva'),
    'id' => 'footer_options',
    'icon' => 'fa fa-copyright',
    'fields' => array(
      array(
        'type' => 'subheading',
        'content' =>'<h3>'.esc_html__('Footer Options','minerva').'</h3>'
      ),
	  
	array(
        'id' => 'footer_nav',
        'title' => esc_html__('Footer Right Menu','minerva'),
        'type' => 'switcher',
		'desc' => esc_html__('You can set Yes or No to show Footer menu','minerva'),
        'default' => false,
      ),
	  
	  
	  
	array(
		'id' => 'footer_social_enable',
		'title' => esc_html__('Do You want to Show Footer Social Icons', 'minerva') ,
		'type' => 'switcher',
		'desc' => esc_html__('Enable or Disable Social Bar', 'minerva') ,
		'default' => false,
	) ,

	array(
		'id' => 'fsocial-icon',
		'type' => 'repeater',
		'title' => esc_html__('Repeater', 'minerva') ,
		'dependency' => array(
			'footer_social_enable',
			'==',
			'true'
		) ,
		'fields' => array(
			array(
				'id' => 'icon',
				'type' => 'icon',
				'title' => esc_html__('Pick Up Your Social Icon', 'minerva') ,
			) ,
			array(
				'id' => 'link',
				'type' => 'text',
				'title' => esc_html__('Inter Social Url', 'minerva') ,
			) ,

		) ,
	) , 
	  
	  
	  
      array(
        'type' => 'subheading',
        'content' =>'<h3>'.esc_html__('Footer Copyright Area Options','minerva').'</h3>'
      ),

      array(
        'id' => 'copyright_text',
        'title' => esc_html__('Copyright Area Text','minerva'),
        'type' => 'textarea',
        'desc' => esc_html__('Footer Copyright Text','minerva'),
      ),


	  
    )
  ));


  // Backup section
  CSF::createSection( $prefix.'_theme_options', array(
    'title'  => esc_html__('Backup','minerva'),
    'id'    => 'backup_options',
    'icon'  => 'fa fa-window-restore',
    'fields' => array(
        array(
            'type' => 'backup',
        ),   
    )
  ) );
  

}