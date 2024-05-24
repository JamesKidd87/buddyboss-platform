<?php

namespace BuddyBoss\Library;

/**
 * Composer class
 */
class Composer {

	/**
	 * @var $instance
	 */
	private static $instance;

	/**
	 * Get the instance of the class.
	 *
	 * @since [BBVERSION]
	 *
	 * @return Composer
	 */
	public static function instance() {
		if ( ! isset( self::$instance ) ) {
			$class          = __CLASS__;
			self::$instance = new $class();
		}

		return self::$instance;
	}

	/**
	 * This function is used to get ZipStream instance from scoped vendor.
	 *
	 * @since [BBVERSION]
	 *
	 * @return \BuddyBoss\Library\Composer\ZipStream/\BuddyBossPlatform\BuddyBoss\Library\Composer\ZipStream
	 */
	function zipstream_instance() {
		if ( class_exists( '\BuddyBossPlatform\BuddyBoss\Library\Composer\ZipStream' ) ) {
			return \BuddyBossPlatform\BuddyBoss\Library\Composer\ZipStream::instance();
		}

		return \BuddyBoss\Library\Composer\ZipStream::instance();
	}

	/**
	 * This function is used to get FFMpeg instance from scoped vendor
	 *
	 * @since [BBVERSION]
	 *
	 * @return \BuddyBoss\Library\Composer\FFMpeg/\BuddyBossPlatform\BuddyBoss\Library\Composer\FFMpeg
	 */
	function ffmpeg_instance() {
		if ( class_exists( '\BuddyBossPlatform\BuddyBoss\Library\Composer\FFMpeg' ) ) {
			return \BuddyBossPlatform\BuddyBoss\Library\Composer\FFMpeg::instance();
		}

		return \BuddyBoss\Library\Composer\FFMpeg::instance();
	}
}

?>
