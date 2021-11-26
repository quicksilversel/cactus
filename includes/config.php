<?php

	session_start();
	// connect to database
	require( "config.user.php" );

	$conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DB_NAME);

	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	ini_set( "display_errors", true ); // set to false if not in debugging mode
	date_default_timezone_set( "Asia/Tokyo" );  // http://www.php.net/manual/en/timezones.php

	// global constants
	define ('ROOT_PATH', realpath(dirname(__FILE__)));
	define('BASE_URL', 'http://localhost/dashboard/');

	// automatically generates page title
	switch ($_SERVER["SCRIPT_NAME"]) {
		case '/cactus/status.php':
			$CURRENT_PAGE = "status"; 
			$PAGE_TITLE = "Status";
			break;
		default:
			$CURRENT_PAGE = "index";
			$PAGE_TITLE = "Dashboard";
	}
?>