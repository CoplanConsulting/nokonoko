<header role="banner" id="header">

	<div id="branding">

		<?php if ( current_theme_supports( 'tamatebako-logo' ) && get_theme_mod( 'logo' ) ) { ?>

			<?php if( is_front_page() && is_home() ){ ?>

				<h1 id="site-logo">
					<a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>">
						<img class="logo-img" src="<?php echo esc_url( tamatebako_logo_url() ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"/>
						<span class="screen-reader-text"><?php bloginfo( 'name' ); ?></span>
					</a>
				</h1>

			<?php } else { ?>

				<p id="site-logo">
					<a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>">
						<img class="logo-img" src="<?php echo esc_url( tamatebako_logo_url() ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"/>
						<span class="screen-reader-text"><?php bloginfo( 'name' ); ?></span>
					</a>
				</p>

			<?php } /* end logo */ ?>

		<?php } else { /* no logo */ ?>

			<?php if( is_front_page() && is_home() ){ ?>

				<h1 id="site-title"><a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>

			<?php } else { ?>

				<p id="site-title"><a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></p>

			<?php } ?>

			<p id="site-description"><?php bloginfo( 'description' ); ?></p>

		<?php } /* end logo conditional */ ?>

	</div><!-- #branding -->

</header><!-- #header-->