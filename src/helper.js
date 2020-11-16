const str_replace = ( str, search, replace ) => str.replace( search, replace );

const remove_hyphen = ( str, replaceWith = ' ' ) => str_replace( str, /-/g, replaceWith );

/**
 * Slugify a given string.
 * @param {string} inputString
 * @return {string} The slugified string.
 */
const slugify = ( inputString ) => inputString.toLowerCase().replace( /[^a-z0-9 -]/g, ' ' )
											  .replace( /^\s+|\s+$/g, '' )
											  .replace( /\s+/g, '-' )
											  .replace( /-+/g, '-' );

module.exports = {
	handle: ( value ) => ( typeof value !== 'undefined' ) ? value : '',
	getShaShort: ( fullSha ) => fullSha ? fullSha.substring( 0, 8 ) : null,
	getRefName: ( ref ) => ref ? ref.split( '/' ).slice( 2 ).join( '/' ) : null,
	getRefVersion: ( str ) => {
		const regex = /^refs\/\w+\//gm;
		const subst = ``;
		return str.replace( regex, subst );
	},
	slugify: slugify,
	str_replace: str_replace,
	remove_hyphen: remove_hyphen,
	ucwords: ( str ) => str.toLowerCase().replace( /\b[a-z]/g, ( letter ) => letter.toUpperCase() ),
};