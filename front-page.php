<?php
/**
 * Front page — matches HomeContent.tsx
 *
 * @package YourRestaurant
 */

get_header();

$settings     = yr_get_settings();
$banners      = yr_get_banners();
$featured     = yr_get_featured_menu_items( 3 );
$testimonials = yr_get_testimonials( 3 );
$book_url     = yr_page_url( 'page-templates/template-book.php' );
$menu_url     = yr_page_url( 'page-templates/template-menu.php' );
$about_url    = yr_page_url( 'page-templates/template-about.php' );
$story        = $settings['home_story'];
$hero_parts   = yr_hero_title_parts( $settings['hero_title'] );
$stat_icons   = array( 'award', 'users', 'star', 'clock' );

$hero_slides = array();
if ( $banners ) {
	foreach ( $banners as $banner ) {
		$hero_slides[] = array(
			'image'    => yr_image_url( $banner->ID, '_yr_image_url' ),
			'subtitle' => yr_meta( $banner->ID, '_yr_subtitle' ),
		);
	}
} else {
	$hero_slides[] = array(
		'image'    => yr_placeholder( 'hero-1' ),
		'subtitle' => sprintf( __( 'Welcome to %s', 'your-restaurant' ), $settings['site_name'] ),
	);
}

$story_image = ! empty( $story['image'] ) ? yr_resolve_media_url( $story['image'] ) : yr_placeholder( 'story' );
$story_url   = $story['cta_link'] ?? $about_url;
if ( is_string( $story_url ) && 0 === strpos( $story_url, '/' ) ) {
	$story_url = home_url( $story_url );
}
$badge_lines = preg_split( '/\r\n|\r|\n/', $story['badge_label'] ?? '' );
?>

