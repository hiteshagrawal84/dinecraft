</main>

<?php
$settings     = yr_get_settings();
$social_labels = array( 'instagram' => 'IG', 'facebook' => 'FB', 'twitter' => 'X' );
$footer_links = array(
	array( home_url( '/' ), __( 'Home', 'your-restaurant' ) ),
	array( yr_page_url( 'page-templates/template-menu.php' ), __( 'Our Menu', 'your-restaurant' ) ),
	array( yr_page_url( 'page-templates/template-book.php' ), __( 'Book a Table', 'your-restaurant' ) ),
	array( yr_page_url( 'page-templates/template-about.php' ), __( 'About Us', 'your-restaurant' ) ),
	array( get_permalink( get_option( 'page_for_posts' ) ) ?: home_url( '/blog' ), __( 'Blog', 'your-restaurant' ) ),
	array( yr_page_url( 'page-templates/template-contact.php' ), __( 'Contact', 'your-restaurant' ) ),
);
$phones = ! empty( $settings['contact_phones'] ) ? $settings['contact_phones'] : array( $settings['footer_phone'] );
$emails = ! empty( $settings['contact_emails'] ) ? $settings['contact_emails'] : array( $settings['footer_email'] );
?>
<footer class="yr-footer">
	<div class="yr-footer__line" aria-hidden="true"></div>
	<div class="yr-container yr-footer__grid">
		<div class="yr-footer__brand">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="yr-logo" style="margin-bottom:1.5rem;">
				<span class="yr-logo__icon"><?php echo yr_icon( 'chef-hat', 20 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
				<span>
					<span class="yr-logo__name"><?php echo esc_html( $settings['site_name'] ); ?></span>
					<span class="yr-logo__tagline"><?php echo esc_html( $settings['site_tagline'] ); ?></span>
				</span>
			</a>
			<p><?php echo esc_html( $settings['footer_description'] ); ?></p>
			<div class="yr-footer__social">
				<?php foreach ( $settings['footer_social'] as $network => $url ) : ?>
					<?php if ( $url ) : ?>
						<a href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener noreferrer" title="<?php echo esc_attr( ucfirst( $network ) ); ?>">
							<?php echo esc_html( $social_labels[ $network ] ?? strtoupper( substr( $network, 0, 2 ) ) ); ?>
						</a>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
		</div>

		<div>
			<h4><?php esc_html_e( 'Navigation', 'your-restaurant' ); ?></h4>
			<ul class="yr-footer__links">
				<?php foreach ( $footer_links as $link ) : ?>
					<li><a href="<?php echo esc_url( $link[0] ); ?>"><?php echo esc_html( $link[1] ); ?></a></li>
				<?php endforeach; ?>
			</ul>
		</div>

		<div>
			<h4><?php esc_html_e( 'Hours', 'your-restaurant' ); ?></h4>
			<ul class="yr-footer__hours">
				<?php foreach ( $settings['footer_hours'] as $hour ) : ?>
					<li>
						<div class="yr-footer__hours-day"><?php echo esc_html( $hour['day'] ); ?></div>
						<div class="yr-footer__hours-time"><?php echo esc_html( $hour['time'] ); ?></div>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>

		<div>
			<h4><?php esc_html_e( 'Contact', 'your-restaurant' ); ?></h4>
			<ul class="yr-footer__contact">
				<li>
					<?php echo yr_icon( 'map-pin', 15 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					<span><?php echo esc_html( $settings['footer_address'] ); ?></span>
				</li>
				<?php foreach ( array_filter( $phones ) as $phone ) : ?>
					<li>
						<?php echo yr_icon( 'phone', 15 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						<a href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a>
					</li>
				<?php endforeach; ?>
				<?php foreach ( array_filter( $emails ) as $email ) : ?>
					<li>
						<?php echo yr_icon( 'mail', 15 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						<a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a>
					</li>
				<?php endforeach; ?>
				<li>
					<?php echo yr_icon( 'clock', 15 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					<span><?php esc_html_e( 'Open 7 days a week', 'your-restaurant' ); ?></span>
				</li>
			</ul>
		</div>
	</div>

	<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
		<div class="yr-container yr-footer-widgets">
			<?php dynamic_sidebar( 'footer-1' ); ?>
		</div>
	<?php endif; ?>

	<div class="yr-footer__bottom">
		<div class="yr-container yr-footer__bottom-inner">
			<p><?php echo esc_html( $settings['footer_copyright'] ); ?></p>
			<?php if ( ! empty( $settings['footer_credit_url'] ) ) : ?>
				<a href="<?php echo esc_url( $settings['footer_credit_url'] ); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html( $settings['footer_tagline'] ); ?></a>
			<?php else : ?>
				<p><?php echo esc_html( $settings['footer_tagline'] ); ?></p>
			<?php endif; ?>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
