const toolkit = require( 'actions-js-toolkit' );
const github  = require( '@actions/github' );

let GITHUB_TOKEN = toolkit.input.env( 'GITHUB_TOKEN' );
const github_api = github.getOctokit( GITHUB_TOKEN );

module.exports = github_api;