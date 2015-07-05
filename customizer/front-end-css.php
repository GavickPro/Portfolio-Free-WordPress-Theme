<?php 

// Add CSS styles generated from GK Cusotmizer settings
function portfolio_customizer_css() {
	$google = esc_attr(get_theme_mod('portfolio_google_font', 'http://fonts.googleapis.com/css?family=Open+Sans:700'));
	$fname = array();
	preg_match('@family=(.+)$@is', $google, $fname);
	$font_family = "'" . str_replace('+', ' ', preg_replace('@:.+@', '', preg_replace('@&.+@', '', $fname[1]))) . "'";
	
	$body_google = esc_attr(get_theme_mod('portfolio_body_google_font', 'http://fonts.googleapis.com/css?family=Open+Sans:400'));
	$body_fname = array();
	preg_match('@family=(.+)$@is', $body_google, $body_fname);
	$body_font_family = "'" . str_replace('+', ' ', preg_replace('@:.+@', '', preg_replace('@&.+@', '', $body_fname[1]))) . "'";
    
    if (get_theme_mod('portfolio_font') == 'google') {
    	$portfolio_font = $font_family;
    } else {
    	$portfolio_font = esc_attr(get_theme_mod('portfolio_font'));
    }
    
    if (get_theme_mod('portfolio_body_font') == 'google') {
    	$body_portfolio_font = $body_font_family;
    } else {
    	$body_portfolio_font = esc_attr(get_theme_mod('portfolio_body_font'));
    }
    
    $primary_color = esc_attr(get_theme_mod('portfolio_primary_color', '#5cc1a9'));
    
    ?>   
    <style type="text/css">
    	body { font-family: <?php echo $body_portfolio_font; ?> }
        .site-title { font-family: <?php echo $portfolio_font; ?> }
    	
    	.site-main #page {
    		max-width: <?php echo get_theme_mod('portfolio_portfolio_width', '1260'); ?>px;
    	}
    
    	#primary,
    	#comments,
    	.author-info,
    	.attachment #primary,
    	.site-content.archive #gk-search,
    	.search-no-results .page-content {
    		width: <?php echo get_theme_mod('portfolio_content_width', 700); ?>px;
    	}
    
    	<?php if(get_theme_mod('portfolio_word_break', '0') == '1') : ?>
        body {
            -ms-word-break: break-all;
            word-break: break-all;
            word-break: break-word;
            -webkit-hyphens: auto;
            -moz-hyphens: auto;
            -ms-hyphens: auto;
            hyphens: auto;
        }
        <?php endif; ?>
    
        a,
        a.inverse:active,
        a.inverse:focus,
        a.inverse:hover,
        button,
        input[type="submit"],
        input[type="button"],
        input[type="reset"],
        .entry-summary .readon,
        .comment-author .fn,
        .comment-author .url,
        .comment-reply-link,
        .comment-reply-login,
        #content .tags-links a:active,
        #content .tags-links a:focus,
        #content .tags-links a:hover,
        .nav-menu li a:active,
        .nav-menu li a:focus,
        .nav-menu li a:hover,
        ul.nav-menu ul a:hover,
        .nav-menu ul ul a:hover,
        .gk-social-buttons a:hover:before,
        .format-gallery .entry-content .page-links a:hover,
        .format-audio .entry-content .page-links a:hover,
        .format-status .entry-content .page-links a:hover,
        .format-video .entry-content .page-links a:hover,
        .format-chat .entry-content .page-links a:hover,
        .format-quote .entry-content .page-links a:hover,
        .page-links a:hover,
        .paging-navigation a:active,
        .paging-navigation a:focus,
        .paging-navigation a:hover,
        .comment-meta a:hover,
        .social-menu li:hover:before,
        .social-menu-topbar li:hover:before,
        .entry-title a:hover {
        	color: <?php echo $primary_color; ?>;
        }
        button,
        input[type="submit"],
        input[type="button"],
        input[type="reset"],
        .entry-summary .readon {
        	border: 1px solid <?php echo $primary_color; ?>;
        }
        body .nav-menu .current_page_item > a,
        body .nav-menu .current_page_ancestor > a,
        body .nav-menu .current-menu-item > a,
        body .nav-menu .current-menu-ancestor > a {
        	border-color: <?php echo $primary_color; ?>;
        	color: <?php echo $primary_color; ?>!important;
        }
        .format-status .entry-content .page-links a,
        .format-gallery .entry-content .page-links a,
        .format-chat .entry-content .page-links a,
        .format-quote .entry-content .page-links a,
        .page-links a {
        	background:  <?php echo $primary_color; ?>;
        	border-color: <?php echo $primary_color; ?>;
        }
        .hentry .mejs-controls .mejs-time-rail .mejs-time-current,
        .comment-post-author,
        .sticky .post-preview:after,
        .entry-header.sticky:after,
        .article-helper.sticky:after,
        #prev-post > a:hover,
        #next-post > a:hover {
        	background: <?php echo $primary_color; ?>;
        }
        .comments-title > span,
        .comment-reply-title > span {
        	border-bottom-color: <?php echo $primary_color; ?>;
        }
        
        <?php if(
        	get_theme_mod('portfolio_logo', '') != '' && 
        	get_theme_mod('portfolio_logo_autosize', '0') == '1'
        ) : ?>
        .site-header,
        .home-link > img {
        	height: auto;
        	max-height: none;
        }
        <?php endif; ?>
        
        .article-helper {
	        height: <?php echo get_theme_mod('portfolio_block_h', '380'); ?>px; 
        }
        
        .site-content.archive article {
        	height: <?php echo intval(get_theme_mod('portfolio_block_h', '380')) + 36; ?>px;
        }
        
        .post-preview {
        	padding: <?php echo get_theme_mod('portfolio_block_padding', '56px 36px 36px 36px'); ?>;
        }
        
        @media (max-width: 1140px) {
        	.site-content.archive article {
        		height: <?php echo intval(get_theme_mod('portfolio_block_h_mobile', '320')) + 16; ?>px;
        	}
        	
        	.article-helper {
        		height: <?php echo get_theme_mod('portfolio_block_h_mobile', '320'); ?>px;
        	}
        	
        	.post-preview {
        		padding: <?php echo get_theme_mod('portfolio_block_padding_mobile', '20px 16px 36px 16px'); ?>;
        	}
        }
    </style>
    <?php   
    
    $width = '';
    if ( get_theme_mod('portfolio_article_column', '4') == '4') { $width = '25%'; }
    elseif ( get_theme_mod('portfolio_article_column', '2') == '2') { $width = '50%'; }
    else { $width = '33%'; }
	 ?>
    <style type="text/css">
        .site-content.archive article { width: <?php echo $width ?>; }
    </style> 
    <?php 
}

add_action( 'wp_head', 'portfolio_customizer_css' );

// EOF