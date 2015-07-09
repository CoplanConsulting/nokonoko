jQuery(document).ready(function ($) {

	/**
	 * This loaded when URL is changing in the customizer preview.
	 * it will:
	 * - show notice that it pulling data
	 * - from current preview url:
	 * - - get current title, and update title.
	 * - - get current layout, and update current layout.
	 */
	function update_post_layout_setting(){

		/* display notes that we are gathering the data.. */
		$( ".post-layout-update-status span" ).hide();
		$( ".post-layout-checking" ).show();

		/* Start ajax */
		$.ajax( {
			type: "POST",
			url: tamatebako_customize_post_layout.ajaxurl, /* from localized script */
			data:
			{
				action       : 'tamatebako_customize_post_layout_update_setting', /* inject data to hook "wp_ajax_*" */
				ajaxnonce    : tamatebako_customize_post_layout.ajaxnonce, /* from localize script */
				current_url  : wp.customize.previewer.previewUrl(),
			},
			dataType: 'json', /* use JSON data */
			success: function( data ){

				/* debug */
				//$( '.customize-post-layouts-wrap' ).append( '<p>' + JSON.stringify(data) + '</p>' );
				//$( '.customize-post-layouts-wrap' ).append( '<p>' + data.layout + '</p>' );

				/* Change wrapper ID with post ID (temp method) */
				$( '.customize-post-layouts-wrap' ).attr( 'id', data.id )

				/* done checking the data... */
				$( ".post-layout-checking" ).hide();

				/* If layout data is empty, that mean layout is not supported in this "view", hide the post layout setting. */
				if( '' == data.layout ){
					$( '.customize-post-layouts-wrap' ).addClass( 'post-layouts-hide' );
				}

				/* yes, post layout is available for this "view" */
				else{
					
					/* display the setting */
					$( '.customize-post-layouts-wrap' ).removeClass( 'post-layouts-hide' );
					
					/* Change post info title */
					$( '.post-layout-title' ).text( data.title );

					/* if current post have no layout yet. */
					if( "default" == data.layout ){

						/* Do not select any layout. remove all selected. */
						$( ".customize-post-layouts-wrap .theme-layout-input" ).each( function(){
							$( this ).parent( '.theme-layout-label' ).removeClass( 'layout-selected' );
							$( this ).attr( 'checked', false );
						});
					}

					/* display the setting */
					$( '.customize-post-layouts-wrap' ).removeClass( 'post-layout-hide' );

					/* if the data is "default", do not select it. */
					if( 'default' == data ){
						$( ".customize-post-layouts-wrap .theme-layout-input" ).each( function(){
							$( this ).parent( '.theme-layout-label' ).removeClass( 'layout-selected' );
							$( this ).attr( 'checked', false );
						});
					}
	
					/* data is not default, select current post layout */
					else{
						/* loop all post layout input */
						$( ".customize-post-layouts-wrap .theme-layout-input" ).each( function(){
							/* if layout found, select it. */
							if( $( this ).hasClass( 'layout-' + data.layout ) ){
								$( this ).parent( '.theme-layout-label' ).addClass( 'layout-selected' );
								$( this ).attr( 'checked', 'checked' );
							}
						});
					}
				}
			}
		} );
	}
	wp.customize.previewer.bind('url', update_post_layout_setting );
	//$( ".check-post-layout" ).click( my_post_layout );

	/* Click it. */
	$( ".customize-post-layouts-wrap .theme-layout-input" ).click( function(){

		/* Updating the data notice */
		$( ".post-layout-update-status span" ).hide();
		$( ".post-layout-updating" ).show();
		var new_layout = $( this ).attr( 'value' );
		var layout_clicked = $(this);

		/* Start ajax */
		$.ajax( {
			type: "POST",
			url: tamatebako_customize_post_layout.ajaxurl, /* from localized script */
			data:
			{
				action       : 'tamatebako_customize_post_layout_update_meta', /* inject data to hook "wp_ajax_*" */
				ajaxnonce    : tamatebako_customize_post_layout.ajaxnonce, /* from localize script */
				post_id      : $( '.customize-post-layouts-wrap' ).attr( 'id' ),
				new_layout   : new_layout,
			},
			dataType: 'json', /* use JSON data */
			success: function( data ){

				/* debug */
				//$( '.customize-post-layouts-wrap' ).append( '<p>' + JSON.stringify(data) + '</p>' );

				/* Success updating */
				if( 'success' == data.update ){
					$( ".post-layout-updating" ).hide();
					$( ".post-layout-updated" ).show();

					/* highlight selected. */
					layout_clicked.parent( '.theme-layout-label' ).siblings( '.theme-layout-label' ).removeClass( 'layout-selected' );
					layout_clicked.parent( '.theme-layout-label' ).addClass( 'layout-selected' );

				}
				/* oh no.. something's wrong */
				else{
					$( ".post-layout-updating" ).hide();
					$( ".post-layout-error" ).show();
				}
			}
		} );
	});

	
});























