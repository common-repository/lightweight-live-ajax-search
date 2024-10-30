<?php
/**
 * Search form template
 *
 * @package live-search
 */

defined( 'ABSPATH' ) || die( 'No direct script access allowed!' );

?>

<div id="wpls-live-search">
	<div class="wpls-search-container">
		<div id="wpls-search-wrap">
			<form role="search" method="get" id="wpls-searchform" class="clearfix" action="<?php echo esc_url_raw( home_url() ); ?>">
				<?php
				foreach ( $selected_post_types as $key => $post_type ) { //phpcs:ignore
					echo '<input type="hidden" name="post_type[]" value="' . esc_attr( $post_type ) . '">';
				}
				?>
				<input type="text" placeholder="<?php echo esc_attr( $placeholder ); ?>" onfocus="if (this.value === '') {this.value = '';}" onblur="if (this.value === '')  {this.value = '';}" value="" name="s" id="wpls-sq" autocapitalize="off" autocorrect="off" autocomplete="off">
				<div class="spinner live-search-loading wpls-search-loader" style="display: none;">
					<img src="<?php echo esc_url( admin_url( 'images/spinner-2x.gif' ) ); ?>" >
				</div>
			</form>
	</div>
	</div>
</div>
