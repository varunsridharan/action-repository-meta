const core    = require( '@actions/core' );
const toolkit = require( 'actions-js-toolkit' );

let request_repo = core.getInput( 'REPOSITORY' );

if( '' === request_repo || false === request_repo || 'false' === request_repo ) {
	request_repo = toolkit.input.env( 'GITHUB_REPOSITORY' );
}

let info = request_repo.split( '/' );

module.exports = {
	repository: request_repo,
	request_owner: info[ 0 ],
	request_repo: info[ 1 ],
};