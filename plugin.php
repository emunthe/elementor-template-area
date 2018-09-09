<?php
namespace TemplateArea;

/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.2.0
 */
class Plugin {

	/**
	 * Instance
	 *
	 * @since 1.2.0
	 * @access private
	 * @static
	 *
	 * @var Plugin The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.2.0
	 * @access public
	 *
	 * @return Plugin An instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * widget_scripts
	 *
	 * Load required plugin core files.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function widget_scripts() {
		wp_register_script( 'template-area', plugins_url( '/assets/js/template-area.js', __FILE__ ), [ 'jquery' ], __VERSION__, true );
		wp_enqueue_script( 'template-area' );
	}

	/**
	 * widget_styles
	 *
	 * Load required plugin core files.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function widget_styles() {
		wp_register_style( 'template-area', plugins_url( '/assets/css/template-area.css', __FILE__ ), false, __VERSION__, 'all' );
		wp_enqueue_style( 'template-area' );
	}

	/**
	 * Include Widgets files
	 *
	 * Load widgets files
	 *
	 * @since 1.2.0
	 * @access private
	 */
	private function include_widgets_files() {
		require_once( __DIR__ . '/widgets/template-area-links.php' );
		require_once( __DIR__ . '/widgets/template-area.php' );
	}

	/**
	 * Register Widgets
	 *
	 * Register new Elementor widgets.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function register_widgets() {
		// Its is now safe to include Widgets files
		$this->include_widgets_files();

		// Register Widgets
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Template_Area_Links() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Template_Area() );
	}



	function add_elementor_widget_categories( $elements_manager ) {

		$elements_manager->add_category(
			'template-area',
			[
				'title' => __( 'Template Area', 'template-area' ),
				'icon' => 'fa fa-plug',
			]
		);

	}




	/**
	 *  Plugin class constructor
	 *
	 * Register plugin action hooks and filters
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function __construct() {

		// Register widget scripts
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ] );

		// Register plugin style
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_styles' ] );

		// Register widgets
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );

		// Add categories
		add_action( 'elementor/elements/categories_registered', 'add_elementor_widget_categories' );


	}
}

// Instantiate Plugin Class
Plugin::instance();
