<?php
/**
 * BuddyBoss - Groups Admin - Delete Group
 *
 * @package BuddyBoss
 * @subpackage bp-legacy
 * @version 3.0.0
 */

?>

<h2 class="bp-screen-reader-text"><?php _e( 'Delete Group', 'buddyboss' ); ?></h2>

<?php

/**
 * Fires before the display of group delete admin.
 *
 * @since 1.1.0
 */
do_action( 'bp_before_group_delete_admin' ); ?>

<div id="message" class="info">
	<p><?php _e( 'WARNING: Deleting this group will completely remove ALL content associated with it. There is no way back, please be careful with this option.', 'buddyboss' ); ?></p>
</div>

<label for="delete-group-understand"><input type="checkbox" name="delete-group-understand" id="delete-group-understand" value="1" onclick="if(this.checked) { document.getElementById('delete-group-button').disabled = ''; } else { document.getElementById('delete-group-button').disabled = 'disabled'; }" /> <?php _e( 'I understand the consequences of deleting this group.', 'buddyboss' ); ?></label>

<?php

/**
 * Fires after the display of group delete admin.
 *
 * @since 1.1.0
 */
do_action( 'bp_after_group_delete_admin' ); ?>

<div class="submit">
	<input type="submit" disabled="disabled" value="<?php esc_attr_e( 'Delete Group', 'buddyboss' ); ?>" id="delete-group-button" name="delete-group-button" />
</div>

<?php wp_nonce_field( 'groups_delete_group' );
