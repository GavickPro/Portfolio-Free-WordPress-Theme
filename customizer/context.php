<?php 

/*
 * Context functions
 */
 
function portfolio_is_singular($section) {
	return is_singular();
} 
 
function portfolio_font_url_field($control) {
	$option = $control->manager->get_setting('portfolio_font');
	return $option->value() == 'google';
}

function portfolio_body_font_url_field($control) {
	$option = $control->manager->get_setting('portfolio_body_font');
	return $option->value() == 'google';
}

function portfolio_logo_config($control) {
	$option = $control->manager->get_setting('portfolio_logo');
	return $option->value() != '';
}

// EOF