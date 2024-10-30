<?php
/**
 * Shortcode for live search
 *
 * @package live-search
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Search Shortcode.
 *
 * @since 1.0
 */
class Wpls_Search_Shortcode {

	/**
	 * The unique instance of the plugin.
	 *
	 * @var instance variable
	 */
	private static $instance;

	/**
	 * Gets an instance of our plugin.
	 */
	public static function get_instance() {

		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Constructor.
	 */
	private function __construct() {

		add_shortcode( 'wpls_live_search', array( $this, 'render_search_shortcode' ) );

		if ( 'yes' === Wpls_Helper::get_setting( 'wpls_replace_theme_search' ) ) {
			add_filter( 'get_search_form', array( $this, 'replace_default_search_form' ) );
		}

		add_action( 'wp_ajax_wpls_load_search_results', array( $this, 'load_search_results' ) );
		add_action( 'wp_ajax_nopriv_wpls_load_search_results', array( $this, 'load_search_results' ) );
	}


	/**
	 * Render the search box shortcode.
	 *
	 * @param int $atts Get attributes for the search field.
	 * @param int $content Get content to search from.
	 *
	 * @return string.
	 */
	public function render_search_shortcode( $atts, $content = null ) {

		wp_enqueue_style( 'wpls-frontend' );
		wp_enqueue_script( 'wpls-frontend' );

		$args = shortcode_atts(
			array(
				'placeholder' => __( 'Type and Search...', 'lightweight-live-ajax-search' ),
			),
			$atts
		);

		$placeholder         = $args['placeholder'];
		$selected_post_types = Wpls_Helper::get_setting( 'wpls_search_post_types' );

		ob_start();
		include WPLS_DIR . 'includes/search-form-template.php';
		return ob_get_clean();
	}

	/**
	 * Render the search form.
	 *
	 * @param string $form Search form.
	 *
	 * @return string.
	 */
	public function replace_default_search_form( $form ) {

		wp_enqueue_style( 'wpls-frontend' );
		wp_enqueue_script( 'wpls-frontend' );

		$placeholder         = __( 'Type and Search...', 'lightweight-live-ajax-search' );
		$selected_post_types = Wpls_Helper::get_setting( 'wpls_search_post_types' );

		ob_start();
		include WPLS_DIR . 'includes/search-form-template.php';
		return ob_get_clean();
	}

	/**
	 * To load search results.
	 */
	public function load_search_results() {

		//phpcs:ignore
		$query               = isset( $_GET['query'] ) ? sanitize_text_field( wp_unslash( $_GET['query'] ) ) : '';
		$selected_post_types = Wpls_Helper::get_setting( 'wpls_search_post_types' );

		$args = array(
			'post_type'   => $selected_post_types,
			'post_status' => 'publish',
			's'           => $query,
		);

		$search = new WP_Query( $args );

		ob_start();

		?>
		<ul id="wpls-search-result">
		<?php if ( $search->have_posts() ) : ?>

			<?php
			while ( $search->have_posts() ) :
				$search->the_post();
				?>
					<li>
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</li>
				<?php
			endwhile;
			?>
		<?php else : ?>
			<li class="nothing-here"><?php esc_html_e( 'Sorry, no search results were found.', 'lightweight-live-ajax-search' ); ?></li>
		<?php endif; ?>
		</ul> 
		<?php

		wp_reset_postdata();

		$content = ob_get_clean();

		echo $content; //phpcs:ignore
		die();
	}
}

Wpls_Search_Shortcode::get_instance();
