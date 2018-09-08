<?php
namespace TemplateLinker;

use TemplateLinker\Widgets\TemplateLinker;

if (! defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

/**
 * Main Plugin Class
 *
 * Register new elementor widget.
 *
 * @since 1.0.0
 */
class Plugin
{

    /**
     * Constructor
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function __construct()
    {
        $this->add_actions();
    }

    /**
     * Add Actions
     *
     * @since 1.0.0
     *
     * @access private
     */
    private function add_actions()
    {
        add_action('elementor/widgets/widgets_registered', [ $this, 'on_widgets_registered' ]);

        add_action('elementor/frontend/after_register_scripts', function () {
            wp_register_script('template-linker', plugins_url('/assets/js/template-linker.js', __ELEMENTOR_TEMPLATE_LINKER_FILE__), [ 'jquery' ], false, true);
        });
    }

    /**
     * On Widgets Registered
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function on_widgets_registered()
    {
        $this->includes();
        $this->register_widget();
    }

    /**
     * Includes
     *
     * @since 1.0.0
     *
     * @access private
     */
    private function includes()
    {
        require __DIR__ . '/widgets/template-linker.php';
    }

    /**
     * Register Widget
     *
     * @since 1.0.0
     *
     * @access private
     */
    private function register_widget()
    {
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new TemplateLinker());
    }
}

new Plugin();
