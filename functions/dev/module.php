<?php

namespace Dixon\Dev;

if ( class_exists( 'WP_CLI' ) ) {
	require_once __DIR__ . '/Main.php';

	require_once __DIR__ . '/Create_Pages.php';
	( new Create_Pages() )->registration_commands();

	require_once __DIR__ . '/Teacher_Generator.php';
	( new Teacher_Generator() )->registration_commands();

	require_once __DIR__ . '/News_Generator.php';
	( new News_Generator() )->registration_commands();

	require_once __DIR__ . '/Courses_Generator.php';
	( new Courses_Generator() )->registration_commands();

	require_once __DIR__ . '/Courses_Validate.php';
	( new Courses_Validate() )->registration_commands();
}
