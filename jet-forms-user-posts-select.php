<?php
/**
 * Plugin Name: JetEngine forms - user posts
 * Plugin URI:
 * Description: Allow to get only posts by current user as options for select, checkbox or radio fields in the JetFormBuilder & JetEngine forms.
 * Version:     1.1.0
 * Author:      Crocoblock
 * Author URI:  https://crocoblock.com/
 * Text Domain: jet-forms-user-posts-select
 * License:     GPL-3.0+
 * License URI: http://www.gnu.org/licenses/gpl-3.0.txt
 * Domain Path: /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die();
}

add_action( 'plugins_loaded', function () {
	define( 'JET_UPS__FILE__', __FILE__ );
	define( 'JET_UPS_PLUGIN_BASE', plugin_basename( JET_UPS__FILE__ ) );
	define( 'JET_UPS_PATH', plugin_dir_path( JET_UPS__FILE__ ) );

	add_filter( 'jet-engine/forms/options-generators', function( $instances ) {
		require JET_UPS_PATH . 'generator.php';
		$instances[] = new Jet_Forms_User_Posts_Generator();
		return $instances;
	} );

	add_filter( 'jet-form-builder/forms/options-generators', function ( $instances ) {
		require JET_UPS_PATH . 'jet-fb-generator.php';
		$instances[] = new Jet_Fb_Generator();
		return $instances;
	} );
} );

