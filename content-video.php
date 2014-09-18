<?php
/**
 *
 * The default template for displaying Video post format
 *
 **/
 
 $video_code = portfolio_video_code();

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
			<?php if($video_code != '') : ?>
				<?php echo str_replace($video_code, '', apply_filters('the_content', get_the_content( __( 'Read more', 'portfolio' ) ))); ?>
			<?php else : ?>
				<?php the_content(__('Read more', 'portfolio')); ?>
			<?php endif; ?>	
			
			<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __('Pages:', 'portfolio') . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
		</div><!-- .entry-content -->
		<?php endif; ?>
	</div>
</article><!-- #post -->

