<?php

/*
Plugin Name: WordPress Editor Experience Talk Demo Plugin
Description: Demo plugin for my talk at the WP Leeds meetup.
Version: 0.1
License: GPL
Author: mattheu
Author URI: http://matth.eu

=== RELEASE NOTES ===
2014-06-21 - v1.0 - first version
*/

/*
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
Online: http://www.gnu.org/licenses/gpl.txt
*/

define( 'WPEETD_PATH', plugin_dir_path( __FILE__ ) );
define( 'WPEETD_URL',  plugins_url( '', __FILE__ ) );

add_action( 'plugins_loaded', function() {

	require_once( WPEETD_PATH . '/inc/tinymce-mods.php' );
	require_once( WPEETD_PATH . '/inc/tinymce-custom-button.php' );

} );