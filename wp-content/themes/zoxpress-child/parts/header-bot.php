<?php $zox_skin = get_option('zox_skin'); $zox_trans_menu = get_option('zox_trans_menu'); if (($zox_skin == "14"  && is_front_page()) || ($zox_trans_menu == "true" && is_front_page())) { ?>
	<div id="zox-bot-head-wrap" class="left zoxrel zox-trans-bot">
<?php } else { ?>
	<div id="zox-bot-head-wrap" class="left zoxrel">
<?php } ?>
	<div class="zox-head-width">
		<div id="zox-bot-head">
		    <div class='sticky-logo-wrapper'><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img class='dark-logo' src="https://www.biznob.com/wp-content/uploads/2021/11/biznob-logo-e1636331077805.png" alt="<?php bloginfo( 'name' ); ?>" data-rjs="2" /></a></div>
			<div id="zox-bot-head-left">
				<div class="zox-fly-but-wrap zoxrel zox-fly-but-click">
					<span></span>
					<span></span>
					<span></span>
					<span></span>
				</div><!--zox-fly-but-wrap-->
			</div><!--zox-bot-head-left-->
			<div id="zox-bot-head-mid" class="relative">
				<div class="zox-bot-head-logo">
					<div class="zox-bot-head-logo-main">
						<?php if(get_option('zox_logo_nav')) { ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img class="zox-logo-dark" src="<?php echo esc_url(get_option('zox_logo_navd')); ?>" alt="<?php bloginfo( 'name' ); ?>" data-rjs="2" /></a>
						<?php } ?>
					</div><!--zox-bot-head-logo-main-->
					<?php $zox_skin = get_option('zox_skin'); $zox_trans_menu = get_option('zox_trans_menu'); if (($zox_skin == "14"  && is_front_page()) || ($zox_trans_menu == "true" && is_front_page())) { ?>
						<div class="zox-bot-logo-trans">
							<?php if(get_option('zox_logo_trans')) { ?>
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url(get_option('zox_logo_trans')); ?>" alt="<?php bloginfo( 'name' ); ?>" data-rjs="2" /></a>
							<?php } else { ?>
								<?php $zox_skin = get_option('zox_skin'); $zox_feat_layout = get_option('zox_feat_layout'); if ($zox_skin == "14" || ($zox_skin == "1" && $zox_feat_layout == "14")) { ?>
									<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/logos/logo-trans-tech1.png" alt="<?php bloginfo( 'name' ); ?>" data-rjs="2" /></a>
								<?php } ?>
							<?php } ?>
						</div><!--zox-bot-logo-trans-->
					<?php } ?>
					<?php if ( is_home() || is_front_page() ) { ?>
						<h1 class="zox-logo-title"><?php bloginfo( 'name' ); ?></h1>
					<?php } else { ?>
						<h2 class="zox-logo-title"><?php bloginfo( 'name' ); ?></h2>
					<?php } ?>
				</div><!--zox-bot-head-logo-->
				<div class="zox-bot-head-menu">
					<div class="zox-nav-menu">
						<?php 
							wp_nav_menu(array('theme_location' => 'main-menu', 'fallback_cb' => 'false')); 
						?>
					</div><!--zox-nav-menu-->
				</div><!--zox-bot-head-menu-->
			</div><!--zox-bot-head-mid-->
			<div class='bot-head-logo-wrapper'>
			    <a class='bot-head-logo' href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<!--<img class='standard-logo' src="http://www.biznob.com/wp-content/uploads/2021/11/biznob-logo-black-e1636331037767.png" alt="<?php bloginfo( 'name' ); ?>" data-rjs="2" />-->
				    <img class='dark-logo' src="https://www.biznob.com/wp-content/uploads/2021/11/biznob-logo-e1636331077805.png" alt="<?php bloginfo( 'name' ); ?>" data-rjs="2" />
				</a>
			</div>
		</div><!--zox-bot-head-->
	</div><!--zox-head-width-->
</div><!--zox-bot-head-wrap-->