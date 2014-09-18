<?php
/**
 * The template for displaying Tag pages
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content archive" role="main">

		<?php if ( have_posts() ) : ?>
			<header class="archive-header">
				<h1 class="page-title"><?php printf( __( 'Tag Archives: %s', 'portfolio' ), '<strong>' . single_tag_title( '', false ) . '</strong>' ); ?></h1>

				<?php if ( tag_description() ) : // Show an optional tag description ?>
				<div class="archive-meta"><?php echo tag_description(); ?></div>
				<?php endif; ?>
			</header><!-- .archive-header -->

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content-archive', get_post_format() ); ?>
			<?php endwhile; ?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

		</div><!-- #content -->
		
		<?php portfolio_paging_nav(); ?>
	</div><!-- #primary -->

<?php get_footer(); ?>