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

function portfolio_filter_categories($control) {
	$option = $control->manager->get_setting('portfolio_filter_categories');
	return $option->value() != '';
}

function portfolio_logo_config($control) {
	$option = $control->manager->get_setting('portfolio_logo');
	return $option->value() != '';
}

function portfolio_active_animations($control) {
	$option = $control->manager->get_setting('portfolio_frontpage_animation');
	return $option->value() != '';
}

function portfolio_img_size_active($control) {
	$option = $control->manager->get_setting('portfolio_special_img_size');
	return $option->value() == '1';
}

// EOF