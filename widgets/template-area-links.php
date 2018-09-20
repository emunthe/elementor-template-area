<?php
namespace TemplateArea\Widgets;

use Elementor\Widget_Base;
use Elementor\Repeater;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

use ElementorPro\Plugin;
use ElementorPro\Modules\Library\Module;

use Elementor_Template_Area;

if (! defined('ABSPATH')) {
    exit;
} // Exit if accessed directly




class Template_Area_Links extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve links widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'template-area-links';
	}



    public function get_categories() {
		return [ 'template-area' ];
	}


	/**
	 * Get widget title.
	 *
	 * Retrieve links widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Template Area Links', 'template-area' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve links widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-nav-menu';
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 2.1.0
	 * @access public
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'links', 'accordion', 'toggle' ];
	}

	/**
	 * Register links widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'section_links',
			[
				'label' => __( 'links', 'template-area' ),
			]
		);

        $template_areas = Elementor_Template_Area::get_template_areas();

		if ( empty( $template_areas ) ) {

			$this->add_control(
				'no_template_areas',
				[
					'label' => false,
					'type' => Controls_Manager::RAW_HTML,
					'raw' => Module::empty_templates_message(),
				]
			);

			return;
		}

		$options = [
			'0' => '— ' . __( 'Select Template Area', 'template-area' ) . ' —',
		];


		foreach ( $template_areas as $template_area ) {
			$options[ $template_area['template_area_id'] ] = $template_area['title'];
		}


        $this->add_control(
			'template_area_select',
			[
				'label' => __( 'Choose Template Area', 'template-area' ),
				//'type' => Controls_Manager::SELECT,
                'type' => 'altselect',
				'default' => '0',
				'options' => $options,
				'label_block' => 'true',
			]
		);




		$repeater = new Repeater();

		$repeater->add_control(
			'link_title',
			[
				'label' => __( 'Title & Content', 'template-area' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Tab Title', 'template-area' ),
				'placeholder' => __( 'Tab Title', 'template-area' ),
				'label_block' => true,
			]
		);


        $templates = Module::get_templates();

		if ( empty( $templates ) ) {

			$this->add_control(
				'no_templates',
				[
					'label' => false,
					'type' => Controls_Manager::RAW_HTML,
					'raw' => Module::empty_templates_message(),
				]
			);

			return;
		}

		$options = [
			'0' => '— ' . __( 'Select', 'template-area' ) . ' —',
		];

		$types = [];

		foreach ( $templates as $template ) {
			$options[ $template['template_id'] ] = $template['title'] . ' (' . $template['type'] . ')';
			$types[ $template['template_id'] ] = $template['type'];
		}

		$repeater->add_control(
			'template_id',
			[
				'label' => __( 'Choose Template', 'template-area' ),
				//'type' => Controls_Manager::SELECT,
                'type' => 'altselect',
				'default' => '0',
				'options' => $options,
				'types' => $types,
				'label_block' => 'true',
			]
		);


		$this->add_control(
			'links',
			[
				'label' => __( 'Link Items', 'template-area' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'link_title' => __( 'Link #1', 'template-area' ),
					],
					[
						'link_title' => __( 'Link #2', 'template-area' ),
					],
				],
				'title_field' => '{{{ link_title }}}',
			]
		);





		$this->add_control(
			'view',
			[
				'label' => __( 'View', 'template-area' ),
				'type' => Controls_Manager::HIDDEN,
				'default' => 'traditional',
			]
		);

		$this->add_control(
			'type',
			[
				'label' => __( 'Type', 'template-area' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'horizontal',
				'options' => [
					'horizontal' => __( 'Horizontal', 'template-area' ),
					'vertical' => __( 'Vertical', 'template-area' ),
				],
				'prefix_class' => 'elementor-template-area-view-',
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_links_style',
			[
				'label' => __( 'links', 'template-area' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'navigation_width',
			[
				'label' => __( 'Navigation Width', 'template-area' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
				],
				'range' => [
					'%' => [
						'min' => 10,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-template-area-wrapper' => 'width: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'type' => 'vertical',
				],
			]
		);

		$this->add_control(
			'border_width',
			[
				'label' => __( 'Border Width', 'template-area' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 1,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-tab-title, {{WRAPPER}} .elementor-tab-title:before, {{WRAPPER}} .elementor-tab-title:after, {{WRAPPER}} .elementor-tab-content, {{WRAPPER}} .elementor-template-area-content-wrapper' => 'border-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'border_color',
			[
				'label' => __( 'Border Color', 'template-area' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-tab-mobile-title, {{WRAPPER}} .elementor-tab-desktop-title.elementor-active, {{WRAPPER}} .elementor-tab-title:before, {{WRAPPER}} .elementor-tab-title:after, {{WRAPPER}} .elementor-tab-content, {{WRAPPER}} .elementor-template-area-content-wrapper' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'background_color',
			[
				'label' => __( 'Background Color', 'template-area' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-tab-desktop-title.elementor-active' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .elementor-template-area-content-wrapper' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'heading_title',
			[
				'label' => __( 'Title', 'template-area' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'tab_color',
			[
				'label' => __( 'Color', 'template-area' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-tab-title' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
			]
		);

		$this->add_control(
			'tab_active_color',
			[
				'label' => __( 'Active Color', 'template-area' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-tab-title.elementor-active' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_4,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'tab_typography',
				'selector' => '{{WRAPPER}} .elementor-tab-title',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
			]
		);

		$this->add_control(
			'heading_content',
			[
				'label' => __( 'Content', 'template-area' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'content_color',
			[
				'label' => __( 'Color', 'template-area' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-tab-content' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'selector' => '{{WRAPPER}} .elementor-tab-content',
				'scheme' => Scheme_Typography::TYPOGRAPHY_3,
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render links widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$links = $this->get_settings_for_display( 'links' );

		$id_int = substr( $this->get_id_int(), 0, 3 );
		?>
		<div class="elementor-template-area" >
			<div class="elementor-template-area-links-wrapper">
				<?php
				foreach ( $links as $index => $item ) :
					$tab_count = $index + 1;
					?>
					<div <?php echo 'class="elementor-template-area-link" data-link="' . $tab_count . '"'; ?>><a href="#"><?php echo $item['link_title']; ?></a></div>
				<?php endforeach; ?>
            </div>
		</div>
		<?php
	}

	/**
	 * Render links widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _content_template() {
		?>
		<div class="elementor-template-area-links" >
			<#

            /*
            console.log('settings', settings);
            console.log('view', view);
            console.log('view.model', view.model);
            console.log('view.options', view.options);
            console.log('view.options.model', view.options.model);
            console.log('view.options.model.attributes', view.options.model.attributes);
            console.log('view.options.model.attributes.settings', view.options.model.attributes.settings);
            console.log('view.$el', view.$el);

            console.log('settings.template_area_select', settings.template_area_select);
            console.log('settings.links', settings.links);
            */

			if ( settings.links ) {
				var tabindex = view.getIDInt().toString().substr( 0, 3 );
				#>
				<div class="elementor-template-area-links-wrapper">
					<#
					_.each( settings.links, function( item, index ) {
						var tabCount = index + 1;
						#>
						<div class="elementor-template-area-link" data-link="{{ tabCount }}">{{{ item.link_title }}}</div>
					<# } ); #>
				</div>
			<# }

            /*
            setTimeout(function(){
                var children = view.$el.find('[data-link]');
                _.each( children, function( item, index ) {
                    $(item).click(function(ev) {
                        console.log('data-link=',index,ev);
                        $(item).addClass('active');
                        $(item).siblings().removeClass('active');
                    } )
                });

            },50);
            */

            #>
		</div>
		<?php
	}
}
