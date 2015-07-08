jQuery(document).ready(function ($) {

	$( ".check-post-layout" ).click( function(e){
		e.preventDefault();

		$( ".checking-post-layout-data" ).show();
		$.ajax( {
			type: "POST",
			url: tamatebako_customize_post_layout.ajaxurl, /* from localized script */
			data:
			{
				action       : 'tamatebako_customize_post_layout', /* inject data to hook "wp_ajax_*" */
				ajaxnonce    : tamatebako_customize_post_layout.ajaxnonce, /* from localize script */
				current_url  : wp.customize.previewer.previewUrl(), /* from data-ttatermid in add module link */
			},
			success: function( data ){
				$( ".checking-post-layout-data" ).hide();
				$( ".current-page-layout-info" ).remove();
				$( ".customize-post-layouts" ).append( '<p class="current-page-layout-info">' + data + '</p>' );
			}
		} );

	});


});