<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package BeOnePage
 */

get_header(); ?>

	<header class="page-header img-background clearfix">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h1 class="page-title"><?php echo esc_html__( '404','beonepage' ); ?></h1>

					<?php beonepage_get_breadcrumbs(); ?>
				</div><!-- col-md-12 -->
			</div><!-- .row -->
		</div><!-- .container -->
	</header><!-- .page-header -->

	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div id="primary" class="content-area">
					<main id="main" class="site-main" role="main">
						<div class="error-404 not-found">
							<div class="page-content">
								<h2><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'beonepage' ); ?></h2>
								<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'beonepage' ); ?></p>

								<?php get_search_form(); ?>
							</div><!-- .page-content -->
						</div><!-- .error-404 -->
					</main><!-- #main -->
				</div><!-- #primary -->
			</div><!-- col-md-12 -->
		</div><!-- .row -->
	</div><!-- .container -->

<?php get_footer(); ?>
