<?php
/**
 *
 * Portfolio functions and definitions
 *
 */

// loading the necessary elements
get_template_part( 'comments', 'template' );
get_template_part( 'theme', 'customizer' );

/**
 *
 * Functions used to generate post excerpt
 *
 * @return HTML output
 *
 **/

if(!function_exists('portfolio_excerpt')) {
	function portfolio_excerpt($text) {
	    return $text . '&hellip;';
	}
}

add_filter( 'get_the_excerpt', 'portfolio_excerpt', 999 );

if(!function_exists('portfolio_excerpt_more')) {
	function portfolio_excerpt_more($text) {
	    return '';
	}
}

add_filter( 'excerpt_more', 'portfolio_excerpt_more', 999 );

if(!function_exists('portfolio_custom_excerpt_length')) {
	function portfolio_custom_excerpt_length( $length ) {
		return get_theme_mod('portfolio_excerpt_length', 16);
	}
}

add_filter( 'excerpt_length', 'portfolio_custom_excerpt_length', 999 );

if(!function_exists('portfolio_setup')) {
	/**
	 * Portfolio setup.
	 *
	 * Sets up theme defaults and registers the various WordPress features
	 *
	 * @uses load_theme_textdomain() For translation/localization support.
	 * @uses add_theme_support() To add support for automatic feed links, post
	 * formats, and post thumbnails.
	 * @uses register_nav_menu() To add support for a navigation menu.
	 *
	 *
	 * @return void
	 */
	function portfolio_setup() {
		global $content_width;
		
		if ( ! isset( $content_width ) ) $content_width = get_theme_mod('portfolio_content_width', 700);
		
		/*
		 * Makes Portfolio available for translation.
		 *
		 */
		load_theme_textdomain( 'portfolio', get_template_directory() . '/languages' );
	
		// Adds RSS feed links to <head> for posts and comments.
		add_theme_support( 'automatic-feed-links' );
	
		/*
		 * Switches default core markup for search form, comment form,
		 * and comments to output valid HTML5.
		 */
		add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );
	
		/**
		 * Add support for the title-tag
		 *
		 * @since Portfolio 1.4
		 */
		add_theme_support( 'title-tag' );
	
		/*
		 * This theme supports all available post formats by default.
		 * See http://codex.wordpress.org/Post_Formats
		 */
		add_theme_support('post-formats', array(
			'gallery', 'image', 'link', 'quote', 'video'
		));
	
		// This theme uses wp_nav_menu() in two locations.
		register_nav_menu('primary', __('Navigation Menu', 'portfolio'));
		register_nav_menu('footer', __('Social Menu', 'portfolio'));
	
		/*
		 * This theme uses a custom image size for featured images, displayed on
		 * "standard" posts and pages.
		 */
		add_theme_support('post-thumbnails');
		
		// Support for custom background
		$args = array(
			'default-color' => 'f1f1f1',
			'wp-head-callback' => 'portfolio_custom_background_callback'
		);
		add_theme_support('custom-background', $args);
	
		// This theme uses its own gallery styles.
		add_filter('use_default_gallery_style', '__return_false');
	}
}

add_action('after_setup_theme', 'portfolio_setup');

if(!function_exists('portfolio_custom_background_callback')) {
	/**
	 * Modify the custom background head code
	 *
	 * @return void
	 */
	
	function portfolio_custom_background_callback() {
	    $background = get_background_image();
	    $color = get_background_color();
	    if ( ! $background && ! $color )
	        return;
	 
	    $style = $color ? "background-color: #$color;" : '';
	 
	    if ($background) {
	        $image = " background-image: url('$background');";
	 
	        $repeat = get_theme_mod('background_repeat', 'repeat');
	        if (!in_array($repeat, array('no-repeat', 'repeat-x', 'repeat-y', 'repeat'))) {
	            $repeat = 'repeat';
	        }
	        $repeat = " background-repeat: $repeat;";
	 
	        $position = get_theme_mod('background_position_x', 'left');
	        if (!in_array($position, array( 'center', 'right', 'left'))) {
	            $position = 'left';
	        }
	        $position = " background-position: top $position;";
	 
	        $attachment = get_theme_mod( 'background_attachment', 'scroll' );
	        if (!in_array($attachment, array( 'fixed', 'scroll' ))) {
	            $attachment = 'scroll';
	        }
	        $attachment = " background-attachment: $attachment;";
	 
	        $style .= $image . $repeat . $position . $attachment;
	    }
	?>
	<style type="text/css">
	body.custom-background #main { <?php echo trim( $style ); ?> }
	</style>
	<?php
	}
}

