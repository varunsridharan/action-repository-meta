<?php

use Milo\Github\Api;
use Milo\Github\OAuth\Token;

set_time_limit( 0 );
define( 'APP_PATH', __DIR__ . '/' );

require_once APP_PATH . 'functions.php';
require_once APP_PATH . 'vendor/autoload.php';

if ( empty( get_env( 'GITHUB_TOKEN' ) ) ) {
	die( '::error:: 🛑 GITHUB_TOKEN ENV is not set !' );
}

$token  = get_env( 'GITHUB_TOKEN' );
$repo   = get_env( 'GITHUB_REPOSITORY' );
$gh_api = ( new Api() )->setToken( new Token( $token ) );
$data   = $gh_api->decode( $gh_api->get( 'repos/' . $repo ) );

if ( empty( $data ) ) {
	die( '::error:: 🛑  Unable To Fetch Data From Github Api' );
}
var_dump( $data->name );
var_dump( $data );
if ( isset( $data->name ) ) {
	set_action_env_not_exists( 'GITHUB_REPO_SLUG', $data->name );
}