<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package BeOnePage
 */

get_header(); ?>

	<header class="page-header img-background clearfix">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h1 class="page-title"><?php echo esc_html( get_the_title( get_option( 'page_for_posts' ) ) ); ?></h1>

					<?php beonepage_get_breadcrumbs(); ?>
				</div><!-- col-md-12 -->
			</div><!-- .row -->
		</div><!-- .container -->
	</header><!-- .page-header -->

	<div class="container">
		<div class="row">
			<div class="col-md-9">
				<div id="primary" class="content-area">
					<main id="main" class="site-main" role="main">
						<?php
							while ( have_posts() ) : the_post();
								get_template_part( 'template-parts/content', 'single' );

								beonepage_post_navigation();

								// If comments are open or we have at least one comment, load up the comment template.
								if ( comments_open() || get_comments_number() ) {
									comments_template();
								}
							endwhile; // End of the loop.
						?>
					</main><!-- #main -->
				</div><!-- #primary -->
			</div><!-- col-md-9 -->

			<?php get_sidebar(); ?>
		</div><!-- .row -->
	</div><!-- .container -->

<?php get_footer(); ?>
