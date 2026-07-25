<?php
/**
 * Theme Customizer settings.
 *
 * @package YourRestaurant
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register presentation settings in the WordPress Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Customizer instance.
 */
function yr_customize_register( $wp_customize ) {
	$wp_customize->add_section(
		'yr_restaurant_options',
		array(
			'title'       => __( 'Restaurant Options', 'your-restaurant' ),
			'description' => __( 'Customize the restaurant identity and contact details.', 'your-restaurant' ),
			'priority'    => 35,
		)
	);

	$fields = array(
		'site_name'          => array( __( 'Restaurant Name', 'your-restaurant' ), 'text', 'sanitize_text_field' ),
		'site_tagline'       => array( __( 'Restaurant Tagline', 'your-restaurant' ), 'text', 'sanitize_text_field' ),
		'hero_title'         => array( __( 'Hero Title', 'your-restaurant' ), 'text', 'sanitize_text_field' ),
		'hero_subtitle'      => array( __( 'Hero Subtitle', 'your-restaurant' ), 'textarea', 'sanitize_textarea_field' ),
		'footer_description' => array( __( 'Footer Description', 'your-restaurant' ), 'textarea', 'sanitize_textarea_field' ),
		'footer_address'     => array( __( 'Address', 'your-restaurant' ), 'textarea', 'sanitize_textarea_field' ),
		'footer_phone'       => array( __( 'Phone', 'your-restaurant' ), 'text', 'sanitize_text_field' ),
		'footer_email'       => array( __( 'Email', 'your-restaurant' ), 'email', 'sanitize_email' ),
		'footer_copyright'   => array( __( 'Copyright Text', 'your-restaurant' ), 'text', 'sanitize_text_field' ),
		'map_latitude'       => array( __( 'Map Latitude', 'your-restaurant' ), 'text', 'sanitize_text_field' ),
		'map_longitude'      => array( __( 'Map Longitude', 'your-restaurant' ), 'text', 'sanitize_text_field' ),
	);

	foreach ( $fields as $key => $field ) {
		$setting_id = 'yr_' . $key;
		$wp_customize->add_setting(
			$setting_id,
			array(
				'default'           => '',
				'sanitize_callback' => $field[2],
			)
		);
		$wp_customize->add_control(
			$setting_id,
			array(
				'label'   => $field[0],
				'section' => 'yr_restaurant_options',
				'type'    => $field[1],
			)
		);
	}

	$url_fields = array(
		'footer_credit_url' => __( 'Footer Credit URL', 'your-restaurant' ),
		'instagram'         => __( 'Instagram URL', 'your-restaurant' ),
		'facebook'          => __( 'Facebook URL', 'your-restaurant' ),
		'twitter'           => __( 'X / Twitter URL', 'your-restaurant' ),
	);

	foreach ( $url_fields as $key => $label ) {
		$setting_id = 'yr_' . $key;
		$wp_customize->add_setting(
			$setting_id,
			array(
				'default'           => '',
				'sanitize_callback' => 'esc_url_raw',
			)
		);
		$wp_customize->add_control(
			$setting_id,
			array(
				'label'   => $label,
				'section' => 'yr_restaurant_options',
				'type'    => 'url',
			)
		);
	}
}
add_action( 'customize_register', 'yr_customize_register' );
