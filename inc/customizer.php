<?php
/**
 * Theme Customizer settings.
 *
 * @package DineCraft
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
			'title'       => __( 'Restaurant Options', 'dinecraft' ),
			'description' => __( 'Customize the restaurant identity and contact details.', 'dinecraft' ),
			'priority'    => 35,
		)
	);

	$fields = array(
		'site_name'          => array( __( 'Restaurant Name', 'dinecraft' ), 'text', 'sanitize_text_field' ),
		'site_tagline'       => array( __( 'Restaurant Tagline', 'dinecraft' ), 'text', 'sanitize_text_field' ),
		'hero_title'         => array( __( 'Hero Title', 'dinecraft' ), 'text', 'sanitize_text_field' ),
		'hero_subtitle'      => array( __( 'Hero Subtitle', 'dinecraft' ), 'textarea', 'sanitize_textarea_field' ),
		'footer_description' => array( __( 'Footer Description', 'dinecraft' ), 'textarea', 'sanitize_textarea_field' ),
		'footer_address'     => array( __( 'Address', 'dinecraft' ), 'textarea', 'sanitize_textarea_field' ),
		'footer_phone'       => array( __( 'Phone', 'dinecraft' ), 'text', 'sanitize_text_field' ),
		'footer_email'       => array( __( 'Email', 'dinecraft' ), 'email', 'sanitize_email' ),
		'footer_copyright'   => array( __( 'Copyright Text', 'dinecraft' ), 'text', 'sanitize_text_field' ),
		'map_latitude'       => array( __( 'Map Latitude', 'dinecraft' ), 'text', 'sanitize_text_field' ),
		'map_longitude'      => array( __( 'Map Longitude', 'dinecraft' ), 'text', 'sanitize_text_field' ),
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
		'footer_credit_url' => __( 'Footer Credit URL', 'dinecraft' ),
		'instagram'         => __( 'Instagram URL', 'dinecraft' ),
		'facebook'          => __( 'Facebook URL', 'dinecraft' ),
		'twitter'           => __( 'X / Twitter URL', 'dinecraft' ),
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
