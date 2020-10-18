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

print_r($data);

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

require_once APP_PATH . 'repo-topics.php';
