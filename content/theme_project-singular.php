<?php
use fx_wpshop\theme_project\Functions as ThemeProject;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="wrap">

		<div class="entry-thumbnail">
			<a class="theme-thumbnail-link" href="<?php the_permalink(); ?>">
				<?php ThemeProject::featured_image(); ?>
			</a>
		</div>

		<?php ThemeProject::description(); ?>

		<?php ThemeProject::features(); ?>

		<div class="entry-content">
			<?php the_content(); ?>
			<?php wp_link_pages(); ?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php edit_post_link(); ?>
			<?php tamatebako_entry_taxonomies(); ?>
		</footer><!-- .entry-footer -->

	</div><!-- .entry > .wrap -->

</article><!-- .entry -->

<?php comments_template( '', true ); // Load comments. ?>