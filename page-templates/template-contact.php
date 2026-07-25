<?php
/**
 * Template Name: Contact
 *
 * @package YourRestaurant
 */

get_header();
$settings = yr_get_settings();
$phones   = ! empty( $settings['contact_phones'] ) ? $settings['contact_phones'] : array( $settings['footer_phone'] );
$emails   = ! empty( $settings['contact_emails'] ) ? $settings['contact_emails'] : array( $settings['footer_email'] );
$address_lines = array_filter( array_map( 'trim', explode( ',', $settings['footer_address'] ) ) );
$hour_lines = array();
foreach ( $settings['footer_hours'] as $hour ) {
	$hour_lines[] = $hour['day'] . ': ' . $hour['time'];
}

$subjects = array(
	'General Enquiry',
	'Reservation Query',
	'Private Events & Dining',
	'Press & Media',
	'Feedback',
);

$info_cards = array(
	array( 'icon' => 'map-pin', 'title' => __( 'Our Address', 'your-restaurant' ), 'lines' => $address_lines ),
	array( 'icon' => 'phone', 'title' => __( 'Phone', 'your-restaurant' ), 'lines' => array_filter( $phones ) ),
	array( 'icon' => 'mail', 'title' => __( 'Email', 'your-restaurant' ), 'lines' => array_filter( $emails ) ),
	array( 'icon' => 'clock', 'title' => __( 'Hours', 'your-restaurant' ), 'lines' => $hour_lines ),
);
?>
<?php
get_template_part( 'template-parts/page', 'header', array(
	'eyebrow'  => __( 'Get in Touch', 'your-restaurant' ),
	'title'    => __( 'Contact Us', 'your-restaurant' ),
	'subtitle' => __( "We'd love to hear from you", 'your-restaurant' ),
) );
?>

<section class="yr-section">
	<div class="yr-container yr-layout-5">
		<aside>
			<p class="yr-eyebrow"><?php esc_html_e( 'Find Us', 'your-restaurant' ); ?></p>
			<h2 class="yr-heading" style="font-size:1.8rem;"><?php esc_html_e( "We're Always Happy to Talk", 'your-restaurant' ); ?></h2>
			<p class="yr-text"><?php esc_html_e( 'Whether you have a question about a reservation, a special event, or simply want to share your experience — our team is ready to assist.', 'your-restaurant' ); ?></p>

			<div style="margin-top:2rem;display:flex;flex-direction:column;gap:1rem;">
				<?php foreach ( $info_cards as $card ) : ?>
					<div class="yr-info-card">
						<span class="yr-info-card__icon"><?php echo yr_icon( $card['icon'], 18 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
						<div>
							<h4><?php echo esc_html( $card['title'] ); ?></h4>
							<?php foreach ( $card['lines'] as $line ) : ?>
								<div><?php echo esc_html( $line ); ?></div>
							<?php endforeach; ?>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</aside>

		<div>
			<?php if ( post_type_exists( 'yr_contact' ) ) : ?>
			<div id="yr-contact-success" class="yr-form-success" hidden>
				<?php echo yr_icon( 'check', 52 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				<h2><?php esc_html_e( 'Message Received', 'your-restaurant' ); ?></h2>
				<p><?php esc_html_e( "Thank you. We'll be in touch within 24 hours.", 'your-restaurant' ); ?></p>
			</div>

			<form id="yr-contact-form" class="yr-form">
				<div class="yr-form-row yr-form-row--2">
					<div class="yr-form-field">
						<label for="contact_name"><?php esc_html_e( 'Full Name', 'your-restaurant' ); ?> <span class="yr-required">*</span></label>
						<input type="text" id="contact_name" name="name" placeholder="Amira Al-Hassan" required />
					</div>
					<div class="yr-form-field">
						<label for="contact_email"><?php esc_html_e( 'Email', 'your-restaurant' ); ?> <span class="yr-required">*</span></label>
						<input type="email" id="contact_email" name="email" placeholder="amira@example.com" required />
					</div>
				</div>
				<div class="yr-form-field">
					<label for="contact_subject"><?php esc_html_e( 'Subject', 'your-restaurant' ); ?> <span class="yr-required">*</span></label>
					<select id="contact_subject" name="subject" required>
						<option value="" disabled selected><?php esc_html_e( 'Select a subject…', 'your-restaurant' ); ?></option>
						<?php foreach ( $subjects as $subject ) : ?>
							<option value="<?php echo esc_attr( $subject ); ?>"><?php echo esc_html( $subject ); ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="yr-form-field">
					<label for="contact_message"><?php esc_html_e( 'Message', 'your-restaurant' ); ?> <span class="yr-required">*</span></label>
					<textarea id="contact_message" name="message" rows="6" placeholder="<?php esc_attr_e( 'Tell us how we can help…', 'your-restaurant' ); ?>" required></textarea>
				</div>
				<p id="yr-contact-error" class="yr-form-error" hidden></p>
				<button type="submit" class="yr-btn yr-btn--primary yr-btn--block">
					<?php echo yr_icon( 'send', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					<?php esc_html_e( 'Send Message', 'your-restaurant' ); ?>
				</button>
			</form>
			<?php else : ?>
			<div class="yr-content yr-form">
				<?php while ( have_posts() ) : the_post(); the_content(); endwhile; ?>
				<?php if ( ! trim( get_post()->post_content ) ) : ?>
				<p><?php esc_html_e( 'Activate Your Restaurant Core or add a form plugin shortcode to this page.', 'your-restaurant' ); ?></p>
				<?php endif; ?>
			</div>
			<?php endif; ?>
		</div>
	</div>
</section>

<?php get_template_part( 'template-parts/map' ); ?>

<?php get_footer(); ?>
