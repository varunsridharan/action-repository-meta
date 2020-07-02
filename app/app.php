<?php
define( 'APP_PATH', __DIR__ . '/' );

require_once APP_PATH . 'functions.php';

if ( empty( get_env( 'GITHUB_TOKEN' ) ) ) {
	die( '::error:: 🛑 GITHUB_TOKEN ENV is not set !' );
}