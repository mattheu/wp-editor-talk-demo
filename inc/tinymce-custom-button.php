<?php

/**
 * Add a custom button to the WordPress TinyMCE editor.
 * Button inserts a shortcode
 * Shortcode is rendered/styled as it would be on the front end of the site.
 */

add_action( 'admin_init', function() {
	add_filter( 'mce_external_plugins', 'wpeetd_add_tinymce_plugin' );
	add_filter( 'mce_buttons_2', 'wpeetd_add_tinymce_button' );
	add_filter( 'admin_head', 'wpeetd_editor_button_styles' );
	add_filter( 'tiny_mce_before_init', 'wpeetd_editor_styles' );
} );

add_action( 'init', function() {
	add_shortcode( 'custom' , 'wpeetd_shortcode' );
	wp_register_style( 'wpeetd_custom_header', WPEETD_URL . '/css/test-tinyMCE-button.css' );
} );

/**
 * Add our custom TinyMCE plugin
 * .
 * @param  array $plugin_array
 * @return array $plugin_array
 */
function wpeetd_add_tinymce_plugin( $plugin_array ) {
	$plugin_array['wpeetd_custom_button'] = WPEETD_URL . '/js/test-tinyMCE-button.js';
	return $plugin_array;
}

/**
 * Add the custom button to the editor.
 *
 * @param  array $buttons
 * @return array $buttons
 */
function wpeetd_add_tinymce_button( $buttons ) {
	array_push( $buttons, 'wpeetd_custom_button' );
	return $buttons;
}

/**
 * Output the styles for our custom button.
 *
 * @return null
 */
function wpeetd_editor_button_styles() {
	?>
	<style>
		.mce-toolbar .mce-i-format-aside {
			font: normal 20px/1 'dashicons';
			padding: 0;
			vertical-align: top;
			speak: none;
			-webkit-font-smoothing: antialiased;
			-moz-osx-font-smoothing: grayscale;
			margin-left: -2px;
			padding-right: 2px;
		}
		.mce-toolbar .mce-i-format-aside:before {
			content: "\f123";
		}
	</style>
	<?php
}

/**
 * Add the styles to the editor for our custom header.
 *
 * @param  array $init TinyMCE settings
 * @return array $init TinyMCE settings
 */
function wpeetd_editor_styles( $init ) {
	$init['content_css'] .= ',' . WPEETD_URL . '/css/test-tinyMCE-button.css';
	return $init;
}

/**
 * Do shortcode
 *
 * @param  array $data
 * @return string shortcode HTML
 */
function wpeetd_shortcode( $data ) {
	wp_enqueue_style( 'wpeetd_custom_header' );
	return sprintf( '<h1 class="custom-header">%s</h1>', $data['text'] );
}