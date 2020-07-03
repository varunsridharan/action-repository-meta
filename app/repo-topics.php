<?php
$topics = false;

if ( isset( $data->topics ) ) {
	$topics = $data->topics;
}

if ( empty( $topics ) ) {
	try {
		$topics = $gh_api->decode( $gh_api->get( 'repos/' . $repo . '/topics', [], [] ) );
	} catch ( \Milo\Github\UnexpectedResponseException $exception ) {
		$topics = $gh_api->decode( $gh_api->get( 'repos/' . $repo . '/topics', [], [ 'Accept' => 'application/vnd.github.mercy-preview+json' ] ) );
	}
	$topics = ( isset( $topics->names ) && ! empty( $topics->names ) ) ? $topics->names : false;
}

if ( ! empty( $topics ) ) {
	$topics = ( empty( $topics ) ) ? '' : json_encode( $topics );
	set_action_env_not_exists( 'REPOSITORY_TOPICS', $topics );
} else {
	_warning( 'Unable To Fetch Repository Topics' );
}

