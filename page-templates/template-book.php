<?php
/**
 * Template Name: Book a Table
 *
 * @package DineCraft
 */

get_header();
$settings = yr_get_settings();

$time_slots = array(
	'12:00 PM', '12:30 PM', '1:00 PM', '1:30 PM', '2:00 PM',
	'6:00 PM', '6:30 PM', '7:00 PM', '7:30 PM', '8:00 PM', '8:30 PM', '9:00 PM', '9:30 PM',
);

$occasions = array(
	'No special occasion', 'Birthday Celebration', 'Anniversary', 'Romantic Dinner',
	'Business Dinner', 'Family Gathering', 'Engagement', 'Other',
);
?>
<?php
get_template_part( 'template-parts/page', 'header', array(
	'eyebrow'  => __( 'Reservations', 'dinecraft' ),
	'title'    => __( 'Book a Table', 'dinecraft' ),
	'subtitle' => __( 'Secure your seat for an unforgettable evening', 'dinecraft' ),
) );
?>

<section class="yr-section">
	<div class="yr-container yr-layout-5">
		<aside>
			<p class="yr-eyebrow"><?php esc_html_e( 'What to Expect', 'dinecraft' ); ?></p>
			<h2 class="yr-heading" style="font-size:1.8rem;"><?php esc_html_e( 'An Evening to Remember', 'dinecraft' ); ?></h2>
			<p class="yr-text"><?php esc_html_e( 'From the moment you arrive, our team is dedicated to ensuring your experience is seamless, warm, and unforgettable.', 'dinecraft' ); ?></p>

			<div class="yr-info-card" style="margin-top:2rem;">
				<span class="yr-info-card__icon"><?php echo yr_icon( 'clock', 18 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
				<div>
					<h4><?php esc_html_e( 'Opening Hours', 'dinecraft' ); ?></h4>
					<?php foreach ( $settings['footer_hours'] as $hour ) : ?>
						<div><?php echo esc_html( $hour['day'] . ': ' . $hour['time'] ); ?></div>
					<?php endforeach; ?>
				</div>
			</div>

			<div class="yr-info-card">
				<span class="yr-info-card__icon"><?php echo yr_icon( 'users', 18 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
				<div>
					<h4><?php esc_html_e( 'Large Groups', 'dinecraft' ); ?></h4>
					<p><?php printf( esc_html__( 'For parties of 10 or more, please contact us at %s.', 'dinecraft' ), esc_html( $settings['footer_phone'] ) ); ?></p>
				</div>
			</div>

			<div class="yr-info-card">
				<span class="yr-info-card__icon"><?php echo yr_icon( 'calendar', 18 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
				<div>
					<h4><?php esc_html_e( 'Cancellations', 'dinecraft' ); ?></h4>
					<p><?php esc_html_e( 'We kindly request 24 hours notice for cancellations or changes.', 'dinecraft' ); ?></p>
				</div>
			</div>
		</aside>

		<div>
			<?php if ( post_type_exists( 'yr_reservation' ) ) : ?>
			<div id="yr-reservation-success" class="yr-form-success" hidden>
				<?php echo yr_icon( 'check', 56 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				<h2><?php esc_html_e( 'Reservation Confirmed', 'dinecraft' ); ?></h2>
				<p><?php esc_html_e( 'Thank you. We look forward to welcoming you.', 'dinecraft' ); ?></p>
			</div>

			<form id="yr-reservation-form" class="yr-form">
				<div class="yr-form-row yr-form-row--2">
					<div class="yr-form-field">
						<label for="first_name"><?php esc_html_e( 'First Name', 'dinecraft' ); ?> <span class="yr-required">*</span></label>
						<input type="text" id="first_name" name="first_name" placeholder="Amira" required />
					</div>
					<div class="yr-form-field">
						<label for="last_name"><?php esc_html_e( 'Last Name', 'dinecraft' ); ?> <span class="yr-required">*</span></label>
						<input type="text" id="last_name" name="last_name" placeholder="Al-Hassan" required />
					</div>
				</div>
				<div class="yr-form-row yr-form-row--2">
					<div class="yr-form-field">
						<label for="email"><?php esc_html_e( 'Email Address', 'dinecraft' ); ?> <span class="yr-required">*</span></label>
						<input type="email" id="email" name="email" placeholder="amira@example.com" required />
					</div>
					<div class="yr-form-field">
						<label for="phone"><?php esc_html_e( 'Phone Number', 'dinecraft' ); ?> <span class="yr-required">*</span></label>
						<input type="tel" id="phone" name="phone" placeholder="+91 98765 43210" required />
					</div>
				</div>
				<div class="yr-form-row yr-form-row--3">
					<div class="yr-form-field">
						<label for="date"><?php esc_html_e( 'Date', 'dinecraft' ); ?> <span class="yr-required">*</span></label>
						<input type="date" id="date" name="date" required />
					</div>
					<div class="yr-form-field">
						<label for="time"><?php esc_html_e( 'Time', 'dinecraft' ); ?> <span class="yr-required">*</span></label>
						<select id="time" name="time" required>
							<option value=""><?php esc_html_e( 'Select time', 'dinecraft' ); ?></option>
							<?php foreach ( $time_slots as $slot ) : ?>
								<option value="<?php echo esc_attr( $slot ); ?>"><?php echo esc_html( $slot ); ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="yr-form-field">
						<label for="guests"><?php esc_html_e( 'Guests', 'dinecraft' ); ?> <span class="yr-required">*</span></label>
						<select id="guests" name="guests" required>
							<?php for ( $i = 1; $i <= 9; $i++ ) : ?>
								<option value="<?php echo esc_attr( (string) $i ); ?>"<?php selected( $i, 2 ); ?>><?php echo esc_html( $i . ( 1 === $i ? ' Guest' : ' Guests' ) ); ?></option>
							<?php endfor; ?>
						</select>
					</div>
				</div>
				<div class="yr-form-field">
					<label for="occasion"><?php esc_html_e( 'Occasion', 'dinecraft' ); ?></label>
					<select id="occasion" name="occasion">
						<?php foreach ( $occasions as $occasion ) : ?>
							<option value="<?php echo esc_attr( $occasion ); ?>"><?php echo esc_html( $occasion ); ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="yr-form-field">
					<label for="requests"><?php esc_html_e( 'Special Requests', 'dinecraft' ); ?></label>
					<textarea id="requests" name="requests" rows="4" placeholder="<?php esc_attr_e( 'Dietary requirements, seating preferences…', 'dinecraft' ); ?>"></textarea>
				</div>
				<p id="yr-reservation-error" class="yr-form-error" hidden></p>
				<button type="submit" class="yr-btn yr-btn--primary yr-btn--block"><?php esc_html_e( 'Confirm Reservation', 'dinecraft' ); ?></button>
			</form>
			<?php else : ?>
			<div class="yr-content yr-form">
				<?php while ( have_posts() ) : the_post(); the_content(); endwhile; ?>
				<?php if ( ! trim( get_post()->post_content ) ) : ?>
				<p><?php esc_html_e( 'Activate DineCraft Core or add a form plugin shortcode to this page.', 'dinecraft' ); ?></p>
				<?php endif; ?>
			</div>
			<?php endif; ?>
		</div>
	</div>
</section>

<?php get_footer(); ?>
