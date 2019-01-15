<?php
/**
 * Settings Page
 *
 * @package WP Logo Showcase Responsive Slider Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// Taking Values
?>

<div class="wrap apwpultimate-settings">

<h2><?php _e( 'WP Audio Playlist Settings', 'audio-player-with-playlist-ultimate' ); ?></h2><br />

<?php
// Success message
if( isset($_GET['settings-updated']) && $_GET['settings-updated'] == 'true' ) {
	echo '<div id="message" class="updated notice notice-success is-dismissible">
			<p><strong>'.__("Your changes saved successfully.", "audio-player-with-playlist-ultimate").'</strong></p>
		  </div>';
}
?>

<form action="options.php" method="POST" id="apwpultimate-settings-form" class="apwpultimate-settings-form">
	
	<?php
	    settings_fields( 'apwpultimate_ultimate_plugin_options' );
	    global $apwpultimate_ultimate_options;
	?>

	<!-- Tooltip Settings Starts -->
	<div id="apwpultimate-tooltip-sett" class="post-box-container apwpultimate-tooltip-sett">
		<div class="metabox-holder">
			<div class="meta-box-sortables ui-sortable">
				<div class="postbox">

					<button class="handlediv button-link" type="button"><span class="toggle-indicator"></span></button>

						<!-- Settings box title -->
						<h3 class="hndle">
							<span><?php _e( 'Playlist Settings', 'audio-player-with-playlist-ultimate' ); ?></span>
						</h3>
						
						<div class="inside">
						
						<table class="form-table apwpultimate-tooltip-sett-tbl">
							<tbody>								
								<!-- audio_title_font_size -->	
								<tr valign="top">
									<th scope="row">
										<label for="apwpultimate-audio-title-size"><?php _e('Title Font Size', 'audio-player-with-playlist-ultimate'); ?></label>
									</th>
									<td class="row-meta">		
										<input type="text" name="apwpultimate_ultimate_options[audio_title_font_size]" id="apwpultimate-audio-title-size" value="<?php echo apwpultimate_ultimate_esc_attr(apwpultimate_ultimate_get_option('audio_title_font_size')); ?>" class="regular-text" placeholder="<?php _e('30', 'audio-player-with-playlist-ultimate'); ?>" /> px <br/>
										<span class="description"><?php _e('Enter title font size in PX', 'audio-player-with-playlist-ultimate'); ?></span>
									</td>			
								</tr>
								
								<!-- playlist_font_size -->	
								<tr valign="top">
									<th scope="row">
										<label for="apwpultimate-audio-playlist-size"><?php _e('Playlist Font Size', 'audio-player-with-playlist-ultimate'); ?></label>
									</th>
									<td class="row-meta">			
										<input type="number" name="apwpultimate_ultimate_options[playlist_font_size]" id="apwpultimate-audio-playlist-size" value="<?php echo apwpultimate_ultimate_esc_attr( apwpultimate_ultimate_get_option('playlist_font_size') ); ?>" class="regular-text" placeholder="<?php _e('18', 'audio-player-with-playlist-ultimate'); ?>" /> px <br/>
										<span class="description"><?php _e('Enter playlist font size in PX', 'audio-player-with-playlist-ultimate'); ?></span>
									</td>			
								</tr>	
								

								<!-- Audio Player Color Setting -->
								<tr valign="top" style="border-bottom:1px solid #ddd;">
									<th scope="row" colspan="2"><h3 style="padding-bottom:0px;margin-bottom:0px;"><?php _e('Audio Player Color Setting', 'audio-player-with-playlist-ultimate'); ?></h3></th>
								</tr>
								<!-- Title Color -->
								<tr>
									<th scope="row">
											<label for="apwpultimate-title-color"><?php _e('Title Color', 'audio-player-with-playlist-ultimate'); ?>:</label>
									</th>
									<td>				
										<input type="text" name="apwpultimate_ultimate_options[audio_title_font_color]" id="apwpultimate-title-color" value="<?php echo apwpultimate_ultimate_esc_attr( apwpultimate_ultimate_get_option('audio_title_font_color') ); ?>" class="apwpultimate-color-box" /><br/>						
										<span class="description"><?php _e('Select title color.', 'audio-player-with-playlist-ultimate'); ?></span>
									</td>
								</tr>
								<!-- Playlist Font Color -->
								<tr>
									<th scope="row">
											<label for="apwpultimate-playlist-font-color"><?php _e('Playlist Font Color', 'audio-player-with-playlist-ultimate'); ?>:</label>
									</th>
									<td>				
										<input type="text" name="apwpultimate_ultimate_options[playlist_font_color]" id="apwpultimate-playlist-font-color" value="<?php echo apwpultimate_ultimate_esc_attr( apwpultimate_ultimate_get_option('playlist_font_color') ); ?>" class="apwpultimate-color-box" /><br/>						
										<span class="description"><?php _e('Select playlist font color.', 'audio-player-with-playlist-ultimate'); ?></span>
									</td>
								</tr>		
								<!-- Title Background Color -->
								<tr>
									<th scope="row">
											<label for="apwpultimate-title-bgcolor"><?php _e('Title Background Color', 'audio-player-with-playlist-ultimate'); ?>:</label>
									</th>
									<td>				
										<input type="text" name="apwpultimate_ultimate_options[title_bg_color]" id="apwpultimate-title-bgcolor" value="<?php echo apwpultimate_ultimate_esc_attr( apwpultimate_ultimate_get_option('title_bg_color') ); ?>" class="apwpultimate-color-box" /><br/>						
										<span class="description"><?php _e('Select banner overlay background color.', 'audio-player-with-playlist-ultimate'); ?></span>
									</td>
								</tr>	
								<!-- Playlist Background Color -->
								<tr>
									<th scope="row">
											<label for="apwpultimate-laylist-bgcolor"><?php _e('Playlist Background Color', 'audio-player-with-playlist-ultimate'); ?>:</label>
									</th>
									<td>				
										<input type="text" name="apwpultimate_ultimate_options[playlist_bg_color]" id="apwpultimate-laylist-bgcolor" value="<?php echo apwpultimate_ultimate_esc_attr( apwpultimate_ultimate_get_option('playlist_bg_color') ); ?>" class="apwpultimate-color-box" /><br/>						
										<span class="description"><?php _e('Select playlist background color.', 'audio-player-with-playlist-ultimate'); ?></span>
									</td>
								</tr>	
								<!-- Select theme color Color -->
								<tr>
									<th scope="row">
											<label for="apwpultimate-theme-color"><?php _e('Player Theme Color', 'audio-player-with-playlist-ultimate'); ?>:</label>
									</th>
									<td>				
										<input type="text" name="apwpultimate_ultimate_options[theme_color]" id="apwpultimate-theme-color" value="<?php echo apwpultimate_ultimate_esc_attr( apwpultimate_ultimate_get_option('theme_color') ); ?>" class="apwpultimate-color-box" /><br/>						
										<span class="description"><?php _e('Select player theme Color.', 'audio-player-with-playlist-ultimate'); ?></span>
									</td>
								</tr>
								
							</tbody>
						 </table>
					</div><!-- .inside -->
				</div><!-- .postbox -->
			</div><!-- .meta-box-sortables ui-sortable -->
		</div><!-- .metabox-holder -->
	</div><!-- #apwpultimate-tooltip-sett -->
	<!-- Tooltip Settings Ends -->

	<!-- Custom CSS Settings Starts -->
	<div id="apwpultimate-custom-css-sett" class="post-box-container apwpultimate-custom-css-sett">
		<div class="metabox-holder">
			<div class="meta-box-sortables ui-sortable">
				<div id="custom-css" class="postbox">

					<button class="handlediv button-link" type="button"><span class="toggle-indicator"></span></button>

						<!-- Settings box title -->
						<h3 class="hndle">
							<span><?php _e( 'Custom CSS Settings', 'audio-player-with-playlist-ultimate' ); ?></span>
						</h3>
						
						<div class="inside">
						
						<table class="form-table apwpultimate-custom-css-sett-tbl">
							<tbody>
								<tr>
									<th scope="row">
										<label for="apwpultimate-custom-css"><?php _e('Custom Css', 'audio-player-with-playlist-ultimate'); ?>:</label>
									</th>
									<td>
										<textarea name="apwpultimate_ultimate_options[custom_css]" class="large-text apwpultimate-custom-css" id="apwpultimate-custom-css" rows="15"><?php echo apwpultimate_ultimate_esc_attr(apwpultimate_ultimate_get_option('custom_css')); ?></textarea><br/>
										<span class="description"><?php _e('Enter custom CSS to override plugin CSS.', 'audio-player-with-playlist-ultimate'); ?></span>
									</td>
								</tr>
								<tr>
									<td colspan="2" valign="top" scope="row">
										<input type="submit" id="apwpultimate-settings-submit" name="apwpultimate-settings-submit" class="button button-primary right" value="<?php _e('Save Changes','audio-player-with-playlist-ultimate'); ?>" />
									</td>
								</tr>
							</tbody>
						 </table>

					</div><!-- .inside -->
				</div><!-- #custom-css -->
			</div><!-- .meta-box-sortables ui-sortable -->
		</div><!-- .metabox-holder -->
	</div><!-- #apwpultimate-custom-css-sett -->
	<!-- Custom CSS Settings Ends -->

</form><!-- end .apwpultimate-settings-form -->

</div><!-- end .apwpultimate-settings -->
