<?php
use fx_wpshop\plugin_project\Functions as PluginProject;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="wrap">

		<div class="entry-thumbnail">
			<a class="theme-thumbnail-link" href="<?php the_permalink(); ?>">
				<?php PluginProject::featured_image(); ?>
			</a>
		</div>

		<div class="entry-content">
			<?php //the_content(); ?>
			<?php //wp_link_pages(); ?>
			<?php PluginProject::tabbed_content(); ?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php edit_post_link(); ?>
			<?php tamatebako_entry_taxonomies(); ?>
		</footer><!-- .entry-footer -->

	</div><!-- .entry > .wrap -->

</article><!-- .entry -->

<?php comments_template( '', true ); // Load comments. ?>