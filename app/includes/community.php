<?php
/**
 * Sets ENV About Repository Communit Files
 */

$license = _get( $data, 'license' );
if ( $license ) {
	gh_set_env_not_exists( 'REPOSITORY_LICENSE_SLUG', _get( $license, 'key' ) );
	gh_set_env_not_exists( 'REPOSITORY_LICENSE', _get( $license, 'name' ) );

}