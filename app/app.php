<?php
global $data, $github_api;

set_time_limit( 0 );

error_reporting( E_ALL );

define( 'APP_PATH', __DIR__ . '/' );

require_once '/gh-toolkit/php.php';
require_once '/gh-toolkit/gh-api.php';
require_once APP_PATH . 'functions.php';


define( 'REQUEST_REPOSITORY', gh_input( 'REPOSITORY', gh_env( 'GITHUB_REPOSITORY' ) ) );

$data = $github_api->decode( $github_api->get( 'repos/' . REQUEST_REPOSITORY ) );

if ( empty( $data ) ) {
	gh_log_error( 'Unable To Fetch Repository Data via API For : ' . REQUEST_REPOSITORY );
}

require_once APP_PATH . 'includes/basic.php';
require_once APP_PATH . 'includes/community.php';
require_once APP_PATH . 'includes/counts.php';
require_once APP_PATH . 'includes/features.php';
require_once APP_PATH . 'includes/owner.php';
require_once APP_PATH . 'includes/type.php';
require_once APP_PATH . 'includes/urls.php';
