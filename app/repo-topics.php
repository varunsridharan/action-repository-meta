<?php
$topics = false;

if ( isset( $data->topics ) ) {
	$topics = $data->topics;
}

if ( empty( $topics ) ) {
	try {
		$topics = $github_api->decode( $github_api->get( 'repos/' . $repo . '/topics', [], [] ) );
	} catch ( \Milo\Github\UnexpectedResponseException $exception ) {
		$topics = $github_api->decode( $github_api->get( 'repos/' . $repo . '/topics', [], [ 'Accept' => 'application/vnd.github.mercy-preview+json' ] ) );
	}
	$topics = ( isset( $topics->names ) && ! empty( $topics->names ) ) ? $topics->names : false;
}

if ( ! empty( $topics ) ) {
	$topics = ( empty( $topics ) ) ? '' : json_encode( $topics );
	gh_set_env_not_exists( 'REPOSITORY_TOPICS', addslashes( $topics ) );
} else {
	gh_log_warning( 'Unable To Fetch Repository Topics' );
}

