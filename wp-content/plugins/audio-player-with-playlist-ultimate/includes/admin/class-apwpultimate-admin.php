<?php
/**
 * Admin Class
 *
 * Handles the Admin side functionality of plugin
 *
 * @package Hero Banner Ultimate 
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Apwpultimate_Admin {

	function __construct() {
		
		// Action to add metabox
		add_action( 'add_meta_boxes', array($this, 'apwpultimate_post_sett_metabox') );

		// Action to save metabox
		add_action( 'save_post', array($this, 'apwpultimate_save_metabox_value') );
		
		// Action to register admin menu
		add_action( 'admin_menu', array($this, 'apwpultimate_ultimate_register_menu'), 9 );

		// Filter to add columns and data in logo showcase category table
		add_filter('manage_edit-'.APWPULTIMATE_CAT.'_columns', array($this, 'apwpultimate_ultimate_manage_category_columns'));
		add_filter('manage_'.APWPULTIMATE_CAT.'_custom_column', array($this, 'apwpultimate_ultimate_cat_columns_data'), 10, 3);

		// Action to register plugin settings
		add_action ( 'admin_init', array($this, 'apwpultimate_ultimate_register_settings') );

		// Action to add custom column to  listing
		add_filter( 'manage_'.APWPULTIMATE_POST_TYPE.'_posts_columns', array($this, 'apwpultimate_ultimate_posts_columns') );

		// Action to add custom column data to Logo listing
		add_action('manage_'.APWPULTIMATE_POST_TYPE.'_posts_custom_column', array($this, 'apwpultimate_ultimate_post_columns_data'), 10, 2);		
		
		
	}

	/**
	 * Post Settings Metabox
	 * 
	 * @package Hero Banner Ultimate 
	 * @since 1.0.0
	 */
	function apwpultimate_post_sett_metabox() {
		add_meta_box( 'apwpultimate-post-sett', __( 'Hero Banner - Settings', 'banner-anything-on-click' ), array($this, 'apwpultimate_post_sett_mb_content'), APWPULTIMATE_POST_TYPE, 'normal', 'high' );
	}

	/**
	 * Post Settings Metabox HTML
	 * 
	 * @package Hero Banner Ultimate Pro
	 * @since 1.0.0
	 */
	function apwpultimate_post_sett_mb_content() {
		include_once( APWPULTIMATE_DIR .'/includes/admin/metabox/apwpultimate-post-sett-metabox.php');
	}

	/**
	 * Function to save metabox values
	 * 
	 * @package Hero Banner Ultimate Pro
	 * @since 1.0.0
	 */
	function apwpultimate_save_metabox_value( $post_id ) {

		global $post_type;
		
		if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )                	// Check Autosave
		|| ( ! isset( $_POST['post_ID'] ) || $post_id != $_POST['post_ID'] )  	// Check Revision
		|| ( $post_type !=  APWPULTIMATE_POST_TYPE ) )              				// Check if current post type is supported.
		{
		  return $post_id;
		}

		$prefix = APWPULTIMATE_META_PREFIX; // Taking metabox prefix

		// Taking variables	
		$artist_name 			= isset($_POST[$prefix.'artist_name']) 				? $_POST[$prefix.'artist_name'] 			: '';
		$audio_file 			= isset($_POST[$prefix.'audio_file']) 				? $_POST[$prefix.'audio_file'] 			: '';
		$duration 				= isset($_POST[$prefix.'duration']) 				? $_POST[$prefix.'duration'] 			: '';

		
		update_post_meta($post_id, $prefix.'artist_name', $artist_name);	
		update_post_meta($post_id, $prefix.'audio_file', $audio_file);
		update_post_meta($post_id, $prefix.'duration', $duration);
	}

	/**
	 * Function to register admin menus
	 * 
	 * @package WP Audio Playlist Pro
	 * @since 1.0.0
	 */
	function apwpultimate_ultimate_register_menu() {
		add_submenu_page( 'edit.php?post_type='.APWPULTIMATE_POST_TYPE, __('Settings', 'audio-player-with-playlist-ultimate'), __('Settings', 'audio-player-with-playlist-ultimate'), 'manage_options', 'apwpultimate-ultimate-settings', array($this, 'apwpultimate_ultimate_settings_page') );
	}

	/**
	 * Function to handle the setting page html
	 * 
	 * @package WP Audio Playlist Pro
	 * @since 1.0.0
	 */
	function apwpultimate_ultimate_settings_page() {
		include_once( APWPULTIMATE_DIR . '/includes/admin/settings/apwpultimate-settings.php' );
	}

	/**
	 * Function register setings
	 * 
	 * @package WP Audio Playlist Pro
	 * @since 1.0.0
	 */
	function apwpultimate_ultimate_register_settings() {
		register_setting( 'apwpultimate_ultimate_plugin_options', 'apwpultimate_ultimate_options', array($this, 'apwpultimate_ultimate_validate_options') );
	}

	/**
	 * Validate Settings Options
	 * 
	 * @package WP Audio Playlist Pro
	 * @since 1.0.0
	 */
	function apwpultimate_ultimate_validate_options( $input ) {		
		$input['custom_css'] 	= isset($input['custom_css']) 		? apwpultimate_ultimate_slashes_deep($input['custom_css'], true) : '';		
		return $input;
	}

	/**
	 * Function to add category columns
	 * 
	 * @package WP Audio Playlist Pro
	 * @since 1.0.0
	 */
	function apwpultimate_ultimate_manage_category_columns( $columns ){
		
		$new_columns['apwpultimate_ultimate_cat_id'] = __( 'Audio Category ID', 'audio-player-with-playlist-ultimate' );
		
		$columns = apwpultimate_ultimate_add_array( $columns, $new_columns, 2 );
		
		return $columns;
	}

	/**
	 * Function to add category columns data
	 * 
	 * @package WP Audio Playlist Pro
	 * @since 1.0.0
	 */
	function apwpultimate_ultimate_cat_columns_data( $ouput, $column_name, $tax_id ) {
		if( $column_name == 'apwpultimate_ultimate_cat_id' ){
			$ouput .= $tax_id;
		}
		echo $ouput;
	}

	/**
	 * Add custom column to Logo listing page
	 * 
	 * @package WP Audio Playlist Pro
	 * @since 1.0.0
	 */
	function apwpultimate_ultimate_posts_columns( $columns ){

		$new_columns['apwpultimate_play_list_id'] 	= __( 'Playlist ID', 'audio-player-with-playlist-ultimate' );
	   
	    $columns = apwpultimate_ultimate_add_array( $columns, $new_columns, 1, true );

	    return $columns;
	}

	/**
	 * Add custom column data to audio listing page
	 * 
	 * @package WP Audio Playlist Pro
	 * @since 1.0.0
	 */
	function apwpultimate_ultimate_post_columns_data( $column, $post_id ) {

	    global $post;
		echo $post_id;    	
	}		
	
}

$apwpultimate_admin = new Apwpultimate_Admin();
