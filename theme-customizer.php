<?php

global $wp_customize;

// Load necessary files with additional elements
require get_template_directory() . '/customizer/sanitization.php';
require get_template_directory() . '/customizer/context.php';
require get_template_directory() . '/customizer/front-end-css.php';
require get_template_directory() . '/customizer/front-end-js.php';

if(isset($wp_customize)) {
	require get_template_directory() . '/customizer/custom-controls/category-selection/category-selection.php';
}
	
/* Add additional options to Theme Customizer */
function portfolio_init_customizer( $wp_customize ) {		
	// Modify existing controls and settings
	$wp_customize->get_setting('background_color')->transport = 'postMessage';
	$wp_customize->get_setting('blogname')->transport = 'postMessage';
	$wp_customize->get_setting('blogdescription')->transport = 'postMessage';
	
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
        'portfolio_effects_options',
        array(
            'title'     => __('Effects', 'portfolio'),
            'priority'  => 350
    	)
    );
    
    $wp_customize->add_section(
    	'portfolio_post_options',
	    array(
	        'title'     => __('Post display', 'portfolio'),
	        'priority'  => 400
    	)
    );

    $wp_customize->add_section(
   		'portfolio_advanced',
    	array(
    	    'title'     => __('Advanced settings', 'portfolio'),
			'description' => __('If you change the portfolio image dimensions please remember to regenerate all thumbnails i.e. using the Regenerate Thumbnails plugin.', 'portfolio'),
        	'priority'  => 500
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
    	'portfolio_logo_autosize',
    	array(
    		'default' => '0',
    		'capability' => 'edit_theme_options',
    		'sanitize_callback' => 'portfolio_sanitize_checkbox'
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
		'posts_per_page',
		array(
			'default' => '10',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'portfolio_intval',
			'type' => 'option'
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
	    'portfolio_portfolio_width',
	    array(
	        'default'   => '1260',
	        'capability' => 'edit_theme_options',
	        'sanitize_callback' => 'portfolio_intval'
	    )
	);
	
	$wp_customize->add_setting(
	    'portfolio_word_break',
	    array(
	        'default'   => '',
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
	
	$wp_customize->add_setting(
	    'portfolio_show_excerpts',
	    array(
	        'default'   => '1',
	        'capability' => 'edit_theme_options',
	        'sanitize_callback' => 'portfolio_sanitize_checkbox'
	    )
	);
	
	$wp_customize->add_setting(
	    'portfolio_show_tags',
	    array(
	        'default'   => '1',
	        'capability' => 'edit_theme_options',
	        'sanitize_callback' => 'portfolio_sanitize_checkbox'
	    )
	);
	
	$wp_customize->add_setting(
	    'portfolio_whole_overlay_clickable',
	    array(
	        'default'   => '0',
	        'capability' => 'edit_theme_options',
	        'sanitize_callback' => 'portfolio_sanitize_checkbox'
	    )
	);

	$wp_customize->add_setting(
	    'portfolio_special_img_size',
	    array(
	        'default'   => '1',
	        'capability' => 'edit_theme_options',
	        'sanitize_callback' => 'portfolio_intval'
	    )
	);

	$wp_customize->add_setting(
	    'portfolio_img_w',
	    array(
	        'default'   => '300',
	        'capability' => 'edit_theme_options',
	        'sanitize_callback' => 'portfolio_intval',
	        'transport' => 'postMessage'
	    )
	);

	$wp_customize->add_setting(
	    'portfolio_img_h',
	    array(
	        'default'   => '400',
	        'capability' => 'edit_theme_options',
	        'sanitize_callback' => 'portfolio_intval',
	        'transport' => 'postMessage'
	    )
	);
	
	$wp_customize->add_setting(
	    'portfolio_img_hard_crop',
	    array(
	        'default'   => '1',
	        'capability' => 'edit_theme_options',
	        'sanitize_callback' => 'portfolio_intval',
	        'transport' => 'postMessage'
	    )
	);
	
	$wp_customize->add_setting(
	    'portfolio_block_h',
	    array(
	        'default'   => '380',
	        'capability' => 'edit_theme_options',
	        'sanitize_callback' => 'portfolio_intval'
	    )
	);
	
	$wp_customize->add_setting(
	    'portfolio_block_h_mobile',
	    array(
	        'default'   => '320',
	        'capability' => 'edit_theme_options',
	        'sanitize_callback' => 'portfolio_intval'
	    )
	);
	
	$wp_customize->add_setting(
	    'portfolio_block_padding',
	    array(
	        'default'   => '56px 36px 36px 36px',
	        'capability' => 'edit_theme_options',
	        'sanitize_callback' => 'sanitize_text_field'
	    )
	);
	
	$wp_customize->add_setting(
	    'portfolio_block_padding_mobile',
	    array(
	        'default'   => '20px 16px 36px 16px',
	        'capability' => 'edit_theme_options',
	        'sanitize_callback' => 'sanitize_text_field'
	    )
	);
	
	$wp_customize->add_setting(
	    'portfolio_excerpt_length',
	    array(
	        'default'   => '16',
	        'capability' => 'edit_theme_options',
	        'sanitize_callback' => 'portfolio_intval'
	    )
	);
	
	$wp_customize->add_setting(
	    'portfolio_item_hover',
	    array(
	        'default'   => '',
	        'capability' => 'edit_theme_options',
	        'sanitize_callback' => 'portfolio_intval'
	    )
	);
	
	$wp_customize->add_setting(
	    'portfolio_frontpage_animation_type',
	    array(
	        'default'   => '1',
	        'capability' => 'edit_theme_options',
	        'sanitize_callback' => 'portfolio_intval'
	    )
	);
	
	$wp_customize->add_setting(
	    'portfolio_frontpage_animation_speed',
	    array(
	        'default'   => '500',
	        'capability' => 'edit_theme_options',
	        'sanitize_callback' => 'portfolio_intval'
	    )
	);
	
	$wp_customize->add_setting(
	    'portfolio_post_preview_animation',
	    array(
	        'default'   => 'animation-slide-up',
	        'capability' => 'edit_theme_options',
	        'sanitize_callback' => 'portfolio_post_preview_animation_type'
	    )
	);
	
	$wp_customize->add_setting(
	    'portfolio_show_post_navigation',
	    array(
	        'default'   => '1',
	        'capability' => 'edit_theme_options',
	        'sanitize_callback' => 'portfolio_intval'
	    )
	);
	
	$wp_customize->add_setting(
	    'portfolio_show_post_navigation_same_taxonomy',
	    array(
	        'default'   => '0',
	        'capability' => 'edit_theme_options',
	        'sanitize_callback' => 'portfolio_intval'
	    )
	);
	
	$wp_customize->add_setting(
	    'portfolio_filter_categories',
	    array(
	        'default'   => '',
	        'capability' => 'edit_theme_options',
	        'sanitize_callback' => 'portfolio_intval'
	    )
	);
	
	$wp_customize->add_setting(
	    'portfolio_meta_type',
	    array(
	        'default'   => 'tags',
	        'capability' => 'edit_theme_options',
	        'sanitize_callback' => 'portfolio_meta_types'
	    )
	);
	
	$wp_customize->add_setting(
		'portfolio_filtered_categories', 
		array(
	   		'default' => '',
	   		'capability' => 'edit_theme_options',
	        'sanitize_callback' => 'portfolio_validate_category_selection'
	    )
	);
	
	$wp_customize->add_setting(
	    'portfolio_show_topbar_search',
	    array(
	        'default'   => '',
	        'capability' => 'edit_theme_options',
	        'sanitize_callback' => 'portfolio_intval'
	    )
	);
	
	$wp_customize->add_setting(
	    'portfolio_show_topbar_social',
	    array(
	        'default'   => '',
	        'capability' => 'edit_theme_options',
	        'sanitize_callback' => 'portfolio_intval'
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
	    'portfolio_logo_autosize',
	    array(
	        'label'    => __('Adjust header size to the logo image', 'portfolio'),
	        'section'    => 'title_tagline',
	        'type'     => 'checkbox',
	        'active_callback' => 'portfolio_logo_config'
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
	    'posts_per_page',
	    array(
	        'section'  => 'portfolio_layout_options',
	        'label'    => __('Posts per page', 'portfolio'),
	        'type'     => 'text'
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
	    'portfolio_portfolio_width',
	    array(
	        'section'  => 'portfolio_layout_options',
	        'label'    => __('Portfolio view width', 'portfolio'),
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
        'portfolio_show_excerpts',
        array(
            'section'  => 'portfolio_layout_options',
            'label'    => __('Show excerpts on portfolio', 'portfolio'),
            'type'     => 'checkbox'
        )
    );

	$wp_customize->add_control(
	    'portfolio_show_tags',
	    array(
	        'section'  => 'portfolio_layout_options',
	        'label'    => __('Show post information on portfolio', 'portfolio'),
	        'type'     => 'checkbox'
	    )
	);
	
	$wp_customize->add_control(
	    'portfolio_whole_overlay_clickable',
	    array(
	        'section'  => 'portfolio_layout_options',
	        'label'    => __('Whole overlay clickable in portfolio', 'portfolio'),
	        'type'     => 'checkbox'
	    )
	);
	
	$wp_customize->add_control(
	    'portfolio_show_topbar_search',
	    array(
	        'section'  => 'portfolio_layout_options',
	        'label'    => __('Show search at top bar', 'portfolio'),
	        'type'     => 'checkbox'
	    )
	);
	
	$wp_customize->add_control(
	    'portfolio_show_topbar_social',
	    array(
	        'section'  => 'portfolio_layout_options',
	        'label'    => __('Show social icons at top bar', 'portfolio'),
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
        'portfolio_show_post_navigation',
        array(
            'section'  => 'portfolio_post_options',
            'label'    => __('Show post navigation', 'portfolio'),
            'type'     => 'checkbox'
        )
    );
    
    $wp_customize->add_control(
        'portfolio_show_post_navigation_same_taxonomy',
        array(
            'section'  => 'portfolio_post_options',
            'label'    => __('Navigate between posts in the same category', 'portfolio'),
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
    
    $wp_customize->add_control(
        'portfolio_special_img_size',
        array(
            'section'  => 'portfolio_advanced',
            'label'    => __('Use dedicated portfolio image size', 'portfolio'),
            'type'     => 'checkbox'
        )
    );

    $wp_customize->add_control(
        'portfolio_img_w',
        array(
            'section'  => 'portfolio_advanced',
            'label'    => __('Portfolio image width (px)', 'portfolio'),
            'type'     => 'text',
            'active_callback' => 'portfolio_img_size_active'
        )
    );

    $wp_customize->add_control(
        'portfolio_img_h',
        array(
            'section'  => 'portfolio_advanced',
            'label'    => __('Portfolio image height (px)', 'portfolio'),
            'type'     => 'text',
            'active_callback' => 'portfolio_img_size_active'
        )
    );
    
    $wp_customize->add_control(
        'portfolio_img_hard_crop',
        array(
            'section'  => 'portfolio_advanced',
            'label'    => __('Use hard crop mode', 'portfolio'),
            'type'     => 'checkbox',
            'active_callback' => 'portfolio_img_size_active'
        )
    );
    
    $wp_customize->add_control(
        'portfolio_frontpage_animation',
        array(
            'section'  => 'portfolio_effects_options',
            'label'    => __('Frontpage items animation', 'portfolio'),
            'type'     => 'checkbox'
        )
    );
    
    $wp_customize->add_control(
        'portfolio_item_hover',
        array(
            'section'  => 'portfolio_effects_options',
            'label'    => __('Hover effect in portfolio', 'portfolio'),
            'type'     => 'checkbox'
        )
    );
    
    $wp_customize->add_control(
        'portfolio_frontpage_animation_type',
        array(
            'section'  => 'portfolio_effects_options',
            'label'    => __('Animation type', 'portfolio'),
            'type'     => 'select',
            'choices'  => array(
            	'1' => __('Default (flip)', 'portfolio'),
            	'2' => __('Center flip', 'portfolio'),
            	'3' => __('Scale bottom', 'portfolio'),
            	'4' => __('Scale center', 'portfolio'),
            	'5' => __('Scale top', 'portfolio'),
            	'6' => __('Opacity', 'portfolio')
            ),
            'active_callback' => 'portfolio_active_animations'
       	 )
    );
    
    $wp_customize->add_control(
        'portfolio_frontpage_animation_speed',
        array(
            'section'  => 'portfolio_effects_options',
            'label'    => __('Animation speed', 'portfolio'),
            'type'     => 'select',
            'choices'  => array(
            	'250' => __('Fast animation', 'portfolio'),
            	'500' => __('Normal animation', 'portfolio'),
            	'750' => __('Slow animation', 'portfolio'),
            ),
            'active_callback' => 'portfolio_active_animations'
       	 )
    );
    
    $wp_customize->add_control(
        'portfolio_post_preview_animation',
        array(
            'section'  => 'portfolio_effects_options',
            'label'    => __('Post preview animation type', 'portfolio'),
            'type'     => 'select',
            'choices'  => array(
            	'animation-slide-up' => __('Slide up', 'portfolio'),
            	'animation-slide-down' => __('Slide down', 'portfolio'),
            	'animation-slide-left' => __('Slide left', 'portfolio'),
            	'animation-slide-right' => __('Slide right', 'portfolio'),
            	'animation-opacity' => __('Opacity', 'portfolio'),
            	'animation-scale' => __('Scale', 'portfolio')
            )
       	 )
    );
    
    $wp_customize->add_control(
        'portfolio_block_h',
        array(
            'section'  => 'portfolio_advanced',
            'label'    => __('Portfolio block height (px)', 'portfolio'),
            'type'     => 'text'
        )
    );
    
    $wp_customize->add_control(
        'portfolio_block_h_mobile',
        array(
            'section'  => 'portfolio_advanced',
            'label'    => __('Portfolio block height on mobile (px)', 'portfolio'),
            'type'     => 'text'
        )
    );
    
    $wp_customize->add_control(
        'portfolio_block_padding',
        array(
            'section'  => 'portfolio_advanced',
            'label'    => __('Portfolio block padding', 'portfolio'),
            'type'     => 'text'
        )
    );
    
    $wp_customize->add_control(
        'portfolio_block_padding_mobile',
        array(
            'section'  => 'portfolio_advanced',
            'label'    => __('Portfolio block padding on mobile', 'portfolio'),
            'type'     => 'text'
        )
    );
    
    $wp_customize->add_control(
        'portfolio_excerpt_length',
        array(
            'section'  => 'portfolio_advanced',
            'label'    => __('Excerpt length', 'portfolio'),
            'type'     => 'text'
        )
    );
    
    $wp_customize->add_control(
        'portfolio_filter_categories',
        array(
            'section'  => 'static_front_page',
            'label'    => __('Filter categories', 'portfolio'),
            'type'     => 'checkbox'
        )
    );
    
    $wp_customize->add_control(new GK_Portfolio_Category_Selection(
        $wp_customize,
        'portfolio_filtered_categories',
        array(
       		'label' => __('Select categories', 'portfolio'),
            'section' => 'static_front_page',
            'active_callback' => 'portfolio_filter_categories'
        )
    ));
    
    $wp_customize->add_control(
        'portfolio_meta_type',
        array(
            'section'  => 'static_front_page',
            'label'    => __('Post information under image', 'portfolio'),
            'type'     => 'select',
            'choices'  => array(
            	'tags' => __('Post tags', 'portfolio'),
            	'categories' => __('Post categories', 'portfolio'),
            	'date' => __('Post date', 'portfolio'),
            	'title' => __('Post title', 'portfolio')
            )
       	 )
    );
}

add_action( 'customize_register', 'portfolio_init_customizer' );

// EOF
