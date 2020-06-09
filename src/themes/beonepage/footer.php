<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package BeOnePage
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer clearfix" role="contentinfo">
		<?php if ( Kirki::get_option( 'footer_site_title' ) == '1' ) : ?>
			<div class="site-branding col-md-12 clearfix">
				<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
			</div><!-- .site-branding -->
		<?php endif; ?>

		<div class="site-info col-md-12">
			<?php
				$byline = sprintf( esc_html__( ' Build with %s.', 'beonepage' ), '<a href="' . esc_url( 'http://betheme.me/' ) . '" rel="developer" target="_blank">BeTheme</a>' );

				echo html_entity_decode( Kirki::get_option( 'footer_copyright' ) ) . $byline;
			?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->

	<?php if ( Kirki::get_option( 'general_go_to_top' ) == '1' ) : ?>
		<div id="go-to-top" class="go-to-top btn btn-light"><i class="fa fa-angle-up"></i></div>
	<?php endif; ?>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
