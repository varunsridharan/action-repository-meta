const toolkit = require( 'actions-js-toolkit' );
const api     = require( './github-api' );
const vars    = require( './vars' );
const core    = require( '@actions/core' );
const helper  = require( './helper' );

async function run() {
	toolkit.input.env_validate( 'GITHUB_TOKEN', 'Github Token Is Required' );

	const GITHUB_REF         = toolkit.input.env( 'GITHUB_REF' );
	const GITHUB_SHA         = toolkit.input.env( 'GITHUB_SHA' );
	let repository_info      = false;
	let repository_community = false;
	let repository_topics    = false;

	await api.repos.get( {
		owner: vars.request_owner,
		repo: vars.request_repo,
	} )
			 .then( ( data ) => repository_info = data.data )
			 .catch( () => toolkit.log.warn( 'Unable To Fetch Repository Information' ) );

	await api.repos.getCommunityProfileMetrics( {
		owner: vars.request_owner,
		repo: vars.request_repo,
	} )
			 .then( ( data ) => repository_community = data.data )
			 .catch( () => toolkit.log.yellowBright( 'Unable To Fetch Community Profile Metrics' ) );

	await api.repos.getAllTopics( {
		owner: vars.request_owner,
		repo: vars.request_repo
	} )
			 .then( ( data ) => repository_topics = data.data )
			 .catch( () => toolkit.log.warn( 'Unable To Fetch Repository Topics' ) );


	core.info( '' );
	core.startGroup( 'ℹ️  Repository Basic Info' );
	toolkit.input.set_env( 'REPOSITORY_SLUG', helper.handle( repository_info.name ) );
	toolkit.input.set_env( 'REPOSITORY_NAME', helper.ucwords( helper.remove_hyphen( helper.handle( repository_info.name ) ) ) );
	toolkit.input.set_env( 'REPOSITORY_FULL_NAME', helper.handle( repository_info.full_name ) );
	toolkit.input.set_env( 'REPOSITORY_DESCRIPTION', helper.handle( repository_info.description ) );
	toolkit.input.set_env( 'REPOSITORY_DEFAULT_BRANCH', helper.handle( repository_info.default_branch ) );
	toolkit.input.set_env( 'REPOSITORY_CREATED_AT', helper.handle( repository_info.created_at ) );
	toolkit.input.set_env( 'REPOSITORY_UPDATED_AT', helper.handle( repository_info.updated_at ) );
	toolkit.input.set_env( 'REPOSITORY_PUSHED_AT', helper.handle( repository_info.pushed_at ) );
	toolkit.input.set_env( 'RELEASE_VERSION', helper.getRefVersion( GITHUB_REF ) );
	toolkit.input.set_env( 'SHA_SHORT', helper.getShaShort( GITHUB_SHA ) );
	toolkit.input.set_env( 'REPOSITORY_TOPICS', JSON.stringify( helper.handle( repository_topics.names ) ) );
	/**
	 * New
	 */
	toolkit.input.set_env( 'GITHUB_REF_SLUG', helper.slugify( GITHUB_REF ) );
	toolkit.input.set_env( 'GITHUB_REF_NAME', helper.getRefName( GITHUB_REF ) );
	core.endGroup();

	core.info( '' );
	core.startGroup( '🧑‍🤝‍🧑  Repository Community Health Files Info' );
	toolkit.input.set_env( 'REPOSITORY_CONTENTS_REPORTS_ENABLED', helper.handle( repository_community.content_reports_enabled ) );
	if( repository_community.files ) {

		if( repository_community.files.code_of_conduct ) {
			toolkit.input.set_env( 'REPOSITORY_CODE_OF_CONDUCT_URL', helper.handle( repository_community.files.code_of_conduct.html_url ) );
		}

		if( repository_community.files.contributing ) {
			toolkit.input.set_env( 'REPOSITORY_CONTRIBUTING_URL', helper.handle( repository_community.files.contributing.html_url ) );
		}

		if( repository_community.files.license ) {
			toolkit.input.set_env( 'REPOSITORY_LICENSE', helper.handle( repository_community.files.license.name ) );
			toolkit.input.set_env( 'REPOSITORY_LICENSE_URL', helper.handle( repository_community.files.license.html_url ) );
			toolkit.input.set_env( 'REPOSITORY_LICENSE_SLUG', helper.handle( repository_community.files.license.key ) );
			toolkit.input.set_env( 'REPOSITORY_LICENSE_SPDX_ID', helper.handle( repository_community.files.license.spdx_id ) );
		}

		if( repository_community.files.readme ) {
			toolkit.input.set_env( 'REPOSITORY_README_URL', helper.handle( repository_community.files.readme.html_url ) );
		}

	}
	core.endGroup();

	core.info( '' );
	core.startGroup( 'Repository | 🍴 Forks | ⭐ Stars | ⏱️Watchers - Count' );
	toolkit.input.set_env( 'REPOSITORY_WATCHERS_COUNT', helper.handle( repository_info.watchers_count ) );
	toolkit.input.set_env( 'REPOSITORY_STARGAZERS_COUNT', helper.handle( repository_info.stargazers_count ) );
	toolkit.input.set_env( 'REPOSITORY_FORKS_COUNT', helper.handle( repository_info.forks_count ) );
	core.endGroup();


	core.info( '' );
	core.startGroup( 'Repository Features | ❗  issues | 📗 Wiki | 🌐 Pages - Status' );
	toolkit.input.set_env( 'REPOSITORY_HAS_ISSUES', helper.handle( repository_info.has_issues ) );
	toolkit.input.set_env( 'REPOSITORY_HAS_PROJECTS', helper.handle( repository_info.has_projects ) );
	toolkit.input.set_env( 'REPOSITORY_HAS_DOWNLOADS', helper.handle( repository_info.has_downloads ) );
	toolkit.input.set_env( 'REPOSITORY_HAS_WIKI', helper.handle( repository_info.has_wiki ) );
	toolkit.input.set_env( 'REPOSITORY_HAS_PAGES', helper.handle( repository_info.has_pages ) );
	core.endGroup();

	core.info( '' );
	core.startGroup( '💁  Repository Owner Info' );
	if( repository_info.owner ) {
		toolkit.input.set_env( 'REPOSITORY_OWNER', helper.handle( repository_info.owner.login ) );
		toolkit.input.set_env( 'OWNER_PROFILE', helper.handle( repository_info.owner.html_url ) );
		toolkit.input.set_env( 'OWNER_TYPE', helper.handle( repository_info.owner.type ) );
		toolkit.input.set_env( 'OWNER_AVATAR_URL', helper.handle( repository_info.owner.avatar_url ) );
		toolkit.input.set_env( 'IS_OWNER_ORGANIZATION', ( 'Organization' === helper.handle( repository_info.owner.type ) ) );
		toolkit.input.set_env( 'IS_OWNER_USER', ( 'Organization' !== helper.handle( repository_info.owner.type ) ) );
	}
	core.endGroup();

	core.info( '' );
	core.startGroup( '📃  Repository Status' );
	toolkit.input.set_env( 'REPOSITORY_IS_PRIVATE', helper.handle( repository_info.private ) );
	toolkit.input.set_env( 'REPOSITORY_IS_FORK', helper.handle( repository_info.fork ) );
	toolkit.input.set_env( 'REPOSITORY_IS_TEMPLATE', helper.handle( repository_info.is_template ) );
	toolkit.input.set_env( 'REPOSITORY_IS_ARCHIVED', helper.handle( repository_info.archived ) );
	toolkit.input.set_env( 'REPOSITORY_IS_DISABLED', helper.handle( repository_info.disabled ) );
	core.endGroup();

	core.info( '' );
	core.startGroup( '🔗  Repository URLs' );
	toolkit.input.set_env( 'REPOSITORY_GITHUB_URL', helper.handle( repository_info.html_url ) );
	toolkit.input.set_env( 'REPOSITORY_HOMEPAGE_URL', helper.handle( repository_info.homepage ) );
	toolkit.input.set_env( 'REPOSITORY_GIT_URL', helper.handle( repository_info.git_url ) );
	toolkit.input.set_env( 'REPOSITORY_SSH_URL', helper.handle( repository_info.ssh_url ) );
	core.endGroup();
}

run();