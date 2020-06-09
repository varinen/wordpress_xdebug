<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package BeOnePage
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
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
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<div class="entry-publish-date">
			<span class="post-date-day"><?php echo esc_html( get_the_date( 'd', $post->ID ) ); ?></span>
			<span class="post-date-month"><?php echo esc_html( get_the_date( 'M', $post->ID ) ); ?></span>
		</div><!-- .entry-publish-date -->

		<div class="entry-excerpt">
			<?php the_excerpt(); ?>
		</div><!-- .entry-excerpt -->
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php printf( '<a href="%1$s" class="btn-more">%2$s</a>', get_the_permalink(), esc_html__( 'Read More', 'beonepage' ) ); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
