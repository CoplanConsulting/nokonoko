<?php
/**
 * Tamatebako Layout Customizer Control
 *
 * @since  3.0.0
 * @access public
 */
class Tamatebako_Customize_Layout extends WP_Customize_Control {

	/* Vars */
	public $type = 'tamatebako-layouts';
	public $section = 'layout';
	public $settings = 'theme_layout';

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

		/* Wrapper class */
		$wrap_class = 'customize-theme-layouts-wrap';
		if( true == $layouts_args['thumbnail'] ){
			$wrap_class .= ' theme-layouts-thumbnail-wrap';
		}
		?>

		<div class="<?php echo esc_attr( $wrap_class ); ?>">

			<span class="customize-control-title"><?php echo esc_html( tamatebako_string( 'global_layout' ) ); ?></span>

			<?php foreach ( $layouts as $layout => $layout_data ){

				/* Label class */
				$label_class = "theme-layout-label";
				if( tamatebako_layout_default() == $layout ){
					$label_class .= " layout-default";
				}
				if( tamatebako_current_layout() == $layout ){
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
					<input class="theme-layout-input" type="radio" value="<?php echo esc_attr( $layout ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $layout ); ?> />
					<?php echo $layout_label; ?><br/>
				</label>

			<?php } // end foreach ?>

			<?php if( true === $layouts_args['post_meta'] ){ ?>
			<span style="margin-top:20px;" class="customize-control-title">Post Layouts</span>

			<div class="customize-post-layouts">

				<p><input type="text" name="_customize-radio-theme_layout" value="haha"></p>
				<p><a href="#" data-temp-post-id="<?php echo $post_id; ?>" class="check-post-layout">Check current post layouts</a> <span class="checking-post-layout-data" style="color:red;display:none;">checking...</span></p>

				<?php if ( isset( $_GET['url'] ) ){
					$post_id = url_to_postid( esc_url_raw( $_GET['url'] ) );
					?>


				<?php } // end if $_GET ?>

			</div><!-- .customize-post-layouts -->
			<?php } //end post layout info ?>

		</div><!-- .customize-theme-layouts-wrap -->

		<?php
	}
}
