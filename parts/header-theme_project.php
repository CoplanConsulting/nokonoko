<?php
/**
 * Archive Header
 * @since 1.0.0
 */
use fx_wpshop\theme_project\Functions as ThemeProject;
?>
<header class="archive-header content-header">

	<div class="wrap">

		<?php the_archive_title( '<h1 class="archive-title content-title">', '</h1>'); ?>
		<?php the_archive_description( '<div class="archive-description content-description"><p>', '</p></div>' ); ?>

		<?php if ( class_exists( 'fx_wpshop\theme_project\Functions' ) ){ ?>
			<p class="project-stats"><span class="downloaded-total"><strong><?php echo ThemeProject::total_downloads(); ?>+</strong> Total Downloads</span> - <span class="active-installs-total"><strong><?php echo ThemeProject::total_active_installs(); ?>+</strong> Sites Using Our Themes.</span></p>
		<?php } ?>

	</div><!-- .archive-header > .wrap -->

</header><!-- .archive-header -->
