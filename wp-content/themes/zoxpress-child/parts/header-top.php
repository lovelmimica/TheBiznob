<?php echo do_shortcode( "[md_crypto_market_data_bar/]" ); ?>
<div id="zox-top-head-wrap" class="left relative">
	<?php if ( has_header_image() ) { ?>
		<img class="zox-head-bg" src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="<?php echo( get_bloginfo( 'title' ) ); ?>" />
	<?php } ?>
	<div class="zox-head-width">
		<div id="zox-top-head" class="relative">
			<div id="zox-top-head-left">
				<?php $zox_skin = get_option('zox_skin'); if ($zox_skin == "4" || $zox_skin == "11" || $zox_skin == "12") { ?>
					<?php get_template_part( 'parts/soc', 'top' ); ?>
				<?php } else if ($zox_skin == "5" || $zox_skin == "6" || $zox_skin == "7" || $zox_skin == "16") { ?>
					<div class="zox-top-nav-menu zox100">
						<?php wp_nav_menu(array('theme_location' => 'sec-menu', 'fallback_cb' => 'false')); ?>
					</div><!--zox-top-nav-menu-->
				<?php } else { ?>
					<?php $zox_top_navl = get_option('zox_top_navl'); if ($zox_top_navl == "3") { ?>
						<?php get_template_part( 'parts/soc', 'top' ); ?>
					<?php } else if ($zox_top_navl == "4") { ?>
						<?php if ( class_exists( 'WooCommerce' ) ) { ?>
							<div class="zox-woo-cart-wrap">
								<a class="zox-woo-cart" href="<?php echo wc_get_cart_url(); ?>" title="<?php esc_html_e( 'View your shopping cart', 'zoxpress' ); ?>"><span class="zox-woo-cart-num"><?php echo WC()->cart->get_cart_contents_count(); ?></span></a><span class="zox-woo-cart-icon fas fa-shopping-cart"></span>
							</div><!--zox-woo-cart-wrap-->
						<?php } ?>
					<?php } else if ($zox_top_navl == "5") { ?>
						<?php $zox_top_nav_html = get_option('zox_top_nav_html'); if ($zox_top_nav_html) { ?>
							<?php echo html_entity_decode($zox_top_nav_html); ?>
						<?php } ?>
					<?php } else if ($zox_top_navl == "6") { ?>
						<div class="zox-top-nav-menu zox100">
							<?php wp_nav_menu(array('theme_location' => 'sec-menu', 'fallback_cb' => 'false')); ?>
						</div><!--zox-top-nav-menu-->
					<?php } ?>
				<?php } ?>
			</div><!--zox-top-head-left-->
			<div id="zox-top-head-mid">
				<?php $zox_top_nav_logo = get_option('zox_top_nav_logo'); if ($zox_top_nav_logo == "true") { ?>
					<?php if(get_option('zox_logo')) { ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img class="zox-logo-stand" src="<?php echo esc_url(get_option('zox_logo')); ?>" alt="<?php bloginfo( 'name' ); ?>" data-rjs="2" /><img class="zox-logo-dark" src="<?php echo esc_url(get_option('zox_logod')); ?>" alt="<?php bloginfo( 'name' ); ?>" data-rjs="2" /></a>
						<?php 
							if( !is_front_page() ){
								if( is_category() ) $title = get_category( get_query_var( 'cat' ) )->name;
								else if( is_single() ) $title = get_the_category()[0]->name;
								else if( is_404() ) $title = "Page not Found";
								else if( is_search() ) $title = "Search Results";
								else if( is_author() ) {
								    global $author;
								    $userdata = get_userdata($author);
								    $title = "Posts by " . $userdata->display_name;
								}
								else $title = get_the_title();
							?>
								<div class='border-middle'></div>
								<h1><?php echo $title ?></h1>
							<?php }
						?>

					<?php } else { ?>
						<?php $zox_feat_layout = get_option('zox_feat_layout'); $zox_skin = get_option('zox_skin'); if ($zox_skin == "11" || ($zox_skin == "1" && $zox_feat_layout == "10")) { ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img class="zox-logo-stand" src="<?php echo get_template_directory_uri(); ?>/images/logos/logo-fash1.png" alt="<?php bloginfo( 'name' ); ?>" data-rjs="2" /><img class="zox-logo-dark" src="<?php echo get_template_directory_uri(); ?>/images/logos/logo-fash1d.png" alt="<?php bloginfo( 'name' ); ?>" data-rjs="2" /></a>
						<?php } else if ($zox_skin == "12" || ($zox_skin == "1" && $zox_feat_layout == "11")) { ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img class="zox-logo-stand" src="<?php echo get_template_directory_uri(); ?>/images/logos/logo-fash2.png" alt="<?php bloginfo( 'name' ); ?>" data-rjs="2" /><img class="zox-logo-dark" src="<?php echo get_template_directory_uri(); ?>/images/logos/logo-fash2d.png" alt="<?php bloginfo( 'name' ); ?>" data-rjs="2" /></a>
						<?php } else { ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/logos/logo.png" alt="<?php bloginfo( 'name' ); ?>" data-rjs="2" /></a>
						<?php } ?>
					<?php } ?>
				<?php } ?>
			</div><!--zox-top-head-mid-->
			<div id="zox-top-head-right">
				<?php $zox_dark_mode = get_option('zox_dark_mode'); if ($zox_dark_mode !== "2" && $zox_dark_mode !== "3") { ?>
					<span class="zox-night zox-night-mode"><i class='fas fa-moon'></i></span>
				<?php } ?>
				<span class="zox-nav-search-but zox-search-click"><i class='fas fa-search'></i></span>
				<a class='my-account-link' href="<?php echo get_permalink( get_page_by_path( 'my-account' ) ); ?>">

					<?php 
						echo is_user_logged_in() ? "<i class='fas fa-user'></i> Profile" : "<i class='fas fa-sign-in-alt'></i> Sign In";
					?>
				</a>
				<?php
					 
					if( is_user_logged_in() ) : 
						$current_url = "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
					?>
						<a class='my-account-link logout' href="<?php echo wp_logout_url( $current_url ); ?>"><i class="fas fa-sign-out-alt"></i> Logout</a>
				<?php
					endif;
				?>
			</div><!--zox-top-head-right-->
		</div><!--zox-top-head-->
	</div><!--zox-head-width-->
</div><!--zox-top-head-wrap-->