<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package BeOnePage
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function beonepage_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class for front page.
	if ( is_front_page() ) {
		$classes[] = 'front-page';
	}

	return $classes;
}
add_filter( 'body_class', 'beonepage_body_classes' );

/**
 * Get theme version.
 *
 * @return string $theme_version The theme version.
 */
function beonepage_get_version() {
	$theme_info = wp_get_theme();

	// If it's a child theme, then get parent theme.
	if ( is_child_theme() ) {
		$theme_info = wp_get_theme( $theme_info->parent_theme );
	}

	$theme_version = $theme_info->display( 'Version' );

	return $theme_version;
}

/**
 * Register the required plugins for this theme.
 *
 * @link https://github.com/TGMPA/TGM-Plugin-Activation
 */
function beonepage_register_required_plugins() {
	// Required plugin.
	$plugins = array(
		array(
			'name'               => 'BeOnePage Lite Plugin',
			'slug'               => 'beonepage-lite',
			'required'           => false,
			'version'            => '1.0.0',
			'force_activation'   => true,
			'force_deactivation' => true
		),
	);

	// Array of configuration settings.
	$config = array(
		'id'           => 'beonepage_tgmpa',
		'default_path' => '',
		'menu'         => 'beonepage-install-plugins',
		'parent_slug'  => 'themes.php',
		'capability'   => 'edit_theme_options',
		'has_notices'  => true,
		'dismissable'  => true,
		'is_automatic' => true
	);

	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'beonepage_register_required_plugins' );

/**
 * The notification to upgrade to Pro version.
 *
 * @return string $output The upgrade notification.
 */
function beonepage_premium_info() {
	$output = sprintf (
				'%1$s <a href="%2$s" target="_blank">BeOnePage Pro</a> %3$s <a href="%4$s" class="thickbox" title="BeOnePage Pro">%5$s</a> %6$s.',
				esc_html__( 'Upgrade to', 'beonepage' ),
				esc_url( 'http://betheme.me/themes/beonepage/' ),
				esc_html__( 'to enjoy', 'beonepage' ),
				esc_url( 'http://betheme.me/themes/beonepage/?TB_iframe=true&width=1024&height=800' ),
				esc_html__( 'Premium Features', 'beonepage' ),
				esc_html__( 'and support continued development', 'beonepage' )
			);

	return $output;
}

/**
 * Only show blog posts in search results.
 *
 * @param array $query The WP_Query object.
 */

function beonepage_search_filter( $query ) {
    if ( ! is_admin() && $query->is_main_query() ) {
		if ( $query->is_search ) {
			$query->set( 'post_type', array( 'post' ) );
		}
	}
}
add_filter( 'pre_get_posts', 'beonepage_search_filter' );

/**
 * Get the current URL of the page being viewed.
 *
 * @global object $wp
 * @return string $current_url Current URL.
 */
function beonepage_get_current_url() {
	global $wp;

	if ( empty( $_SERVER['QUERY_STRING'] ) )
		$current_url = trailingslashit( home_url( $wp->request ) );
	else
		$current_url = add_query_arg( $_SERVER['QUERY_STRING'], '', trailingslashit( home_url( $wp->request ) ) );

	return $current_url;
}

/**
 * Filter to remove thumbnail image dimension attributes.
 *
 * @return string $html The HTML codes without width and height attributes.
 */
function beonepage_remove_thumbnail_dimensions( $html, $post_id, $post_image_id ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', '', $html );

    return $html;
}
add_filter( 'post_thumbnail_html', 'beonepage_remove_thumbnail_dimensions', 10, 3 );

/**
 * Change the excerpt length.
 */
function beonepage_custom_excerpt_length( $length ) {
	return 60;
}
add_filter( 'excerpt_length', 'beonepage_custom_excerpt_length', 999 );

/**
 * Change the excerpt more string at the end.
 */
function beonepage_new_excerpt_more( $more ) {
	return ' &hellip;';
}
add_filter( 'excerpt_more', 'beonepage_new_excerpt_more' );

/**
 * Include the Portfolio details template.
 */
function beonepage_ajax_portfolio() {
	
	get_template_part( 'template-parts/content', 'ajax-portfolio' );

	wp_die();
}
add_action( 'wp_ajax_ajax_portfolio', 'beonepage_ajax_portfolio' );
add_action( 'wp_ajax_nopriv_ajax_portfolio', 'beonepage_ajax_portfolio' );

