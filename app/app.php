<?php
global $data;
global $gh_api;
global $repo;

set_time_limit( 0 );
error_reporting( E_ALL );

define( 'APP_PATH', __DIR__ . '/' );

require_once APP_PATH . 'vendor/autoload.php';
require_once APP_PATH . 'functions.php';

use Milo\Github\Api;
use Milo\Github\OAuth\Token;

if ( empty( get_env( 'GITHUB_TOKEN' ) ) ) {
	_error( 'GITHUB_TOKEN ENV is not set !' );
}

$token  = get_env( 'GITHUB_TOKEN' );
$repo   = get_env( 'GITHUB_REPOSITORY' );
$gh_api = new Api();
$gh_api->setToken( new Token( $token ) );
$data = $gh_api->decode( $gh_api->get( 'repos/' . $repo ) );

print_r( get_env( 'github' ) );
print_r( $_ENV );
print_r( json_decode( file_get_contents( '/github/workflow/event.json' ) ) );

if ( empty( $data ) ) {
	_error( 'Unable To Fetch Data From Github Api' );
}

if ( _validate( $data, 'name' ) ) {
	set_action_env_not_exists( 'REPOSITORY_SLUG', $data->name );
	set_action_env_not_exists( 'REPOSITORY_NAME', ucwords( str_replace( '-', ' ', $data->name ) ) );
}

if ( _validate( $data, 'full_name' ) ) {
	set_action_env_not_exists( 'REPOSITORY_FULL_NAME', $data->full_name );
}

if ( _validate( $data, 'owner' ) ) {
	set_action_env_not_exists( 'REPOSITORY_OWNER', $data->owner->login );
	set_action_env_not_exists( 'OWNER_PROFILE', $data->owner->html_url );
	set_action_env_not_exists( 'OWNER_TYPE', $data->owner->type );

	if ( 'Organization' === $data->owner->type ) {
		set_action_env_not_exists( 'IS_OWNER_ORGANIZATION', 'yes' );
		set_action_env_not_exists( 'IS_OWNER_USER', 'no' );
	} else {
		set_action_env_not_exists( 'IS_OWNER_ORGANIZATION', 'no' );
		set_action_env_not_exists( 'IS_OWNER_USER', 'yes' );
	}
}

if ( _validate( $data, 'private' ) ) {
	set_action_env_not_exists( 'REPOSITORY_IS_PRIVATE', ( isset( $data->private ) && true === $data->private ) ? 'yes' : 'no' );
}

if ( _validate( $data, 'fork' ) ) {
	set_action_env_not_exists( 'REPOSITORY_IS_FORK', ( isset( $data->fork ) && true === $data->fork ) ? 'yes' : 'no' );
}

if ( _validate( $data, 'html_url' ) ) {
	set_action_env_not_exists( 'REPOSITORY_GITHUB_URL', $data->html_url );
}

if ( _validate( $data, 'homepage' ) ) {
	set_action_env_not_exists( 'REPOSITORY_HOMEPAGE_URL', $data->homepage );
}

if ( _validate( $data, 'git_url' ) ) {
	set_action_env_not_exists( 'REPOSITORY_GIT_URL', $data->git_url );
}

if ( _validate( $data, 'ssh_url' ) ) {
	set_action_env_not_exists( 'REPOSITORY_SSH_URL', $data->ssh_url );
}

if ( _validate( $data, 'description' ) ) {
	set_action_env_not_exists( 'REPOSITORY_DESCRIPTION', $data->description );
}

if ( _validate( $data, 'created_at' ) ) {
	set_action_env_not_exists( 'REPOSITORY_CREATED_AT', $data->created_at );
}

if ( _validate( $data, 'updated_at' ) ) {
	set_action_env_not_exists( 'REPOSITORY_UPDATED_AT', $data->updated_at );
}

if ( _validate( $data, 'pushed_at' ) ) {
	set_action_env_not_exists( 'REPOSITORY_PUSHED_AT', $data->pushed_at );
}

if ( _validate( $data, 'default_branch' ) ) {
	set_action_env_not_exists( 'REPOSITORY_DEFAULT_BRANCH', $data->default_branch );
}

if ( ! empty( get_env( 'GITHUB_SHA', false ) ) ) {
	$sha_short = substr( get_env( 'GITHUB_SHA', false ), 0, 8 );
	set_action_env_not_exists( 'SHA_SHORT', $sha_short );
}

if ( _validate( $data, 'watchers_count' ) ) {
	set_action_env_not_exists( 'REPOSITORY_WATCHERS_COUNT', $data->watchers_count );
}

if ( _validate( $data, 'stargazers_count' ) ) {
	set_action_env_not_exists( 'REPOSITORY_STARGAZERS_COUNT', $data->stargazers_count );
}

if ( _validate( $data, 'forks_count' ) ) {
	set_action_env_not_exists( 'REPOSITORY_FORKS_COUNT', $data->forks_count );
}


require_once APP_PATH . 'repo-topics.php';
