<?php 

    $layout = get_field( "single_post_layout", $post->ID );

    if( !$layout ) $layout = "single-post-layout-1";

?>

<article id="post-<?php echo get_the_ID(); ?>" <?php post_class( $layout ); ?> itemscope itemtype="http://schema.org/NewsArticle">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<?php $zox_post_layout = get_option('zox_post_layout'); $zox_post_temp = get_post_meta($post->ID, "zox_post_template", true); if( (empty($zox_post_temp) && $zox_post_layout == '7') || ( $zox_post_temp == "def" && $zox_post_layout == '7' ) || ( $zox_post_temp == "global" && $zox_post_layout == '7' ) || $zox_post_temp == "temp7" ) { ?>

			<?php get_template_part( 'parts/post/post', 'vid' ); ?>

		<?php } ?>

		<div class="zox-article-wrap zoxrel left zox100">

			<meta itemscope itemprop="mainEntityOfPage"  itemType="https://schema.org/WebPage" itemid="<?php the_permalink(); ?>"/>

			<?php $zox_post_layout = get_option('zox_post_layout'); $zox_post_temp = get_post_meta($post->ID, "zox_post_template", true); if( ( empty($zox_post_temp) && empty($zox_post_layout) ) || (empty($zox_post_temp) && $zox_post_layout == '1') || ( $zox_post_temp == "def" && $zox_post_layout == '1' ) || ( $zox_post_temp == "global" && $zox_post_layout == '1' ) || ( empty($zox_post_temp) && $zox_post_layout == '2' ) || ( $zox_post_temp == "def" && $zox_post_layout == '2' ) || ( $zox_post_temp == "global" && $zox_post_layout == '2' ) || ( empty($zox_post_temp) && $zox_post_layout == '3' ) || ( $zox_post_temp == "def" && $zox_post_layout == '3' ) || ( $zox_post_temp == "global" && $zox_post_layout == '3' ) || ( empty($zox_post_temp) && $zox_post_layout == '4' ) || ( $zox_post_temp == "def" && $zox_post_layout == '4' ) || ( $zox_post_temp == "global" && $zox_post_layout == '4' ) || $zox_post_temp == "temp1" || $zox_post_temp == "temp2" || $zox_post_temp == "temp3" || $zox_post_temp == "temp4" ) { ?>

				<div class="zox-post-top-wrap zoxrel left zox100">

					<?php $zox_post_layout = get_option('zox_post_layout'); $zox_post_temp = get_post_meta($post->ID, "zox_post_template", true); if( ( empty($zox_post_temp) && empty($zox_post_layout) ) || (empty($zox_post_temp) && $zox_post_layout == '1') || ( $zox_post_temp == "def" && $zox_post_layout == '1' ) || ( $zox_post_temp == "global" && $zox_post_layout == '1' ) || ( empty($zox_post_temp) && $zox_post_layout == '2' ) || ( $zox_post_temp == "def" && $zox_post_layout == '2' ) || ( $zox_post_temp == "global" && $zox_post_layout == '2' ) || $zox_post_temp == "temp1" || $zox_post_temp == "temp2" ) { ?>

					<?php if( $layout != 'single-post-layout-3' ): ?>

						<div class="zox-post-title-wrap zox-tit2">

							<div class="zox-post-width">

								<?php get_template_part( 'parts/post/post', 'head' ); ?>

							</div><!--zox-post-width-->

						</div><!--zox-post-title-wrap-->

					<?php endif; ?>

					<?php } ?>

					<?php $zox_post_layout = get_option('zox_post_layout'); $zox_post_temp = get_post_meta($post->ID, "zox_post_template", true); if( (empty($zox_post_temp) && $zox_post_layout == '2') || ( $zox_post_temp == "def" && $zox_post_layout == '2' ) || ( $zox_post_temp == "global" && $zox_post_layout == '2' ) || $zox_post_temp == "temp2" ) { ?>

						<div class="zox-post-img-wrap body-img-wrap">

							<div class="zox-post-width">

								<?php get_template_part( 'parts/post/post', 'img' ); ?>

							</div><!--zox-post-width-->

						</div><!--zox-post-img-wrap-->

					<?php } ?>

					<?php $zox_post_layout = get_option('zox_post_layout'); $zox_post_temp = get_post_meta($post->ID, "zox_post_template", true); if( ( empty($zox_post_temp) && $zox_post_layout == '4' ) || ( $zox_post_temp == "def" && $zox_post_layout == '4' ) || ( $zox_post_temp == "global" && $zox_post_layout == '4' ) || $zox_post_temp == "temp4" ) { ?>

						<div class="zox-post-img-wrap zox-post-img-full body-img-wrap">

							<div class="zox-post-width">

								<?php get_template_part( 'parts/post/post', 'img' ); ?>

							</div><!--zox-post-width-->

						</div><!--zox-post-img-wrap-->

					<?php } ?>

					<?php $zox_post_layout = get_option('zox_post_layout'); $zox_post_temp = get_post_meta($post->ID, "zox_post_template", true); if( ( empty($zox_post_temp) && $zox_post_layout == '3' ) || ( $zox_post_temp == "def" && $zox_post_layout == '3' ) || ( $zox_post_temp == "global" && $zox_post_layout == '3' ) ||$zox_post_temp == "temp3" ) { ?>

						<div class="zox-post-img-wrap zox-post-img-full body-img-wrap">

							<div class="zox-post-width">

								<?php get_template_part( 'parts/post/post', 'img' ); ?>

							</div><!--zox-post-width-->

						</div><!--zox-post-img-wrap-->

					<?php if( $layout != 'single-post-layout-3' ): ?>

						<div class="zox-post-title-wrap zox-tit2">

							<div class="zox-post-width">

								<?php get_template_part( 'parts/post/post', 'head' ); ?>

							</div><!--zox-post-width-->

						</div><!--zox-post-title-wrap-->

					<?php endif; ?>

					<?php } ?>

				</div><!--zox-post-top-wrap-->

			<?php } ?>

			<div class="zox-post-main-grid">

				<div class="zox-post-width">

					<div class="zox-post-main-wrap zoxrel left zox100">

						<div class="zox-post-main">

							<?php $zox_post_layout = get_option('zox_post_layout'); $zox_post_temp = get_post_meta($post->ID, "zox_post_template", true); if( ( empty($zox_post_temp) && empty($zox_post_layout) ) || (empty($zox_post_temp) && $zox_post_layout == '1') || ( $zox_post_temp == "def" && $zox_post_layout == '1' ) || ( $zox_post_temp == "global" && $zox_post_layout == '1' ) || ( empty($zox_post_temp) && $zox_post_layout == '4' ) || ( $zox_post_temp == "def" && $zox_post_layout == '4' ) || ( $zox_post_temp == "global" && $zox_post_layout == '4' ) || ( empty($zox_post_temp) && $zox_post_layout == '5' ) || ( $zox_post_temp == "def" && $zox_post_layout == '5' ) || ( $zox_post_temp == "global" && $zox_post_layout == '5' ) || ( empty($zox_post_temp) && $zox_post_layout == '6' ) || ( $zox_post_temp == "def" && $zox_post_layout == '6' ) || ( $zox_post_temp == "global" && $zox_post_layout == '6' ) || $zox_post_temp == "temp1" || $zox_post_temp == "temp4" || $zox_post_temp == "temp5" || $zox_post_temp == "temp6" ) { ?>

								<div class="zox-post-bot-wrap body-image-container">

									<?php $zox_post_layout = get_option('zox_post_layout'); $zox_post_temp = get_post_meta($post->ID, "zox_post_template", true); if( (empty($zox_post_temp) && $zox_post_layout == '4') || ( $zox_post_temp == "def" && $zox_post_layout == '4' ) || ( $zox_post_temp == "global" && $zox_post_layout == '4' ) || $zox_post_temp == "temp4" ) { ?>

									<?php if( $layout != 'single-post-layout-3' ): ?>	

										<div class="zox-post-title-wrap zox-tit2 zox-post-head-min">

											<div class="zox-post-width">

												<?php get_template_part( 'parts/post/post', 'head' ); ?>

											</div><!--zox-post-width-->

										</div><!--zox-post-title-wrap-->

									<?php endif; ?>

									<?php } ?>

									<?php $zox_post_layout = get_option('zox_post_layout'); $zox_post_temp = get_post_meta($post->ID, "zox_post_template", true); if( ( empty($zox_post_temp) && $zox_post_layout == '5' ) || ( $zox_post_temp == "def" && $zox_post_layout == '5' ) || ( $zox_post_temp == "global" && $zox_post_layout == '5' ) || $zox_post_temp == "temp5" ) { ?>

									<?php if( $layout != 'single-post-layout-3' ): ?>	

										<div class="zox-post-title-wrap zox-tit2">

											<?php get_template_part( 'parts/post/post', 'head' ); ?>

										</div><!--zox-post-title-wrap-->

									<?php endif; ?>

    									<div class="zox-post-img-wrap body-img-wrap">

    										<?php get_template_part( 'parts/post/post', 'img' ); ?>

    									</div><!--zox-post-img-wrap-->

									<?php } ?>

									<?php $zox_post_layout = get_option('zox_post_layout'); $zox_post_temp = get_post_meta($post->ID, "zox_post_template", true); if( ( empty($zox_post_temp) && empty($zox_post_layout) ) || (empty($zox_post_temp) && $zox_post_layout == '1') || ( $zox_post_temp == "def" && $zox_post_layout == '1' ) || ( $zox_post_temp == "global" && $zox_post_layout == '1' ) || ( empty($zox_post_temp) && $zox_post_layout == '6' ) || ( $zox_post_temp == "def" && $zox_post_layout == '6' ) || ( $zox_post_temp == "global" && $zox_post_layout == '6' ) || $zox_post_temp == "temp1" || $zox_post_temp == "temp6" ) { ?>

										<div class="zox-post-img-wrap body-img-wrap">

											<?php get_template_part( 'parts/post/post', 'img' ); ?>

										</div><!--zox-post-img-wrap-->

									<?php } ?>

									<?php $zox_post_layout = get_option('zox_post_layout'); $zox_post_temp = get_post_meta($post->ID, "zox_post_template", true); if( ( empty($zox_post_temp) && $zox_post_layout == '6' ) || ( $zox_post_temp == "def" && $zox_post_layout == '6' ) || ( $zox_post_temp == "global" && $zox_post_layout == '6' ) ||$zox_post_temp == "temp6" ) { ?>

									<?php if( $layout != 'single-post-layout-3' ): ?>	

										<div class="zox-post-title-wrap zox-tit2 zox-post-head-min">

											<div class="zox-post-width">

												<?php get_template_part( 'parts/post/post', 'head' ); ?>

											</div><!--zox-post-width-->

										</div><!--zox-post-title-wrap-->

									<?php endif; ?>

									<?php } ?>

								</div><!--zox-post-bot-wrap-->

							<?php } ?>

							<?php get_template_part( 'parts/post/post', 'body' ); ?>

						</div><!--zox-post-main-->

						<?php $zox_glob_side = get_option('zox_post_side'); $zox_post_side = get_post_meta($post->ID, "zox_post_side", true);

							if (

								(empty($zox_post_side) && empty($zox_glob_side)) ||

								(empty($zox_post_side) && $zox_glob_side == "1") ||

								($zox_post_side == "global" && empty($zox_glob_side)) ||

								($zox_post_side == "global" && $zox_glob_side == "1") ||

								$zox_post_side == "show" ||

								empty($zox_glob_side)

							){ ?>

							<div class="zox-post-side-wrap zox-post-side-noalp zoxrel zox-sticky-side">

								<?php get_sidebar(); ?>

							</div><!--zox-post-side-wrap-->

						<?php } ?>

					</div><!--zox-post-main-wrap-->

				</div><!--zox-post-width-->

			</div><!--zox-post-main-grid-->

			<?php setCrunchifyPostViews(get_the_ID()); ?>

			<?php $disqus_id3 = get_option('zox_disqus_id'); zoxClickCommmentButton($disqus_id3); ?>

			<?php $zox_social_box = get_option('zox_social_box'); if ($zox_social_box == "1" || $zox_social_box == "3") { ?>

				<?php if ( function_exists( 'zox_SocialScroll' ) ) { ?>

					<?php zox_SocialScroll(); ?>

				<?php } ?>

			<?php } ?>

		</div><!--zox-article-wrap-->

		<?php get_template_part( 'parts/post/post', 'foot' ); ?>

	<?php endwhile; endif; ?>

</article><!--zox-post-wrap-->

