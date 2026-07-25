<?php
/**
 * Helper functions.
 *
 * @package YourRestaurant
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Bundled placeholder image URL (GPL-compatible theme assets).
 *
 * @param string $key Placeholder key without extension.
 * @return string
 */
function yr_placeholder( $key = 'hero-1' ) {
	$file = 'assets/images/placeholders/' . sanitize_file_name( $key ) . '.jpg';
	$path = YR_THEME_DIR . '/' . $file;
	if ( ! file_exists( $path ) ) {
		$file = 'assets/images/placeholders/hero-1.jpg';
	}
	return trailingslashit( YR_THEME_URI ) . $file;
}

/**
 * Resolve placeholder:key references or return the original URL.
 *
 * @param string $value Image URL or placeholder token.
 * @return string
 */
function yr_resolve_media_url( $value ) {
	if ( ! is_string( $value ) || '' === $value ) {
		return '';
	}
	if ( 0 === strpos( $value, 'placeholder:' ) ) {
		return yr_placeholder( substr( $value, 12 ) );
	}
	return $value;
}

/**
 * Default site settings.
 */
function yr_default_settings() {
	return array(
		'site_name'           => 'Your Restaurant',
		'site_tagline'        => 'Fine Dining',
		'logo'                => '',
		'favicon'             => '',
		'footer_description'  => 'A culinary journey through flavors, tradition, and artistry. Every plate tells a story.',
		'footer_address'      => '42 Ashram Road, Navrangpura, Ahmedabad, Gujarat 380009, India',
		'footer_phone'        => '+91 79 1234 5678',
		'footer_email'        => 'hello@yourrestaurant.com',
		'footer_hours'        => array(
			array( 'day' => 'Monday – Thursday', 'time' => '12:00 PM – 10:00 PM' ),
			array( 'day' => 'Friday – Saturday', 'time' => '12:00 PM – 12:00 AM' ),
			array( 'day' => 'Sunday', 'time' => '11:00 AM – 9:00 PM' ),
		),
		'footer_social'       => array(
			'instagram' => 'https://instagram.com',
			'facebook'  => 'https://facebook.com',
			'twitter'   => 'https://twitter.com',
		),
		'footer_copyright'    => '© 2026 Your Restaurant Fine Dining. All rights reserved.',
		'footer_tagline'      => 'Design & Developed by CreatesWowtech.com',
		'footer_credit_url'   => 'https://www.createswowtech.com',
		'contact_emails'      => array(),
		'contact_phones'      => array(),
		'hero_title'          => 'Where Every Meal Becomes a Memory',
		'hero_subtitle'       => 'An intimate fine dining experience where seasonal ingredients, expert technique, and warm hospitality converge.',
		'stats'               => array(
			array( 'value' => '12', 'label' => 'Years of Excellence' ),
			array( 'value' => '40K+', 'label' => 'Happy Guests' ),
			array( 'value' => '4.9', 'label' => 'Average Rating' ),
			array( 'value' => '7', 'label' => 'Days a Week' ),
		),
		'home_story'          => array(
			'eyebrow'         => 'Our Story',
			'title'           => 'A Labour of Love,',
			'title_highlight' => 'Since 2012',
			'description'     => 'Your Restaurant was born from a simple conviction: that great food is inseparable from great company.',
			'cta_text'        => 'Discover Our Story',
			'cta_link'        => '/about',
			'image'           => '',
			'badge_value'     => '12',
			'badge_label'     => 'Years of Excellence',
		),
		'map_latitude'        => '23.0330',
		'map_longitude'       => '72.5649',
		'about'               => array(
			'team'       => array(),
			'values'     => array(),
			'milestones' => array(),
		),
		'menu_tasting'        => array(
			'title'       => "Chef's Tasting Menu",
			'description' => 'A six-course journey through our seasonal highlights, curated by Chef Mathieu Laurent.',
			'price'       => '₹3,950',
			'note'        => 'per person · wine pairing available',
		),
	);
}

/**
 * Get merged site settings.
 */
