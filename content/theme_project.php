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

		<a href="<?php the_permalink(); ?>" class="entry-header" rel="bookmark">
			<span class="wrap">
				<?php the_title( '<span class="entry-title">', '</span>' );; ?>
			</span>
		</a><!-- .entry-header -->

	</div><!-- .entry > .wrap -->

</article><!-- .entry -->