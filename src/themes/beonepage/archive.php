<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package BeOnePage
 */

get_header(); ?>

	<header class="page-header img-background clearfix">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<?php
						the_archive_title( '<h1 class="page-title">', '</h1>' );

						beonepage_get_breadcrumbs();
					?>
				</div><!-- col-md-12 -->
			</div><!-- .row -->
		</div><!-- .container -->
	</header><!-- .page-header -->

	<div class="container">
		<div class="row">
			<div class="col-md-9">
				<div id="primary" class="content-area blog-list">
					<main id="main" class="site-main" role="main">
						<?php
							if ( have_posts() ) {
								while ( have_posts() ) : the_post();
									/*
									 * Include the Post-Format-specific template for the content.
									 * If you want to override this in a child theme, then include a file
									 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
									 */
									get_template_part( 'template-parts/content', get_post_format() );
								
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
