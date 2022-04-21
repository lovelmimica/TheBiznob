<div id="zox-fly-wrap">
	<div id="zox-fly-menu-top" class="left relative">
		<div id="zox-fly-logo" class="left relative">
			<?php if(get_option('zox_logo_nav')) { ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="https://www.biznob.com/wp-content/uploads/2021/11/biznob-logo-e1636331077805.png" data-rjs="2" /></a>
			<?php } else { ?>
				<?php $zox_feat_layout = get_option('zox_feat_layout'); $zox_skin = get_option('zox_skin'); if (($zox_skin == "2") || ( $zox_skin == "1" && $zox_feat_layout == "2")) { ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img class="zox-logo-stand" src="<?php echo get_template_directory_uri(); ?>/images/logos/logo-nav-ent1.png" alt="<?php bloginfo( 'name' ); ?>" data-rjs="2" /><img class="zox-logo-dark" src="<?php echo get_template_directory_uri(); ?>/images/logos/logo-nav-ent1d.png" alt="<?php bloginfo( 'name' ); ?>" data-rjs="2" /></a>
				<?php } else if (($zox_skin == "3" || $zox_skin == "6") || ( $zox_skin == "1" && $zox_feat_layout == "3") || ( $zox_skin == "1" && $zox_feat_layout == "6")) { ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/logos/logo-nav-ent2.png" alt="<?php bloginfo( 'name' ); ?>" data-rjs="2" /></a>
				<?php } else if (($zox_skin == "4") || ( $zox_skin == "1" && $zox_feat_layout == "3")) { ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img class="zox-logo-stand" src="<?php echo get_template_directory_uri(); ?>/images/logos/logo-nav-ent3.png" alt="<?php bloginfo( 'name' ); ?>" data-rjs="2" /><img class="zox-logo-dark" src="<?php echo get_template_directory_uri(); ?>/images/logos/logo-nav-ent3d.png" alt="<?php bloginfo( 'name' ); ?>" data-rjs="2" /></a>
				<?php } else if (($zox_skin == "5") || ( $zox_skin == "1" && $zox_feat_layout == "5")) { ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/logos/logo-nav-net1.png" alt="<?php bloginfo( 'name' ); ?>" data-rjs="2" /></a>
				<?php } else if (($zox_skin == "7") || ( $zox_skin == "1" && $zox_feat_layout == "7")) { ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/logos/logo-nav-net3.png" alt="<?php bloginfo( 'name' ); ?>" data-rjs="2" /></a>
				<?php } else if (($zox_skin == "8" || $zox_skin == "10") || ( $zox_skin == "1" && $zox_feat_layout == "8") || ( $zox_skin == "1" && $zox_feat_layout == "10")) { ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/logos/logo-nav-sport1.png" alt="<?php bloginfo( 'name' ); ?>" data-rjs="2" /></a>
				<?php } else if (($zox_skin == "9") || ( $zox_skin == "1" && $zox_feat_layout == "9")) { ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img class="zox-logo-stand" src="<?php echo get_template_directory_uri(); ?>/images/logos/logo-nav-sport2.png" alt="<?php bloginfo( 'name' ); ?>" data-rjs="2" /><img class="zox-logo-dark" src="<?php echo get_template_directory_uri(); ?>/images/logos/logo-nav-sport2d.png" alt="<?php bloginfo( 'name' ); ?>" data-rjs="2" /></a>
				<?php } else if (($zox_skin == "11") || ( $zox_skin == "1" && $zox_feat_layout == "11")) { ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img class="zox-logo-stand" src="<?php echo get_template_directory_uri(); ?>/images/logos/logo-nav-fash1.png" alt="<?php bloginfo( 'name' ); ?>" data-rjs="2" /><img class="zox-logo-dark" src="<?php echo get_template_directory_uri(); ?>/images/logos/logo-nav-fash1d.png" alt="<?php bloginfo( 'name' ); ?>" data-rjs="2" /></a>
				<?php } else if (($zox_skin == "12") || ( $zox_skin == "1" && $zox_feat_layout == "11")) { ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img class="zox-logo-stand" src="<?php echo get_template_directory_uri(); ?>/images/logos/logo-nav-fash2.png" alt="<?php bloginfo( 'name' ); ?>" data-rjs="2" /><img class="zox-logo-dark" src="<?php echo get_template_directory_uri(); ?>/images/logos/logo-nav-fash2d.png" alt="<?php bloginfo( 'name' ); ?>" data-rjs="2" /></a>
				<?php } else if ($zox_skin == "13" || ( $zox_skin == "1" && $zox_feat_layout == "13")) { ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img class="zox-logo-stand" src="<?php echo get_template_directory_uri(); ?>/images/logos/logo-nav-fash3.png" alt="<?php bloginfo( 'name' ); ?>" data-rjs="2" /><img class="zox-logo-dark" src="<?php echo get_template_directory_uri(); ?>/images/logos/logo-nav-fash3d.png" alt="<?php bloginfo( 'name' ); ?>" data-rjs="2" /></a>
				<?php } else if ($zox_skin == "14" || ( $zox_skin == "1" && $zox_feat_layout == "13")) { ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/logos/logo-trans-tech1.png" alt="<?php bloginfo( 'name' ); ?>" data-rjs="2" /></a>
				<?php } else if ($zox_skin == "15" || ( $zox_skin == "1" && $zox_feat_layout == "15")) { ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img class="zox-logo-stand" src="<?php echo get_template_directory_uri(); ?>/images/logos/logo-nav-tech2.png" alt="<?php bloginfo( 'name' ); ?>" data-rjs="2" /><img class="zox-logo-dark" src="<?php echo get_template_directory_uri(); ?>/images/logos/logo-nav-tech2d.png" alt="<?php bloginfo( 'name' ); ?>" data-rjs="2" /></a>
				<?php } else if ($zox_skin == "16" || ( $zox_skin == "1" && $zox_feat_layout == "16")) { ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/logos/logo-nav-tech3.png" alt="<?php bloginfo( 'name' ); ?>" data-rjs="2" /></a>
				<?php } ?>
			<?php } ?>
		</div><!--zox-fly-logo-->
		<div class="zox-fly-but-wrap zox-fly-but-menu zox-fly-but-click">
			<span></span>
			<span></span>
			<span></span>
			<span></span>
		</div><!--zox-fly-but-wrap-->
	</div><!--zox-fly-menu-top-->
	<div id="zox-fly-menu-wrap">
		<nav class="zox-fly-nav-menu left relative">
			<?php wp_nav_menu(array('theme_location' => 'mobile-menu')); ?>
		</nav>
	</div><!--zox-fly-menu-wrap-->

	<div id="zox-fly-soc-wrap">
		<div class='fly-menu-bottom-navigation'>
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
		</div>
		<span class="zox-fly-soc-head"><?php esc_html_e( 'Connect with us', 'zoxpress' ); ?></span>
		<ul class="zox-fly-soc-list left relative">
			<?php if(get_option('zox_facebook')) { ?>
				<li><a href="<?php echo esc_url(get_option('zox_facebook')); ?>" target="_blank" class="fab fa-facebook-f"></a></li>
			<?php } ?>
			<?php if(get_option('zox_twitter')) { ?>
				<li><a href="<?php echo esc_url(get_option('zox_twitter')); ?>" target="_blank" class="fab fa-twitter"></a></li>
			<?php } ?>
			<?php if(get_option('zox_instagram')) { ?>
				<li><a href="<?php echo esc_url(get_option('zox_instagram')); ?>" target="_blank" class="fab fa-instagram"></a></li>
			<?php } ?>
			<?php if(get_option('zox_flip')) { ?>
				<li><a href="<?php echo esc_url(get_option('zox_flip')); ?>" target="_blank" class="fab fa-flipboard"></a></li>
			<?php } ?>
			<?php if(get_option('zox_youtube')) { ?>
				<li><a href="<?php echo esc_url(get_option('zox_youtube')); ?>" target="_blank" class="fab fa-youtube"></a></li>
			<?php } ?>
			<?php if(get_option('zox_linkedin')) { ?>
				<li><a href="<?php echo esc_url(get_option('zox_linkedin')); ?>" target="_blank" class="fab fa-linkedin-in"></a></li>
			<?php } ?>
			<?php if(get_option('zox_pinterest')) { ?>
				<li><a href="<?php echo esc_url(get_option('zox_pinterest')); ?>" target="_blank" class="fab fa-pinterest-p"></a></li>
			<?php } ?>
			<?php if(get_option('zox_tumblr')) { ?>
				<li><a href="<?php echo esc_url(get_option('zox_tumblr')); ?>" target="_blank" class="fab fa-tumblr fa-2"></a></li>
			<?php } ?>
		</ul>
	</div><!--zox-fly-soc-wrap-->
</div><!--zox-fly-wrap-->