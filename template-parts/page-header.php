<?php
/**
 * Page header.
 *
 * @package DineCraft
 */

$eyebrow  = $args['eyebrow'] ?? '';
$title    = $args['title'] ?? get_the_title();
$subtitle = $args['subtitle'] ?? '';
?>
<section class="yr-page-header">
	<div class="yr-container yr-reveal">
		<?php if ( $eyebrow ) : ?>
			<p class="yr-eyebrow"><?php echo esc_html( $eyebrow ); ?></p>
		<?php endif; ?>
		<div class="yr-ornament" aria-hidden="true"><span class="yr-ornament__diamond"></span></div>
		<h1 class="yr-page-header__title"><?php echo esc_html( $title ); ?></h1>
		<?php if ( $subtitle ) : ?>
			<p class="yr-page-header__subtitle"><?php echo esc_html( $subtitle ); ?></p>
		<?php endif; ?>
	</div>
</section>
