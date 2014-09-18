<?php
/**
 * The template for displaying Category pages
 *
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content archive" role="main">

		<?php if (have_posts()) : ?>
			<header class="archive-header">
				<h1 class="archive-title"><?php printf( __('Category Archives: %s', 'portfolio'), '<strong>' . single_cat_title('', false) . '</strong>'); ?></h1>

				<?php if (category_description()) : ?>
				<div class="archive-meta"><?php echo category_description(); ?></div>
				<?php endif; ?>
			</header><!-- .archive-header -->

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