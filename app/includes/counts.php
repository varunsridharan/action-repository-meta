<?php
/**
 * Sets ENV About Repository Counts
 */

gh_set_env_not_exists( 'REPOSITORY_WATCHERS_COUNT', _get( $data, 'watchers_count' ) );
gh_set_env_not_exists( 'REPOSITORY_STARGAZERS_COUNT', _get( $data, 'stargazers_count' ) );
gh_set_env_not_exists( 'REPOSITORY_FORKS_COUNT', _get( $data, 'forks_count' ) );