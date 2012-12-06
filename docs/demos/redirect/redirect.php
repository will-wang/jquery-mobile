<?php
	if ( 
		( isset( $_GET[ "source" ] ) || 
		  isset( $_POST[ "source" ] ) ) && 
				isset( $_SERVER[ "SCRIPT_FILENAME" ] ) ) {
		show_source( $_SERVER[ "SCRIPT_FILENAME" ] );
	} else {
		$dst = ( isset( $_GET[ "to" ] ) 
			? $_GET[ "to" ] 
			: ( isset( $_POST[ "to" ] ) 
				? $_POST[ "to" ] 
				: false ) );
		if ( $dst ) {
			// **********************************************************************
			// The crucial line: Issue a custom header with the location to which the
			// redirect should happen. For simplicity, we simply redirect to whatever
			// location was specified in the request's "to" parameter, but real-world
			// scripts can compute the destination based on server-side state.
			//
			// NB: This is not a HTTP redirect. As far as HTTP is concerned, this is
			// a normal request/response cycle with a status code of 200.
			// **********************************************************************
			header( "X-Redirect: " . $dst );
		}
	}
?>