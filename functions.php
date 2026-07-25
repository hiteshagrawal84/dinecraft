<?php
/**
 * DineCraft theme functions.
 *
 * @package DineCraft
 *
 * Copyright (C) 2026 CreatesWowtech
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'YR_THEME_VERSION', '1.2.0' );
define( 'YR_THEME_DIR', get_template_directory() );
define( 'YR_THEME_URI', get_template_directory_uri() );

require_once YR_THEME_DIR . '/inc/helpers.php';
require_once YR_THEME_DIR . '/inc/icons.php';
require_once YR_THEME_DIR . '/inc/fallback-menu.php';
require_once YR_THEME_DIR . '/inc/blocks.php';
require_once YR_THEME_DIR . '/inc/customizer.php';

/**
 * Theme setup.
 */
function yr_theme_setup() {
	load_theme_textdomain( 'dinecraft', YR_THEME_DIR . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'custom-logo', array(
		'height'      => 80,
		'width'       => 200,
		'flex-height' => true,
		'flex-width'  => true,
	) );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'editor-styles' );
	add_theme_support(
		'custom-background',
		array(
			'default-color' => 'faf6f0',
		)
	);
	add_theme_support(
		'custom-header',
		array(
			'default-image' => '',
			'width'         => 1920,
			'height'        => 600,
			'flex-height'   => true,
			'flex-width'    => true,
			'header-text'   => false,
		)
	);

	add_editor_style( 'assets/css/editor-style.css' );

	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'dinecraft' ),
		'footer'  => __( 'Footer Menu', 'dinecraft' ),
	) );

	add_image_size( 'yr-banner', 1920, 1080, true );
	add_image_size( 'yr-menu', 800, 600, true );
	add_image_size( 'yr-blog', 1200, 630, true );
}
add_action( 'after_setup_theme', 'yr_theme_setup' );

/**
 * Set the content width in pixels.
 */
function yr_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'yr_content_width', 768 );
}
add_action( 'after_setup_theme', 'yr_content_width', 0 );

/**
 * Register widget areas.
 */
function yr_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Blog Sidebar', 'dinecraft' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Widgets shown beside blog content.', 'dinecraft' ),
			'before_widget' => '<section id="%1$s" class="yr-widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="yr-widget__title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer Widgets', 'dinecraft' ),
			'id'            => 'footer-1',
			'description'   => __( 'Optional widgets above the site footer credits.', 'dinecraft' ),
			'before_widget' => '<section id="%1$s" class="yr-widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4 class="yr-widget__title">',
			'after_title'   => '</h4>',
		)
	);
}
add_action( 'widgets_init', 'yr_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function yr_enqueue_assets() {
	wp_enqueue_style(
		'yr-style',
		get_stylesheet_uri(),
		array(),
		YR_THEME_VERSION
	);

	if ( file_exists( YR_THEME_DIR . '/assets/css/main.css' ) ) {
		wp_enqueue_style(
			'yr-main',
			YR_THEME_URI . '/assets/css/main.css',
			array( 'yr-style' ),
			YR_THEME_VERSION
		);
	}

	if ( file_exists( YR_THEME_DIR . '/assets/js/main.js' ) ) {
		wp_enqueue_script(
			'yr-main',
			YR_THEME_URI . '/assets/js/main.js',
			array(),
			YR_THEME_VERSION,
			true
		);

	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'yr_enqueue_assets' );

/**
 * Admin notice when companion plugin is missing.
 */
function dinecraft_plugin_notice() {
	if ( ! current_user_can( 'activate_plugins' ) || post_type_exists( 'yr_banner' ) ) {
		return;
	}
	?>
	<div class="notice notice-warning">
		<p>
			<?php
			esc_html_e(
				'DineCraft works best with the DineCraft Core plugin for banners, menus, testimonials, and reservations.',
				'dinecraft'
			);
			?>
		</p>
	</div>
	<?php
}
add_action( 'admin_notices', 'dinecraft_plugin_notice' );

/**
 * Custom comment markup with avatars.
 *
 * @param WP_Comment $comment Comment object.
 * @param array      $args    Arguments.
 * @param int        $depth   Depth.
 */
function yr_comment_callback( $comment, $args, $depth ) {
	$tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
	?>
	<<?php echo esc_attr( $tag ); ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent', $comment ); ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class="yr-comment">
			<header class="yr-comment__header">
				<div class="yr-comment__avatar">
					<?php
					echo get_avatar(
						$comment,
						isset( $args['avatar_size'] ) ? (int) $args['avatar_size'] : 56,
						'',
						esc_attr( sprintf( __( 'Avatar for %s', 'dinecraft' ), get_comment_author( $comment ) ) )
					);
					?>
				</div>
				<div class="yr-comment__meta">
					<strong class="yr-comment__author"><?php comment_author_link( $comment ); ?></strong>
					<a class="yr-comment__date" href="<?php echo esc_url( get_comment_link( $comment ) ); ?>">
						<time datetime="<?php comment_time( 'c' ); ?>">
							<?php
							printf(
								/* translators: 1: comment date, 2: comment time */
								esc_html__( '%1$s at %2$s', 'dinecraft' ),
								esc_html( get_comment_date( '', $comment ) ),
								esc_html( get_comment_time() )
							);
							?>
						</time>
					</a>
				</div>
			</header>

			<?php if ( '0' === (string) $comment->comment_approved ) : ?>
				<p class="yr-comment__awaiting"><?php esc_html_e( 'Your comment is awaiting moderation.', 'dinecraft' ); ?></p>
			<?php endif; ?>

			<div class="yr-comment__content">
				<?php comment_text(); ?>
			</div>

			<div class="yr-comment__reply">
				<?php
				comment_reply_link(
					array_merge(
						$args,
						array(
							'add_below' => 'div-comment',
							'depth'     => $depth,
							'max_depth' => $args['max_depth'],
						)
					)
				);
				?>
			</div>
		</article>
	<?php
}

