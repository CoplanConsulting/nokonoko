<?php
/**
 * Customizer: Post Layout
 * Modify post layout via customizer
**/


/* Add layout option in Customize. */
add_action( 'customize_register', 'tamatebako_layouts_customizer_post_register' );

/**
 * Registers Customizer sections, settings, and controls
 */
function tamatebako_layouts_customizer_post_register( $wp_customize ) {

	/* Load Layout Customizer Class */
	tamatebako_include( 'layouts/customizer-control-post' );

	// Add the layout setting.
	$wp_customize->add_setting(
		'post_layout',
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_key',
			'transport'         => 'refresh'
		)
	);

	// Add the layout control.
	$wp_customize->add_control(
		new Tamatebako_Customize_Post_Layout(
			$wp_customize,
			'post_layout',
			array()
		)
	);
}

/* Load JS for ajax Post Layout */
add_action( 'customize_controls_enqueue_scripts', 'tamatebako_customizer_post_layout_scripts' );

/**
 * Enqueue Script
 */
function tamatebako_customizer_post_layout_scripts(){
	$js = trailingslashit( get_template_directory_uri() ) . TAMATEBAKO_DIR . '/layouts/customizer-post.js';
	wp_enqueue_script( 'tamatabako-customize-post-layout', $js, array(), null, true );
	wp_localize_script( 'tamatabako-customize-post-layout', 'tamatebako_customize_post_layout', array(
		'ajaxurl'     => admin_url( 'admin-ajax.php' ),
		'ajaxnonce' => wp_create_nonce( 'my_customize_ajax_nonce' ),
	));
}

/* Ajax Callback */
add_action( 'wp_ajax_tamatebako_customize_post_layout_update_setting', 'tamatebako_customize_post_layout_update_setting_ajax_callback' );


function tamatebako_customize_post_layout_update_setting_ajax_callback(){
	if ( ! wp_verify_nonce( $_POST['ajaxnonce'], 'my_customize_ajax_nonce' ) ){
		die(-1);
	}

	/* ======= GET CURRENT ID ====== */

	/* Post ID default value */
	$post_id = 0;

	/* Customizer landing page in internal page. */
	if ( isset( $_POST['current_url'] ) ){

		$url = $_POST['current_url'];

		/* format url */
		$url = trailingslashit( esc_url_raw( $url ) );

		/* if it's front page (not internal page) */
		if( home_url('/') == $url ){
			$options_front_page = get_option('show_on_front ');
			if ( $options_front_page == 'page' ){
				$front_page_id = get_option( 'page_on_front' );
				if ( isset( $front_page_id ) && !empty( $front_page_id ) ){
					$post_id = $front_page_id;
				}
			}
		}
		else{
			
			$post_id = url_to_postid( $url );
		}
	}
	/* Customizer landing page in front page (no url defined) */
	else{
		$options_front_page = get_option('show_on_front ');
		if ( $options_front_page == 'page' ){
			$front_page_id = get_option( 'page_on_front' );
			if ( isset( $front_page_id ) && !empty( $front_page_id ) ){
				$post_id = $front_page_id;
			}
		}
	}

	/* ======= ============== ====== */

	/* open sesame */
	$output = array();

	/* data output */
	$title = '';
	$layout = '';

	/* if in singular page */
	if( !empty( $post_id ) ){

		/* check post type */
		if( in_array( get_post_type( $post_id ), tamatebako_layouts_post_types() ) ){

			/* title */
			$title = get_the_title( $post_id );

			/* no layout selected */
			$layout = 'default';

			/* return the current layout. */
			if( tamatebako_get_post_layout( $post_id ) ){
				$layout = tamatebako_get_post_layout( $post_id );
			}
		}
	}

	$output = array(
		'id' => $post_id,
		'title' => $title,
		'layout' => $layout,
	);
	
	/* close sesame: json encode it for js */
	echo json_encode( $output );
	die();
}


/* Ajax Callback */
add_action( 'wp_ajax_tamatebako_customize_post_layout_update_meta', 'tamatebako_customize_post_layout_update_meta_ajax_callback' );


function tamatebako_customize_post_layout_update_meta_ajax_callback(){
	if ( ! wp_verify_nonce( $_POST['ajaxnonce'], 'my_customize_ajax_nonce' ) ){
		die(-1);
	}
	$post_id = $_POST['post_id'];
	$new_layout = $_POST['new_layout'];
	$update = false;
	if( isset($_POST['post_id']) && isset($_POST['new_layout']) && !empty( $post_id ) ){
		$update = update_post_meta( $post_id, tamatebako_layout_meta_key(), $new_layout );
	}
	$output = array();

	/* only if post layout updated */
	if( true === $update ){

		$output['post_id'] = $post_id;
		$output['update'] = 'success';
		$output['layout'] = tamatebako_layout_name( $new_layout );
		$output['layout_key'] = tamatebako_layout_meta_key();
		$output['new_layout'] = tamatebako_get_post_layout( $post_id );
		$output['message'] = 'Post layout "' . get_the_title( $post_id ) . '" updated to "' . tamatebako_layout_name( tamatebako_get_post_layout( $post_id ) ) . '"';

	}
	/* FAIL! */
	else{

		$output['post_id'] = $post_id;
		$output['update'] = 'error';
		$output['new_layout'] = '';
		$output['message'] = 'Error in updating post layout. please try again...';

	}
	//$output = array( 'post_id' =>  $_POST['post_id'], 'new_layout' =>  $_POST['new_layout'],  );

	echo json_encode( $output );
	die();
}


























