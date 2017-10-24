<?php
/**
 * Class: wop_Model_Overview
 * @author Flipper Code <hello@flippercode.com>
 * @package 2.0.0
 * @package Posts
 */

if ( ! class_exists( 'WOP_Model_Overview' ) ) {

	/**
	 * Overview model for Plugin Overview.
	 * @package Posts
	 * @author Flipper Code <hello@flippercode.com>
	 */
	class WOP_Model_Overview extends FlipperCode_Model_Base {
		/**
		 * Intialize Backup object.
		 */
		function __construct() {
		}
		/**
		 * Admin menu for Settings Operation
		 */
		function navigation() {
			return array(
				'wop_how_overview' => __( 'How to Use', WOP_TEXT_DOMAIN ),
			);
		}
	}
}
