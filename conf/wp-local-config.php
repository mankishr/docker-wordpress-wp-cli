<?php
/**
 * WordPress local config
 *
 * @package docker-wordpress-basic-setup
 */

// Conditionally turn on HTTPS since we're behind nginx-proxy.
if ( isset( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) && 'https' === $_SERVER['HTTP_X_FORWARDED_PROTO'] ) { // Input var ok.
	$_SERVER['HTTPS'] = 'on';
}

define( 'WP_HOME', 'https://game-score.loc/' );
define( 'WP_SITEURL', 'https://game-score.loc/' );

define('WP_DEBUG', true);
define( 'WP_DEBUG_LOG', true ); // To turn on logging

define( 'SCRIPT_DEBUG', true );

define('WP_MEMORY_LIMIT', '556M');
set_time_limit(300);

