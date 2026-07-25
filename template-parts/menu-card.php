<?php
/**
 * Menu card (menu page).
 *
 * @package YourRestaurant
 */

$item = $args['item'] ?? null;
if ( ! $item ) {
	return;
}

$image = yr_image_url( $item->ID, '_yr_image_url' );
$badge = yr_meta( $item->ID, '_yr_badge' );
$price = yr_meta( $item->ID, '_yr_price' );
$color = function_exists( 'yr_badge_color' ) ? yr_badge_color( $badge ) : '#C9882A';
?>
<article class="yr-menu-card yr-reveal">
	<div class="yr-menu-card__image">
		<img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $item->post_title ); ?>" width="500" height="380" loading="lazy" decoding="async" />
		<?php if ( $badge ) : ?>
			<span class="yr-badge" style="background:<?php echo esc_attr( $color ); ?>"><?php echo esc_html( $badge ); ?></span>
		<?php endif; ?>
	</div>
	<div class="yr-menu-card__body">
		<div class="yr-menu-card__head">
			<h3><?php echo esc_html( $item->post_title ); ?></h3>
			<span class="yr-menu-card__price"><?php echo esc_html( $price ); ?></span>
		</div>
		<p><?php echo esc_html( $item->post_content ); ?></p>
	</div>
</article>
