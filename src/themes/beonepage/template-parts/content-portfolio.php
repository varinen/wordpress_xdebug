<?php
/**
 * Template part for displaying portfolio posts.
 *
 * @package BeOnePage
 */

$terms = get_the_terms( $post->ID, 'portfolio_tag' );

if ( $terms && ! is_wp_error( $terms ) ) {
	$tag = array();
	$filter = array();

	foreach ( $terms as $term ) {
		$tag[] = $term->name;
		$filter[] = 'portfolio-tag-' . $term->name;
	}

	$filter = str_replace( ' ', '-', $filter );
	$portfolio_tag = ( join( ', ', $tag ) );
	$portfolio_filter = strtolower( join( ' ', $filter ) );
}
?>

<article id="portfolio-item-<?php the_ID() ?>" class="portfolio-item<?php echo isset( $portfolio_filter ) ? ' ' . esc_attr( $portfolio_filter) : ''; ?>">
	<a href="#<?php echo $post->post_name; ?>">
		<div class="portfolio-image">
			<?php
				if ( has_post_thumbnail() ) {
					the_post_thumbnail( 'featured-thumb' );
				} else {
					printf( '<img src="%s">', esc_url( get_template_directory_uri() . '/images/portfolio-placeholder.png' ) );
				}
			?>
		</div><!--.portfolio-image -->

		<div class="portfolio-caption">
			<h3 class="entry-title"><?php the_title(); ?></h3>

			<?php echo isset( $portfolio_tag ) ? '<span class="entry-meta">' . esc_html( $portfolio_tag ) . '</span>' : ''; ?>
		</div><!--.portfolio-caption -->
	</a>
</article>
