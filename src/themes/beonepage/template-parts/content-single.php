<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package BeOnePage
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'clearfix' ) ); ?>>
	<header class="entry-header">
		<?php
			if( has_post_thumbnail() ) {
				$thumb_id = get_post_thumbnail_id();
				$thumb_url = wp_get_attachment_image_src( $thumb_id, 'full' );

				printf(
					'<div class="entry-image">
						<a href="%1$s" data-lightbox="image">%2$s</a>
					</div>',
					esc_url( $thumb_url[0] ) ,
					get_the_post_thumbnail( null, 'full', array( 'class' => 'image-fade' ) )
				);
			}
		?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">
			<?php beonepage_posted_on(); ?>
		</div><!-- .entry-meta -->

		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'beonepage' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php beonepage_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
