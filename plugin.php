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



	public function register_controls_scripts() {
		wp_register_script( 'template-area-name-control', plugins_url( '/assets/js/template-area-name-control.js', __FILE__ ), [ 'jquery' ], __VERSION__, true );
		wp_enqueue_script( 'template-area-name-control' );
		wp_register_script( 'template-links-repeater-control', plugins_url( '/assets/js/template-links-repeater-control.js', __FILE__ ), [ 'jquery' ], __VERSION__, true );
		wp_enqueue_script( 'template-links-repeater-control' );
		wp_register_script( 'template-links-area-select-control', plugins_url( '/assets/js/template-links-area-select-control.js', __FILE__ ), [ 'jquery' ], __VERSION__, true );
		wp_enqueue_script( 'template-links-area-select-control' );
		wp_register_script( 'template-links-links-select-control', plugins_url( '/assets/js/template-links-links-select-control.js', __FILE__ ), [ 'jquery' ], __VERSION__, true );
		wp_enqueue_script( 'template-links-links-select-control' );

	}

	/**
	 * Include Controls files
	 *
	 */
	private function include_controls_files() {
		require_once( __DIR__ . '/controls/template-area-name.php' );
		require_once( __DIR__ . '/controls/template-links-repeater.php' );
		require_once( __DIR__ . '/controls/template-area-select.php' );
		require_once( __DIR__ . '/controls/template-links-select.php' );
	}


	public function plugin_scripts() {
		wp_register_script( 'template-area-plugin', plugins_url( '/assets/js/template-area-plugin.js', __FILE__ ), [ 'jquery' ], __VERSION__, true );
		wp_enqueue_script( 'template-area-plugin' );
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


	public function register_controls() {
		$this->include_controls_files();

		\Elementor\Plugin::instance()->controls_manager->register_control( 'template_area_name', new  Controls\Template_Area_Name);
		\Elementor\Plugin::instance()->controls_manager->register_control( 'templatelinksrepeater', new  Controls\Template_links_Repeater);
		\Elementor\Plugin::instance()->controls_manager->register_control( 'templateareaselect', new  Controls\Template_Area_Select);
		\Elementor\Plugin::instance()->controls_manager->register_control( 'templatearealinksselect', new  Controls\Template_Area_links_Select);
	}



	public function add_elementor_widget_categories( $elements_manager ) {

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

		// Register controls
		add_action( 'elementor/controls/controls_registered', [ $this, 'register_controls_scripts' ] );
		add_action( 'elementor/controls/controls_registered', [ $this, 'register_controls' ] );


		// Add categories
		add_action( 'elementor/elements/categories_registered', [ $this, 'add_elementor_widget_categories' ] );



		add_action( 'elementor/widgets/widgets_registered', [ $this, 'plugin_scripts' ] );

	}
}

// Instantiate Plugin Class
Plugin::instance();
