<?php
/**
 * Internationalization helper.
 *
 * @package     Kirki
 * @category    Core
 * @author      Aristeides Stathopoulos
 * @copyright   Copyright (c) 2016, Aristeides Stathopoulos
 * @license     http://opensource.org/licenses/https://opensource.org/licenses/MIT
 * @since       1.0
 */

if ( ! class_exists( 'Kirki_l10n' ) ) {

	/**
	 * Handles translations
	 */
	class Kirki_l10n {

		/**
		 * The plugin textdomain
		 *
		 * @access protected
		 * @var string
		 */
		protected $textdomain = 'beonepage';

		/**
		 * The class constructor.
		 * Adds actions & filters to handle the rest of the methods.
		 *
		 * @access public
		 */
		public function __construct() {

			add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );

		}

		/**
		 * Load the plugin textdomain
		 *
		 * @access public
		 */
		public function load_textdomain() {

			if ( null !== $this->get_path() ) {
				load_textdomain( $this->textdomain, $this->get_path() );
			}
			load_plugin_textdomain( $this->textdomain, false, Kirki::$path . '/languages' );

		}

		/**
		 * Gets the path to a translation file.
		 *
		 * @access protected
		 * @return string Absolute path to the translation file.
		 */
		protected function get_path() {
			$path_found = false;
			$found_path = null;
			foreach ( $this->get_paths() as $path ) {
				if ( $path_found ) {
					continue;
				}
				$path = wp_normalize_path( $path );
				if ( file_exists( $path ) ) {
					$path_found = true;
					$found_path = $path;
				}
			}

			return $found_path;

		}

		/**
		 * Returns an array of paths where translation files may be located.
		 *
		 * @access protected
		 * @return array
		 */
		protected function get_paths() {

			return array(
				WP_LANG_DIR . '/' . $this->textdomain . '-' . get_locale() . '.mo',
				Kirki::$path . '/languages/' . $this->textdomain . '-' . get_locale() . '.mo',
			);

		}

		/**
		 * Shortcut method to get the translation strings
		 *
		 * @static
		 * @access public
		 * @param string $config_id The config ID. See Kirki_Config.
		 * @return array
		 */
		public static function get_strings( $config_id = 'global' ) {

			$translation_strings = array(
				'background-color'      => esc_attr__( 'Background Color', 'beonepage' ),
				'background-image'      => esc_attr__( 'Background Image', 'beonepage' ),
				'no-repeat'             => esc_attr__( 'No Repeat', 'beonepage' ),
				'repeat-all'            => esc_attr__( 'Repeat All', 'beonepage' ),
				'repeat-x'              => esc_attr__( 'Repeat Horizontally', 'beonepage' ),
				'repeat-y'              => esc_attr__( 'Repeat Vertically', 'beonepage' ),
				'inherit'               => esc_attr__( 'Inherit', 'beonepage' ),
				'background-repeat'     => esc_attr__( 'Background Repeat', 'beonepage' ),
				'cover'                 => esc_attr__( 'Cover', 'beonepage' ),
				'contain'               => esc_attr__( 'Contain', 'beonepage' ),
				'background-size'       => esc_attr__( 'Background Size', 'beonepage' ),
				'fixed'                 => esc_attr__( 'Fixed', 'beonepage' ),
				'scroll'                => esc_attr__( 'Scroll', 'beonepage' ),
				'background-attachment' => esc_attr__( 'Background Attachment', 'beonepage' ),
				'left-top'              => esc_attr__( 'Left Top', 'beonepage' ),
				'left-center'           => esc_attr__( 'Left Center', 'beonepage' ),
				'left-bottom'           => esc_attr__( 'Left Bottom', 'beonepage' ),
				'right-top'             => esc_attr__( 'Right Top', 'beonepage' ),
				'right-center'          => esc_attr__( 'Right Center', 'beonepage' ),
				'right-bottom'          => esc_attr__( 'Right Bottom', 'beonepage' ),
				'center-top'            => esc_attr__( 'Center Top', 'beonepage' ),
				'center-center'         => esc_attr__( 'Center Center', 'beonepage' ),
				'center-bottom'         => esc_attr__( 'Center Bottom', 'beonepage' ),
				'background-position'   => esc_attr__( 'Background Position', 'beonepage' ),
				'background-opacity'    => esc_attr__( 'Background Opacity', 'beonepage' ),
				'on'                    => esc_attr__( 'ON', 'beonepage' ),
				'off'                   => esc_attr__( 'OFF', 'beonepage' ),
				'all'                   => esc_attr__( 'All', 'beonepage' ),
				'cyrillic'              => esc_attr__( 'Cyrillic', 'beonepage' ),
				'cyrillic-ext'          => esc_attr__( 'Cyrillic Extended', 'beonepage' ),
				'devanagari'            => esc_attr__( 'Devanagari', 'beonepage' ),
				'greek'                 => esc_attr__( 'Greek', 'beonepage' ),
				'greek-ext'             => esc_attr__( 'Greek Extended', 'beonepage' ),
				'khmer'                 => esc_attr__( 'Khmer', 'beonepage' ),
				'latin'                 => esc_attr__( 'Latin', 'beonepage' ),
				'latin-ext'             => esc_attr__( 'Latin Extended', 'beonepage' ),
				'vietnamese'            => esc_attr__( 'Vietnamese', 'beonepage' ),
				'hebrew'                => esc_attr__( 'Hebrew', 'beonepage' ),
				'arabic'                => esc_attr__( 'Arabic', 'beonepage' ),
				'bengali'               => esc_attr__( 'Bengali', 'beonepage' ),
				'gujarati'              => esc_attr__( 'Gujarati', 'beonepage' ),
				'tamil'                 => esc_attr__( 'Tamil', 'beonepage' ),
				'telugu'                => esc_attr__( 'Telugu', 'beonepage' ),
				'thai'                  => esc_attr__( 'Thai', 'beonepage' ),
				'serif'                 => _x( 'Serif', 'font style', 'beonepage' ),
				'sans-serif'            => _x( 'Sans Serif', 'font style', 'beonepage' ),
				'monospace'             => _x( 'Monospace', 'font style', 'beonepage' ),
				'font-family'           => esc_attr__( 'Font Family', 'beonepage' ),
				'font-size'             => esc_attr__( 'Font Size', 'beonepage' ),
				'font-weight'           => esc_attr__( 'Font Weight', 'beonepage' ),
				'line-height'           => esc_attr__( 'Line Height', 'beonepage' ),
				'font-style'            => esc_attr__( 'Font Style', 'beonepage' ),
				'letter-spacing'        => esc_attr__( 'Letter Spacing', 'beonepage' ),
				'top'                   => esc_attr__( 'Top', 'beonepage' ),
				'bottom'                => esc_attr__( 'Bottom', 'beonepage' ),
				'left'                  => esc_attr__( 'Left', 'beonepage' ),
				'right'                 => esc_attr__( 'Right', 'beonepage' ),
				'center'                => esc_attr__( 'Center', 'beonepage' ),
				'justify'               => esc_attr__( 'Justify', 'beonepage' ),
				'color'                 => esc_attr__( 'Color', 'beonepage' ),
				'add-image'             => esc_attr__( 'Add Image', 'beonepage' ),
				'change-image'          => esc_attr__( 'Change Image', 'beonepage' ),
				'no-image-selected'     => esc_attr__( 'No Image Selected', 'beonepage' ),
				'add-file'              => esc_attr__( 'Add File', 'beonepage' ),
				'change-file'           => esc_attr__( 'Change File', 'beonepage' ),
				'no-file-selected'      => esc_attr__( 'No File Selected', 'beonepage' ),
				'remove'                => esc_attr__( 'Remove', 'beonepage' ),
				'select-font-family'    => esc_attr__( 'Select a font-family', 'beonepage' ),
				'variant'               => esc_attr__( 'Variant', 'beonepage' ),
				'subsets'               => esc_attr__( 'Subset', 'beonepage' ),
				'size'                  => esc_attr__( 'Size', 'beonepage' ),
				'height'                => esc_attr__( 'Height', 'beonepage' ),
				'spacing'               => esc_attr__( 'Spacing', 'beonepage' ),
				'ultra-light'           => esc_attr__( 'Ultra-Light 100', 'beonepage' ),
				'ultra-light-italic'    => esc_attr__( 'Ultra-Light 100 Italic', 'beonepage' ),
				'light'                 => esc_attr__( 'Light 200', 'beonepage' ),
				'light-italic'          => esc_attr__( 'Light 200 Italic', 'beonepage' ),
				'book'                  => esc_attr__( 'Book 300', 'beonepage' ),
				'book-italic'           => esc_attr__( 'Book 300 Italic', 'beonepage' ),
				'regular'               => esc_attr__( 'Normal 400', 'beonepage' ),
				'italic'                => esc_attr__( 'Normal 400 Italic', 'beonepage' ),
				'medium'                => esc_attr__( 'Medium 500', 'beonepage' ),
				'medium-italic'         => esc_attr__( 'Medium 500 Italic', 'beonepage' ),
				'semi-bold'             => esc_attr__( 'Semi-Bold 600', 'beonepage' ),
				'semi-bold-italic'      => esc_attr__( 'Semi-Bold 600 Italic', 'beonepage' ),
				'bold'                  => esc_attr__( 'Bold 700', 'beonepage' ),
				'bold-italic'           => esc_attr__( 'Bold 700 Italic', 'beonepage' ),
				'extra-bold'            => esc_attr__( 'Extra-Bold 800', 'beonepage' ),
				'extra-bold-italic'     => esc_attr__( 'Extra-Bold 800 Italic', 'beonepage' ),
				'ultra-bold'            => esc_attr__( 'Ultra-Bold 900', 'beonepage' ),
				'ultra-bold-italic'     => esc_attr__( 'Ultra-Bold 900 Italic', 'beonepage' ),
				'invalid-value'         => esc_attr__( 'Invalid Value', 'beonepage' ),
				'add-new'           	=> esc_attr__( 'Add new', 'beonepage' ),
				'row'           		=> esc_attr__( 'row', 'beonepage' ),
				'limit-rows'            => esc_attr__( 'Limit: %s rows', 'beonepage' ),
				'open-section'          => esc_attr__( 'Press return or enter to open this section', 'beonepage' ),
				'back'                  => esc_attr__( 'Back', 'beonepage' ),
				'reset-with-icon'       => sprintf( esc_attr__( '%s Reset', 'beonepage' ), '<span class="dashicons dashicons-image-rotate"></span>' ),
				'text-align'            => esc_attr__( 'Text Align', 'beonepage' ),
				'text-transform'        => esc_attr__( 'Text Transform', 'beonepage' ),
				'none'                  => esc_attr__( 'None', 'beonepage' ),
				'capitalize'            => esc_attr__( 'Capitalize', 'beonepage' ),
				'uppercase'             => esc_attr__( 'Uppercase', 'beonepage' ),
				'lowercase'             => esc_attr__( 'Lowercase', 'beonepage' ),
				'initial'               => esc_attr__( 'Initial', 'beonepage' ),
				'select-page'           => esc_attr__( 'Select a Page', 'beonepage' ),
				'open-editor'           => esc_attr__( 'Open Editor', 'beonepage' ),
				'close-editor'          => esc_attr__( 'Close Editor', 'beonepage' ),
				'switch-editor'         => esc_attr__( 'Switch Editor', 'beonepage' ),
				'hex-value'             => esc_attr__( 'Hex Value', 'beonepage' ),
			);

			// Apply global changes from the kirki/config filter.
			// This is generally to be avoided.
			// It is ONLY provided here for backwards-compatibility reasons.
			// Please use the kirki/{$config_id}/l10n filter instead.
			$config = apply_filters( 'kirki/config', array() );
			if ( isset( $config['i18n'] ) ) {
				$translation_strings = wp_parse_args( $config['i18n'], $translation_strings );
			}

			// Apply l10n changes using the kirki/{$config_id}/l10n filter.
			return apply_filters( 'kirki/' . $config_id . '/l10n', $translation_strings );

		}
	}
}
