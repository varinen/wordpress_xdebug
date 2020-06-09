<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package BeOnePage
 */

?>

<div class="no-results not-found">
	<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'beonepage' ); ?></h1>

	<div class="page-content">
		<?php if ( is_front_page() && current_user_can( 'publish_posts' ) ) : ?>
			<?php
				global $switch_portfolio_post;

				if ( $switch_portfolio_post == 'portfolio' ) {
					echo '<p>';
					printf( wp_kses( __( 'Ready to publish your first portfolio? <a href="%1$s">Get started here</a>.', 'beonepage' ),
						array( 'a' => array( 'href' => array() ) ) ),
						esc_url( admin_url( 'post-new.php?post_type=portfolio' ) )
					);
					echo '</p>';
				}
			?>

			<?php
				if ( $switch_portfolio_post == 'post' ) {
					echo '<p>';
					printf( wp_kses( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'beonepage' ),
						array( 'a' => array( 'href' => array() ) ) ),
						esc_url( admin_url( 'post-new.php' ) )
					);
					echo '</p>';
				}
			?>
		<?php elseif ( is_search() ) : ?>
			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'beonepage' ); ?></p>

			<?php get_search_form(); ?>
		<?php else : ?>
			<div class="col-md-6">
				<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'beonepage' ); ?></p>

				<?php get_search_form(); ?>
			</div><!-- .col-md-6 -->
		<?php endif; ?>
	</div><!-- .page-content -->
</div><!-- .no-results -->
