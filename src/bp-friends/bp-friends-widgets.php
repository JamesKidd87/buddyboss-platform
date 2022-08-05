<?php
/**
 * BuddyBoss Connections Widgets.
 *
 * @package BuddyBoss\Connections
 * @since BuddyPress 1.9.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Register the friends widget.
 *
 * @since BuddyPress 1.9.0
 */
function bp_friends_register_widgets() {
	if ( ! bp_is_active( 'friends' ) ) {
		return;
	}

	// The Connections widget works only when looking at a displayed user,
	// and the concept of "displayed user" doesn't exist on non-root blogs,
	// so we don't register the widget there.
	if ( ! bp_is_root_blog() ) {
		return;
	}

	add_action(
		'widgets_init',
		function() {
			register_widget( 'BP_Core_Friends_Widget' );
		}
	);
}
add_action( 'bp_register_widgets', 'bp_friends_register_widgets' );

/** Widget AJAX ***************************************************************/

/**
 * Process AJAX pagination or filtering for the Connections widget.
 *
 * @since BuddyPress 1.9.0
 */
function bp_core_ajax_widget_friends() {

	check_ajax_referer( 'bp_core_widget_friends' );

	switch ( $_POST['filter'] ) {
		case 'newest-friends':
			$type = 'newest';
			break;

		case 'recently-active-friends':
			$type = 'active';
			break;

		case 'popular-friends':
			$type = 'popular';
			break;
	}

	$user_id = bp_displayed_user_id();

	if ( ! $user_id ) {

		// If member widget is putted on other pages then will not get the bp_displayed_user_id so set the bp_loggedin_user_id to bp_displayed_user_id.
		$user_id = bp_loggedin_user_id();

	}

	// If $user_id still blank then return.
	if ( ! $user_id ) {
		return;
	}

	$members_args = array(
		'user_id'         => absint( $user_id ),
		'type'            => $type,
		'max'             => absint( $_POST['max-friends'] ),
		'populate_extras' => 1,
	);

	global $members_template;

	if ( bp_has_members( $members_args ) ) : ?>
		<?php echo '0[[SPLIT]]'; // Return valid result. TODO: remove this. ?>
		<?php
		while ( bp_members() ) :
			bp_the_member();
			?>
			<li class="vcard">
				<div class="item-avatar">
					<a href="<?php bp_member_permalink(); ?>" class="bb-item-avatar-connection-widget-<?php echo esc_attr( bp_get_member_user_id() ); ?>">
						<?php bp_member_avatar(); ?>
						<?php
						if ( function_exists( 'bb_current_user_status' ) ) {
							bb_current_user_status( bp_get_member_user_id() );
						} else {
							$current_time = current_time( 'mysql', 1 );
							$diff         = strtotime( $current_time ) - strtotime( $members_template->member->last_activity );
							if ( $diff < 300 ) { // 5 minutes  =  5 * 60
								echo wp_kses_post( apply_filters( 'bb_user_online_html', '<span class="member-status online"></span>', bp_get_member_user_id() ) );
							}
						}
						?>
					</a>
				</div>

				<div class="item">
					<div class="item-title fn"><a href="<?php bp_member_permalink(); ?>"><?php bp_member_name(); ?></a></div>
					<?php if ( 'active' === $type ) : ?>
						<div class="item-meta"><span class="activity" data-livestamp="<?php bp_core_iso8601_date( bp_get_member_last_active( array( 'relative' => false ) ) ); ?>"><?php bp_member_last_active(); ?></span></div>
					<?php elseif ( 'newest' === $type ) : ?>
						<div class="item-meta"><span class="activity" data-livestamp="<?php bp_core_iso8601_date( bp_get_member_registered( array( 'relative' => false ) ) ); ?>"><?php bp_member_registered(); ?></span></div>
					<?php elseif ( bp_is_active( 'friends' ) ) : ?>
						<div class="item-meta"><span class="activity"><?php bp_member_total_friend_count(); ?></span></div>
					<?php endif; ?>
				</div>
			</li>
		<?php endwhile; ?>

	<?php else : ?>
		<?php echo '-1[[SPLIT]]<li>'; ?>
		<?php _e( 'There were no members found, please try another filter.', 'buddyboss' ); ?>
		<?php echo '</li>'; ?>
		<?php
	endif;
}
add_action( 'wp_ajax_widget_friends', 'bp_core_ajax_widget_friends' );
add_action( 'wp_ajax_nopriv_widget_friends', 'bp_core_ajax_widget_friends' );
