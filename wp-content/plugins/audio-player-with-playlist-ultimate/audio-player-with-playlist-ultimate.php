<?php
/*
 * Plugin Name: Audio Player with Playlist Ultimate
 * Plugin URI: https://www.wponlinesupport.com/plugins
 * Text Domain: audio-player-with-playlist-ultimate
 * Description: Audio Player with Playlist Ultimate plugin is a jQuery HTML5 Music/Audio Player with Playlist comes with huge possibilities and options. Its comes with 1 styles for grid and 1 for playlist with Single player & Multiple player orientations. It supports shuffle, repeat, volume control, time line progress-bar, Song Title and Artist. Also work with Gutenberg shortcode block. 
 * Domain Path: /languages/
 * Version: 1.1
 * Author: WP OnlineSupport
 * Author URI: https://www.wponlinesupport.com
 * Contributors: WP OnlineSupport
*/

if( !defined( 'APWPULTIMATE_VERSION' ) ) {
	define( 'APWPULTIMATE_VERSION', '1.1' ); // Version of plugin
}
if( !defined( 'APWPULTIMATE_DIR' ) ) {
    define( 'APWPULTIMATE_DIR', dirname( __FILE__ ) ); // Plugin dir
}
if( !defined( 'APWPULTIMATE_URL' ) ) {
    define( 'APWPULTIMATE_URL', plugin_dir_url( __FILE__ )); // Plugin url
}
if( !defined( 'APWPULTIMATE_PLUGIN_BASENAME' ) ) {
	define( 'APWPULTIMATE_PLUGIN_BASENAME', plugin_basename( __FILE__ ) ); // plugin base name
}
if(!defined( 'APWPULTIMATE_POST_TYPE' ) ) {
	define('APWPULTIMATE_POST_TYPE', 'apwp-audio-player'); // Plugin post type
}
if( !defined( 'APWPULTIMATE_CAT' ) ) {
    define( 'APWPULTIMATE_CAT', 'apwp-audio-category' ); // Plugin category name
}
if(!defined( 'APWPULTIMATE_META_PREFIX' ) ) {
	define('APWPULTIMATE_META_PREFIX','_apwp_'); // Plugin metabox prefix
}

/**
 * Activation Hook
 * 
 * Register plugin activation hook.
 * 
 * @package Audio Player with Playlist Pro
 * @since 1.0.0
 */
register_activation_hook( __FILE__, 'apwpultimate_install' );

/**
 * Deactivation Hook
 * 
 * Register plugin deactivation hook.
 * 
 * @package Audio Player with Playlist Pro
 * @since 1.0.0
 */
register_deactivation_hook( __FILE__, 'apwpultimate_uninstall');

/**
 * Plugin Activation Function
 * Does the initial setup, sets the default values for the plugin options
 * 
 * @package Audio Player with Playlist Pro
 * @since 1.0.0
 */
function apwpultimate_install() {        
   // Get settings for the plugin
    $apwpultimate_options = get_option( 'apwppro_options' );
    if( empty( $apwpultimate_options ) ) { 
        // Set default settings
        apwpultimate_default_settings();
    }
}

/**
 * Plugin Functinality (On Deactivation)
 * 
 * Delete  plugin options.
 * 
 * @package Audio Player with Playlist Pro
 * @since 1.0.0
 */
function apwpultimate_uninstall() {

}

/**
 * Load Text Domain
 * This gets the plugin ready for translation
 * 
 * @package Audio Player with Playlist Pro
 * @since 1.0.0
 */
function apwpultimate_load_textdomain() {

    global $wp_version;

    // Set filter for plugin's languages directory
    $apwpultimate_lang_dir = dirname( plugin_basename( __FILE__ ) ) . '/languages/';
    $apwpultimate_lang_dir = apply_filters( 'apwpultimate_languages_directory', $apwpultimate_lang_dir );

    // Traditional WordPress plugin locale filter.
    $get_locale = get_locale();

    if ( $wp_version >= 4.7 ) {
        $get_locale = get_user_locale();
    }

    // Traditional WordPress plugin locale filter
    $locale = apply_filters( 'plugin_locale',  $get_locale, 'audio-player-with-playlist-ultimate' );
    $mofile = sprintf( '%1$s-%2$s.mo', 'audio-player-with-playlist-ultimate', $locale );

    // Setup paths to current locale file
    $mofile_global  = WP_LANG_DIR . '/plugins/' . basename( APWPULTIMATE_DIR ) . '/' . $mofile;

    if ( file_exists( $mofile_global ) ) { // Look in global /wp-content/languages/plugin-name folder
        load_textdomain( 'audio-player-with-playlist-ultimate', $mofile_global );
    } else { // Load the default language files
        load_plugin_textdomain( 'audio-player-with-playlist-ultimate', false, $apwpultimate_lang_dir );
    }
}
add_action('plugins_loaded', 'apwpultimate_load_textdomain');


// Global variables
global $apwpultimate_ultimate_options;
// Funcions File
require_once( APWPULTIMATE_DIR .'/includes/apwpultimate-functions.php' );
$apwpultimate_ultimate_options = apwpultimate_ultimate_get_settings();

// Post Type File
require_once( APWPULTIMATE_DIR . '/includes/apwpultimate-post-types.php' );

// Script Class File
require_once( APWPULTIMATE_DIR . '/includes/class-apwpultimate-script.php' );

// Admin Class File
require_once( APWPULTIMATE_DIR . '/includes/admin/class-apwpultimate-admin.php' );

// Shortcode file
// Grid Shortcode
require_once( APWPULTIMATE_DIR . '/includes/shortcode/apwpultimate-grid-shortcode.php' );
// Shortcode

require_once( APWPULTIMATE_DIR . '/includes/shortcode/apwpultimate-shortcode.php' );
