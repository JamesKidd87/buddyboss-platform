<?php
/**
 * BP Nouveau Group's avatar template.
 *
 * @since 3.0.0
 * @version 3.1.0
 */
?>

<?php if ( bp_is_group_create() ) : ?>

	<h3 class="bp-screen-title creation-step-name">
		<?php esc_html_e( 'Upload Group Avatar', 'buddyboss' ); ?>
	</h3>

<?php else : ?>

	<h2 class="bp-screen-title">
		<?php esc_html_e( 'Change Group Avatar', 'buddyboss' ); ?>
	</h2>

<?php endif; ?>

<?php if ( ! bp_is_group_create() ) : ?>
	<?php if ( ! bp_get_group_has_avatar() ) : ?>
		<p class="bp-help-text"><?php esc_html_e( 'Add an image to use as a profile photo for this group. The image will be shown on the main group page, and in search results.', 'buddyboss' ); ?></p>
	<?php else : ?>
		<p class="bp-help-text"><?php esc_html_e( 'Edit or update your avatar image for this group.', 'buddyboss' ); ?></p>
	<?php endif; ?>
<?php endif; ?>


<?php if ( 'upload-image' === bp_get_avatar_admin_step() ) : ?>
	<?php if ( bp_is_group_create() ) : ?>


		<div class="left-menu">

			<?php bp_new_group_avatar(); ?>

		</div><!-- .left-menu -->

		<div class="main-column">
	<?php endif; ?>

			<p class="bp-help-text"><?php esc_html_e( 'Upload an image to use as a profile photo for this group. The image will be shown on the main group page, and in search results.', 'buddyboss' ); ?></p>

			<p>
				<label for="file" class="bp-screen-reader-text"><?php esc_html_e( 'Select an image', 'buddyboss' ); ?></label>
				<input type="file" name="file" id="file" />
				<input type="submit" name="upload" id="upload" value="<?php esc_attr_e( 'Upload Image', 'buddyboss' ); ?>" />
				<input type="hidden" name="action" id="action" value="bp_avatar_upload" />
			</p>

	<?php if ( bp_is_group_create() ) : ?>
			<p class="bp-help-text"><?php esc_html_e( 'To skip the group profile photo upload process, hit the "Next Step" button.', 'buddyboss' ); ?></p>
		</div><!-- .main-column -->

	<?php elseif ( bp_get_group_has_avatar() ) : ?>

		<p><?php esc_html_e( "If you'd like to remove the existing group profile photo but not upload a new one, please use the delete group profile photo button.", 'buddyboss' ); ?></p>

		<?php
		bp_button(
			array(
				'id'         => 'delete_group_avatar',
				'component'  => 'groups',
				'wrapper_id' => 'delete-group-avatar-button',
				'link_class' => 'edit',
				'link_href'  => bp_get_group_avatar_delete_link(),
				'link_title' => __( 'Delete Group Profile Photo', 'buddyboss' ),
				'link_text'  => __( 'Delete Group Profile Photo', 'buddyboss' ),
			)
		);
		?>

	<?php
	endif;

	/**
	 * Load the Avatar UI templates
	 *
	 * @since 2.3.0
	 */
	bp_avatar_get_templates();

	if ( ! bp_is_group_create() ) {
		wp_nonce_field( 'bp_avatar_upload' );
	}
	?>

<?php
endif;

if ( 'crop-image' === bp_get_avatar_admin_step() ) :
?>

	<h2><?php esc_html_e( 'Crop Group Profile Photo', 'buddyboss' ); ?></h2>

	<img src="<?php bp_avatar_to_crop(); ?>" id="avatar-to-crop" class="avatar" alt="<?php esc_attr_e( 'Profile photo to crop', 'buddyboss' ); ?>" />

	<div id="avatar-crop-pane">
		<img src="<?php bp_avatar_to_crop(); ?>" id="avatar-crop-preview" class="avatar" alt="<?php esc_attr_e( 'Profile photo preview', 'buddyboss' ); ?>" />
	</div>

	<input type="submit" name="avatar-crop-submit" id="avatar-crop-submit" value="<?php esc_attr_e( 'Crop Image', 'buddyboss' ); ?>" />

	<input type="hidden" name="image_src" id="image_src" value="<?php bp_avatar_to_crop_src(); ?>" />
	<input type="hidden" id="x" name="x" />
	<input type="hidden" id="y" name="y" />
	<input type="hidden" id="w" name="w" />
	<input type="hidden" id="h" name="h" />

	<?php
	if ( ! bp_is_group_create() ) {
		wp_nonce_field( 'bp_avatar_cropstore' );
	}
	?>

<?php
endif;
