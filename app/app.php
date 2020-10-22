<?php
global $data;
global $github_api;
global $repo;

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

if ( _validate( $data, 'name' ) ) {
	gh_set_env_not_exists( 'REPOSITORY_SLUG', $data->name );
	gh_set_env_not_exists( 'REPOSITORY_NAME', ucwords( str_replace( '-', ' ', $data->name ) ) );
}

if ( _validate( $data, 'full_name' ) ) {
	gh_set_env_not_exists( 'REPOSITORY_FULL_NAME', $data->full_name );
}

if ( _validate( $data, 'owner' ) ) {
	gh_set_env_not_exists( 'REPOSITORY_OWNER', $data->owner->login );
	gh_set_env_not_exists( 'OWNER_PROFILE', $data->owner->html_url );
	gh_set_env_not_exists( 'OWNER_TYPE', $data->owner->type );

	if ( 'Organization' === $data->owner->type ) {
		gh_set_env_not_exists( 'IS_OWNER_ORGANIZATION', 'yes' );
		gh_set_env_not_exists( 'IS_OWNER_USER', 'no' );
	} else {
		gh_set_env_not_exists( 'IS_OWNER_ORGANIZATION', 'no' );
		gh_set_env_not_exists( 'IS_OWNER_USER', 'yes' );
	}
}

if ( _validate( $data, 'private' ) ) {
	gh_set_env_not_exists( 'REPOSITORY_IS_PRIVATE', ( isset( $data->private ) && true === $data->private ) ? 'yes' : 'no' );
}

if ( _validate( $data, 'fork' ) ) {
	gh_set_env_not_exists( 'REPOSITORY_IS_FORK', ( isset( $data->fork ) && true === $data->fork ) ? 'yes' : 'no' );
}

if ( _validate( $data, 'html_url' ) ) {
	gh_set_env_not_exists( 'REPOSITORY_GITHUB_URL', $data->html_url );
}

if ( _validate( $data, 'homepage' ) ) {
	gh_set_env_not_exists( 'REPOSITORY_HOMEPAGE_URL', $data->homepage );
}

if ( _validate( $data, 'git_url' ) ) {
	gh_set_env_not_exists( 'REPOSITORY_GIT_URL', $data->git_url );
}

if ( _validate( $data, 'ssh_url' ) ) {
	gh_set_env_not_exists( 'REPOSITORY_SSH_URL', $data->ssh_url );
}

if ( _validate( $data, 'description' ) ) {
	gh_set_env_not_exists( 'REPOSITORY_DESCRIPTION', $data->description );
}

if ( _validate( $data, 'created_at' ) ) {
	gh_set_env_not_exists( 'REPOSITORY_CREATED_AT', $data->created_at );
}

if ( _validate( $data, 'updated_at' ) ) {
	gh_set_env_not_exists( 'REPOSITORY_UPDATED_AT', $data->updated_at );
}

if ( _validate( $data, 'pushed_at' ) ) {
	gh_set_env_not_exists( 'REPOSITORY_PUSHED_AT', $data->pushed_at );
}

if ( _validate( $data, 'default_branch' ) ) {
	gh_set_env_not_exists( 'REPOSITORY_DEFAULT_BRANCH', $data->default_branch );
}

if ( ! empty( gh_env( 'GITHUB_SHA', false ) ) ) {
	$sha_short = substr( gh_env( 'GITHUB_SHA', false ), 0, 8 );
	gh_set_env_not_exists( 'SHA_SHORT', $sha_short );
}

if ( _validate( $data, 'watchers_count' ) ) {
	gh_set_env_not_exists( 'REPOSITORY_WATCHERS_COUNT', $data->watchers_count );
}

if ( _validate( $data, 'stargazers_count' ) ) {
	gh_set_env_not_exists( 'REPOSITORY_STARGAZERS_COUNT', $data->stargazers_count );
}

if ( _validate( $data, 'forks_count' ) ) {
	gh_set_env_not_exists( 'REPOSITORY_FORKS_COUNT', $data->forks_count );
}

$github_ref_regex = '#^refs/\w+/#';
$github_ref       = preg_match( $github_ref_regex, gh_env( 'GITHUB_REF' ) ) ? preg_replace( $github_ref_regex, '', gh_env( 'GITHUB_REF' ) ) : null;
gh_set_env_not_exists( 'RELEASE_VERSION', $github_ref );

require_once APP_PATH . 'repo-topics.php';
