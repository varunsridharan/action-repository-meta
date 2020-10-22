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
	gh_log_warning( 'Unable To Fetch ' . $key );
	return false;
}