function yr_get_settings() {
	static $settings = null;

	if ( null !== $settings && ! is_customize_preview() ) {
		return $settings;
	}

	$stored   = get_option( 'yr_site_settings', array() );
	$settings = wp_parse_args( is_array( $stored ) ? $stored : array(), yr_default_settings() );

	$customizer_fields = array(
		'site_name',
		'site_tagline',
		'hero_title',
		'hero_subtitle',
		'footer_description',
		'footer_address',
		'footer_phone',
		'footer_email',
		'footer_copyright',
		'footer_credit_url',
		'map_latitude',
		'map_longitude',
	);

	foreach ( $customizer_fields as $field ) {
		$value = get_theme_mod( 'yr_' . $field, '' );
		if ( '' !== $value ) {
			$settings[ $field ] = $value;
		}
	}

	foreach ( array( 'instagram', 'facebook', 'twitter' ) as $network ) {
		$value = get_theme_mod( 'yr_' . $network, '' );
		if ( '' !== $value ) {
			$settings['footer_social'][ $network ] = $value;
		}
	}

	return $settings;
}

/**
 * Get a single setting value.
 */
function yr_setting( $key, $default = '' ) {
	$settings = yr_get_settings();
	return isset( $settings[ $key ] ) ? $settings[ $key ] : $default;
}

/**
 * Get active banners.
 */
function yr_get_banners() {
	if ( ! post_type_exists( 'yr_banner' ) ) {
		return array();
	}

	return get_posts( array(
		'post_type'      => 'yr_banner',
		'posts_per_page' => 10,
		'no_found_rows'  => true,
		'meta_key'       => '_yr_sort_order',
		'orderby'        => 'meta_value_num',
		'order'          => 'ASC',
		'meta_query'     => array(
			array(
				'key'   => '_yr_is_active',
				'value' => '1',
			),
		),
	) );
}

/**
 * Get menu categories.
 */
function yr_get_menu_categories() {
	if ( ! taxonomy_exists( 'yr_menu_category' ) ) {
		return array();
	}

	$terms = get_terms( array(
		'taxonomy'   => 'yr_menu_category',
		'hide_empty' => false,
		'meta_key'   => 'sort_order',
		'orderby'    => 'meta_value_num',
		'order'      => 'ASC',
	) );

	return is_wp_error( $terms ) ? array() : $terms;
}

/**
 * Get menu items.
 */
function yr_get_menu_items( $category_slug = '' ) {
	if ( ! post_type_exists( 'yr_menu_item' ) ) {
		return array();
	}

	$args = array(
		'post_type'      => 'yr_menu_item',
		'posts_per_page' => 100,
		'no_found_rows'  => true,
		'meta_key'       => '_yr_sort_order',
		'orderby'        => 'meta_value_num',
		'order'          => 'ASC',
		'meta_query'     => array(
			array(
				'key'   => '_yr_is_active',
				'value' => '1',
			),
		),
	);

	if ( $category_slug ) {
		$args['tax_query'] = array(
			array(
				'taxonomy' => 'yr_menu_category',
				'field'    => 'slug',
				'terms'    => $category_slug,
			),
		);
	}

	return get_posts( $args );
}

/**
 * Get featured menu items.
 */
function yr_get_featured_menu_items( $limit = 3 ) {
	if ( ! post_type_exists( 'yr_menu_item' ) ) {
		return array();
	}

	return get_posts( array(
		'post_type'      => 'yr_menu_item',
		'posts_per_page' => $limit,
		'no_found_rows'  => true,
		'meta_key'       => '_yr_sort_order',
		'orderby'        => 'meta_value_num',
		'order'          => 'ASC',
		'meta_query'     => array(
			'relation' => 'AND',
			array(
				'key'   => '_yr_is_active',
				'value' => '1',
			),
			array(
				'key'   => '_yr_is_featured',
				'value' => '1',
			),
		),
	) );
}

/**
 * Get active testimonials.
 */
function yr_get_testimonials( $limit = 3 ) {
	if ( ! post_type_exists( 'yr_testimonial' ) ) {
		return array();
	}

	return get_posts( array(
		'post_type'      => 'yr_testimonial',
		'posts_per_page' => $limit,
		'no_found_rows'  => true,
		'meta_key'       => '_yr_sort_order',
		'orderby'        => 'meta_value_num',
		'order'          => 'ASC',
		'meta_query'     => array(
			array(
				'key'   => '_yr_is_active',
				'value' => '1',
			),
		),
	) );
}

