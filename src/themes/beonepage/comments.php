<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package BeOnePage
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				$comments_number = get_comments_number();
				if ( 1 === $comments_number ) {
					/* translators: %s: post title */
					printf( _x( 'One thought on &ldquo;%s&rdquo;', 'comments title', 'beonepage' ), get_the_title() );
				} else {
					printf(
						/* translators: 1: number of comments, 2: post title */
						_nx(
							'%1$s thought on &ldquo;%2$s&rdquo;',
							'%1$s thoughts on &ldquo;%2$s&rdquo;',
							$comments_number,
							'comments title',
							'beonepage'
						),
						number_format_i18n( $comments_number ),
						'<span>' . get_the_title() . '</span>'
					);
				}
			?>
		</h2>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<nav id="comment-nav-above" class="navigation comment-navigation clearfix" role="navigation">
				<h2 class="sr-only"><?php esc_html_e( 'Comment navigation', 'beonepage' ); ?></h2>

				<ul class="nav-links">
					<li class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'beonepage' ) ); ?></li>
					<li class="nav-next pull-right"><?php next_comments_link( esc_html__( 'Newer Comments', 'beonepage' ) ); ?></li>
				</ul><!-- .nav-links -->
			</nav><!-- #comment-nav-above -->
		<?php endif; // Check for comment navigation. ?>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'       => 'ol',
					'avatar_size' => 60,
					'short_ping' => true,
					'callback'    => 'beonepage_comment'
				) );
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<nav id="comment-nav-below" class="navigation comment-navigation clearfix" role="navigation">
				<h2 class="sr-only"><?php esc_html_e( 'Comment navigation', 'beonepage' ); ?></h2>

				<ul class="nav-links">
					<li class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'beonepage' ) ); ?></li>
					<li class="nav-next pull-right"><?php next_comments_link( esc_html__( 'Newer Comments', 'beonepage' ) ); ?></li>
				</ul><!-- .nav-links -->
			</nav><!-- #comment-nav-below -->
		<?php endif; // Check for comment navigation. ?>

	<?php endif; // Check for have_comments(). ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'beonepage' ); ?></p>
	<?php endif; ?>

	<!-- Comment form begin -->
	<?php
		$commenter = wp_get_current_commenter();
		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? " required" : '' );
		$aria_req_mark = ( $req ? '&lowast;' : '' );

		$args = array(
			'label_submit'  => esc_html__( 'Submit Comment', 'beonepage' ),
			'submit_field'  => '<fieldset class="col-sm-12 form-submit text-right">%1$s %2$s</a></fieldset>',
			'title_reply'   => wp_kses( __( 'Leave a <span>Comment</span>', 'beonepage' ), array ( 'span' => array() ) ),
			'comment_field' =>
				'<fieldset class="col-sm-12 textarea-field">' .
				'<textarea name="comment" placeholder="' . esc_html__( 'Comment', 'beonepage' ) . '&lowast;" id="comment" rows="7" tabindex="4" class="input-form-control" required></textarea>' .
				'</fieldset>',

			'fields' => apply_filters( 'comment_form_default_fields', array(
				'author' =>
					'<div class="input-field clearfix">' .
					'<fieldset class="col-sm-4">' .
					'<input type="text" name="author" id="name" placeholder="' . esc_html__( 'Name', 'beonepage' ) . '&lowast;" value="' . esc_attr( $commenter['comment_author'] ) . '" tabindex="1" class="input-form-control"' . $aria_req . ' />' .
					'</fieldset>',

				'email' =>
					'<fieldset class="col-sm-4">' .
					'<input type="email" name="email" id="email" placeholder="' . esc_html__( 'E-Mail', 'beonepage' ) . $aria_req_mark . '" value="' . esc_attr( $commenter['comment_author_email'] ) . '" tabindex="2" class="input-form-control"' . $aria_req . ' />' .
					'</fieldset>',

				'url' =>
					'<fieldset class="col-sm-4">' .
					'<input id="url" name="url" type="text" placeholder="' . esc_html__( 'Website', 'beonepage') . '" value="' . esc_attr( $commenter['comment_author_url'] ) . '" tabindex="3" class="input-form-control" />' .
					'</fieldset>'.
					'</div>',
				)
			),
		);

		comment_form( $args );
	?>
	<!-- Comment form end -->
</div><!-- #comments -->
