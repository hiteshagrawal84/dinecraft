<?php
/**
 * Fallback navigation menu.
 *
 * @package DineCraft
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Output fallback nav when no menu is assigned.
 */
function yr_fallback_menu() {
	$blog_page = get_option( 'page_for_posts' );
	$blog_url  = $blog_page ? get_permalink( $blog_page ) : home_url( '/blog' );

	$links = array(
		home_url( '/' )                                      => __( 'Home', 'dinecraft' ),
		yr_page_url( 'page-templates/template-menu.php' )    => __( 'Menu', 'dinecraft' ),
		yr_page_url( 'page-templates/template-book.php' )      => __( 'Book', 'dinecraft' ),
		yr_page_url( 'page-templates/template-about.php' )     => __( 'About', 'dinecraft' ),
		$blog_url                                              => __( 'Blog', 'dinecraft' ),
		yr_page_url( 'page-templates/template-contact.php' ) => __( 'Contact', 'dinecraft' ),
	);

	echo '<ul class="yr-nav__menu">';
	foreach ( $links as $url => $label ) {
		echo '<li><a href="' . esc_url( $url ) . '">' . esc_html( $label ) . '</a></li>';
	}
	echo '</ul>';
}
