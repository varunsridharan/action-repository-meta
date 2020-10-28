<?php
/**
 * Sets ENV About Repository Communit Files
 */

$community = $github_api->decode( $github_api->get( 'repos/' . REQUEST_REPOSITORY . '/community/profile' ) );

if ( empty( $community ) ) {
	gh_log_error( 'Unable To Fetch Community Information For : ' . REQUEST_REPOSITORY );
}

gh_set_env_not_exists( 'REPOSITORY_CONTENTS_REPORTS_ENABLED', _get( $community, 'content_reports_enabled' ) );

$files = _get( $community, 'files' );
if ( $files ) {
	$code_of_conduct = _get( $files, 'code_of_conduct' );
	gh_set_env_not_exists( 'REPOSITORY_CODE_OF_CONDUCT_URL', _get( $code_of_conduct, 'html_url' ) );

	$contributing = _get( $files, 'contributing' );
	gh_set_env_not_exists( 'REPOSITORY_CONTRIBUTING_URL', _get( $contributing, 'html_url' ) );

	$license = _get( $files, 'license' );
	gh_set_env_not_exists( 'REPOSITORY_LICENSE', _get( $license, 'name' ) );
	gh_set_env_not_exists( 'REPOSITORY_LICENSE_URL', _get( $license, 'html_url' ) );
	gh_set_env_not_exists( 'REPOSITORY_LICENSE_SLUG', _get( $license, 'key' ) );
	gh_set_env_not_exists( 'REPOSITORY_LICENSE_SPDX_ID', _get( $license, 'spdx_id' ) );

	$readme = _get( $files, 'readme' );
	gh_set_env_not_exists( 'REPOSITORY_README_URL', _get( $readme, 'html_url' ) );

}