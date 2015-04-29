<?php

	/*
		Template for the entry header
	*/

	$video_code = portfolio_video_code();

?>
<?php if(
	!is_singular() || 
	(
		is_singular() && 
		(
			get_theme_mod('portfolio_post_show_featured_image', '1') == '1' || 
			get_theme_mod('portfolio_post_show_title', '1') == '1'
		)
	)
) : ?>
<header class="entry-header<?php if(is_singular() && is_sticky()) :?> sticky<?php endif; ?><?php if(get_theme_mod('portfolio_full_width_images', '1') == '1') : ?> full-width-image<?php endif; ?><?php if(get_theme_mod('portfolio_post_show_title', '1') == '0') : ?> no-title<?php endif; ?>" data-url="<?php echo get_permalink(); ?>">
	<?php if(!is_singular() || get_theme_mod('portfolio_post_show_featured_image', '1') == '1') : ?>
		<?php if (has_post_thumbnail() && !post_password_required()) : ?>			
			<?php the_post_thumbnail(is_singular() ? 'full' : 'gk-portfolio-size'); ?>
		<?php elseif($video_code) : ?>
			<div class="video-wrapper">
				<?php echo $video_code; ?>
			</div>
		<?php endif; ?>
	<?php endif; ?>

	<?php if(get_theme_mod('portfolio_post_show_title', '1') == '1') : ?>
	<h<?php echo is_single() ? '1' : '2'; ?> class="entry-title">
		<?php if(!is_singular()) : ?>
		<a href="<?php the_permalink(); ?>" rel="bookmark">
		<?php endif; ?>
			<?php the_title(); ?>
		<?php if(!is_singular()) : ?>
		</a>
		<?php endif; ?>
	</h<?php echo is_single() ? '1' : '2'; ?>>
	<?php endif; ?>
</header><!-- .entry-header -->
<?php endif; 