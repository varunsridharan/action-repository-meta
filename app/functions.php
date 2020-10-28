<?php
/**
 * @param $var
 * @param $key
 *
 * @return bool
 */
function _validate( $var, $key ) {
	if ( isset( $var->$key ) ) {
		return true;
	}
	GH_LOG::Log( sprintf( 'Warning: ⚠️   Unable To Fetch {%s}', $key ), 'black', 'yellow' );
	return false;
}

function _get( $var, $key ) {
	return ( _validate( $var, $key ) ) ? $var->$key : false;
}