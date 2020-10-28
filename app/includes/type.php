<?php
/**
 * Sets ENV About Repository Type
 */

gh_set_env_not_exists( 'REPOSITORY_IS_PRIVATE', _get( $data, 'private' ) );
gh_set_env_not_exists( 'REPOSITORY_IS_FORK', _get( $data, 'fork' ) );
gh_set_env_not_exists( 'REPOSITORY_IS_TEMPLATE', _get( $data, 'is_template' ) );
gh_set_env_not_exists( 'REPOSITORY_IS_TEMPLATE', _get( $data, 'is_template' ) );
gh_set_env_not_exists( 'REPOSITORY_IS_ARCHIVED', _get( $data, 'archived' ) );
gh_set_env_not_exists( 'REPOSITORY_IS_DISABLED', _get( $data, 'disabled' ) );
