<?php
/**
 * @package Calculator Test Pluggin
 */
 /*
	Plugin Name: Calculator - Vasil
	Plugin URI: http://vasil-calculator.tk/calculator-vasil/
	Description: This plugin is just for testing purposes
	Version: 1.0.0
	Author: Vasil Llukmani
	Author URI: https://vasilllukmani.com
	License: GPLv2 or later
	Text Domain: calculator-vasil
 */

if ( !defined('ABSPATH')){
	die;
}

/* Adding plugin admin menu */

add_action( 'admin_menu', 'register_my_custom_menu_page' );

function register_my_custom_menu_page(){
    add_menu_page( 'my plugin', 'Calculator Vasil', 'manage_options', 'my-plugin-settings', 'my_plugin_custom_function', plugins_url( 'calculator-vasil/img/icon.png' ), 66 );
}

function my_plugin_custom_function(){

	$content = '';
	$content .= '<div>';
	$content .= '<h1>Calculator-Vasil</h1>';
	$content .= '<h2>Instructions</h2>';
	$content .= '<p>To use the booking form, please copy this shortcode: <b>[calculator_form]</b> to any page you want.</p>';
	$content .= '</div>';
	echo $content ;

}


/* Adding styles and scripts */

add_action('wp_enqueue_scripts','calculator_script');

function calculator_script() {
    wp_enqueue_script( 'calculator_script_js', plugins_url( 'assets/js/scripts.js', __FILE__ ));
}

add_action('wp_enqueue_scripts','register_my_scripts');

function register_my_scripts(){
    wp_enqueue_style( 'style1', plugins_url( 'assets/css/styles.css' , __FILE__ ) );
}


/* Plugin Form HTML structure */

 function calculator() {

		$content = '';
		$content .= '<section style=" max-width: 100%; width:70%;background:#003D59;padding: 80px 0px;height: -webkit-fill-available;display: flex;flex-direction: column;justify-content: center;align-items: center;">';
		$content .= '<div class="date-content">';
		$content .= '<p class="date"><span>Please check the</span> days</p>';
		$content .= '</div>';
		$content .= '<div class="date-picker-wrapper">';
		$content .= '<div>';
		$content .= '<p style="margin-left:0px;">From:</p>';
		$content .= '<input type="date" class="from-day" id="myDate"/>';
		$content .= '<p>To:</p>';
		$content .= '<input type="date" class="to-day"/>';
		$content .= '</div>';
		$content .= '</div>';
		$content .= '<div style="margin-top: 70px; width:50%">';
		$content .= '<p>Days to book </p>';
		$content .= '<input style="width:100%; " name="range--seats" id="range--seats" class="range-slider__range" type="range" value="0" min="0" max="14">';
		$content .= '<div class="value"><p><span id="value-change">0</span> days</p></div>';
		$content .= '</div>';
		$content .= '<div style="margin-top: 70px; width:50%">';
		$content .= '<label for="quantity">Number of people (max 5):</label>';
		$content .= '<input type="number" id="quantity" name="quantity" min="1" max="5" value="1">';
		$content .= '</div>';
		$content .= '</section>';
		$content .= '<section style="width: 30%;display:flex;align-items: center;justify-content: space-evenly;flex-direction: column; height:100%">';
		$content .= '<div>';
		$content .= '<span id="price-person">Total</span> $<br>';
		$content .= '<p class="sub-price">per person</p>';
		$content .= '</div>';
		$content .= '<div>';
		$content .= '<span id="price-total">0.00</span> $<br>';
		$content .= '<p class="sub-price">total</p>';
		$content .= '</div>';
		$content .= '</section>';
		return $content ;


 }

 add_shortcode ('calculator_form','calculator');

?>