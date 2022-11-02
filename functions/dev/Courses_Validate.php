<?php

namespace Dixon\Dev;

use WP_CLI;

class Courses_Validate extends Main {


	public function registration_commands() {
		WP_CLI::add_command( 'dev courses_validate start', [ $this, 'start' ] );
		WP_CLI::add_command( 'dev update_course_open', [ $this, 'update_course_open' ] );
	}

	public function start() {
		wp_set_current_user( 1 );
		define( 'ALLOW_UNFILTERED_UPLOADS', true );

		$this->update_course_public();
	}

	public function update_course_public() {
		$post_ids = get_posts( [
			'post_type'   => 'course',
			'numberposts' => - 1,
			'fields'      => 'ids',
			'meta_query'  => [
				[
					'key'     => 'course_level',
					'value'   => 'master',
					'compare' => '=',
				],
			],
		] );

		foreach ( $post_ids as $post_id ) {
			update_post_meta( $post_id, 'course_public', 0 );
		}
	}

	public function update_course_open() {
		$post_ids = get_posts( [
			'post_type'   => 'course',
			'numberposts' => - 1,
			'fields'      => 'ids',
		] );

		foreach ( $post_ids as $post_id ) {
			update_post_meta( $post_id, 'course_open', 1 );
		}
	}

}