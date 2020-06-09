<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package BeOnePage
 */

get_header(); ?>

	<header class="page-header img-background clearfix">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'beonepage' ), '<span>' . get_search_query() . '</span>' ); ?></h1>

					<?php beonepage_get_breadcrumbs(); ?>
				</div><!-- col-md-12 -->
			</div><!-- .row -->
		</div><!-- .container -->
	</header><!-- .page-header -->

	<div class="container">
		<div class="row">
			<div class="col-md-9">
				<div id="primary" class="content-area search-list">
					<main id="main" class="site-main" role="main">
						<?php
							if ( have_posts() ) {
								while ( have_posts() ) : the_post();
									/**
									 * Run the loop for the search to output the results.
									 * If you want to overload this in a child theme then include a file
									 * called content-search.php and that will be used instead.
									 */
									get_template_part( 'template-parts/content', 'search' );

								endwhile;

								the_posts_pagination(
									array(
										'prev_text' => esc_html__('PREVIOUS','beonepage'),
										'next_text' => esc_html__('NEXT','beonepage')
									)
								);

						} else {
							get_template_part( 'template-parts/content', 'none' );
						}
					?>
					</main><!-- #main -->
				</div><!-- #primary -->
			</div><!-- col-md-9 -->

			<?php get_sidebar(); ?>
		</div><!-- .row -->
	</div><!-- .container -->

<?php get_footer(); ?>
