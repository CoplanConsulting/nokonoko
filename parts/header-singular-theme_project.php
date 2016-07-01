<?php
/**
 * Single Post Header
 * @since 1.0.0
 */
use fx_wpshop\theme_project\Functions as ThemeProject;
?>
<header class="archive-header content-header">

	<div class="wrap">

		<?php tamatebako_entry_title(); ?>
		<p>WordPress Theme</p>

		<?php ThemeProject::action_buttons(); ?>

		<?php ThemeProject::lite_download_link(); ?>

		<?php ThemeProject::wporg_stats(); ?>

	</div><!-- .archive-header > .wrap -->

</header><!-- .archive-header -->
