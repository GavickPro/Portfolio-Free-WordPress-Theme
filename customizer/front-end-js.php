<?php

function portfolio_customize_preview_js($wp_customize) {
	wp_enqueue_script('customizer-front-end', get_template_directory_uri() . '/js/customize-preview.js', array('customize-preview'));
}

add_action('customize_preview_init', 'portfolio_customize_preview_js');

// EOF