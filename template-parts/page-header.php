<?php
/**
 * Page header.
 *
 * @package YourRestaurant
 */

$eyebrow  = $args['eyebrow'] ?? '';
$title    = $args['title'] ?? get_the_title();
$subtitle = $args['subtitle'] ?? '';
?>
<section class="yr-page-header">
	<div class="yr-page-header__overlay" aria-hidden="true"></div>
	<div class="yr-container yr-page-header__inner">
		<?php if ( $eyebrow ) : ?>
			<p class="yr-eyebrow yr-eyebrow--light"><?php echo esc_html( $eyebrow ); ?></p>
		<?php endif; ?>
		<h1 class="yr-page-header__title"><?php echo esc_html( $title ); ?></h1>
		<?php if ( $subtitle ) : ?>
			<p class="yr-page-header__subtitle"><?php echo esc_html( $subtitle ); ?></p>
		<?php endif; ?>
	</div>
</section>
