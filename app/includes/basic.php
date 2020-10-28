<?php
/**
 * Sets Env For Basic Repository Information
 */
$name       = _get( $data, 'name' );
$sha_short  = ( ! empty( gh_env( 'GITHUB_SHA', false ) ) ) ? substr( gh_env( 'GITHUB_SHA', false ), 0, 8 ) : '';
$topics     = ( isset( $data->topics ) ) ? $data->topics : false;
$github_ref = preg_match( '#^refs/\w+/#', gh_env( 'GITHUB_REF' ) ) ? preg_replace( '#^refs/\w+/#', '', gh_env( 'GITHUB_REF' ) ) : null;

gh_set_env_not_exists( 'REPOSITORY_SLUG', $name );
gh_set_env_not_exists( 'REPOSITORY_NAME', ucwords( str_replace( '-', ' ', $name ) ) );
gh_set_env_not_exists( 'REPOSITORY_FULL_NAME', _get( $data, 'full_name' ) );
gh_set_env_not_exists( 'REPOSITORY_DESCRIPTION', _get( $data, 'description' ) );
gh_set_env_not_exists( 'REPOSITORY_DEFAULT_BRANCH', _get( $data, 'default_branch' ) );
gh_set_env_not_exists( 'REPOSITORY_CREATED_AT', _get( $data, 'created_at' ) );
gh_set_env_not_exists( 'REPOSITORY_UPDATED_AT', _get( $data, 'updated_at' ) );
gh_set_env_not_exists( 'REPOSITORY_PUSHED_AT', _get( $data, 'pushed_at' ) );

gh_set_env_not_exists( 'SHA_SHORT', $sha_short );
gh_set_env_not_exists( 'RELEASE_VERSION', $github_ref );

if ( empty( $topics ) ) {
	try {
		$topics = $github_api->decode( $github_api->get( 'repos/' . $repo . '/topics', [], [] ) );
	} catch ( \Milo\Github\UnexpectedResponseException $exception ) {
		$topics = $github_api->decode( $github_api->get( 'repos/' . $repo . '/topics', [], [ 'Accept' => 'application/vnd.github.mercy-preview+json' ] ) );
	}
	$topics = ( isset( $topics->names ) && ! empty( $topics->names ) ) ? $topics->names : false;
}

if ( ! empty( $topics ) ) {
	$topics = ( empty( $topics ) ) ? '' : json_encode( $topics );
	gh_set_env_not_exists( 'REPOSITORY_TOPICS', addslashes( $topics ) );
} else {
	GH_LOG::Log( 'Unable To Fetch Repository Topics', 'black', 'yellow' );
}
