<?php
/**
 * The default template for displaying content
 * Used for both single and index/archive/search.
 *
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div>
		<?php get_template_part('content', 'header'); ?>
		
		<?php get_template_part('content', 'meta'); ?>
	
		<?php if (is_home() || is_search() || is_archive() || is_tag()) : // Only display Excerpts for Search ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
			<a href="<?php echo get_permalink(get_the_ID()); ?>" class="readon"><?php _e('Read more', 'portfolio'); ?></a>
		</div><!-- .entry-summary -->
		<?php else : ?>
		<div class="entry-content">
			<?php the_content(__('Read more', 'portfolio')); ?>
			<?php echo portfolio_social_button(); ?>
			
			<?php wp_link_pages(array('before' => '<div class="page-links"><span class="page-links-title">' . __('Pages:', 'portfolio') . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>')); ?>
			
			<?php
				if(get_theme_mod('portfolio_post_show_tags', '1') == '1') {
					$tag_list = get_the_tag_list('<ul class="tags-links"><li>',', </li><li>','</li></ul>');
					if ($tag_list) {
						echo $tag_list;
					}
				}
			?>
		</div><!-- .entry-content -->
		<?php endif; ?>
	</div>
</article><!-- #post -->
