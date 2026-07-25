<?php
/**
 * Restaurant map section.
 *
 * @package DineCraft
 */

$settings = yr_get_settings();
$lat      = $settings['map_latitude'];
$lng      = $settings['map_longitude'];
$dirs     = 'https://www.google.com/maps/dir/?api=1&destination=' . rawurlencode( $lat . ',' . $lng );
?>
<section class="yr-map-section">
	<div class="yr-container yr-map-header">
		<div>
			<div class="yr-map-label">
				<?php echo yr_icon( 'map-pin', 15 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				<?php esc_html_e( 'Find Us on the Map', 'dinecraft' ); ?>
			</div>
			<p class="yr-map-address"><?php echo esc_html( $settings['footer_address'] ); ?></p>
		</div>
		<a href="<?php echo esc_url( $dirs ); ?>" class="yr-btn yr-btn--primary yr-btn--sm" target="_blank" rel="noopener noreferrer">
			<?php esc_html_e( 'Get Directions', 'dinecraft' ); ?>
			<?php echo yr_icon( 'external', 14 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		</a>
	</div>
	<div class="yr-map-frame">
		<a class="yr-map-canvas" href="<?php echo esc_url( $dirs ); ?>" target="_blank" rel="noopener noreferrer">
			<span class="screen-reader-text">
				<?php
				printf(
					/* translators: %s: restaurant name. */
					esc_html__( 'Open directions to %s in Google Maps', 'dinecraft' ),
					esc_html( $settings['site_name'] )
				);
				?>
			</span>
		</a>
		<div class="yr-map-pin">
			<div class="yr-map-pin__marker">
				<div class="yr-map-pin__dot"><?php echo yr_icon( 'chef-hat', 24 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
				<div class="yr-map-pin__arrow"></div>
				<div class="yr-map-pin__label"><?php echo esc_html( $settings['site_name'] ); ?></div>
			</div>
		</div>
	</div>
</section>
