<?php
/**
 * Search Form Template
 *
 * @package BeOnePage
 */
?>

<form name="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" role="search">
	<div class="search-wrap">
		<button class="search-btn" type="submit"><i class="fa fa-search"></i></button>

		<input type="text" name="s" id="search" class="form-control search-field" placeholder="<?php esc_attr_e( 'Search', 'beonepage' ); ?>">
	</div><!-- .search-wrap -->
</form>
