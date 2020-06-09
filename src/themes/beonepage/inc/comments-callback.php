<?php
/**
 * Template for Comments
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @package BeOnePage
 */

function beonepage_comment( $comment, $args, $depth ) {
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>

	<<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">

	<?php if ( 'div' != $args['style'] ) : ?>
		<div id="div-comment-<?php comment_ID() ?>" class="comment-body clearfix">
	<?php endif; ?>

	<div class="comment-author vcard">
		<span class="comment-avatar clearfix">
			<?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
		</span>
	</div><!-- .comment-author -->

	<div class="comment-content clearfix">
		<div class="comment-meta">
			<div class="comment-author">
				<?php echo get_comment_author_link(); ?>

				<span>
					<?php
						$posted_on = sprintf( esc_html_x( '%1$s at %2$s', 'post date', 'beonepage' ), get_comment_date(),  get_comment_time() );

						printf(
							'<a href="%1$s">%2$s</a>',
							htmlspecialchars( get_comment_link( $comment->comment_ID ) ),
							$posted_on
						);

						edit_comment_link( esc_html_x( 'Edit', 'edit comment', 'beonepage' ), '  ' );
					?>
				</span>
			</div><!-- .comment-author -->
		</div><!-- .comment-meta -->

		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'beonepage' ); ?></em>
			<br />
		<?php endif; ?>

		<?php comment_text(); ?>

		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => '<i class="fa fa-reply"></i>' ) ) ); ?>
		</div><!-- .reply -->
	</div><!-- .comment-content -->

	<?php if ( 'div' != $args['style'] ) : ?>
		</div><!-- .comment-body -->
	<?php endif; ?>

	<div class="clear"></div>
<?php
}
