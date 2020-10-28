<?php
global $data, $github_api, $repo;

set_time_limit( 0 );
error_reporting( E_ALL );

define( 'APP_PATH', __DIR__ . '/' );

require_once '/gh-toolkit/php.php';
require_once '/gh-toolkit/gh-api.php';
require_once APP_PATH . 'functions.php';

define( 'REQUEST_REPOSITORY', gh_env( 'GITHUB_REPOSITORY' ) );

$data = $github_api->decode( $github_api->get( 'repos/' . REQUEST_REPOSITORY ) );

if ( empty( $data ) ) {
	gh_log_error( 'Unable To Fetch Data From Github Api' );
}

/*gh_log_group_start( 'GH API VAR' );
print_r( $data );
gh_log_group_end();

gh_log_group_start( '$_ENV VAR' );
print_r( $_ENV );
gh_log_group_end();

gh_log_group_start( 'GITHUB_EVENT_PATH VAR' );
print_r( json_decode( file_get_contents( $_ENV['GITHUB_EVENT_PATH'] ), true ) );
gh_log_group_end();*/

require_once APP_PATH . 'includes/basic.php';
require_once APP_PATH . 'includes/community.php';
require_once APP_PATH . 'includes/counts.php';
require_once APP_PATH . 'includes/features.php';
require_once APP_PATH . 'includes/owner.php';
require_once APP_PATH . 'includes/type.php';
require_once APP_PATH . 'includes/urls.php';
