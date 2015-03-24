<?php

// Load necessary files with additional elements
require get_template_directory() . '/customizer/sanitization.php';
require get_template_directory() . '/customizer/context.php';
require get_template_directory() . '/customizer/front-end-css.php';
require get_template_directory() . '/customizer/front-end-js.php';
	
/* Add additional options to Theme Customizer */
function portfolio_init_customizer( $wp_customize ) {		
	// Add new settings sections
    $wp_customize->add_section(
    'portfolio_font_options',
    array(
        'title'     => __('Font options', 'portfolio'),
        'priority'  => 200
    	)
    );
    
    $wp_customize->add_section(
    'portfolio_layout_options',
    array(
        'title'     => __('Layout & Features', 'portfolio'),
        'priority'  => 300
    	)
    );
    
    $wp_customize->add_section(
    'portfolio_post_options',
    array(
        'title'     => __('Post display', 'portfolio'),
        'priority'  => 400,
        'active_callback' => 'portfolio_is_singular'
    	)
    );
    
    // Add new settings
    $wp_customize->add_setting(
    	'portfolio_logo',
    	array(
    		'default' => '',
    		'capability' => 'edit_theme_options',
    		'sanitize_callback' => 'esc_url_raw'
    	)
    );
    
    $wp_customize->add_setting( 
    	'portfolio_primary_color', 
    	array( 
    		'default' => '#5cc1a9', 
    		'capability' => 'edit_theme_options',
    		'transport' => 'postMessage',
    		'sanitize_callback' => 'sanitize_hex_color'
    	)
    );
    
	$wp_customize->add_setting(
		'portfolio_font',
		array(
		    'default'   => 'google',
		    'capability' => 'edit_theme_options',
		    'sanitize_callback' => 'portfolio_sanitize_font'
		)
	);
	
	$wp_customize->add_setting(
	    'portfolio_google_font',
	    array(
	        'default'   => 'http://fonts.googleapis.com/css?family=Open+Sans:700',
	        'capability' => 'edit_theme_options',
	        'sanitize_callback' => 'esc_url_raw'
	    )
	);
	
	$wp_customize->add_setting(
		'portfolio_body_font',
		array(
	    	'default'   => 'google',
	    	'capability' => 'edit_theme_options',
	    	'sanitize_callback' => 'portfolio_sanitize_font'
		)
	);
		
	$wp_customize->add_setting(
	    'portfolio_body_google_font',
	    array(
	        'default'   => 'http://fonts.googleapis.com/css?family=Open+Sans:400',
	        'capability' => 'edit_theme_options',
	        'sanitize_callback' => 'esc_url_raw'
	    )
	);
	
	$wp_customize->add_setting(
		'portfolio_article_column',
		array( 
			'default'   => '4',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'portfolio_sanitize_article_column'
		)
	);
	
	$wp_customize->add_setting(
		'portfolio_date_format',
		array( 
			'default'   => 'default',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'portfolio_sanitize_date_format'
		)
	);
	
	$wp_customize->add_setting(
	    'portfolio_content_width',
	    array(
	        'default'   => '700',
	        'capability' => 'edit_theme_options',
	        'sanitize_callback' => 'portfolio_intval'
	    )
	);
	
	$wp_customize->add_setting(
	    'portfolio_word_break',
	    array(
	        'default'   => '0',
	        'capability' => 'edit_theme_options',
	        'sanitize_callback' => 'portfolio_sanitize_checkbox'
	    )
	);
	
	$wp_customize->add_setting(
	    'portfolio_full_width_images',
	    array(
	        'default'   => '1',
	        'capability' => 'edit_theme_options',
	        'sanitize_callback' => 'portfolio_sanitize_checkbox'
	    )
	);
	
	$wp_customize->add_setting(
	    'portfolio_post_show_featured_image',
	    array(
	        'default'   => '1',
	        'capability' => 'edit_theme_options',
	        'sanitize_callback' => 'portfolio_sanitize_checkbox'
	    )
	);
	
	$wp_customize->add_setting(
	    'portfolio_post_show_title',
	    array(
	        'default'   => '1',
	        'capability' => 'edit_theme_options',
	        'sanitize_callback' => 'portfolio_sanitize_checkbox'
	    )
	);
	
	$wp_customize->add_setting(
	    'portfolio_post_show_date',
	    array(
	        'default'   => '1',
	        'capability' => 'edit_theme_options',
	        'sanitize_callback' => 'portfolio_sanitize_checkbox'
	    )
	);
	
	$wp_customize->add_setting(
	    'portfolio_post_show_category',
	    array(
	        'default'   => '1',
	        'capability' => 'edit_theme_options',
	        'sanitize_callback' => 'portfolio_sanitize_checkbox'
	    )
	);
	
	$wp_customize->add_setting(
	    'portfolio_post_show_social',
	    array(
	        'default'   => '1',
	        'capability' => 'edit_theme_options',
	        'sanitize_callback' => 'portfolio_sanitize_checkbox'
	    )
	);
	
	$wp_customize->add_setting(
	    'portfolio_post_show_tags',
	    array(
	        'default'   => '1',
	        'capability' => 'edit_theme_options',
	        'sanitize_callback' => 'portfolio_sanitize_checkbox'
	    )
	);
	
	$wp_customize->add_setting(
	    'portfolio_post_show_author',
	    array(
	        'default'   => '1',
	        'capability' => 'edit_theme_options',
	        'sanitize_callback' => 'portfolio_sanitize_checkbox'
	    )
	);
	
	$wp_customize->add_setting(
	    'portfolio_frontpage_animation',
	    array(
	        'default'   => '1',
	        'capability' => 'edit_theme_options',
	        'sanitize_callback' => 'portfolio_sanitize_checkbox'
	    )
	);
	
	// Add control for the settings
	$wp_customize->add_control(
		new WP_Customize_Image_Control( 
			$wp_customize, 
			'portfolio_logo', 
			array(
				'label'      => __('Logo image', 'portfolio'),
				'section'    => 'title_tagline',
				'settings'   => 'portfolio_logo'
			) 
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 
			'portfolio_primary_color', 
			array( 
				'label' => __('Primary Color', 'portfolio'), 
				'section' => 'colors', 
				'settings' => 'portfolio_primary_color'
			)
		)
	);		
	
	$wp_customize->add_control(
	    'portfolio_font',
	    array(
	        'section'  => 'portfolio_font_options',
	        'label'    => __('Header Font', 'portfolio'),
	        'type'     => 'select',
	        'choices'  => array(
	        	'google'    		=> 'Google Font',
	        	'verdana'   		=> 'Verdana',
	        	'georgia'    		=> 'Georgia',
	        	'arial'      		=> 'Arial',
	        	'impact'     		=> 'Impact',
	        	'tahoma'     		=> 'Tahoma',
	            'times'      		=> 'Times New Roman',		            
	            'comic sans ms'     => 'Comic Sans MS',
	            'courier new'   	=> 'Courier New',
	            'helvetica'  		=> 'Helvetica'
	        )
	   	 )
	);

	$wp_customize->add_control(
	    'portfolio_google_font',
	    array(
	        'section'  => 'portfolio_font_options',
	        'label'    => __('Google Font URL for Header', 'portfolio'),
	        'type'     => 'text',
	        'active_callback' => 'portfolio_font_url_field'
    	)
	);
		
	$wp_customize->add_control(
	    'portfolio_body_font',
	    array(
	        'section'  => 'portfolio_font_options',
	        'label'    => __('Body Font', 'portfolio'),
	        'type'     => 'select',
	        'choices'  => array(
	        	'google'    		=> 'Google Font',
	        	'verdana'   		=> 'Verdana',
	        	'georgia'    		=> 'Georgia',
	        	'arial'      		=> 'Arial',
	        	'impact'     		=> 'Impact',
	        	'tahoma'     		=> 'Tahoma',
	            'times'      		=> 'Times New Roman',		            
	            'comic sans ms'     => 'Comic Sans MS',
	            'courier new'   	=> 'Courier New',
	            'helvetica'  		=> 'Helvetica'
	        )
	   	 )
	);	
	
	$wp_customize->add_control(
	    'portfolio_body_google_font',
	    array(
	        'section'  => 'portfolio_font_options',
	        'label'    => __('Google Font URL for the Body', 'portfolio'),
	        'type'     => 'text',
	        'active_callback' => 'portfolio_body_font_url_field'
    	)
	);
	
	$wp_customize->add_control(
	    'portfolio_article_column',
	    array(
	        'section'  => 'portfolio_layout_options',
	        'label'    => __('Amount of article columns', 'portfolio'),
	        'type'     => 'select',
	        'choices'  => array(
	            '4'     => __('4 Column', 'portfolio'),
	            '3'     => __('3 Columns', 'portfolio'),
	            '2'     => __('2 Columns', 'portfolio')
	        )
	    )
	);
	
	$wp_customize->add_control(
	    'portfolio_date_format',
	    array(
	        'section'  => 'portfolio_layout_options',
	        'label'    => __('Date format', 'portfolio'),
	        'type'     => 'select',
	        'choices'  => array(
	            'default'     => __('Default theme format', 'portfolio'),
	            'wordpress'     => __('WordPress Date Format', 'portfolio')
	        )
	    )
	);
	
	$wp_customize->add_control(
	    'portfolio_content_width',
	    array(
	        'section'  => 'portfolio_layout_options',
	        'label'    => __('Content width', 'portfolio'),
	        'type'     => 'text'
	    )
	);
	
	$wp_customize->add_control(
        'portfolio_word_break',
        array(
            'section'  => 'portfolio_layout_options',
            'label'    => __('Enable word-break', 'portfolio'),
            'type'     => 'checkbox'
        )
    );
    
    $wp_customize->add_control(
        'portfolio_full_width_images',
        array(
            'section'  => 'portfolio_layout_options',
            'label'    => __('Full-width images', 'portfolio'),
            'type'     => 'checkbox'
        )
    );
    
    $wp_customize->add_control(
        'portfolio_frontpage_animation',
        array(
            'section'  => 'portfolio_layout_options',
            'label'    => __('Frontpage items animation', 'portfolio'),
            'type'     => 'checkbox'
        )
    );
    
    $wp_customize->add_control(
        'portfolio_post_show_featured_image',
        array(
            'section'  => 'portfolio_post_options',
            'label'    => __('Show featured image', 'portfolio'),
            'type'     => 'checkbox'
        )
    );
    
    $wp_customize->add_control(
        'portfolio_post_show_title',
        array(
            'section'  => 'portfolio_post_options',
            'label'    => __('Show title', 'portfolio'),
            'type'     => 'checkbox'
        )
    );
    
    $wp_customize->add_control(
        'portfolio_post_show_date',
        array(
            'section'  => 'portfolio_post_options',
            'label'    => __('Show date', 'portfolio'),
            'type'     => 'checkbox'
        )
    );
    
    $wp_customize->add_control(
        'portfolio_post_show_category',
        array(
            'section'  => 'portfolio_post_options',
            'label'    => __('Show category', 'portfolio'),
            'type'     => 'checkbox'
        )
    );
    
    $wp_customize->add_control(
        'portfolio_post_show_tags',
        array(
            'section'  => 'portfolio_post_options',
            'label'    => __('Show tags', 'portfolio'),
            'type'     => 'checkbox'
        )
    );
    
    $wp_customize->add_control(
        'portfolio_post_show_social',
        array(
            'section'  => 'portfolio_post_options',
            'label'    => __('Show social icons', 'portfolio'),
            'type'     => 'checkbox'
        )
    );
    
    $wp_customize->add_control(
        'portfolio_post_show_author',
        array(
            'section'  => 'portfolio_post_options',
            'label'    => __('Show author', 'portfolio'),
            'type'     => 'checkbox'
        )
    );
}

add_action( 'customize_register', 'portfolio_init_customizer' );

// EOF