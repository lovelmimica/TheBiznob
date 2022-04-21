<?php get_header(); ?>
<?php global $author; $userdata = get_userdata($author); ?>
<div class="zox-body-width">
	<div id="zox-author-page-top" class="left zoxrel">
		<div class="zox-author-top right relative">
			<div id="zox-author-top-left" class="left zoxrel">
				<?php echo get_avatar( $userdata->user_email, '200' ); ?>
			</div><!--zox-author-top-left-->
			<div id="zox-author-top-right" class="left zoxrel">
				<span class="zox-author-page-desc left zoxrel"><?php echo wp_kses_post( $userdata->description ); ?></span>
				<ul class="zox-author-page-list left zoxrel">
					<?php $zox_email = get_option('zox_author_email'); if ($zox_email == "true") { ?>
						<a href="mailto:<?php echo esc_html($userdata->user_email); ?>"><li class="fab fa-envelope"></li></a>
					<?php } ?>
					<?php $authordesc = $userdata->facebook; if ( ! empty ( $authordesc ) ) { ?>
						<a href="<?php echo esc_url( $userdata->facebook); ?>" alt="Facebook" target="_blank"><li class="fab fa-facebook-f"></li></a>
					<?php } ?>
					<?php $authordesc = $userdata->twitter; if ( ! empty ( $authordesc ) ) { ?>
						<a href="<?php echo esc_url( $userdata->twitter); ?>" alt="Twitter" target="_blank"><li class="fab fa-twitter"></li></a>
					<?php } ?>
					<?php $authordesc = $userdata->pinterest; if ( ! empty ( $authordesc ) ) { ?>
						<a href="<?php echo esc_url( $userdata->pinterest); ?>" alt="Pinterest" target="_blank"><li class="fab fa-pinterest-p"></li></a>
					<?php } ?>
					<?php $authordesc = $userdata->instagram; if ( ! empty ( $authordesc ) ) { ?>
						<a href="<?php echo esc_url( $userdata->instagram); ?>" alt="Instagram" target="_blank"><li class="fab fa-instagram"></li></a>
					<?php } ?>
					<?php $authordesc = $userdata->googleplus; if ( ! empty ( $authordesc ) ) { ?>
						<a href="<?php echo esc_url( $userdata->googleplus); ?>" alt="Google Plus" target="_blank"><li class="fab fa-google-plus fa-2"></li></a>
					<?php } ?>
					<?php $authordesc = $userdata->linkedin; if ( ! empty ( $authordesc ) ) { ?>
						<a href="<?php echo esc_url( $userdata->linkedin); ?>" alt="LinkedIn" target="_blank"><li class="fab fa-linkedin"></li></a>
					<?php } ?>
				</ul>
			</div><!--zox-author-top-right-->
		</div><!--zox-author-top-->
	</div><!--zox-author-page-top-->
</div><!--zox-body-width-->
<div id="zox-home-main-wrap" class="zoxrel zox100">

	<?php $zox_skin = get_option('zox_skin'); $zox_home_rside = get_option('zox_home_rside'); if ($zox_skin == "1" && $zox_home_rside == "1") { ?>
		<div class="zox-body-width">
			<div id="zox-home-body-wrap" class="zoxrel zox100">
				<div id="zox-home-cont-wrap" class="zoxrel">
					<div id="zox-main-blog-wrap" class="zoxrel left zox100">
						<?php get_template_part( 'parts/blog', 'wrap' ); ?>
					</div><!--zox-main-blog-wrap-->
				</div><!--zox-home-cont-wrap-->
			</div><!--zox-home-body-wrap-->
		</div><!--zox-body-width-->
	<?php } else { ?>
		<div class="zox-body-width">
			<div id="zox-home-body-wrap" class="zoxrel zox100">
				<div id="zox-home-cont-wrap" class="zoxrel">
					<div id="zox-main-blog-wrap" class="zoxrel left zox100">
						<?php get_template_part( 'parts/blog', 'wrap' ); ?>
					</div><!--zox-main-blog-wrap-->
				</div><!--zox-home-cont-wrap-->
				<div class="zox-home-right-wrap zox-sticky-side zoxrel">
					<?php get_sidebar(); ?>
				</div><!--zox-home-right-wrap-->
			</div><!--zox-home-body-wrap-->
		</div><!--zox-body-width-->
	<?php } ?>
</div><!--zox-home-main-wrap-->
<?php get_footer(); ?>