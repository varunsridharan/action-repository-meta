<?php
/**
 * Sets ENV About Repository URL's
 */

gh_set_env_not_exists( 'REPOSITORY_GITHUB_URL', _get( $data, 'html_url' ) );
gh_set_env_not_exists( 'REPOSITORY_HOMEPAGE_URL', _get( $data, 'homepage' ) );
gh_set_env_not_exists( 'REPOSITORY_GIT_URL', _get( $data, 'git_url' ) );
gh_set_env_not_exists( 'REPOSITORY_SSH_URL', _get( $data, 'ssh_url' ) );