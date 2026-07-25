<?php
/**
 * Template Name: About
 *
 * @package YourRestaurant
 */

get_header();
$about      = yr_setting( 'about', array() );
$team       = $about['team'] ?? array();
$values     = $about['values'] ?? array();
$milestones = $about['milestones'] ?? array();
$value_icons = array( 'leaf', 'heart', 'award', 'star' );
?>
<?php
get_template_part( 'template-parts/page', 'header', array(
	'eyebrow' => __( 'Our Story', 'your-restaurant' ),
	'title'   => __( 'About Your Restaurant', 'your-restaurant' ),
) );
?>

<section class="yr-section" data-reveal>
	<div class="yr-container yr-grid-2">
		<div>
			<p class="yr-eyebrow"><?php esc_html_e( 'Who We Are', 'your-restaurant' ); ?></p>
			<h2 class="yr-heading"><?php esc_html_e( 'A Restaurant Built on', 'your-restaurant' ); ?><br><em><?php esc_html_e( 'Conviction and Care', 'your-restaurant' ); ?></em></h2>
			<p class="yr-text"><?php esc_html_e( "Your Restaurant was founded in 2012 by chef Mathieu Laurent and restaurateur Rania Hosseini, united by a shared belief: that the best restaurants don't just serve food — they create the conditions for life's most meaningful conversations.", 'your-restaurant' ); ?></p>
			<p class="yr-text"><?php esc_html_e( "We remain a family restaurant in every sense. Decisions are made slowly, with care, and in service of one goal: to give every guest an evening they'll still be talking about a year from now.", 'your-restaurant' ); ?></p>
		</div>
		<div class="yr-about-image yr-story-media">
			<img src="<?php echo esc_url( yr_placeholder( 'about' ) ); ?>" alt="<?php esc_attr_e( 'Dining room', 'your-restaurant' ); ?>" width="700" height="820" loading="lazy" decoding="async" />
			<div class="yr-about-badge">
				<strong>2012</strong>
				<span><?php esc_html_e( 'Est. Ahmedabad', 'your-restaurant' ); ?></span>
			</div>
		</div>
	</div>
</section>

<section class="yr-section yr-section--dark" data-reveal>
	<div class="yr-container">
		<div class="yr-section__header yr-section__header--center">
			<p class="yr-eyebrow"><?php esc_html_e( 'What Drives Us', 'your-restaurant' ); ?></p>
			<h2 class="yr-heading yr-heading--light"><?php esc_html_e( 'Our Values', 'your-restaurant' ); ?></h2>
		</div>
		<div class="yr-grid-4">
			<?php foreach ( $values as $i => $value ) : ?>
				<div class="yr-value-card">
					<span class="yr-value-card__icon"><?php echo yr_icon( $value_icons[ $i ] ?? 'star', 20 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
					<h3><?php echo esc_html( $value['title'] ); ?></h3>
					<p><?php echo esc_html( $value['description'] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="yr-section">
	<div class="yr-container yr-timeline">
		<div class="yr-section__header yr-section__header--center">
			<p class="yr-eyebrow"><?php esc_html_e( 'Our Journey', 'your-restaurant' ); ?></p>
			<h2 class="yr-heading"><?php esc_html_e( 'Twelve Years, One Vision', 'your-restaurant' ); ?></h2>
		</div>
		<?php foreach ( $milestones as $milestone ) : ?>
			<div class="yr-timeline-item">
				<span class="yr-timeline-year"><?php echo esc_html( $milestone['year'] ); ?></span>
				<h3><?php echo esc_html( $milestone['title'] ); ?></h3>
				<p><?php echo esc_html( $milestone['description'] ); ?></p>
			</div>
		<?php endforeach; ?>
	</div>
</section>

<section class="yr-section yr-section--secondary">
	<div class="yr-container">
		<div class="yr-section__header yr-section__header--center">
			<p class="yr-eyebrow"><?php esc_html_e( 'The People', 'your-restaurant' ); ?></p>
			<h2 class="yr-heading"><?php esc_html_e( 'Meet Our Team', 'your-restaurant' ); ?></h2>
		</div>
		<div class="yr-grid-3">
			<?php foreach ( $team as $member ) : ?>
				<div class="yr-team-card">
					<div class="yr-team-card__image">
						<img src="<?php echo esc_url( $member['image'] ); ?>" alt="<?php echo esc_attr( $member['name'] ); ?>" width="500" height="600" loading="lazy" decoding="async" />
					</div>
					<h3><?php echo esc_html( $member['name'] ); ?></h3>
					<p class="yr-team-card__role"><?php echo esc_html( $member['role'] ); ?></p>
					<p class="yr-text"><?php echo esc_html( $member['bio'] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<?php get_footer(); ?>
