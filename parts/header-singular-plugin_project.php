<?php
/**
 * Single Post Header
 * @since 1.0.0
 */
use fx_wpshop\theme_project\Functions as PluginProject;
?>
<header class="archive-header content-header">

	<div class="wrap">

		<?php tamatebako_entry_title(); ?>

		<p>WordPress Plugin</p>

		<?php PluginProject::action_buttons(); ?>

		<?php PluginProject::lite_download_link(); ?>

		<?php PluginProject::wporg_stats(); ?>


	</div><!-- .archive-header > .wrap -->

</header><!-- .archive-header -->
