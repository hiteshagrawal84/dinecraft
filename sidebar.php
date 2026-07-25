<?php
/**
 * Blog sidebar template.
 *
 * @package YourRestaurant
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>
<aside class="yr-sidebar" role="complementary" aria-label="<?php esc_attr_e( 'Blog Sidebar', 'your-restaurant' ); ?>">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside>
