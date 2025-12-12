<?php
/**
 * Plugin Name: Fast Accordion Elementor Addon
 * Description: Custom Elementor widget for Blocked Accordion Tabs with support for dynamic templates.
 * Version: 1.0.15
 * Author: Abe Prangishvili
 * Text Domain: fast-accordion
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Register Widget.
 *
 * Include widget file and register widget class.
 *
 * @since 1.0.0
 * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
 * @return void
 */
function fast_accordion_register_widget( $widgets_manager ) {

	require_once( __DIR__ . '/widgets/fast-accordion-widget.php' );

	$widgets_manager->register( new \Fast_Accordion_Widget() );

}
add_action( 'elementor/widgets/register', 'fast_accordion_register_widget' );

function fast_accordion_enqueue_styles() {
	wp_enqueue_style( 'fast-accordion-style', plugins_url( 'assets/css/style.css', __FILE__ ), array(), '1.0.15' );
	wp_enqueue_script( 'fast-accordion-script', plugins_url( 'assets/js/script.js', __FILE__ ), array('jquery'), '1.0.15', true );
}
add_action( 'wp_enqueue_scripts', 'fast_accordion_enqueue_styles' );