/**
 * Set/unset post as image post type if post has thumbnail.
 *
 * @param int $post_id The post ID.
 */
function beonepage_set_post_type( $post_id ) {
	global $pagenow; 

	if ( in_array( $pagenow, array( 'post.php', 'post-new.php' ) ) ) {
		if ( get_post_type( $post_id ) == 'post' ) {
			if ( has_post_thumbnail( $post_id ) ) {
				set_post_format( $post->ID, 'image' );
			}

			if ( ! has_post_thumbnail( $post_id ) ) {
				set_post_format( $post->ID, '' );
			}
		}
	}
}
add_action( 'save_post', 'beonepage_set_post_type', 10, 3 );



/**
 * Remove Recent Comments Widget style from header.
 */
function beonepage_remove_recent_comments_style() {  
	global $wp_widget_factory;  

	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );  
}  
add_action( 'widgets_init', 'beonepage_remove_recent_comments_style' );

/**
 * Change the font size for Tag Cloud widget.
 */
function beonepage_custom_tag_cloud_font( $args ) {
	$custom_args = array( 'smallest' => 10, 'largest' => 10 );
	$args = wp_parse_args( $args, $custom_args );

	return $args;
}
add_filter( 'widget_tag_cloud_args', 'beonepage_custom_tag_cloud_font' );



/**
 * Update option after Customizer save.
 */
function beonepage_customize_save_after() {
	update_option( 'blogname', Kirki::get_option( 'general_site_title' ) );

	if ( Kirki::get_option( 'general_front_page' ) != '0' ) {
		update_option( 'show_on_front ', 'page' );
		update_option( 'page_on_front', Kirki::get_option( 'general_front_page' ) );
		update_option( 'page_for_posts', Kirki::get_option( 'general_posts_page' ) );
	}
}
add_action( 'customize_save_after', 'beonepage_customize_save_after' );

/**
 * Set option data when Customizer controls are initialized.
 */
function beonepage_customize_controls_init() {
	set_theme_mod( 'general_site_title', get_bloginfo( 'name' ) );
	set_theme_mod( 'general_front_page', get_option( 'page_on_front' ) );
	set_theme_mod( 'general_posts_page', get_option( 'page_for_posts' ) );
}
add_action( 'customize_controls_init', 'beonepage_customize_controls_init' );

/**
 * Enqueue scripts and styles for admin pages.
 */
function beonepage_admin_scripts() {
	global $pagenow;

	if ( ! is_admin() ) {
		return;
	}

	if ( in_array( $pagenow, array( 'nav-menus.php', 'post.php', 'post-new.php', 'themes.php', 'update-core.php' ) ) ) {
		wp_enqueue_script( 'beonepage-admin-script', get_template_directory_uri() . '/js/admin.js', array(), beonepage_get_version(), true );
	}

	// Localize the script with new data.
	wp_localize_script( 'beonepage-admin-script', 'be_admin_vars', array(
		'screen'            => $pagenow,
		's_icon_found'      => esc_html__( 'icon found.', 'beonepage' ),
		'p_icons_found'     => esc_html__( 'icons found.', 'beonepage' ),
		'no_icons_found'    => esc_html__( 'No icons found.', 'beonepage' ),
		'upgrade_available' => esc_html__( 'Upgrade to Pro Version', 'beonepage' ),
		'upgrade_info'      => beonepage_premium_info()
	) );
}
add_action( 'admin_enqueue_scripts', 'beonepage_admin_scripts' );

/**
 * Get font icons list.
 *
 * @return array $font_icons
 */
