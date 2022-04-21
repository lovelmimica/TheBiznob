<?php $zox_more_posts = get_option('zox_more_posts'); if ($zox_more_posts == "1" || $zox_more_posts == "2") { ?>
	<div class="zox-post-more-wrap left zoxrel zox100">
		<div class="zox-post-width">
			<div class="zox-post-more left zoxrel zox100">
				<div class="zox-post-main-head left zoxrel zox100">
					<h4 class="zox-post-main-title">
						<span class="zox-post-main-title"><?php echo esc_html(get_option('zox_more_head')); ?></span>
					</h4>
				</div><!--zox-widget-main-head-->
				<?php $zox_more_posts = get_option('zox_more_posts'); if ($zox_more_posts == "1") { ?>
					<div class="zox-post-more-grid zox-div4 left zoxrel zox100">
						<?php global $post; $zox_related_num = get_option('zox_related_num'); $pop_days = esc_html(get_option('zox_pop_days')); $popular_days_ago = "$pop_days days ago"; $recent = new WP_Query(array('posts_per_page' => $zox_related_num, 'ignore_sticky_posts'=> 1, 'post__not_in' => array( $post->ID ), 'orderby' => 'meta_value_num', 'order' => 'DESC', 'meta_key' => 'post_views_count', 'date_query' => array( array( 'after' => $popular_days_ago )) )); while($recent->have_posts()) : $recent->the_post(); ?>
							<?php /* get_template_part( 'parts/art', 'more' ); */ echo do_shortcode( "[post_card post_id='{$post->ID}' excerpt_length='200' /]" ) ?>
						<?php endwhile; wp_reset_postdata(); ?>
					</div><!--zox-post-more-grid-->
				<?php } else if ($zox_more_posts == "2") { ?>
					<?php zox_related_posts(); ?>
				<?php } ?>
			</div><!--zox-post-more-->
		</div><!--zox-post-width-->
	</div><!--zox-post-more-wrap-->
<?php } ?>
<?php $zox_post_bot_ad = get_option('zox_post_bot_ad'); if ($zox_post_bot_ad) { ?>
	<div class="zox-post-bot-ad left zoxrel zox100 zox-lh0">
		<span class="zox-ad-label"><?php esc_html_e( 'Advertisement', 'zoxpress' ); ?></span>
		<?php $zox_post_ad = get_option('zox_post_bot_ad'); if ($zox_post_bot_ad) { echo do_shortcode(html_entity_decode($zox_post_bot_ad)); } ?>
	</div><!--zox-post-bot-ad-->
<?php } ?>
<?php zoxMoreClick(); ?>