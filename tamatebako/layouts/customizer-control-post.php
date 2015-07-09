<?php
/**
 * Tamatebako Layout Customizer Control
 *
 * @since  3.0.0
 * @access public
 */
class Tamatebako_Customize_Post_Layout extends WP_Customize_Control {

	/* Vars */
	public $type = 'tamatebako-post-layouts';
	public $section = 'layout';
	public $settings = 'post_layout';

	/**
	 * Render Content
	 */
	public function render_content() {

		/* Get theme layout args. */
		$layouts_args = tamatebako_layouts_args();
		$layouts = tamatebako_layouts();

		/* No layout defined, return. */
		if ( empty( $layouts ) ){
			return;
		}

		/* Add default layout info in layout name */
		$layouts[tamatebako_layout_default()]['name'] = $layouts[tamatebako_layout_default()]['name'] . ' (' . tamatebako_string( 'default' ) . ')';

		/* Input name */
		$name = '_customize-radio-' . $this->id;

		/* ======= GET CURRENT ID ====== */

		/* Post ID default value */
		$post_id = 0;

		/* Customizer landing page in internal page. */
		if ( isset( $_GET['url'] ) ){

			/* format url */
			$url = trailingslashit( esc_url_raw( $_GET['url'] ) );

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

		/* Wrapper class */
		$wrap_class = 'customize-post-layouts-wrap';
		if( true == $layouts_args['thumbnail'] ){
			$wrap_class .= ' theme-layouts-thumbnail-wrap';
		}
		if( empty( $post_id ) ){
			$wrap_class .= ' post-layouts-hide';
		}
		?>

		<div id="<?php echo esc_attr( $post_id ); ?>" class="<?php echo esc_attr( $wrap_class ); ?>">

			<span class="customize-control-title"><span class="post-layout-post-type">Post</span> Layout</span>

			<div class="post-layout-info">
				<?php if( !empty( $post_id ) ){ ?>
					<p>Current layout for <strong class="post-layout-title"><?php echo get_the_title( $post_id );?></strong></p>
					
				<?php } ?>
			</div>

			<p class="post-layout-update-status">
				<span class="post-layout-checking" style="color:red;display:none;">Checking post layout...</span>
				<span class="post-layout-updating" style="color:red;display:none;">Updating post layout...</span>
				<span class="post-layout-updated" style="color:green;display:none;">Post layout saved.</span>
				<span class="post-layout-error" style="color:red;display:none;">Something is wrong</span>
			</p>

			<?php foreach ( $layouts as $layout => $layout_data ){

				/* Label class */
				$label_class = "theme-layout-label";
				if( tamatebako_layout_default() == $layout ){
					$label_class .= " layout-default";
				}
				if( tamatebako_get_post_layout( $post_id ) == $layout ){
					$label_class .= " layout-selected";
				}
				/* Label default */
				$layout_label = $layout_data['name'];

				/* If theme using layout thumbnail, label using image. */
				if( true == $layouts_args['thumbnail'] ){
					$layout_label = '<img src="' . esc_url( $layout_data['thumbnail'] ) . '" class="layout-thumbnail" title="' . esc_attr( $layout_data['name'] ) . '">' . '<span class="layout-name">' . $layout_data['name'] . '</span>';
				}
				?>

				<label class="<?php echo esc_attr( $label_class );?>">
					<input class="theme-layout-input layout-<?php echo esc_attr( $layout ); ?>" type="radio" value="<?php echo esc_attr( $layout ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $layout ); ?> />
					<?php echo $layout_label; ?><br/>
				</label>

			<?php } // end foreach ?>

		</div><!-- .customize-theme-layouts-wrap -->

		<?php
	}
}
