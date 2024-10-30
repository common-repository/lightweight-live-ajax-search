<?php
/**
 * Live search options page
 *
 * @package live-search
 */

defined( 'ABSPATH' ) || die( 'No direct script access allowed!' );
?>

<div class="wrap">
	<div class="wpls-options-form-wrap clearfix">

		<h1><?php esc_html_e( 'Lightweight Live Ajax Search Settings', 'lightweight-live-ajax-search' ); ?></h1>
		<form method="post" action="options.php"> 
				<h2 class="title"><?php esc_html_e( 'Live Search', 'lightweight-live-ajax-search' ); ?></h2>
				<p><?php esc_html_e( "Settings to control the live search functionality & it's search area.", 'lightweight-live-ajax-search' ); ?></p>
				<table  class="form-table">
					<tr valign="top">
						<th scope="row"><?php esc_html_e( 'Replace Theme\'s Search Form', 'lightweight-live-ajax-search' ); ?></th>
						<td>
							<fieldset>
								<?php
								$replace_theme_search = Wpls_Helper::get_setting( 'wpls_replace_theme_search' );

								?>
								<input type="hidden" name="wpls_replace_theme_search" value="no"/>
								<input type="checkbox" name="wpls_replace_theme_search" value="yes" <?php checked( $replace_theme_search, 'yes', true ); ?>/>
								<label>
									<?php echo esc_html__( 'Enable', 'lightweight-live-ajax-search' ); ?>
								</label><br>
							</fieldset>
						</td>
					</tr>

					<tr valign="top">
						<th scope="row"><?php esc_html_e( 'Search Within Post Types', 'lightweight-live-ajax-search' ); ?></th>
						<td>	
							<fieldset>
								<?php
								$selected_post_types = Wpls_Helper::get_setting( 'wpls_search_post_types' );

								$post_types = get_post_types(
									array(
										'public'  => true,
										'show_ui' => true,
									),
									'objects'
								);

								unset( $post_types['attachment'] );
								unset( $post_types['fl-builder-template'] );
								unset( $post_types['fl-theme-layout'] );

								foreach ( $post_types as $key => $post_type_data ) {

									$checked = '';
									if ( in_array( $key, $selected_post_types ) ) {// phpcs:ignore WordPress.PHP.StrictInArray.MissingTrueStrict
										$checked = "checked='checked' ";
									}

									?>
									<input type="checkbox" name="wpls_search_post_types[]" value="<?php echo esc_attr( $key ); ?>" <?php echo esc_html( $checked ); ?>/>
									<label>
										<?php echo esc_html( ucfirst( $post_type_data->label ) ); ?>
									</label><br>
								<?php } ?>
							</fieldset>
						</td>
					</tr>
				</table>

				<?php
				settings_fields( 'wpls-settings-group' );
				do_settings_sections( 'wpls-settings-group' );
				submit_button();
				?>
		</form>
	</div>
	<div class="wpls-shortcodes-wrap">

		<h2 class="title"><?php esc_html_e( 'Shortcodes', 'lightweight-live-ajax-search' ); ?></h2>
		<p><?php esc_html_e( 'If you do not want to replace them\'s search form, then copy below shortcode and paste it into your post, page, or text widget.', 'lightweight-live-ajax-search' ); ?></p>

		<div class="wpls-shortcode-container">
			<table class="form-table">
				<tr valign="top">
					<th scope="row"><?php esc_html_e( 'Display Live Search Box', 'lightweight-live-ajax-search' ); ?></th>
					<td>
						<div class="wpls-shortcode-container wp-ui-text-highlight">
							[wpls_live_search placeholder="Type and Search..."]
						</div>  
					</td>
				</tr>
			</table>
		</div>
	</div>
</div>

