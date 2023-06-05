<?php

include_once 'trash-post-type.php';

add_filter( 'comments_open', '__return_true' );

function get_trash_dots() {
	$dots = get_posts(
		array(
			'post_type'      => 'trash-dot',
			'posts_per_page' => - 1,
			'fields'         => 'ids',
		)
	);

	$dots_data = [];

	foreach ( $dots as $dot_post_id ) {
		$dots_data[ $dot_post_id ] = [
			'title'       => get_the_title( $dot_post_id ),
			'desc'        => get_field( 'summary', $dot_post_id ),
			'img'         => get_field( 'main_photo', $dot_post_id ),
			'link'        => get_post_permalink( $dot_post_id ),
			'coordinates' => get_field('coordinates', $dot_post_id)['marks'][0]['coords'],
			'time'        => get_the_date( '', $dot_post_id ),
			'address'     => get_field( 'place', $dot_post_id ),
		];
	}

	return $dots_data;
}