if(!function_exists('portfolio_add_editor_styles')) {
	/**
	 * Enqueue scripts for the back-end.
	 *
	 * @return void
	 */
	function portfolio_add_editor_styles() {
	    add_editor_style(array('editor.css', 'css/font.awesome.css', 'https://fonts.googleapis.com/css?family=Open+Sans'));
	}
}

add_action('init', 'portfolio_add_editor_styles');

if(!function_exists('portfolio_scripts')) {
	/**
	 * Enqueue scripts for the front end.
	 *
	 * @return void
	 */
	function portfolio_scripts() {
		/*
		 * Adds JavaScript to pages with the comment form to support
		 * sites with threaded comments (when in use).
		 */
		if (is_singular() && comments_open() && get_option('thread_comments')) {
			wp_enqueue_script( 'comment-reply' );
		}
	
		// Loads JavaScript file with functionality specific to Portfolio.
		wp_enqueue_script('portfolio-script', get_template_directory_uri() . '/js/functions.js', array('jquery'), '', true);
		
		// Loads JavaScript file for responsive video.
		wp_enqueue_script('portfolio-video', get_template_directory_uri() . '/js/jquery.fitvids.js', false, false, true);
	}
}

add_action('wp_enqueue_scripts', 'portfolio_scripts');

if(!function_exists('portfolio_styles')) {
	/**
	 * Enqueue styles for the front end.
	 *
	 * @return void
	 */
	function portfolio_styles() {
		// Add normalize stylesheet.
		wp_enqueue_style('portfolio-normalize', get_template_directory_uri() . '/css/normalize.css', false);
	
		// Add Google font from the customizer
		wp_enqueue_style('portfolio-fonts', get_theme_mod('portfolio_google_font', 'http://fonts.googleapis.com/css?family=Open+Sans:700'), false);
		
		if(get_theme_mod('portfolio_google_font', 'http://fonts.googleapis.com/css?family=Open+Sans:700') != get_theme_mod('portfolio_body_google_font', 'http://fonts.googleapis.com/css?family=Open+Sans:400')) {
			wp_enqueue_style('portfolio-fonts-body', get_theme_mod('portfolio_body_google_font', 'http://fonts.googleapis.com/css?family=Open+Sans:400'), false);
		}
		
		// Font Awesome
		wp_enqueue_style('portfolio-font-awesome', get_template_directory_uri() . '/css/font.awesome.css', false, '4.0.3');
	
		// Loads our main stylesheet.
		wp_enqueue_style('portfolio-style', get_stylesheet_uri());
		
		// Loads the Internet Explorer specific stylesheet.
		wp_enqueue_style('portfolio-ie8', get_template_directory_uri() . '/css/ie8.css', array('portfolio-style'));
		wp_style_add_data('portfolio-ie8', 'conditional', 'lt IE 9');
		
		wp_enqueue_style('portfolio-ie9', get_template_directory_uri() . '/css/ie9.css', array('portfolio-style'));
		wp_style_add_data('portfolio-ie9', 'conditional', 'IE 9');
	}
}

add_action('wp_enqueue_scripts', 'portfolio_styles');

