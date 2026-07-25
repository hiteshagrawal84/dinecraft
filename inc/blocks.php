<?php
/**
 * Block patterns, styles, and editor support.
 *
 * @package YourRestaurant
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register a simple block style for core/group.
 */
function yr_register_block_styles() {
	register_block_style(
		'core/group',
		array(
			'name'  => 'yr-card',
			'label' => __( 'Restaurant Card', 'your-restaurant' ),
		)
	);

	register_block_style(
		'core/quote',
		array(
			'name'  => 'yr-testimonial',
			'label' => __( 'Testimonial Quote', 'your-restaurant' ),
		)
	);
}
add_action( 'init', 'yr_register_block_styles' );

/**
 * Register block patterns.
 */
function yr_register_block_patterns() {
	register_block_pattern_category(
		'your-restaurant',
		array( 'label' => __( 'Your Restaurant', 'your-restaurant' ) )
	);

	register_block_pattern(
		'your-restaurant/cta-reserve',
		array(
			'title'       => __( 'Reserve a Table CTA', 'your-restaurant' ),
			'description' => __( 'A dark call-to-action section inviting guests to book a table.', 'your-restaurant' ),
			'categories'  => array( 'your-restaurant', 'buttons' ),
			'content'     => '<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"3rem","bottom":"3rem","left":"2rem","right":"2rem"}},"color":{"background":"#6b1e2a","text":"#faf6f0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide has-text-color has-background" style="color:#faf6f0;background-color:#6b1e2a;padding-top:3rem;padding-right:2rem;padding-bottom:3rem;padding-left:2rem"><!-- wp:heading {"textAlign":"center","style":{"typography":{"fontStyle":"normal","fontWeight":"700"}}} -->
<h2 class="wp-block-heading has-text-align-center">' . esc_html__( 'Reserve Your Table', 'your-restaurant' ) . '</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">' . esc_html__( 'Whether it\'s an intimate dinner for two or a celebration with loved ones, we\'ll make it unforgettable.', 'your-restaurant' ) . '</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"","style":{"color":{"background":"#c9882a","text":"#faf6f0"}}} -->
<div class="wp-block-button"><a class="wp-block-button__link has-text-color has-background wp-element-button" style="color:#faf6f0;background-color:#c9882a">' . esc_html__( 'Make a Reservation', 'your-restaurant' ) . '</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->',
		)
	);

	register_block_pattern(
		'your-restaurant/hours-card',
		array(
			'title'       => __( 'Opening Hours Card', 'your-restaurant' ),
			'description' => __( 'A simple opening hours content block.', 'your-restaurant' ),
			'categories'  => array( 'your-restaurant', 'text' ),
			'content'     => '<!-- wp:group {"style":{"spacing":{"padding":{"top":"1.5rem","bottom":"1.5rem","left":"1.5rem","right":"1.5rem"}},"border":{"width":"1px","color":"#6b1e2a2e"}},"backgroundColor":"","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-border-color" style="border-color:#6b1e2a2e;border-width:1px;padding-top:1.5rem;padding-right:1.5rem;padding-bottom:1.5rem;padding-left:1.5rem"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">' . esc_html__( 'Hours', 'your-restaurant' ) . '</h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><strong>' . esc_html__( 'Monday – Thursday', 'your-restaurant' ) . '</strong><br>' . esc_html__( '12:00 PM – 10:00 PM', 'your-restaurant' ) . '</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><strong>' . esc_html__( 'Friday – Saturday', 'your-restaurant' ) . '</strong><br>' . esc_html__( '12:00 PM – 12:00 AM', 'your-restaurant' ) . '</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><strong>' . esc_html__( 'Sunday', 'your-restaurant' ) . '</strong><br>' . esc_html__( '11:00 AM – 9:00 PM', 'your-restaurant' ) . '</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->',
		)
	);
}
add_action( 'init', 'yr_register_block_patterns' );
