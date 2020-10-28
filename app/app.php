<?php
global $data, $github_api;

define( 'APP_PATH', __DIR__ . '/' );
set_time_limit( 0 );

require_once '/gh-toolkit/php.php';
require_once '/gh-toolkit/gh-api.php';
require_once APP_PATH . 'functions.php';

$repo = gh_input( 'REPOSITORY', gh_env( 'GITHUB_REPOSITORY' ) );
$repo = ( empty( $repo ) ) ? gh_env( 'GITHUB_REPOSITORY' ) : $repo;
$repo = ( 'false' === $repo || false === $repo ) ? gh_env( 'GITHUB_REPOSITORY' ) : $repo;
var_dump( $repo );
define( 'REQUEST_REPOSITORY', $repo );
define( 'IS_DEBUG', gh_input( 'DEBUG', false ) );

error_reporting( ( IS_DEBUG ) ? E_ALL : 0 );

$data = $github_api->decode( $github_api->get( 'repos/' . REQUEST_REPOSITORY ) );

if ( empty( $data ) ) {
	gh_log_error( 'Unable To Fetch Repository Data via API For : ' . REQUEST_REPOSITORY );
}

gh_log_group_start( 'Repository Basic Info' );
require_once APP_PATH . 'includes/basic.php';
gh_log_group_end();
gh_log();

gh_log_group_start( 'Repository Community Health Files Info' );
require_once APP_PATH . 'includes/community.php';
gh_log_group_end();
gh_log();

gh_log_group_start( 'Repository { forks, stars, watchers, .etc } Counts' );
require_once APP_PATH . 'includes/counts.php';
gh_log_group_end();
gh_log();

gh_log_group_start( 'Repository Features { issues, wiki, pages, .etc }' );
require_once APP_PATH . 'includes/features.php';
gh_log_group_end();
gh_log();

gh_log_group_start( 'Repository Owner Info' );
require_once APP_PATH . 'includes/owner.php';
gh_log_group_end();
gh_log();

gh_log_group_start( 'Repository Type' );
require_once APP_PATH . 'includes/type.php';
gh_log_group_end();
gh_log();

gh_log_group_start( 'Repository URL\'s' );
require_once APP_PATH . 'includes/urls.php';
gh_log_group_end();
gh_log();

