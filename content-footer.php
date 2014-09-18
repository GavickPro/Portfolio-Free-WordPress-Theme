<?php 

	/*
		Template for the content item footer
	*/

	if (is_single() && get_the_author_meta('description')) : 
?>
<footer class="entry-meta">
	<?php get_template_part('author', 'bio'); ?>
</footer><!-- .entry-meta -->
<?php 
endif;

// EOF