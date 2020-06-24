<?php
class Jet_Forms_User_Posts_Generator extends \Jet_Engine\Forms\Generators\Base {

	/**
	 * Returns generator ID
	 *
	 * @return string
	 */
	public function get_id() {
		return 'jet_user_posts';
	}

	/**
	 * Returns generator name
	 *
	 * @return string
	 */
	public function get_name() {
		return 'User Posts';
	}

	/**
	 * Returns generated options list
	 *
	 * @return array
	 */
	public function generate( $field ) {

		$result = array();

		if ( ! is_user_logged_in() ) {
			return $result;
		}

		$user_id = get_current_user_id();
		$post_type = ! empty( $field ) ? $field : 'post';

		global $wpdb;
		$posts_table = $wpdb->posts;

		$posts = $wpdb->get_results( "SELECT ID, post_title FROM $posts_table WHERE post_author = $user_id AND post_status = 'publish' AND post_type = '$post_type';" );

		if ( empty( $posts ) ) {
			return $result;
		}

		foreach ( $posts as $post ) {
			$result[] = array(
				'value' => $post->ID,
				'label' => $post->post_title,
			);
		}

		return $result;

	}

}
