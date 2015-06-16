<?php

/*
 * Sanitization functions
 */
function portfolio_intval($value) {
	return intval($value);
} 
 
function portfolio_sanitize_article_column($value) {
	if(in_array($value, array('1', '2', '3', '4'))) {
		return $value;
	}
	
	return null;	
}

function portfolio_sanitize_font($value) {
	$fonts = array(
		'google', 
		'verdana', 
		'georgia', 
		'arial', 
		'impact', 
		'tahoma', 
		'times',
		'comic sans ms',
		'courier new',
		'helvetica'
	);
	
	if(in_array($value, $fonts)) {
		return $value;
	}
	
	return null;
}

function portfolio_sanitize_date_format($value) {
	if($value === 'default' || $value === 'wordpress') {
		return $value;
	}
	return null;
}

function portfolio_sanitize_checkbox($value) {
	if($value == '1' || $value == '0') {
		return $value;
	}
	return null;
}

function portfolio_validate_category_selection($value) {
    $temp = explode(',', $value);
 
    if(count($temp) === count(array_filter($temp, 'is_numeric'))) {
        return $value;
    }
 
    return null;
}

function portfolio_post_preview_animation_type($value) {
	$types = array(
		'animation-slide-up',
		'animation-slide-down',
		'animation-slide-left',
		'animation-slide-right',
		'animation-opacity',
		'animation-scale'
	);
	
	if(in_array($value, $types)) {
		return $value;
	}
	
	return null;
}

function portfolio_meta_types($value) {
	$types = array(
		'tags',
		'categories',
		'date',
		'title'
	);
	
	if(in_array($value, $types)) {
		return $value;
	}
	
	return null;
}


// EOF