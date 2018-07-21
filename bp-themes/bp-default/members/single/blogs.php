<?php

/**
 * BuddyBoss - Users Blogs
 *
 * @package BuddyBoss
 * @subpackage bp-default
 */

?>

<div class="item-list-tabs" id="subnav" role="navigation">
	<ul>

		<?php bp_get_options_nav(); ?>

		<li id="blogs-order-select" class="last filter">

			<label for="blogs-all"><?php _e( 'Order By:', 'buddyboss' ); ?></label>
			<select id="blogs-all">
				<option value="active"><?php _e( 'Last Active', 'buddyboss' ); ?></option>
				<option value="newest"><?php _e( 'Newest', 'buddyboss' ); ?></option>
				<option value="alphabetical"><?php _e( 'Alphabetical', 'buddyboss' ); ?></option>

				<?php do_action( 'bp_member_blog_order_options' ); ?>

			</select>
		</li>
	</ul>
</div><!-- .item-list-tabs -->

<?php do_action( 'bp_before_member_blogs_content' ); ?>

<div class="blogs myblogs" role="main">

	<?php locate_template( array( 'blogs/blogs-loop.php' ), true ); ?>

</div><!-- .blogs.myblogs -->

<?php do_action( 'bp_after_member_blogs_content' ); ?>
