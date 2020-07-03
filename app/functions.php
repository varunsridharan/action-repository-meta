<?php
/**
 * Sets Global ENV Variable For Github Action
 *
 * @param $key
 * @param $value
 * @param $msg
 *
 * @return true
 */
function set_action_env( $key, $value ) {
	_echo( "::set-env name=${key}::${value}" );
	$_ENV[ $key ] = $value;
	return true;
}

/**
 * Sets ENV If not exists.
 *
 * @param $key
 * @param $value
 * @param $msg
 *
 * @return bool
 */
function set_action_env_not_exists( $key, $value, $msg = true ) {
	if ( ! isset( $_ENV[ $key ] ) ) {
		set_action_env( $key, $value );
		if ( $msg ) {
			_echo( "✔️ ENV   ${key}		=		${value}" );
		}
		return true;
	}
	_echo( "ℹ️ ENV ${key} ALREADY EXISTS WITH VALUE - {$_ENV[$key]}" );
	return false;
}

/**
 * @param      $content
 */
function _echo( $content ) {
	echo $content . PHP_EOL;
}

/**
 * @param string $key
 * @param bool   $default
 *
 * @return mixed
 */
function get_env( $key, $default = false ) {
	return ( isset( $_ENV[ $key ] ) ) ? $_ENV[ $key ] : $default;
}
