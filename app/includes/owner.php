<?php
/**
 * Sets ENV About Repository Owner
 */
$owner = _get( $data, 'owner' );

gh_set_env_not_exists( 'REPOSITORY_OWNER', _get( $owner, 'login' ) );
gh_set_env_not_exists( 'OWNER_PROFILE', _get( $owner, 'html_url' ) );
gh_set_env_not_exists( 'OWNER_TYPE', _get( $owner, 'type' ) );
gh_set_env_not_exists( 'OWNER_AVATAR_URL', _get( $owner, 'avatar_url' ) );
gh_set_env_not_exists( 'IS_OWNER_ORGANIZATION', ( 'Organization' === _get( $owner, 'type' ) ) );
gh_set_env_not_exists( 'IS_OWNER_USER', ( 'Organization' === _get( $owner, 'type' ) ) );
