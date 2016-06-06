<?php
/* Archive & Search */
if ( get_the_archive_title() && !is_front_page() && !is_singular() && !is_404() ){
	?>
	<header class="archive-header content-header">

		<div class="wrap">

			<?php the_archive_title( '<h1 class="archive-title content-title">', '</h1>'); ?>
			<?php the_archive_description( '<div class="archive-description content-description">', '</div>' ); ?>

		</div><!-- .archive-header > .wrap -->

	</header><!-- .archive-header -->
	<?php
}
elseif( is_singular( 'post' ) ){
	?>
	<header class="archive-header content-header">

		<div class="wrap">

			<?php tamatebako_entry_title(); ?>

			<div class="entry-byline">

				<span class="entry-author vcard">
					<?php
					//the_author_posts_link();
					$author_id = get_post_field ('post_author', get_queried_object_id() );
					$author_posts_url = get_author_posts_url( $author_id );
					$author_name = get_the_author_meta( 'display_name', $author_id );
					?>
					<a class="url fn n" rel="author" href="<?php echo esc_url( $author_posts_url ); ?>"><span class="author-name"><?php echo $author_name; ?></span></a>
				</span>

				<?php tamatebako_entry_date(); ?>

				<?php tamatebako_comments_link(); ?>

			</div><!-- .entry-byline -->

		</div><!-- .archive-header > .wrap -->

	</header><!-- .archive-header -->
	<?php
}