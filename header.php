<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,500;1,600&display=swap" rel="stylesheet">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#yr-content"><?php esc_html_e( 'Skip to content', 'your-restaurant' ); ?></a>

<?php
$settings = yr_get_settings();
$book_url = yr_page_url( 'page-templates/template-book.php' );
$nav_links = array(
	array( 'label' => __( 'Home', 'your-restaurant' ), 'url' => home_url( '/' ) ),
	array( 'label' => __( 'Menu', 'your-restaurant' ), 'url' => yr_page_url( 'page-templates/template-menu.php' ) ),
	array( 'label' => __( 'Book a Table', 'your-restaurant' ), 'url' => yr_page_url( 'page-templates/template-book.php' ) ),
	array( 'label' => __( 'About Us', 'your-restaurant' ), 'url' => yr_page_url( 'page-templates/template-about.php' ) ),
	array( 'label' => __( 'Blog', 'your-restaurant' ), 'url' => get_permalink( get_option( 'page_for_posts' ) ) ?: yr_page_url( 'page-templates/template-blog.php' ) ),
	array( 'label' => __( 'Contact', 'your-restaurant' ), 'url' => yr_page_url( 'page-templates/template-contact.php' ) ),
);
?>
<header class="yr-header" id="yr-header">
	<div class="yr-container yr-header__inner">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="yr-logo">
			<span class="yr-logo__icon" aria-hidden="true">
				<?php
				$logo_id = get_theme_mod( 'custom_logo' );
				if ( $logo_id ) :
					echo wp_get_attachment_image( $logo_id, 'thumbnail', false, array( 'alt' => esc_attr( $settings['site_name'] ) ) );
				else :
					echo yr_icon( 'chef-hat', 20 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				endif;
				?>
			</span>
			<span class="yr-logo__text">
				<span class="yr-logo__name"><?php echo esc_html( $settings['site_name'] ); ?></span>
				<span class="yr-logo__tagline"><?php echo esc_html( $settings['site_tagline'] ); ?></span>
			</span>
		</a>

		<nav class="yr-nav" aria-label="<?php esc_attr_e( 'Primary', 'your-restaurant' ); ?>">
			<?php if ( has_nav_menu( 'primary' ) ) : ?>
				<?php
				wp_nav_menu( array(
					'theme_location' => 'primary',
					'container'      => false,
					'menu_class'     => 'yr-nav__menu',
					'fallback_cb'    => false,
				) );
				?>
			<?php else : ?>
				<ul class="yr-nav__menu">
					<?php foreach ( $nav_links as $link ) : ?>
						<li><a href="<?php echo esc_url( $link['url'] ); ?>"><?php echo esc_html( $link['label'] ); ?></a></li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</nav>

		<a href="<?php echo esc_url( $book_url ); ?>" class="yr-btn yr-btn--accent yr-btn--sm yr-header__cta yr-header__cta--desktop">
			<?php esc_html_e( 'Reserve', 'your-restaurant' ); ?>
		</a>

		<button class="yr-nav__toggle" id="yr-nav-toggle" type="button" aria-expanded="false" aria-controls="yr-mobile-nav" aria-label="<?php esc_attr_e( 'Toggle menu', 'your-restaurant' ); ?>">
			<span class="yr-nav__toggle-open"><?php echo yr_icon( 'menu', 24 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
			<span class="yr-nav__toggle-close" hidden><?php echo yr_icon( 'close', 24 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
		</button>
	</div>

	<div class="yr-mobile-nav" id="yr-mobile-nav">
		<?php foreach ( $nav_links as $link ) : ?>
			<a href="<?php echo esc_url( $link['url'] ); ?>"><?php echo esc_html( $link['label'] ); ?></a>
		<?php endforeach; ?>
		<a href="<?php echo esc_url( $book_url ); ?>" class="yr-btn yr-btn--accent"><?php esc_html_e( 'Reserve a Table', 'your-restaurant' ); ?></a>
	</div>
</header>

<main class="yr-main" id="yr-content">
