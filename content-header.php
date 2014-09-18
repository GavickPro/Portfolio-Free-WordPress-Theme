<?php

	/*
		Template for the entry header
	*/

	$video_code = portfolio_video_code();

?>
<header class="entry-header">
	<?php if (has_post_thumbnail() && ! post_password_required()) : ?>			
		<?php the_post_thumbnail(); ?>
	<?php elseif($video_code) : ?>
		<div class="video-wrapper">
			<?php echo $video_code; ?>
		</div>
	<?php endif; ?>

	<h<?php echo is_single() ? '1' : '2'; ?> class="entry-title<?php if(is_sticky()) echo ' sticky'; ?>">
		<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
	</h<?php echo is_single() ? '1' : '2'; ?>>
</header><!-- .entry-header -->