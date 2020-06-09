<?php
/**
 * Template part for displaying blog posts.
 *
 * @package BeOnePage
 */
?>

<a class="blog-item" href="<?php echo esc_url( get_permalink() ); ?>">
	<div class="entry-image">
		<?php the_post_thumbnail( 'featured-thumb' ); ?>

		<div class="entry-publish-date">
			<span class="post-date-day"><?php echo esc_html( get_the_date( 'd', $post->ID ) ); ?></span>
			<span class="post-date-month"><?php echo esc_html( get_the_date( 'M', $post->ID ) ); ?></span>
		</div><!-- .entry-publish-date -->

		<div class="read-more">
			<?php echo esc_html(Kirki::get_option( 'front_page_blog_module_read_more' )); ?>
		</div><!-- .read-more -->
	</div><!-- .entry-image -->

	<div class="entry-meta">
		<?php the_title( sprintf( '<h3 class="entry-title">', esc_url( get_permalink() ) ), '</h3>' ); ?>

		<?php if ( beonepage_categorized_blog() ) : ?>
			<div class="entry-cats">
				<?php
					$categories_list = get_the_category();

					if ( $categories_list ) {
						$i = 1;
						$c = count( $categories_list );

						foreach( $categories_list as $category ) {
							if ( $i == 1 ) {
								if ( $c == 1 ) {
									printf( esc_html__( 'Posted in %1$s', 'beonepage' ), $category->cat_name );
								} else {
									printf( esc_html__( 'Posted in %1$s, ', 'beonepage' ), $category->cat_name );
								}
							} else if ( $i < $c ) {
								echo $category->cat_name . esc_html__( ', ', 'beonepage' );
							} else {
								echo $category->cat_name;
							}

							$i++;
						}
					}
				?>
			</div><!-- .entry-cats -->
		<?php endif; ?>
	</div><!-- .entry-meta -->
</a><!-- .blog-item -->
