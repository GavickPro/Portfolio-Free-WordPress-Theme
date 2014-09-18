<?php
/**
 * The template for displaying Author archive pages
 *
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content archive" role="main">

		<?php if(have_posts()) : ?>

			<?php the_post(); ?>

			<header class="archive-header">
				<h1 class="page-title"><?php printf( __('All posts by %s', 'portfolio'), get_the_author() ); ?></h1>
			</header><!-- .archive-header -->

			<?php rewind_posts(); ?>

			<?php if (get_the_author_meta('description')) : ?>
				<?php get_template_part('author-bio'); ?>
			<?php endif; ?>

			<?php while (have_posts()) : the_post(); ?>
				<?php get_template_part('content-archive', get_post_format()); ?>
			<?php endwhile; ?>

		<?php else : ?>
			<?php get_template_part('content', 'none'); ?>
		<?php endif; ?>

		</div><!-- #content -->
		<?php portfolio_paging_nav(); ?>
	</div><!-- #primary -->

<?php get_footer(); ?>