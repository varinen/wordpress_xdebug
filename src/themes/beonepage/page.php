<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
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
						the_title( '<h1 class="page-title">', '</h1>' );

						beonepage_get_breadcrumbs();
					?>
				</div><!-- col-md-12 -->
			</div><!-- .row -->
		</div><!-- .container -->
	</header><!-- .page-header -->

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div id="primary" class="content-area">
					<main id="main" class="site-main" role="main">
						<?php
							while ( have_posts() ) : the_post();
								get_template_part( 'template-parts/content', 'page' );
							
								// If comments are open or we have at least one comment, load up the comment template.
								if ( comments_open() || get_comments_number() ) {
									comments_template();
								}
							endwhile; // End of the loop.
						?>
					</main><!-- #main -->
				</div><!-- #primary -->
			</div><!-- col-md-12 -->
		</div><!-- .row -->
	</div><!-- .container -->

<?php get_footer(); ?>
