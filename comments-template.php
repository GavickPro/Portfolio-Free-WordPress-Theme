<?php

/**
 *
 * Template for comments and pingbacks.
 *
 * @param comment - the comment to render
 * @param args - additional arguments
 * @param depth - the depth of the comment
 *
 * @return null
 *
 **/
 
function portfolio_comment_template($comment, $args, $depth) {
	global $tpl;

	$GLOBALS['comment'] = $comment;

	do_action('portfolio_before_comment');

	switch ($comment->comment_type) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="pingback">
		<p>
			<?php _e('Pingback:', 'portfolio'); ?> 
			<?php comment_author_link(); ?>
			<?php edit_comment_link(__('Edit', 'portfolio'), '<span class="edit-link">', '</span>'); ?>
		</p>
		<?php break; ?>
	<?php default : ?>
	<?php
		$comment_class = comment_class(empty( $args['has_children'] ) ? '' : 'parent', null, null, false);
		$comment_author = in_array('bypostauthor', explode(' ', $comment_class)) ? ' <strong class="comment-post-author">' . __('Post author', 'portfolio') . '</strong>' : '';
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>" <?php $comment_class; ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
			<footer class="comment-meta">
				<div class="comment-author">
					<?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
				</div><!-- .comment-author -->
				
				<div class="comment-metadata vcard">
					<strong class="fn"><?php  echo get_comment_author_link(); ?><?php echo $comment_author; ?></strong>
					
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID, $args ) ); ?>">
						<time datetime="<?php comment_time( 'c' ); ?>">
							<?php printf( _x( '%1$s at %2$s', '1: date, 2: time', 'portfolio' ), get_comment_date(), get_comment_time() ); ?>
						</time>
					</a>
				</div><!-- .comment-metadata -->

				<?php if ('0' == $comment->comment_approved) : ?>
				<p class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'portfolio'); ?></p>
				<?php endif; ?>
			</footer><!-- .comment-meta -->

			<div class="comment-content">
				<?php comment_text(); ?>
			</div><!-- .comment-content -->

			<div class="reply">
				<?php edit_comment_link(__('Edit', 'portfolio'), '<span class="edit-link">', '</span>' ); ?>
				
				<?php comment_reply_link(array_merge($args, array('add_below' => 'div-comment', 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
			</div><!-- .reply -->
		</article><!-- .comment-body -->
	</li><!-- li#comment-ID -->
	<?php
		break;
	endswitch;

	do_action('portfolio_after_comment');
}

// EOF