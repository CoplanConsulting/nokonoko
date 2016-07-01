<?php
if ( strpos( get_theme_mod( 'theme_layout' ),'sidebar1' ) === false) {
	return false;
}
?>

<div id="sidebar-primary">

	<aside class="sidebar">

		<?php if( is_singular( 'theme_project' ) && is_active_sidebar( 'theme_project' ) ){ ?>

			<?php dynamic_sidebar( 'theme_project' ); ?>

		<?php } elseif( is_singular( 'plugin_project' ) && is_active_sidebar( 'plugin_project' ) ){?>

			<?php dynamic_sidebar( 'plugin_project' ); ?>

		<?php } elseif ( is_active_sidebar( 'primary' ) ) { ?>

			<?php dynamic_sidebar( 'primary' ); ?>

		<?php } ?>


	</aside><!-- #sidebar-primary > .sidebar -->

</div><!-- #sidebar-primary -->