/**
 * Get post meta with default.
 */
function yr_meta( $post_id, $key, $default = '' ) {
	$value = get_post_meta( $post_id, $key, true );
	return ( '' !== $value && null !== $value ) ? $value : $default;
}

/**
 * Get featured image or fallback URL.
 */
function yr_image_url( $post_id, $meta_key = '', $fallback = '' ) {
	if ( has_post_thumbnail( $post_id ) ) {
		return get_the_post_thumbnail_url( $post_id, 'large' );
	}

	$url = $meta_key ? yr_meta( $post_id, $meta_key ) : '';
	$url = yr_resolve_media_url( $url );
	return $url ? $url : yr_resolve_media_url( $fallback );
}

/**
 * Badge color map matching React MenuContent.tsx.
 */
function yr_badge_colors() {
	return array(
		"Chef's Pick" => '#6B1E2A',
		'Signature'   => '#6B1E2A',
		'Premium'     => '#1A1208',
		'New'         => '#C9882A',
		'Favourite'   => '#C9882A',
		'Popular'     => '#C9882A',
		'Seasonal'    => '#7A6855',
		'Must Try'    => '#6B1E2A',
	);
}

/**
 * Get badge background color hex.
 */
function yr_badge_color( $badge ) {
	$colors = yr_badge_colors();
	return isset( $colors[ $badge ] ) ? $colors[ $badge ] : '#C9882A';
}

/**
 * Badge CSS class (semantic grouping aligned with React colors).
 */
function yr_badge_class( $badge ) {
	$gold  = array( 'New', 'Favourite', 'Popular' );
	$muted = array( 'Seasonal' );
	$dark  = array( "Chef's Pick", 'Signature', 'Must Try' );
	$premium = array( 'Premium' );

	if ( in_array( $badge, $gold, true ) ) {
		return 'yr-badge--gold';
	}
	if ( in_array( $badge, $muted, true ) ) {
		return 'yr-badge--muted';
	}
	if ( in_array( $badge, $premium, true ) ) {
		return 'yr-badge--premium';
	}
	if ( in_array( $badge, $dark, true ) ) {
		return 'yr-badge--dark';
	}
	return 'yr-badge--primary';
}

/**
 * Inline badge style attribute value.
 */
function yr_badge_style( $badge ) {
	return 'background-color:' . yr_badge_color( $badge );
}

/**
 * Render star rating.
 */
function yr_stars( $rating ) {
	$output = '<div class="yr-stars" aria-label="' . esc_attr( sprintf( __( '%d out of 5 stars', 'your-restaurant' ), $rating ) ) . '">';
	for ( $i = 1; $i <= 5; $i++ ) {
		$output .= '<span class="yr-star' . ( $i <= $rating ? ' yr-star--filled' : '' ) . '">★</span>';
	}
	$output .= '</div>';
	return $output;
}

/**
 * Get page URL by template.
 */
function yr_page_url( $template ) {
	static $urls = array();

	if ( isset( $urls[ $template ] ) ) {
		return $urls[ $template ];
	}

	$pages = get_posts( array(
		'post_type'      => 'page',
		'posts_per_page' => 1,
		'meta_key'       => '_wp_page_template',
		'meta_value'     => $template,
		'no_found_rows'  => true,
	) );

	$urls[ $template ] = ! empty( $pages ) ? get_permalink( $pages[0] ) : home_url( '/' );
	return $urls[ $template ];
}

/**
 * Split hero title on "Becomes a Memory" for styled output.
 */
function yr_hero_title_parts( $title = '' ) {
	if ( ! $title ) {
		$title = yr_setting( 'hero_title', 'Where Every Meal Becomes a Memory' );
	}

	$delimiter = 'Becomes a Memory';
	$pos       = strpos( $title, $delimiter );

	if ( false === $pos ) {
		return array(
			'before'        => $title,
			'highlight'     => '',
			'after'         => '',
			'has_highlight' => false,
		);
	}

	return array(
		'before'        => trim( substr( $title, 0, $pos ) ),
		'highlight'     => $delimiter,
		'after'         => trim( substr( $title, $pos + strlen( $delimiter ) ) ),
		'has_highlight' => true,
	);
}

