<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package BeOnePage
 */

get_header(); ?>

	<?php if ( is_home() ) : ?>
		<header class="page-header img-background clearfix">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h1 class="page-title"><?php single_post_title(); ?></h1>

						<?php beonepage_get_breadcrumbs(); ?>
					</div><!-- col-md-12 -->
				</div><!-- .row -->
			</div><!-- .container -->
		</header><!-- .page-header -->
	<?php endif; ?>

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
