<?php
/**
 * Plugin Name: SermonAudio Embed
 * Description: Easily embed SermonAudio.com sermons.
 * Author: Carlos Rios
 * Author URI: http://crios.me
 * Version: 1.0
 * Plugin URI: https://github.com/CarlosRios/sermonaudio-embed
 * License: GPL2+
 *
 * @package  SermonAudio Embeds
 * @category WordPress/Plugin
 * @author   Carlos Rios
 */

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) {
	die;
}

// Get things going
add_action( 'init', function(){
	wp_embed_register_handler(
		'sermonaudio',
		'#http://(www\.)?sermonaudio\.com/sermoninfo.asp\?SID=([\d]+)#',
		'wp_register_sermonaudio_embed'
	);
	wp_embed_register_handler(
		'sermonaudio_2',
		'#http://(www\.)?sermonaudio\.com/sermoninfo.asp\?m=t&s=([\d]+)#',
		'wp_register_sermonaudio_embed'
	);
});

/**
 * Provide WordPress with the embed code
 *
 * @since  1.0
 * @return string
 */
function wp_register_sermonaudio_embed( $matches, $attr, $url, $rawattr )
{
	$embed = sprintf(
		'<iframe style="min-width:250px;" width="100%%" height="150" frameborder="0" src="http://www.sermonaudio.com/saplayer/player_embed.asp?SID=%1$s"></iframe>',
		esc_attr( $matches[2] )
	);

	return apply_filters( 'wp_embed_sermonaudio', $embed, $matches, $attr, $url, $rawattr );
}
