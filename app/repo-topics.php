<?php
$topics = false;

if ( isset( $data->topics ) ) {
	$topics = $data->topics;
}

if ( empty( $topics ) ) {
	$topics = $gh_api->decode( $gh_api->get( 'repos/varunsridharan/tag/topics', [], [ 'Accept' => 'application/vnd.github.mercy-preview+json' ] ) );
	if ( isset( $topics->names ) && ! empty( $topics->names ) ) {
		$topics = $topics->names;
	} else {
		$topics = false;
	}
}

if ( ! empty( $topics ) ) {
	$topics = json_encode( $topics );
	var_dump( $topics );
	set_action_env_not_exists( 'REPOSITORY_TOPICS', "'$topics'" );
}