if(!function_exists('portfolio_widgets_init')) {
	/**
	 * Register widget area.
	 *
	 * @return void
	 */
	function portfolio_widgets_init() {
		register_sidebar(array(
			'name'          => __( 'Bottom widget area', 'portfolio' ),
			'id'            => 'bottom',
			'description'   => __( 'Appears at the bottom of the website.', 'portfolio' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		));
	}
}

add_action('widgets_init', 'portfolio_widgets_init');

if (!function_exists('portfolio_paging_nav')) {
	/**
	 * Display navigation to next/previous set of posts when applicable.
	 *
	 *
	 * @return void
	 */
	function portfolio_paging_nav() {
		global $wp_query, $paged;
		
		//display number of current page
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	
		// Don't print empty markup if there's only one page.
		if ( $wp_query->max_num_pages < 2 )
			return;
		?>
		<nav class="navigation paging-navigation" role="navigation">
				<div class="nav-links">
		
					<?php if (get_next_posts_link()) : ?>
						<div class="nav-previous"><?php next_posts_link( __( 'Older posts', 'portfolio' ) ); ?></div>
					<?php endif; ?>
								
					<span class="pagination-item"><?php _e( 'Page', 'portfolio' )?> <?php echo $paged ?> <?php _e( 'of', 'portfolio' )?> <?php echo $wp_query->max_num_pages ?></span>			
		
					<?php if (get_previous_posts_link()) : ?>
						<div class="nav-next"><?php previous_posts_link( __( 'Newer posts', 'portfolio' ) ); ?></div>
					<?php endif; ?>
		
				</div><!-- .nav-links -->
			</nav><!-- .navigation -->
		<?php
	}
}

if(!function_exists('portfolio_video_code')) {
	function portfolio_video_code() {
		$video_condition = stripos(get_the_content(), '</iframe>') !== FALSE || stripos(get_the_content(), '</video>') !== FALSE; 
		
		if($video_condition) {
			$video_code = '';
			
			if(stripos(get_the_content(), '</iframe>') !== FALSE) {
				$start = stripos(get_the_content(), '<iframe');
				$len = strlen(substr(get_the_content(), $start, stripos(get_the_content(), '</iframe>', $start)));
				$video_code = substr(get_the_content(), $start, $len + 9); 
			} elseif(stripos(get_the_content(), '</video>') !== FALSE) {
				$start = stripos(get_the_content(), '<video');
				$len = strlen(substr(get_the_content(), $start, stripos(get_the_content(), '</video>', $start)));
				$video_code = substr(get_the_content(), $start, $len + 8); 
			}
			
			return $video_code;
		} else {
			return FALSE;
		}
	}
}


if (!function_exists('portfolio_the_attached_image')) {
	/**
	 * Print the attached image with a link to the next attached image.
	 *
	 * @since Portfolio 1.0
	 *
	 * @return void
	 */
	function portfolio_the_attached_image() {
		/**
		 * Filter the image attachment size to use.
		 *
		 * @since Portfolio 1.0
		 *
		 * @param array $size {
		 *     @type int The attachment height in pixels.
		 *     @type int The attachment width in pixels.
		 * }
		 */
		$attachment_size     = apply_filters( 'portfolio_attachment_size', array( 724, 724 ) );
		$next_attachment_url = wp_get_attachment_url();
		$post                = get_post();
	
		/*
		 * Grab the IDs of all the image attachments in a gallery so we can get the URL
		 * of the next adjacent image in a gallery, or the first image (if we're
		 * looking at the last image in a gallery), or, in a gallery of one, just the
		 * link to that image file.
		 */
		$attachment_ids = get_posts(array(
			'post_parent'    => $post->post_parent,
			'fields'         => 'ids',
			'numberposts'    => -1,
			'post_status'    => 'inherit',
			'post_type'      => 'attachment',
			'post_mime_type' => 'image',
			'order'          => 'ASC',
			'orderby'        => 'menu_order ID'
		));
	
		// If there is more than 1 attachment in a gallery...
		if (count($attachment_ids) > 1) {
			foreach ($attachment_ids as $attachment_id) {
				if ($attachment_id == $post->ID) {
					$next_id = current($attachment_ids);
					break;
				}
			}
	
			// get the URL of the next image attachment...
			if ($next_id) {
				$next_attachment_url = get_attachment_link($next_id);
			} else { // or get the URL of the first image attachment.
				$next_attachment_url = get_attachment_link(array_shift($attachment_ids));
			}
		}
	
		printf('<a href="%1$s" title="%2$s" rel="attachment">%3$s</a>',
			esc_url($next_attachment_url),
			the_title_attribute(array('echo' => false)),
			wp_get_attachment_image($post->ID, $attachment_size)
		);
	}
}

if(!function_exists('portfolio_social_button')) {
	/**
	 * Add Twitter & Facebook Sharing Icon to Posts
	 *
	 * @since Portfolio 1.0
	 *
	 * @param string $content Post content.
	 * @return string Post content with HTML output.
	 */
	function portfolio_social_button($content) {
		global $post;
		// get posts titles and permalinks
		$permalink = get_permalink($post->ID);
		$title = get_the_title();
		// add share button only on posts pages
		if(!is_feed() && !is_home() && !is_page() && get_theme_mod('portfolio_post_show_social', '1') == '1') {
			$content = $content . '<div class="gk-social-buttons">
			<span class="gk-social-label">'.__( 'Share:', 'portfolio' ).'</span>
			<a class="gk-social-twitter" href="http://twitter.com/share?text='.urlencode($title).'&amp;url='.urlencode($permalink).'"
	            onclick="window.open(this.href, \'twitter-share\', \'width=550,height=235\');return false;">
	            <span class="social__icon--hidden">Twitter</span>
	        </a>    
				
			<a class="gk-social-fb" href="https://www.facebook.com/sharer/sharer.php?u='.urlencode($permalink).'"
			     onclick="window.open(this.href, \'facebook-share\',\'width=580,height=296\');return false;">
			    <span class="social-icon-hidden">Facebook</span>
			</a>
			
			<a class="gk-social-gplus" href="https://plus.google.com/share?url='.urlencode($permalink).'"
	           onclick="window.open(this.href, \'google-plus-share\', \'width=490,height=530\');return false;">
	            <span class="social__icon--hidden">Google+</span>
	        </a>
		</div>';
		}
		return $content;
	}
}

add_filter('the_content', 'portfolio_social_button');


if(get_theme_mod('portfolio_special_img_size', '0') == '1') {
	if(!function_exists('portfolio_image_sizes')) {
		/**
		 * Add dedicated portfolio image size
		 *
		 * @since Portfolio 1.3
		 *
		 * @param array $size dimensions of the image.
		 * @return array Array of the modified image dimensions
		 */
		function portfolio_image_sizes($sizes) {
			$addsizes = array(
				"gk-portfolio-size" => __( "Portfolio image", "portfolio")
			);
			$newsizes = array_merge($sizes, $addsizes);
			return $newsizes;
		}
	}
	
	add_image_size('gk-portfolio-size', get_theme_mod('portfolio_img_w', 300), get_theme_mod('portfolio_img_h', 400), get_theme_mod('portfolio_img_hard_crop', '1') == '1');
	add_filter('image_size_names_choose', 'portfolio_image_sizes');
}

if (!function_exists('_wp_render_title_tag')) {
    /**
     * Add backward compatibility for the title tag
     *
     * @since Portfolio 1.4
     */
    function theme_slug_render_title() {
?>
<title><?php wp_title( '|', true, 'right' ); ?></title>
<?php
	}
    add_action( 'wp_head', 'theme_slug_render_title' );
}

if (!function_exists('portfolio_filter_for_categories')) {
	function portfolio_filter_for_categories($query) {
	    if (
	    	get_theme_mod('portfolio_filter_categories', '') != '' &&
	    	$query->is_main_query() && 
	    	is_home()
	    ) {
	        $query->set('cat', get_theme_mod('portfolio_filtered_categories', ''));
	    }
	}
	
	add_action('pre_get_posts', 'portfolio_filter_for_categories');
}