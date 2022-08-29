<?php
/**
 * The template for displaying the notifications on screen.
 *
 * This template can be overridden by copying it to yourtheme/buddypress/notifications/on-screen.php.
 *
 * @since   BuddyBoss 1.0.0
 * @package BuddyBoss\Core
 * @version 1.0.0
 */

remove_filter( 'bp_notifications_get_registered_components', 'bb_notification_exclude_group_message_notification', 999, 1 );
add_filter( 'bp_ajax_querystring', 'bb_notifications_on_screen_notifications_add', 20, 2 );
if ( bp_has_notifications( bp_ajax_querystring( 'notifications' ) ) ) :
	while ( bp_the_notifications() ) :
		bp_the_notification();
		if (
			class_exists( 'BB_Platform_Pro' ) &&
			bbp_pro_is_license_valid() &&
			bb_pusher_is_enabled() &&
			bb_pusher_is_feature_enabled( 'live-messaging' ) &&
			bp_is_user_messages() &&
			isset( buddypress()->notifications->query_loop->notification->component_action ) &&
			(
				'new_message' === buddypress()->notifications->query_loop->notification->component_action ||
				'bb_groups_new_message' === buddypress()->notifications->query_loop->notification->component_action ||
				'bb_messages_new' === buddypress()->notifications->query_loop->notification->component_action
			)
		) {
			return;
		}
		?>
		<li class="read-item <?php echo isset( buddypress()->notifications->query_loop->notification->is_new ) && buddypress()->notifications->query_loop->notification->is_new ? 'unread' : ''; ?>">
			<span class="bb-full-link">
				<?php bp_the_notification_description(); ?>
			</span>
			<div class="notification-avatar">
				<?php bb_notification_avatar(); ?>
			</div>
			<div class="notification-content">
				<span class="bb-full-link">
					<?php bp_the_notification_description(); ?>
				</span>
				<span><?php bp_the_notification_description(); ?></span>
				<span class="posted"><?php bp_the_notification_time_since(); ?></span>
			</div>
			<div class="actions">
				<a class="action-close primary" data-bp-tooltip-pos="left" data-bp-tooltip="<?php esc_attr_e( 'Close', 'buddyboss' ); ?>" data-notification-id="<?php bp_the_notification_id(); ?>">
					<span class="dashicons dashicons-no" aria-hidden="true"></span>
				</a>
			</div>
		</li>
		<?php
	endwhile;
endif;
remove_filter( 'bp_ajax_querystring', 'bb_notifications_on_screen_notifications_add', 20, 2 );
add_filter( 'bp_notifications_get_registered_components', 'bb_notification_exclude_group_message_notification', 999, 1 );
