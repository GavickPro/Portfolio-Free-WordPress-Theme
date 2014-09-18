<?php
/**
 *
 * Archive page
 *
 **/

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content archive" role="main">

		<?php if (have_posts()) : ?>
			<header class="archive-header">
				<h1 class="page-title">
				<?php if (is_day()) : ?>
					<?php printf( __( 'Daily Archives: %s', 'portfolio'), '<span>' . get_the_date() . '</span>' ); ?>
				<?php elseif (is_month()) : ?>
					<?php printf(__( 'Monthly Archives: %s', 'portfolio'), '<span>' . get_the_date('F Y') . '</span>' ); ?>
				<?php elseif ( is_year() ) : ?>
					<?php printf( __( 'Yearly Archives: %s', 'portfolio'), '<span>' . get_the_date('Y') . '</span>' ); ?>
				<?php else : ?>
					<?php _e('Blog Archives', 'portfolio'); ?>
				<?php endif; ?>
				</h1>
			</header>

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part('content-archive', get_post_format()); ?>
			<?php endwhile; ?>

		<?php else : ?>
			<?php get_template_part('content', 'none'); ?>
		<?php endif; ?>

		</div><!-- #content -->
		<?php portfolio_paging_nav(); ?>
	</div><!-- #primary -->

<?php get_footer(); ?>