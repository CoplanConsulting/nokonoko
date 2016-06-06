<div id="sidebar-footer-1" class="footer-widget">

	<aside class="sidebar">

		<?php if ( is_active_sidebar( 'footer-1' ) ){ ?>

			<?php dynamic_sidebar( 'footer-1' ); ?>

		<?php } ?>

	</aside><!-- #sidebar-footer-1 > .sidebar -->

	<?php get_template_part( 'menu/social' ); ?>

</div><!-- #sidebar-footer-1 -->