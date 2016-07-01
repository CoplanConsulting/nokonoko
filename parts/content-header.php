<?php
$context = '';
if( is_post_type_archive() ){
	$context = get_post_type();
}
elseif ( get_the_archive_title() && !is_front_page() && !is_singular() && !is_404() ){
	$context = 'archive';
}
elseif ( is_singular() ){
	$context = 'singular-' . get_post_type();
}
/* Load template */
if( $context ){
	get_template_part( 'parts/header', $context );
}
