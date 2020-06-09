/**
 * admin.js
 *
 * Contain all handlers for admin page.
 */
 
( function( $ ) {
	$( document ).ready( function() {
		$( '.theme[aria-describedby*="beonepage-lite"]' ).append( '<div class="theme-update">' + be_admin_vars.upgrade_available + '</div>' );

		$( '.theme' ).click( function() {
			var themeName = $( '.theme-info .theme-name' ).text();

			if ( themeName.indexOf( 'BeOnePage Lite' ) >= 0 ) {
				$( '.theme-overlay .theme-author' ).after( '<div class="theme-update-message"><h4 class="theme-update">' + be_admin_vars.upgrade_available + '</h4><p><strong>' + be_admin_vars.upgrade_info + '</strong></p></div>' );
			}
		} );

		$( '.plugin-title strong' ).each( function() {
			if ( $( this ).text() == 'BeOnePage Lite' ) {
				$( this ).parent().append( '<p>' + be_admin_vars.upgrade_info + '</p>' );
			}
		} );

		if ( be_admin_vars.screen == 'nav-menus.php' ) {
			// Icon for menu items.
			var	selected_icon,
				icon_item_object;

			// Trigger events when click "Choose Icon" and "Remove Icon" links.
			$( 'body' ).on( 'click', '.thickbox, a.remove-menu-icon', function() {
				icon_item_object = $( this );

				// Add class for selected icon.
				if ( icon_item_object.parents( 'div' ).children( '.field-menu-icon' ).find( 'input[type="hidden"]' ).val() ) {
					selected_icon = icon_item_object.parents( 'div' ).children( '.field-menu-icon' ).find( 'input[type="hidden"]' ).val();

					$( 'ul.font-icons li i.fa-' + selected_icon ).addClass( 'active' );
				}
			} );

			// Trigger events when select an icon.
			$( 'ul.font-icons li' ).click(function () {
				selected_icon = $( this ).attr( 'id' );

				icon_item_object.parents( 'div' ).children( '.field-menu-icon' ).find( 'input[type="hidden"]' ).val( selected_icon );
				icon_item_object.parents( 'div' ).children( '.field-menu-icon' ).find( 'i' ).removeClass().addClass( 'fa fa-' + selected_icon );
				$( 'ul.font-icons li i' ).removeClass( 'active' );

				tb_remove();

				$( '#TB_window #menu-icon-search' ).val( '' );
				$( '#TB_window ul.font-icons li' ).show();
				$( 'span#icons-search-result' ).hide();
			} );

			// Trigger events when click "Remove Icon" link.
			$( 'body' ).on( 'click', 'a.remove-menu-icon', function() {
				icon_item_object.parents( 'div' ).children( '.field-menu-icon' ).find( 'input[type="hidden"]' ).val( '' );
				icon_item_object.parents( 'div' ).children( '.field-menu-icon' ).find( 'i' ).removeClass().addClass( 'icon-none' );
				$( 'ul.font-icons li i' ).removeClass( 'active' );
			} );

			// Determine when a user has stopped typing in a text field.
			$( '#menu-icon-search' ).typeWatch( {
				wait: 500,
				highlight: false,
				captureLength: 0,
				callback: function() {
					var count = 0,
						val = $( this ).val().replace( ' ', '-' );

					// Icon search filter.
					$( '#TB_window ul.font-icons li' ).each( function() {
						if ( $( this ).attr( 'id' ).search( new RegExp( val, 'i' ) ) < 0 ) {
							$( this ).hide();
						} else {
							$( this ).show();
							count++;
						}
					} );

					// Show text for icon search results.
					$( 'span#icons-search-result' ).show();

					if ( count == 1 ) {
						$( 'span#icons-search-result' ).html( '<strong>' + count + '</strong> ' + be_admin_vars.s_icon_found );
					} else if ( count > 1 ) {
						$( 'span#icons-search-result' ).html( '<strong>' + count + '</strong> ' + be_admin_vars.p_icons_found );
					} else {
						$( 'span#icons-search-result' ).html( be_admin_vars.no_icons_found );
					}
				}
			} );
		}
	} );
} )( jQuery );