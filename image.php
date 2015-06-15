<?php
/**
 * The template for displaying image attachments
 *
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'image-attachment' ); ?>>
				<div>
					
					<?php get_template_part( 'content', 'header'); ?>
	
					<div class="entry-content">
						<div class="entry-attachment">
							<div class="attachment">
								<?php portfolio_the_attached_image(); ?>
	
								<?php if ( has_excerpt() ) : ?>
								<div class="entry-caption">
									<?php the_excerpt(); ?>
								</div>
								<?php endif; ?>
							</div><!-- .attachment -->
						</div><!-- .entry-attachment -->
	
						<?php if ( ! empty( $post->post_content ) ) : ?>
						<div class="entry-description">
							<?php the_content(); ?>
							<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'portfolio' ), 'after' => '</div>' ) ); ?>
						</div><!-- .entry-description -->
						<?php endif; ?>
						
						<nav id="image-navigation" class="navigation image-navigation" role="navigation">
							<span class="nav-previous"><?php echo previous_image_link( false, __( '<span class="meta-nav">&larr;</span> Previous Image', 'portfolio' ) ); ?></span>
							<span class="nav-next"><?php echo next_image_link( false, __( 'Next Image <span class="meta-nav">&rarr;</span>', 'portfolio' ) ); ?></span>
							<span class="nav-parent">
								<?php $permalink = get_permalink($post->post_parent); ?>
								<a href="<?php echo $permalink; ?>"><?php _e('&uarr; Return to post', 'portfolio'); ?></a>
							</span>
						</nav><!-- #image-navigation -->
					<?php get_template_part( 'content', 'footer' ); ?>
				</div>
			</article><!-- #post -->

			<?php comments_template(); ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>