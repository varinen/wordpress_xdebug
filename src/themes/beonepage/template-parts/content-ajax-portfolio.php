<?php
/**
 * Template part for displaying portfolio posts with Ajax.
 *
 * @package BeOnePage
 */

$next_id = isset( $_POST['portfolio_next'] ) ? $_POST['portfolio_next'] : '';
$prev_id = isset( $_POST['portfolio_prev'] ) ? $_POST['portfolio_prev'] : '';
$portfolio_id = isset( $_POST['portfolio_id'] ) ? $_POST['portfolio_id'] : '';
$post_id = str_replace( 'portfolio-item-', '', $portfolio_id );
?>

<div id="portfolio-ajax-single" class="portfolio-ajax-single clearfix">
	<div class="portfolio-single-image col-md-7">
		<?php
			if ( has_post_thumbnail( $post_id ) ) {
				$thumb_id = get_post_thumbnail_id( $post_id );
				$thumb_url = wp_get_attachment_image_src( $thumb_id, 'full' );

				printf( '<a href="%1$s" data-lightbox="image">%2$s</a>', esc_url( $thumb_url[0] ), get_the_post_thumbnail( $post_id, 'full', array( 'class' => 'image-fade' ) ) );
			} else {
				printf( '<img class="image-fade" src="%s">', esc_url( get_template_directory_uri() . '/images/portfolio-placeholder.png' ) );
			}
		?>
	</div><!-- #portfolio-item-id -->

    <div id="portfolio-single-content" class="col-md-5">
		<div class="portfolio-single-content">
			<div class="portfolio-ajax-title">
				<h2><?php echo get_the_title( $post_id ); ?></h2>

				<div id="portfolio-navigation">
					<?php if ( $prev_id ) { ?>
						<a href="#prev-portfolio" id="prev-portfolio" data-id="<?php echo esc_attr($prev_id); ?>"><i class="fa fa-arrow-circle-left"></i></a>
					<?php } ?>

					<a href="#close-portfolio" id="close-portfolio"><i class="fa fa-times-circle"></i></a>

					<?php if ( $next_id ) { ?>
						<a href="#next-portfolio" id="next-portfolio" data-id="<?php echo esc_attr($next_id); ?>"><i class="fa fa-arrow-circle-right"></i></a>
					<?php } ?>
				</div><!-- #portfolio-navigation -->
			</div><!-- .portfolio-ajax-title -->

			<?php echo apply_filters( 'the_content', get_post_field( 'post_content', $post_id ) ); ?>

			<div class="line"></div>

			<ul class="portfolio-meta">
				<?php
					$author = get_post_meta( $post_id, '_beonepage_option_author', true );
					$date = get_post_meta( $post_id, '_beonepage_option_date', true );
					$skill = get_post_meta( $post_id, '_beonepage_option_skill', true );
					$client_name = get_post_meta( $post_id, '_beonepage_option_client_name', true );
					$client_url = get_post_meta( $post_id, '_beonepage_option_client_url', true );

					if ( $author != '' ) {
						printf( '<li><span><i class="fa fa-user"></i>%1$s:</span> %2$s</li>', esc_html__( 'Created by', 'beonepage' ), esc_html( $author ) );
					}

					if ( $date != '' ) {
						printf( '<li><span><i class="fa fa-calendar-check-o"></i>%1$s:</span> %2$s</li>', esc_html__( 'Completed on', 'beonepage' ), esc_html( $date ) );
					}

					if ( $skill != '' ) {
						printf( '<li><span><i class="fa fa-lightbulb-o"></i>%1$s:</span> %2$s</li>', esc_html__( 'Skills', 'beonepage' ), esc_html( $skill ) );
					}

					if ( $client_name != '' ) {
						printf( '<li><span><i class="fa fa-link"></i>%1$s:</span> <a href="%2$s" target="_blank">%3$s</a></li>', esc_html__( 'Client', 'beonepage' ), esc_url( $client_url ), esc_html( $client_name ) );
					}
				?>
			</ul><!-- .portfolio-meta -->
		</div><!-- .portfolio-single-content -->
    </div><!-- #portfolio-single-content -->
</div>
