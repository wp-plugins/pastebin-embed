<?php
/*
Plugin Name: Pastebin Embed
Description: Embed pastes from pastebin.com
Version: 1.1
Author: Rami Yushuvaev
Author URI: http://GenerateWP.com/
Text Domain: pastebin-embed
Domain Path: /languages
License: GPL2+
*/

function pastebin_embed_handler( $matches, $attr, $url, $rawattr ) {

	$embed = sprintf(
		'<script src="http://pastebin.com/embed_js.php?i=%1$s"></script>',
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
