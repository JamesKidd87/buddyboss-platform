<?php
/**
 * BuddyBoss LearnDash integration topics reports generator.
 *
 * @package BuddyBoss\LearnDash
 * @since BuddyBoss 1.0.0
 */

namespace Buddyboss\LearndashIntegration\Buddypress\Generators;

use Buddyboss\LearndashIntegration\Library\ReportsGenerator;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Extends report generator for topics reports
 *
 * @since BuddyBoss 1.0.0
 */
class TopicsReportsGenerator extends ReportsGenerator {

	/**
	 * Constructor
	 *
	 * @since BuddyBoss 1.0.0
	 */
	public function __construct() {
		 $this->completed_table_title  = __( 'Completed Topics', 'buddyboss' );
		$this->incompleted_table_title = __( 'Incomplete Topics', 'buddyboss' );

		parent::__construct();
	}

	/**
	 * Returns the columns and their settings
	 *
	 * @since BuddyBoss 1.0.0
	 */
	protected function columns() {
		return [
			'user_id'         => $this->column( 'user_id' ),
			'user'            => $this->column( 'user' ),
			'course_id'       => $this->column( 'course_id' ),
			'course'          => $this->column( 'course' ),
			'topic'           => [
				'label'     => __( 'Topic', 'buddyboss' ),
				'sortable'  => true,
				'order_key' => 'post_title',
			],
			'topic_points'    => [
				'label'     => __( 'Points Earned', 'buddyboss' ),
				'sortable'  => false,
				'order_key' => 'activity_points',
			],
			'start_date'      => $this->column( 'start_date' ),
			'completion_date' => $this->column( 'completion_date' ),
			'time_spent'      => $this->column( 'time_spent' ),
		];
	}

	/**
	 * Format the activity results for each column
	 *
	 * @since BuddyBoss 1.0.0
	 */
	protected function formatData( $activity ) {
		return array(
			'user_id'         => $activity->user_id,
			'user'            => bp_core_get_user_displayname( $activity->user_id ),
			'course_id'       => $activity->activity_course_id,
			'course'          => $activity->activity_course_title,
			'topic'           => $activity->post_title,
			'topic_points'    => ReportsGenerator::coursePointsEarned( $activity ),
			'start_date'      => $activity->activity_started_formatted,
			'completion_date' => $this->completionDate( $activity ),
			'time_spent'      => $this->timeSpent( $activity ),
		);
	}
}
