<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Fast_Accordion_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'fast_accordion';
	}

	public function get_title() {
		return esc_html__( 'Fast Accordion Blocks', 'fast-accordion' );
	}

	public function get_icon() {
		return 'eicon-accordion';
	}

	public function get_categories() {
		return [ 'general' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'fast-accordion' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'list_title',
			[
				'label' => esc_html__( 'Title', 'fast-accordion' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'List Title', 'fast-accordion' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'list_content',
			[
				'label' => esc_html__( 'Content', 'fast-accordion' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => esc_html__( 'List Content', 'fast-accordion' ),
				'show_label' => false,
			]
		);

		$this->add_control(
			'list',
			[
				'label' => esc_html__( 'Repeater List', 'fast-accordion' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'list_title' => esc_html__( 'Title #1', 'fast-accordion' ),
						'list_content' => esc_html__( 'Item content. Click the edit button to change this text.', 'fast-accordion' ),
					],
					[
						'list_title' => esc_html__( 'Title #2', 'fast-accordion' ),
						'list_content' => esc_html__( 'Item content. Click the edit button to change this text.', 'fast-accordion' ),
					],
				],
				'title_field' => '{{{ list_title }}}',
			]
		);

		$this->add_control(
			'layout_type',
			[
				'label' => esc_html__( 'Layout Type', 'fast-accordion' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'accordion',
				'options' => [
					'accordion' => esc_html__( 'Accordion', 'fast-accordion' ),
					'external' => esc_html__( 'External Content (Below)', 'fast-accordion' ),
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_item',
			[
				'label' => esc_html__( 'Item', 'fast-accordion' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'item_margin',
			[
				'label' => esc_html__( 'Margin', 'fast-accordion' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .fast-accordion-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'item_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'fast-accordion' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .fast-accordion-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_header',
			[
				'label' => esc_html__( 'Header', 'fast-accordion' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .fast-accordion-title',
			]
		);

		$this->start_controls_tabs( 'tabs_header_style' );

		// Normal State
		$this->start_controls_tab(
			'tab_header_normal',
			[
				'label' => esc_html__( 'Normal', 'fast-accordion' ),
			]
		);

		$this->add_control(
			'header_background_color',
			[
				'label' => esc_html__( 'Background Color', 'fast-accordion' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .fast-accordion-item-header' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'header_text_color',
			[
				'label' => esc_html__( 'Text Color', 'fast-accordion' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .fast-accordion-item-header' => 'color: {{VALUE}}',
					'{{WRAPPER}} .icon-plus, {{WRAPPER}} .icon-minus' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		// Hover State
		$this->start_controls_tab(
			'tab_header_hover',
			[
				'label' => esc_html__( 'Hover', 'fast-accordion' ),
			]
		);

		$this->add_control(
			'header_background_color_hover',
			[
				'label' => esc_html__( 'Background Color', 'fast-accordion' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .fast-accordion-item-header:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'header_text_color_hover',
			[
				'label' => esc_html__( 'Text Color', 'fast-accordion' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .fast-accordion-item-header:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .fast-accordion-item-header:hover .icon-plus, {{WRAPPER}} .fast-accordion-item-header:hover .icon-minus' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		// Active State
		$this->start_controls_tab(
			'tab_header_active',
			[
				'label' => esc_html__( 'Active', 'fast-accordion' ),
			]
		);

		$this->add_control(
			'header_background_color_active',
			[
				'label' => esc_html__( 'Background Color', 'fast-accordion' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .fast-accordion-item.active .fast-accordion-item-header' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'header_text_color_active',
			[
				'label' => esc_html__( 'Text Color', 'fast-accordion' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .fast-accordion-item.active .fast-accordion-item-header' => 'color: {{VALUE}}',
					'{{WRAPPER}} .fast-accordion-item.active .icon-plus, {{WRAPPER}} .fast-accordion-item.active .icon-minus' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'header_padding',
			[
				'label' => esc_html__( 'Padding', 'fast-accordion' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .fast-accordion-item-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_icon',
			[
				'label' => esc_html__( 'Icon', 'fast-accordion' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'icon_size',
			[
				'label' => esc_html__( 'Size', 'fast-accordion' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .fast-accordion-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_gap',
			[
				'label' => esc_html__( 'Gap', 'fast-accordion' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .fast-accordion-icon' => 'margin-left: {{SIZE}}{{UNIT}};', // Assuming icon is on right
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_content',
			[
				'label' => esc_html__( 'Content', 'fast-accordion' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'content_background_color',
			[
				'label' => esc_html__( 'Background Color', 'fast-accordion' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .fast-accordion-item-content' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'content_text_color',
			[
				'label' => esc_html__( 'Text Color', 'fast-accordion' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .fast-accordion-item-content' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'selector' => '{{WRAPPER}} .fast-accordion-item-content',
			]
		);

		$this->add_control(
			'content_padding',
			[
				'label' => esc_html__( 'Padding', 'fast-accordion' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .fast-accordion-item-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( empty( $settings['list'] ) ) {
			return;
		}

		$layout = isset( $settings['layout_type'] ) ? $settings['layout_type'] : 'accordion';

		if ( 'external' === $layout ) {
			// render as Grid of Headers + External Content Area
			echo '<div class="fast-accordion-wrapper fast-accordion-layout-external">';
			
			// Grid of Headers
			echo '<div class="fast-accordion-grid">';
			foreach ( $settings['list'] as $index => $item ) {
				$active_class = ( 0 === $index ) ? 'active' : '';
				echo '<div class="fast-accordion-item-header fast-accordion-block elementor-repeater-item-' . esc_attr( $item['_id'] ) . ' ' . $active_class . '" data-index="' . esc_attr( $index ) . '">';
				echo '<span class="fast-accordion-title">' . esc_html( $item['list_title'] ) . '</span>';
				echo '<span class="fast-accordion-icon"><span class="icon-plus">+</span><span class="icon-minus">-</span></span>';
				echo '</div>';
			}
			echo '</div>'; // end grid

			// Display Area
			echo '<div class="fast-accordion-display-area">';
			foreach ( $settings['list'] as $index => $item ) {
				$active_style = ( 0 === $index ) ? 'style="display:block;"' : 'style="display:none;"';
				echo '<div class="fast-accordion-content-panel" data-index="' . esc_attr( $index ) . '" ' . $active_style . '>';
				echo '<div class="fast-accordion-item-content elementor-repeater-item-' . esc_attr( $item['_id'] ) . '">';
				echo $item['list_content'];
				echo '</div>';
				echo '</div>';
			}
			echo '</div>'; // end display area

			echo '</div>'; // end wrapper
		} else {
			// Default Accordion Logic
			echo '<div class="fast-accordion-wrapper fast-accordion-layout-accordion">';
			foreach (  $settings['list'] as $item ) {
				echo '<div class="fast-accordion-item elementor-repeater-item-' . esc_attr( $item['_id'] ) . '">';
				echo '<div class="fast-accordion-item-header">';
				echo '<span class="fast-accordion-title">' . esc_html( $item['list_title'] ) . '</span>';
				echo '<span class="fast-accordion-icon"><span class="icon-plus">+</span><span class="icon-minus">-</span></span>';
				echo '</div>';
				echo '<div class="fast-accordion-item-content">' . $item['list_content'] . '</div>';
				echo '</div>';
			}
			echo '</div>';
		}
	}
}
