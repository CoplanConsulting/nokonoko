<?php
/**
 * Layouts Customizer
 * @since 3.0.0
 */

/* Add layout option in Customize. */
add_action( 'customize_register', 'tamatebako_layouts_customizer_register' );

/**
 * Registers Customizer sections, settings, and controls
 */
function tamatebako_layouts_customizer_register( $wp_customize ) {

	/* Load Layout Customizer Class */
	tamatebako_include( 'layouts/customizer-control' );

	/* Add the layout section. */
	$wp_customize->add_section(
		'layout',
		array(
			'title'      => esc_html( tamatebako_string( 'layout' ) ),
			'priority'   => 190,
			'capability' => 'edit_theme_options'
		)
	);

	// Add the layout setting.
	$wp_customize->add_setting(
		'theme_layout',
		array(
			'default'           => 'content',
			'sanitize_callback' => 'sanitize_key',
			'transport'         => 'refresh'
		)
	);

	// Add the layout control.
	$wp_customize->add_control(
		new Tamatebako_Customize_Layout(
			$wp_customize,
			'theme_layout',
			array()
		)
	);
}

/* Print Script and Style if using thumbnail */
$layouts_args = tamatebako_layouts_args();
if( true == $layouts_args['thumbnail'] ){
	add_action( 'customize_controls_print_styles', 'tamatebako_customize_layouts_thumb_style' );
	add_action( 'customize_controls_print_footer_scripts', 'tamatebako_customize_layouts_thumb_script' );
}

/**
 * Style for layout thumbnail.
 * @since 3.0.0
 */
function tamatebako_customize_layouts_thumb_style(){
?>
<style id="tamatebako-customize-layouts">
.theme-layouts-thumbnail-wrap .theme-layout-input{
	display: none;
}
.theme-layouts-thumbnail-wrap .layout-name{
	display: none;
}
.theme-layouts-thumbnail-wrap .customize-control-title{
	margin-bottom: 10px;
}
.theme-layouts-thumbnail-wrap .theme-layout-label{
	width: 60px;
	display: block;
	float: left;
	margin: 0 20px 5px 0;
	padding: 0;
}
.layout-thumbnail{
	width: 100%;
	height: auto;
	border: 5px solid #ccc;
}
.layout-default .layout-thumbnail{
}
.layout-selected .layout-thumbnail{
	border: 5px solid #298cba;
}
.theme-layout-label:hover .layout-thumbnail{
	opacity: 0.8;
}
</style>
<?php
}

/**
 * Script for layout thumbnail
 * @since 3.0.0
 */
function tamatebako_customize_layouts_thumb_script(){
?>
<script type="text/javascript">
jQuery(document).ready(function ($) {
	/* Layouts options */
	$( ".theme-layout-input" ).change( function(){
		if( $( this ).is(':checked') ){
			$( this ).parent( '.theme-layout-label' ).siblings( '.theme-layout-label' ).removeClass( 'layout-selected' );
			$( this ).parent( '.theme-layout-label' ).addClass( 'layout-selected' );
		}
	});


});
</script>
<?php
}

/* Load JS for ajax Post Layout */
add_action( 'customize_controls_enqueue_scripts', 'my_customize_scripts', 0 );

/**
 * Enqueue Script
 */
function my_customize_scripts(){
	$js = trailingslashit( get_template_directory_uri() ) . TAMATEBAKO_DIR . '/layouts/customizer.js';
	wp_enqueue_script( 'tamatabako-customize-post-layout', $js, array(), null, true );
	wp_localize_script( 'tamatabako-customize-post-layout', 'tamatebako_customize_post_layout', array(
		'ajaxurl'     => admin_url( 'admin-ajax.php' ),
		'ajaxnonce' => wp_create_nonce( 'my_customize_ajax_nonce' ),
	));
}

/* Ajax Callback */
add_action( 'wp_ajax_tamatebako_customize_post_layout', 'tamatebako_customize_post_layout_ajax_callback' );


function tamatebako_customize_post_layout_ajax_callback(){

	/* verify nonce */
	if ( ! wp_verify_nonce( $_POST['ajaxnonce'], 'my_customize_ajax_nonce' ) ){
		die(-1);
	}

	/* get term id (clicked) */
	$current_url = $_POST['current_url'];
	$post_id = url_to_postid( $current_url );

	$message = '';

	/* no ID, archive page, etc... */
	if( empty( $post_id ) ){
		$message = "Current page in preview do not support layout and using global layout.";
	}
	elseif( in_array( get_post_type( $post_id ), tamatebako_layouts_post_types() ) ){
		$message = 'You are previewing <strong>' . get_the_title( $post_id ) . '</strong>';
		if( tamatebako_get_post_layout( $post_id ) ){
			$message .= '<br/>' . 'Current post layout is "' . tamatebako_layout_name( tamatebako_get_post_layout( $post_id ) ) . '"';
		}
		else{
			$message .= '<br/>' . 'Page layout not selected yet. Currently using Global Layout.';
		}
		$message .= '<br/>' . '<a target="_blank" href="' . get_edit_post_link( $post_id ) . '">Edit Page Layout.</a>';
	}
	echo $message;
	die();
}





