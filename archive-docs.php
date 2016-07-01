<!DOCTYPE html>
<html <?php language_attributes( 'html' ); ?> class="no-js">

<head>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<div id="container">

		<?php tamatebako_skip_to_content(); ?>

		<?php get_header(); ?>

		<div class="wrap">

			<div id="main">

				<?php get_template_part( 'parts/content-header' );?>

				<div class="wrap">

					<div class="content-wrap">

						<main id="content" class="content" role="main">

							<?php if ( have_posts() ){ /* Posts Found */ ?>

								<div class="wrap">

									<?php //while ( have_posts() ) {  /* Start Loop */ ?>

										<?php //the_post(); /* Load Post Data */ ?>

										<?php /* Start Content */ ?>
										<?php //tamatebako_get_template( 'content' ); // Loads the content/*.php template. ?>
										<?php /* End Content */ ?>

										<article id="docs-archive-content" class="hentry entry">

											<div class="wrap">

												<div class="entry-content">

													<ul id="docs-list">
														<?php
														$args = array(
															'post_type'     => 'docs',
															'depth'         => 9,
															'exclude'       => '',
															'title_li'      => '',
															'echo'          => 1,
															'link_before'   => '<span>',
															'link_after'    => '</span>',
															'sort_column'   => 'menu_order, post_title',
														);
														wp_list_pages( $args ); ?>
													</ul>

												</div><!-- .entry-summary -->

											</div><!-- .entry > .wrap -->

										</article>


									<?php //} /* End Loop */ ?>

								</div><!-- #content > .wrap -->

								<?php tamatebako_archive_footer(); ?>

							<?php } else { /* No Posts Found */ ?>

								<div class="wrap">
									<?php tamatebako_content_error(); ?>
								</div><!-- #content > .wrap -->

							<?php } /* End Posts Found Check */ ?>

						</main><!-- #content -->

						<?php tamatebako_get_sidebar( 'primary' ); ?>

					</div><!-- .content-wrap -->

				</div><!-- #main > .wrap -->

			</div><!-- #main -->

		</div><!-- #container > .wrap -->

		<?php get_footer(); ?>

	</div><!-- #container -->

	<?php wp_footer();?>

</body>
</html>