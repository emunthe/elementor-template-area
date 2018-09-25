<?php
namespace TemplateArea\Widgets;

use Elementor\Controls_Manager;
use ElementorPro\Base\Base_Widget;
use ElementorPro\Modules\Library\Module;
use ElementorPro\Plugin;

use Elementor_Template_Area;

if (! defined('ABSPATH')) {
    exit;
} // Exit if accessed directly


class Template_Area extends Base_Widget {

	public function get_name() {
		return 'template-area-area';
	}

	public function get_title() {
		return __( 'Template Area', 'template-area' );
	}

    public function get_categories() {
		return [ 'template-area' ];
	}


	public function get_icon() {
		return 'eicon-site-title';
	}

	public function get_keywords() {
		return [ 'elementor', 'template', 'library', 'block', 'page' ];
	}

	public function is_reload_preview_required() {
		return false;
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'section_template',
			[
				'label' => __( 'Template', 'template-area' ),
			]
		);

        $this->add_control(
			'template_area_name',
			[
				'label' => __( 'Title Area Name', 'template-area' ),
				'type' => Controls_Manager::TEXT,
				//'type' => 'template_area_name',
				'default' => __( 'Name', 'template-area' ),
				'placeholder' => __( 'Name', 'template-area' ),
				'label_block' => true,
			]
		);


		$this->end_controls_section();
	}


    static function recursive_array_key_search($array, $key)
    {
        $results = array();

        if (is_array($array)) {
            if (isset($array[$key]) ) {
                $results[] = $array;
            }

            foreach ($array as $subarray) {
                $results = array_merge($results, self::recursive_array_key_search($subarray, $key));
            }
        }

        return $results;
    }


	protected function render() {
        $post_id = get_the_ID();

        //$template_id = $this->get_settings( 'template_id' );

        /*
            This is re rendered on settings change
        */


        $template_area_templates = $this->get_settings( 'template_area_templates' );
		?>
		<div class="elementor-template-area" >
			<?php
                if ( !empty( $template_area_templates ) ) {
                    foreach ($template_area_templates as $key => $value) {
                        echo '<div class="elementor-template-area-item">';
                        //echo Plugin::elementor()->frontend->get_builder_content_for_display( $template_id );
                        echo Plugin::elementor()->frontend->get_builder_content_for_display( $value );
                        echo '</div>';
                    }
                }

			?>
		</div>
		<?php

        //$template_area_name_setting = self::recursive_array_key_search($this_data, 'template_area_name');
        //echo '<h1>get template_area_name_setting</h1><pre>' . var_export( $template_area_name_setting, true ) . '</pre>';
        //echo '<h1>get_id()</h1><pre>' . var_export( $this->get_id(), true ) . '</pre>';
        //echo '<h1>get_the_ID()</h1><pre>' . var_export( $post_id, true ) . '</pre>';
        //echo '<h1>get_doc_for_frontend and get_elements_data</h1><pre>' . var_export( $link_setting, true ) . '</pre>';
        //echo '<h1>find template_area_select</h1><pre>' . var_export( $links_array, true ) . '</pre>';



        //$controls = \Elementor\Plugin::instance()->controls_manager->get_controls();
        //$control_alt_text = \Elementor\Plugin::instance()->controls_manager->get_control('alttext');
        //echo '<h1>get_controls</h1><pre>' . var_export( $controls, true ) . '</pre>';
        //echo '<h1>get_control</h1><pre>' . var_export( $control_alt_text, true ) . '</pre>';


        /*
        echo '<h1>get_controls</h1><pre>' . var_export( $controls, true ) . '</pre>';

        //Current Page stack
        $currentStacks = Plugin::elementor()->controls_manager->get_stacks();
        $currentControlsData = Plugin::elementor()->controls_manager->get_controls_data('template-area-links');
        $template_area_select = Plugin::elementor()->controls_manager->get_control_from_stack('template-area-links', 'template_area_select');
        echo '<h1>$template_area_select</h1><pre>' . var_export( $template_area_select, true ) . '</pre>';
        echo '<h1>get_stacks </h1><pre>' . var_export( $currentStacks['template-area-links'], true ) . '</pre>';
        echo '<h1>get_controls_data</h1><pre>' . var_export( $currentControlsData, true ) . '</pre>';
        //echo '<h1>get_stacks</h1><pre>' . var_export( $currentStacks['controls']['template_area_select'], true ) . '</pre>';
        */

	}

    /**
	 * Render heading widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
     /*
    protected function _content_template() {
		?>
		<#
		console.log('settings',settings);
		//console.log('elementor.modules.elements',elementor.modules.elements);
        //console.log('elementorFrontend.getElements()',elementorFrontend.getElements());
        //console.log('elementorFrontend',elementorFrontend);
        //console.log('elementor', elementor);

		#>{{settings.template_area_name}}
		<?php
	}*/



}
