<?php
global $data, $github_api, $repo;

set_time_limit( 0 );
error_reporting( E_ALL );

define( 'APP_PATH', __DIR__ . '/' );

require_once '/gh-toolkit/php.php';
require_once '/gh-toolkit/gh-api.php';
require_once APP_PATH . 'functions.php';

$repo = gh_env( 'GITHUB_REPOSITORY' );
$data = $github_api->decode( $github_api->get( 'repos/' . $repo ) );

if ( empty( $data ) ) {
	gh_log_error( 'Unable To Fetch Data From Github Api' );
}


gh_log_group_start( 'GH API VAR' );
print_r( $data );
gh_log_group_end();

gh_log_group_start( '$_ENV VAR' );
print_r( $_ENV );
gh_log_group_end();

gh_log_group_start( 'GITHUB_EVENT_PATH VAR' );
print_r( json_decode( file_get_contents( $_ENV['GITHUB_EVENT_PATH'] ), true ) );
gh_log_group_end();


$owner = _get( $data, 'owner' );
$name  = _get( $data, 'name' );

gh_set_env_not_exists( 'REPOSITORY_SLUG', $name );
gh_set_env_not_exists( 'REPOSITORY_NAME', ucwords( str_replace( '-', ' ', $name ) ) );
gh_set_env_not_exists( 'REPOSITORY_FULL_NAME', _get( $data, 'full_name' ) );

gh_set_env_not_exists( 'REPOSITORY_OWNER', _get( $owner, 'login' ) );
gh_set_env_not_exists( 'OWNER_PROFILE', _get( $owner, 'html_url' ) );
gh_set_env_not_exists( 'OWNER_TYPE', _get( $owner, 'type' ) );
gh_set_env_not_exists( 'OWNER_AVATAR_URL', _get( $owner, 'avatar_url' ) );
gh_set_env_not_exists( 'IS_OWNER_ORGANIZATION', ( 'Organization' === _get( $owner, 'type' ) ) );
gh_set_env_not_exists( 'IS_OWNER_USER', ( 'Organization' === _get( $owner, 'type' ) ) );

gh_set_env_not_exists( 'REPOSITORY_IS_PRIVATE', _get( $data, 'private' ) );
gh_set_env_not_exists( 'REPOSITORY_IS_FORK', _get( $data, 'fork' ) );
gh_set_env_not_exists( 'REPOSITORY_IS_TEMPLATE', _get( $data, 'is_template' ) );

gh_set_env_not_exists( 'REPOSITORY_GITHUB_URL', _get( $data, 'html_url' ) );
gh_set_env_not_exists( 'REPOSITORY_HOMEPAGE_URL', _get( $data, 'homepage' ) );
gh_set_env_not_exists( 'REPOSITORY_GIT_URL', _get( $data, 'git_url' ) );
gh_set_env_not_exists( 'REPOSITORY_SSH_URL', _get( $data, 'ssh_url' ) );

gh_set_env_not_exists( 'REPOSITORY_DESCRIPTION', _get( $data, 'description' ) );

gh_set_env_not_exists( 'REPOSITORY_CREATED_AT', _get( $data, 'created_at' ) );
gh_set_env_not_exists( 'REPOSITORY_UPDATED_AT', _get( $data, 'updated_at' ) );
gh_set_env_not_exists( 'REPOSITORY_PUSHED_AT', _get( $data, 'pushed_at' ) );

gh_set_env_not_exists( 'REPOSITORY_DEFAULT_BRANCH', _get( $data, 'default_branch' ) );

$license = _get( $data, 'license' );
if ( $license ) {
	gh_set_env_not_exists( 'REPOSITORY_LICENSE_SLUG', _get( $license, 'key' ) );
	gh_set_env_not_exists( 'REPOSITORY_LICENSE', _get( $license, 'name' ) );

}

if ( ! empty( gh_env( 'GITHUB_SHA', false ) ) ) {
	$sha_short = substr( gh_env( 'GITHUB_SHA', false ), 0, 8 );
	gh_set_env_not_exists( 'SHA_SHORT', $sha_short );
}

gh_set_env_not_exists( 'REPOSITORY_WATCHERS_COUNT', _get( $data, 'watchers_count' ) );
gh_set_env_not_exists( 'REPOSITORY_STARGAZERS_COUNT', _get( $data, 'stargazers_count' ) );
gh_set_env_not_exists( 'REPOSITORY_FORKS_COUNT', _get( $data, 'forks_count' ) );

$github_ref_regex = '#^refs/\w+/#';
$github_ref       = preg_match( $github_ref_regex, gh_env( 'GITHUB_REF' ) ) ? preg_replace( $github_ref_regex, '', gh_env( 'GITHUB_REF' ) ) : null;
gh_set_env_not_exists( 'RELEASE_VERSION', $github_ref );

require_once APP_PATH . 'repo-topics.php';
