<?php
/**
 * Sets ENV About Repository Features
 */

gh_set_env_not_exists( 'REPOSITORY_HAS_ISSUES', _get( $data, 'has_issues' ) );
gh_set_env_not_exists( 'REPOSITORY_HAS_PROJECTS', _get( $data, 'has_projects' ) );
gh_set_env_not_exists( 'REPOSITORY_HAS_DOWNLOADS', _get( $data, 'has_downloads' ) );
gh_set_env_not_exists( 'REPOSITORY_HAS_WIKI', _get( $data, 'has_wiki' ) );
gh_set_env_not_exists( 'REPOSITORY_HAS_PAGES', _get( $data, 'has_pages' ) );