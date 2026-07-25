<?php
/**
 * Blog sidebar template.
 *
 * @package DineCraft
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>
<aside class="yr-sidebar" role="complementary" aria-label="<?php esc_attr_e( 'Blog Sidebar', 'dinecraft' ); ?>">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside>