function beonepage_icon_list() {
	$font_icons = array(
		'glass', 'music', 'search', 'envelope-o', 'heart', 'star', 'star-o', 'user', 'film', 'th-large', 'th', 'th-list', 'check', 'remove', 'close', 'times', 'search-plus', 'search-minus', 'power-off', 'signal', 'gear', 'cog', 'trash-o', 'home', 'file-o', 'clock-o', 'road', 'download', 'arrow-circle-o-down', 'arrow-circle-o-up', 'inbox', 'play-circle-o', 'rotate-right', 'repeat', 'refresh', 'list-alt', 'lock', 'flag', 'headphones', 'volume-off', 'volume-down', 'volume-up', 'qrcode', 'barcode', 'tag', 'tags', 'book', 'bookmark', 'print', 'camera', 'font', 'bold', 'italic', 'text-height', 'text-width', 'align-left', 'align-center', 'align-right', 'align-justify', 'list', 'dedent', 'outdent', 'indent', 'video-camera', 'photo', 'image', 'picture-o', 'pencil', 'map-marker', 'adjust', 'tint', 'edit', 'pencil-square-o', 'share-square-o', 'check-square-o', 'arrows', 'step-backward', 'fast-backward', 'backward', 'play', 'pause', 'stop', 'forward', 'fast-forward', 'step-forward', 'eject', 'chevron-left', 'chevron-right', 'plus-circle', 'minus-circle', 'times-circle', 'check-circle', 'question-circle', 'info-circle', 'crosshairs', 'times-circle-o', 'check-circle-o', 'ban', 'arrow-left', 'arrow-right', 'arrow-up', 'arrow-down', 'mail-forward', 'share', 'expand', 'compress', 'plus', 'minus', 'asterisk', 'exclamation-circle', 'gift', 'leaf', 'fire', 'eye', 'eye-slash', 'warning', 'exclamation-triangle', 'plane', 'calendar', 'random', 'comment', 'magnet', 'chevron-up', 'chevron-down', 'retweet', 'shopping-cart', 'folder', 'folder-open', 'arrows-v', 'arrows-h', 'bar-chart-o', 'bar-chart', 'twitter-square', 'facebook-square', 'camera-retro', 'key', 'gears', 'cogs', 'comments', 'thumbs-o-up', 'thumbs-o-down', 'star-half', 'heart-o', 'sign-out', 'linkedin-square', 'thumb-tack', 'external-link', 'sign-in', 'trophy', 'github-square', 'upload', 'lemon-o', 'phone', 'square-o', 'bookmark-o', 'phone-square', 'twitter', 'facebook-f', 'facebook', 'github', 'unlock', 'credit-card', 'feed', 'rss', 'hdd-o', 'bullhorn', 'bell', 'certificate', 'hand-o-right', 'hand-o-left', 'hand-o-up', 'hand-o-down', 'arrow-circle-left', 'arrow-circle-right', 'arrow-circle-up', 'arrow-circle-down', 'globe', 'wrench', 'tasks', 'filter', 'briefcase', 'arrows-alt', 'group', 'users', 'chain', 'link', 'cloud', 'flask', 'cut', 'scissors', 'copy', 'files-o', 'paperclip', 'save', 'floppy-o', 'square', 'navicon', 'reorder', 'bars', 'list-ul', 'list-ol', 'strikethrough', 'underline', 'table', 'magic', 'truck', 'pinterest', 'pinterest-square', 'google-plus-square', 'google-plus', 'money', 'caret-down', 'caret-up', 'caret-left', 'caret-right', 'columns', 'unsorted', 'sort', 'sort-down', 'sort-desc', 'sort-up', 'sort-asc', 'envelope', 'linkedin', 'rotate-left', 'undo', 'legal', 'gavel', 'dashboard', 'tachometer', 'comment-o', 'comments-o', 'flash', 'bolt', 'sitemap', 'umbrella', 'paste', 'clipboard', 'lightbulb-o', 'exchange', 'cloud-download', 'cloud-upload', 'user-md', 'stethoscope', 'suitcase', 'bell-o', 'coffee', 'cutlery', 'file-text-o', 'building-o', 'hospital-o', 'ambulance', 'medkit', 'fighter-jet', 'beer', 'h-square', 'plus-square', 'angle-double-left', 'angle-double-right', 'angle-double-up', 'angle-double-down', 'angle-left', 'angle-right', 'angle-up', 'angle-down', 'desktop', 'laptop', 'tablet', 'mobile-phone', 'mobile', 'circle-o', 'quote-left', 'quote-right', 'spinner', 'circle', 'mail-reply', 'reply', 'github-alt', 'folder-o', 'folder-open-o', 'smile-o', 'frown-o', 'meh-o', 'gamepad', 'keyboard-o', 'flag-o', 'flag-checkered', 'terminal', 'code', 'mail-reply-all', 'reply-all', 'star-half-empty', 'star-half-full', 'star-half-o', 'location-arrow', 'crop', 'code-fork', 'unlink', 'chain-broken', 'question', 'info', 'exclamation', 'superscript', 'subscript', 'eraser', 'puzzle-piece', 'microphone', 'microphone-slash', 'shield', 'calendar-o', 'fire-extinguisher', 'rocket', 'maxcdn', 'chevron-circle-left', 'chevron-circle-right', 'chevron-circle-up', 'chevron-circle-down', 'html5', 'css3', 'anchor', 'unlock-alt', 'bullseye', 'ellipsis-h', 'ellipsis-v', 'rss-square', 'play-circle', 'ticket', 'minus-square', 'minus-square-o', 'level-up', 'level-down', 'check-square', 'pencil-square', 'external-link-square', 'share-square', 'compass', 'toggle-down', 'caret-square-o-down', 'toggle-up', 'caret-square-o-up', 'toggle-right', 'caret-square-o-right', 'euro', 'eur', 'gbp', 'dollar', 'usd', 'rupee', 'inr', 'cny', 'rmb', 'yen', 'jpy', 'ruble', 'rouble', 'rub', 'won', 'krw', 'bitcoin', 'btc', 'file', 'file-text', 'sort-alpha-asc', 'sort-alpha-desc', 'sort-amount-asc', 'sort-amount-desc', 'sort-numeric-asc', 'sort-numeric-desc', 'thumbs-up', 'thumbs-down', 'youtube-square', 'youtube', 'xing', 'xing-square', 'youtube-play', 'dropbox', 'stack-overflow', 'instagram', 'flickr', 'adn', 'bitbucket', 'bitbucket-square', 'tumblr', 'tumblr-square', 'long-arrow-down', 'long-arrow-up', 'long-arrow-left', 'long-arrow-right', 'apple', 'windows', 'android', 'linux', 'dribbble', 'skype', 'foursquare', 'trello', 'female', 'male', 'gittip', 'gratipay', 'sun-o', 'moon-o', 'archive', 'bug', 'vk', 'weibo', 'renren', 'pagelines', 'stack-exchange', 'arrow-circle-o-right', 'arrow-circle-o-left', 'toggle-left', 'caret-square-o-left', 'dot-circle-o', 'wheelchair', 'vimeo-square', 'turkish-lira', 'try', 'plus-square-o', 'space-shuttle', 'slack', 'envelope-square', 'wordpress', 'openid', 'institution', 'bank', 'university', 'mortar-board', 'graduation-cap', 'yahoo', 'google', 'reddit', 'reddit-square', 'stumbleupon-circle', 'stumbleupon', 'delicious', 'digg', 'pied-piper', 'pied-piper-alt', 'drupal', 'joomla', 'language', 'fax', 'building', 'child', 'paw', 'spoon', 'cube', 'cubes', 'behance', 'behance-square', 'steam', 'steam-square', 'recycle', 'automobile', 'car', 'cab', 'taxi', 'tree', 'spotify', 'deviantart', 'soundcloud', 'database', 'file-pdf-o', 'file-word-o', 'file-excel-o', 'file-powerpoint-o', 'file-photo-o', 'file-picture-o', 'file-image-o', 'file-zip-o', 'file-archive-o', 'file-sound-o', 'file-audio-o', 'file-movie-o', 'file-video-o', 'file-code-o', 'vine', 'codepen', 'jsfiddle', 'life-bouy', 'life-buoy', 'life-saver', 'support', 'life-ring', 'circle-o-notch', 'ra', 'rebel', 'ge', 'empire', 'git-square', 'git', 'y-combinator-square', 'yc-square', 'hacker-news', 'tencent-weibo', 'qq', 'wechat', 'weixin', 'send', 'paper-plane', 'send-o', 'paper-plane-o', 'history', 'circle-thin', 'header', 'paragraph', 'sliders', 'share-alt', 'share-alt-square', 'bomb', 'soccer-ball-o', 'futbol-o', 'tty', 'binoculars', 'plug', 'slideshare', 'twitch', 'yelp', 'newspaper-o', 'wifi', 'calculator', 'paypal', 'google-wallet', 'cc-visa', 'cc-mastercard', 'cc-discover', 'cc-amex', 'cc-paypal', 'cc-stripe', 'bell-slash', 'bell-slash-o', 'trash', 'copyright', 'at', 'eyedropper', 'paint-brush', 'birthday-cake', 'area-chart', 'pie-chart', 'line-chart', 'lastfm', 'lastfm-square', 'toggle-off', 'toggle-on', 'bicycle', 'bus', 'ioxhost', 'angellist', 'cc', 'shekel', 'sheqel', 'ils', 'meanpath', 'buysellads', 'connectdevelop', 'dashcube', 'forumbee', 'leanpub', 'sellsy', 'shirtsinbulk', 'simplybuilt', 'skyatlas', 'cart-plus', 'cart-arrow-down', 'diamond', 'ship', 'user-secret', 'motorcycle', 'street-view', 'heartbeat', 'venus', 'mars', 'mercury', 'intersex', 'transgender', 'transgender-alt', 'venus-double', 'mars-double', 'venus-mars', 'mars-stroke', 'mars-stroke-v', 'mars-stroke-h', 'neuter', 'genderless', 'facebook-official', 'pinterest-p', 'whatsapp', 'server', 'user-plus', 'user-times', 'hotel', 'bed', 'viacoin', 'train', 'subway', 'medium', 'yc', 'y-combinator', 'optin-monster', 'opencart', 'expeditedssl', 'battery-4', 'battery-full', 'battery-3', 'battery-three-quarters', 'battery-2', 'battery-half', 'battery-1', 'battery-quarter', 'battery-0', 'battery-empty', 'mouse-pointer', 'i-cursor', 'object-group', 'object-ungroup', 'sticky-note', 'sticky-note-o', 'cc-jcb', 'cc-diners-club', 'clone', 'balance-scale', 'hourglass-o', 'hourglass-1', 'hourglass-start', 'hourglass-2', 'hourglass-half', 'hourglass-3', 'hourglass-end', 'hourglass', 'hand-grab-o', 'hand-rock-o', 'hand-stop-o', 'hand-paper-o', 'hand-scissors-o', 'hand-lizard-o', 'hand-spock-o', 'hand-pointer-o', 'hand-peace-o', 'trademark', 'registered', 'creative-commons', 'gg', 'gg-circle', 'tripadvisor', 'odnoklassniki', 'odnoklassniki-square', 'get-pocket', 'wikipedia-w', 'safari', 'chrome', 'firefox', 'opera', 'internet-explorer', 'tv', 'television', 'contao', '500px', 'amazon', 'calendar-plus-o', 'calendar-minus-o', 'calendar-times-o', 'calendar-check-o', 'industry', 'map-pin', 'map-signs', 'map-o', 'map', 'commenting', 'commenting-o', 'houzz', 'vimeo', 'black-tie', 'fonticons', 'reddit-alien', 'edge', 'credit-card-alt', 'codiepie', 'modx', 'fort-awesome', 'usb', 'product-hunt', 'mixcloud', 'scribd', 'pause-circle', 'pause-circle-o', 'stop-circle', 'stop-circle-o', 'shopping-bag', 'shopping-basket', 'hashtag', 'bluetooth', 'bluetooth-b', 'percent'
	);

	return $font_icons;
}

function beonepage_menu_fallback( $args ) {
	if ( current_user_can( 'manage_options' ) ) {
		extract( $args );
		$fb_output = null;

		if ( $container ) {
			$fb_output = '<' . $container;

			if ( $container_id )
				$fb_output .= ' id="' . $container_id . '"';

			if ( $container_class )
				$fb_output .= ' class="' . $container_class . '"';

			$fb_output .= '>';
		}

		$fb_output .= '<ul';

		if ( $menu_id ) {
			$fb_output .= ' id="' . $menu_id . '"';
		}

		if ( $menu_class ) {
			$fb_output .= ' class="' . $menu_class . '"';
		}

		$fb_output .= '>';
		$fb_output .= '<li><a href="' . admin_url( 'nav-menus.php' ) . '">' . esc_html__( 'Add a menu', 'beonepage' ) . '</a></li>';
		$fb_output .= '</ul>';

		if ( $container ) {
			$fb_output .= '</' . $container . '>';
		}

		echo $fb_output;
	}
}
