<?php
/**
 * The template for displaying Author bios
 */
?>

<div class="author-info">
	<div class="author-avatar">
		<?php
		/**
		 * Filter the author bio avatar size.
		 *
		 */
		$author_bio_avatar_size = apply_filters('portfolio_author_bio_avatar_size', 80);
		echo get_avatar(get_the_author_meta('user_email'), $author_bio_avatar_size);
		?>
	</div><!-- .author-avatar -->
	<div class="author-description">
		<h3 class="author-title">
			<a href="<?php the_author_meta('user_url'); ?>" class="inverse">
				<?php echo get_the_author(); ?>
			</a>
		</h3>
		<p class="author-bio">
			<?php the_author_meta('description'); ?>
		</p>
	</div><!-- .author-description -->
</div><!-- .author-info -->