<section class="yr-hero" data-hero>
	<?php foreach ( $hero_slides as $i => $slide ) : ?>
		<?php if ( 0 === $i ) : ?>
			<div class="yr-hero__slide is-active" data-hero-slide>
				<img
					class="yr-hero__image"
					src="<?php echo esc_url( $slide['image'] ); ?>"
					alt=""
					width="1800"
					height="900"
					fetchpriority="high"
					decoding="async"
				/>
			</div>
		<?php else : ?>
			<div class="yr-hero__slide" data-hero-slide data-hero-src="<?php echo esc_url( $slide['image'] ); ?>"></div>
		<?php endif; ?>
	<?php endforeach; ?>
	<div class="yr-hero__overlay"></div>
	<div class="yr-hero__ornament" aria-hidden="true"></div>

	<?php if ( count( $hero_slides ) > 1 ) : ?>
		<div class="yr-hero__dots">
			<?php foreach ( $hero_slides as $i => $slide ) : ?>
				<button type="button" class="yr-hero__dot<?php echo 0 === $i ? ' is-active' : ''; ?>" data-hero-dot="<?php echo esc_attr( (string) $i ); ?>" aria-label="<?php echo esc_attr( sprintf( __( 'Slide %d', 'your-restaurant' ), $i + 1 ) ); ?>"></button>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>

	<div class="yr-hero__content">
		<p class="yr-hero__brand">
			<?php echo esc_html( $settings['site_name'] ); ?>
			<?php if ( ! empty( $settings['site_tagline'] ) ) : ?>
				<span><?php echo esc_html( $settings['site_tagline'] ); ?></span>
			<?php endif; ?>
		</p>
		<p class="yr-hero__eyebrow" data-hero-eyebrow><?php echo esc_html( $hero_slides[0]['subtitle'] ?: sprintf( __( 'Welcome to %s', 'your-restaurant' ), $settings['site_name'] ) ); ?></p>
		<h1 class="yr-hero__title">
			<?php echo esc_html( $hero_parts['before'] ); ?>
			<?php if ( ! empty( $hero_parts['highlight'] ) ) : ?>
				<br><em><?php echo esc_html( $hero_parts['highlight'] ); ?></em>
			<?php endif; ?>
			<?php if ( ! empty( $hero_parts['after'] ) ) : ?>
				<br><?php echo esc_html( $hero_parts['after'] ); ?>
			<?php endif; ?>
		</h1>
		<p class="yr-hero__subtitle"><?php echo esc_html( $settings['hero_subtitle'] ); ?></p>
		<div class="yr-hero__actions">
			<a href="<?php echo esc_url( $book_url ); ?>" class="yr-btn yr-btn--accent"><?php esc_html_e( 'Reserve a Table', 'your-restaurant' ); ?></a>
			<a href="<?php echo esc_url( $menu_url ); ?>" class="yr-btn yr-btn--outline-light"><?php esc_html_e( 'Explore Menu', 'your-restaurant' ); ?> <?php echo yr_icon( 'arrow', 14 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></a>
		</div>
	</div>
</section>

<section class="yr-stats">
	<div class="yr-container yr-stats__grid">
		<?php foreach ( $settings['stats'] as $i => $stat ) : ?>
			<div class="yr-stat yr-reveal">
				<span class="yr-stat__icon"><?php echo yr_icon( $stat_icons[ $i ] ?? 'award', 20 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
				<strong class="yr-stat__value"><?php echo esc_html( $stat['value'] ); ?></strong>
				<span class="yr-stat__label"><?php echo esc_html( $stat['label'] ); ?></span>
			</div>
		<?php endforeach; ?>
	</div>
</section>

<section class="yr-section">
	<div class="yr-container yr-grid-2">
		<div class="yr-story-media yr-reveal">
			<img src="<?php echo esc_url( $story_image ); ?>" alt="<?php echo esc_attr( $story['title'] ?? '' ); ?>" width="700" height="850" loading="lazy" decoding="async" />
			<div class="yr-story-badge">
				<strong><?php echo esc_html( $story['badge_value'] ?? '12' ); ?></strong>
				<span><?php echo esc_html( implode( ' ', $badge_lines ) ); ?></span>
			</div>
		</div>
		<div class="yr-reveal">
			<p class="yr-eyebrow"><?php echo esc_html( $story['eyebrow'] ?? __( 'Our Story', 'your-restaurant' ) ); ?></p>
			<h2 class="yr-heading"><?php echo esc_html( $story['title'] ?? '' ); ?><br><em><?php echo esc_html( $story['title_highlight'] ?? '' ); ?></em></h2>
			<p class="yr-text"><?php echo esc_html( $story['description'] ?? '' ); ?></p>
			<a href="<?php echo esc_url( $story_url ); ?>" class="yr-link-cta">
				<?php echo esc_html( $story['cta_text'] ?? __( 'Discover Our Story', 'your-restaurant' ) ); ?>
				<span class="yr-link-cta__icon"><?php echo yr_icon( 'arrow', 14 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
			</a>
		</div>
	</div>
</section>

<?php if ( $featured ) : ?>
<section class="yr-section yr-section--dark">
	<div class="yr-container">
		<div class="yr-section__header yr-section__header--center yr-reveal">
			<p class="yr-eyebrow"><?php esc_html_e( 'Culinary Highlights', 'your-restaurant' ); ?></p>
			<h2 class="yr-heading yr-heading--light"><?php esc_html_e( 'Signature Creations', 'your-restaurant' ); ?></h2>
		</div>
		<div class="yr-grid-3">
			<?php foreach ( $featured as $item ) : ?>
				<?php get_template_part( 'template-parts/dish', 'card', array( 'item' => $item, 'menu_url' => $menu_url ) ); ?>
			<?php endforeach; ?>
		</div>
		<div class="yr-text-center yr-mt-12 yr-reveal">
			<a href="<?php echo esc_url( $menu_url ); ?>" class="yr-btn yr-btn--outline-gold"><?php esc_html_e( 'View Full Menu', 'your-restaurant' ); ?></a>
		</div>
	</div>
</section>
<?php endif; ?>

<section class="yr-cta-band">
	<div class="yr-cta-band__inner yr-reveal">
		<p class="yr-eyebrow yr-eyebrow--light"><?php esc_html_e( '— Join Us Tonight —', 'your-restaurant' ); ?></p>
		<h2 class="yr-heading yr-heading--light"><?php esc_html_e( 'Reserve Your Table', 'your-restaurant' ); ?></h2>
		<p class="yr-text yr-text--light"><?php esc_html_e( "Whether it's an intimate dinner for two or a celebration with loved ones, we'll make it unforgettable.", 'your-restaurant' ); ?></p>
		<a href="<?php echo esc_url( $book_url ); ?>" class="yr-btn yr-btn--accent"><?php esc_html_e( 'Make a Reservation', 'your-restaurant' ); ?></a>
	</div>
</section>

<?php if ( $testimonials ) : ?>
<section class="yr-section">
	<div class="yr-container">
		<div class="yr-section__header yr-section__header--center yr-reveal">
			<p class="yr-eyebrow"><?php esc_html_e( 'Guest Voices', 'your-restaurant' ); ?></p>
			<h2 class="yr-heading"><?php esc_html_e( 'What Our Guests Say', 'your-restaurant' ); ?></h2>
		</div>
		<div class="yr-grid-3">
			<?php foreach ( $testimonials as $testimonial ) : ?>
				<?php get_template_part( 'template-parts/testimonial', 'card', array( 'testimonial' => $testimonial ) ); ?>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<?php endif; ?>

<?php get_footer(); ?>
