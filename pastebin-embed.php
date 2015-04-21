<?php
/*
Plugin Name: Pastebin Embed
Plugin URI:  https://wordpress.org/plugins/pastebin-embed/
Description: Embed pastes from pastebin.com into your WordPress site
Version:     1.2
Author:      Rami Yushuvaev
Author URI:  http://GenerateWP.com/
Text Domain: pastebin-embed
Domain Path: /languages
*/



/*
 * Prevent direct access to the file
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}



/*
 * Register embed handler
 */
function pastebin_embed_handler( $matches, $attr, $url, $rawattr ) {

	$scheme = is_ssl() ? 'https' : 'http';

	$embed = sprintf(
		'<script src="' . $scheme . '://pastebin.com/embed_js.php?i=%1$s"></script>',
		esc_attr( $matches[1] )
	);

	return apply_filters( 'embed_pastebin', $embed, $matches, $attr, $url, $rawattr );

}

function pastebin_embed() {

	wp_embed_register_handler(
		'pastebin',
		'#http://pastebin.com/(.*)#i',
		'pastebin_embed_handler'
	);

}

add_action( 'init', 'pastebin_embed' );
