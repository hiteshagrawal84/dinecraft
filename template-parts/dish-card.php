<?php
/**
 * Featured dish card (home dark section).
 *
 * @package DineCraft
 */

$item     = $args['item'] ?? null;
$menu_url = $args['menu_url'] ?? yr_page_url( 'page-templates/template-menu.php' );
if ( ! $item ) {
	return;
}

$image = yr_image_url( $item->ID, '_yr_image_url' );
$badge = yr_meta( $item->ID, '_yr_badge' );
$price = yr_meta( $item->ID, '_yr_price' );
$color = function_exists( 'yr_badge_color' ) ? yr_badge_color( $badge ) : '#C9882A';
?>
<a href="<?php echo esc_url( $menu_url ); ?>" class="yr-dish-card">
	<div class="yr-dish-card__image">
		<img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $item->post_title ); ?>" width="500" height="380" loading="lazy" decoding="async" />
		<?php if ( $badge ) : ?>
			<span class="yr-badge" style="background:<?php echo esc_attr( $color ); ?>"><?php echo esc_html( $badge ); ?></span>
		<?php endif; ?>
	</div>
	<div class="yr-dish-card__body">
		<div class="yr-dish-card__head">
			<h3><?php echo esc_html( $item->post_title ); ?></h3>
			<span class="yr-dish-card__price"><?php echo esc_html( $price ); ?></span>
		</div>
		<p class="yr-dish-card__desc"><?php echo esc_html( $item->post_content ); ?></p>
	</div>
</a>
