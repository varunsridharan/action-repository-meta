<?php
/**
 * Sets ENV About Repository Communit Files
 */

$license = _get( $data, 'license' );
if ( $license ) {
	gh_set_env_not_exists( 'REPOSITORY_LICENSE_SLUG', _get( $license, 'key' ) );
	gh_set_env_not_exists( 'REPOSITORY_LICENSE', _get( $license, 'name' ) );

}

print_r( 'repos/' . REQUEST_REPOSITORY . '/community/profile' );

#$community = $github_api->decode( $github_api->get( 'repos/' . REQUEST_REPOSITORY . '/community/profile' ) );

/*if ( empty( $community ) ) {
	gh_log_error( 'Unable To Fetch Community Information For : ' . REQUEST_REPOSITORY );
}*/


/*gh_log_group_start( 'community info' );
print_r( $community );
gh_log_group_end();*/