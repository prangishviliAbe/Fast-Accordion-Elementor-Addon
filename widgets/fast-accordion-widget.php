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

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'content_border',
				'label' => esc_html__( 'Border', 'fast-accordion' ),
				'selector' => '{{WRAPPER}} .fast-accordion-item-content',
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
			
			// Grid of Headers - Use same class as wrapper if we want same grid behavior, or specific grid class
			// The user wants "side by side", which is handled by .fast-accordion-wrapper CSS (display:grid).
			// So we use .fast-accordion-grid but ensure it inherits grid props or is styled same.
			echo '<div class="fast-accordion-grid">';
			foreach ( $settings['list'] as $index => $item ) {
				$active_class = ( 0 === $index ) ? 'active' : '';
				// Wrap in .fast-accordion-item to get the item border/radius/margin styles
				echo '<div class="fast-accordion-item fast-accordion-block ' . $active_class . '" data-index="' . esc_attr( $index ) . '">';
				echo '<div class="fast-accordion-item-header" data-index="' . esc_attr( $index ) . '">'; // Add data-index here too for safety
				echo '<span class="fast-accordion-title">' . esc_html( $item['list_title'] ) . '</span>';
				echo '<span class="fast-accordion-icon"><span class="icon-plus">+</span><span class="icon-minus">-</span></span>';
				echo '</div>'; // end header
				echo '</div>'; // end item
			}
			echo '</div>'; // end grid

			// Display Area
			echo '<div class="fast-accordion-display-area">';
			foreach ( $settings['list'] as $index => $item ) {
				$active_style = ( 0 === $index ) ? 'style="display:block;"' : 'style="display:none;"';
				echo '<div class="fast-accordion-content-panel" data-index="' . esc_attr( $index ) . '" ' . $active_style . '>';
				// We keep item-content class for styling consistency
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
			echo '</div>';
			echo '</div>';
		}
		?>
		<style>
			/* Inline styles to bypass cache and ensure visibility */
			.fast-accordion-wrapper.fast-accordion-layout-external {
				display: block !important;
			}
			.fast-accordion-layout-external .fast-accordion-grid {
				display: grid;
				grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
				gap: 15px;
				margin-bottom: 20px;
			}
			.fast-accordion-content-panel .fast-accordion-item-content {
				display: block !important; /* Force visible inside panel */
			}
		</style>
		<script>
		jQuery(document).ready(function($) {
			console.log('Fast Accordion: Inline Script Ready');
			// Use event delegation to handle dynamic loading (Elementor/AJAX)
			$(document).off('click.fastAccordion').on('click.fastAccordion', '.fast-accordion-item-header', function(e) {
				console.log('Fast Accordion: Header Clicked');
				// e.preventDefault(); // Optional, depending on if it's a link or not. Safe to omit for divs.
				
				var $header = $(this);
				var $externalWrapper = $header.closest('.fast-accordion-layout-external');

				if ($externalWrapper.length > 0) {
					// External Layout Logic
					console.log('Fast Accordion: External Layout Detected');
					var index = $header.attr('data-index');
					if (typeof index === 'undefined' || index === false) {
						index = $header.closest('.fast-accordion-item').attr('data-index');
					}
					console.log('Fast Accordion: Index ' + index);

					// Toggle Styles
					$externalWrapper.find('.fast-accordion-item').removeClass('active');
					$header.closest('.fast-accordion-item').addClass('active');
					
					$externalWrapper.find('.fast-accordion-item-header').removeClass('active');
					$header.addClass('active');

					// Toggle Content
					$externalWrapper.find('.fast-accordion-content-panel').hide();
					var $panel = $externalWrapper.find('.fast-accordion-content-panel[data-index="' + index + '"]');
					if ($panel.length) {
						$panel.stop(true, true).fadeIn(300);
					} else {
						console.log('Fast Accordion: No panel found for index ' + index);
					}

				} else {
					// Accordion Layout Logic
					console.log('Fast Accordion: Accordion Layout');
					var $item = $header.closest('.fast-accordion-item');
					var $content = $item.find('.fast-accordion-item-content');
					$content.slideToggle();
					$item.toggleClass('active');
				}
			});
		});
		</script>
		<?php
	}
}
