<header class="zox-post-head-wrap left zoxrel zox100">
	<div class="zox-post-head zoxrel">
		<h3 class="zox-post-cat">
			<a class="zox-post-cat-link" href="<?php $category = get_the_category(); $category_id = get_cat_ID( $category[0]->cat_name ); $category_link = get_category_link( $category_id ); echo esc_url( $category_link ); ?>"><span class="zox-post-cat"><?php $category = get_the_category(); echo esc_html( $category[0]->cat_name ); ?></span></a>
		</h3>
		<h1 class="zox-post-title left entry-title" itemprop="headline" data-url="<?php echo get_permalink(); ?>"><?php the_title(); ?></h1>
		<?php if ( has_excerpt() ) { ?>
			<span class="zox-post-excerpt"><?php the_excerpt(); ?></span>
		<?php } ?>
		<div class="zox-post-info-wrap">
			<?php $zox_author_info = get_option('zox_author_info'); if ($zox_author_info == "2") { ?>
				<div class="zox-post-byline-wrap zox-post-byline-date">
					<div class="zox-author-info-wrap">
						<div class="zox-post-date-wrap">
							<p><?php esc_html_e( 'Published', 'zoxpress' ); ?></p> <span class="zox-post-date updated"><time class="post-date updated" itemprop="datePublished" datetime="<?php the_time('Y-m-d'); ?>"><?php if ( zox_post_date(7) ) { ?><?php the_time(get_option('date_format')); ?><?php } else { ?><?php printf( esc_html__( '%s ago', 'zoxpress' ), human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) ); ?><?php } ?></time></span>
							<meta itemprop="dateModified" content="<?php the_modified_date('Y-m-d'); ?>"/>
						</div><!--zox-post-date-wrap-->
					</div><!--zox-author-info-wrap-->
				</div><!--zox-post-byline-wrap-->
			<?php } else { ?>
				<div class="zox-post-byline-wrap">
					<div class="zox-author-thumb">
						<?php echo get_avatar( get_the_author_meta('email'), '40' ); ?>
					</div><!--zox-author-thumb-->
					<div class="zox-author-info-wrap">
						<div class="zox-author-name-wrap" itemprop="author" itemscope itemtype="https://schema.org/Person">
							<p><?php esc_html_e( 'By', 'zoxpress' ); ?></p><span class="zox-author-name vcard fn author" itemprop="name"><?php the_author_posts_link(); ?></span>
						</div><!--zox-author-name-wrap-->
						<div class="zox-post-date-wrap">
							<p><?php esc_html_e( 'Published', 'zoxpress' ); ?></p> <span class="zox-post-date updated"><time class="post-date updated" itemprop="datePublished" datetime="<?php the_time('Y-m-d'); ?>"><?php if ( zox_post_date(7) ) { ?><?php the_time(get_option('date_format')); ?><?php } else { ?><?php printf( esc_html__( '%s ago', 'zoxpress' ), human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) ); ?><?php } ?></time></span>
							<meta itemprop="dateModified" content="<?php the_modified_date('Y-m-d'); ?>"/>
						</div><!--zox-post-date-wrap-->
					</div><!--zox-author-info-wrap-->
				</div><!--zox-post-byline-wrap-->
			<?php } ?>
			<div class="zox-post-soc-top-wrap">
				<?php $zox_social_box = get_option('zox_social_box'); if ($zox_social_box == "2" || $zox_social_box == "3") { ?>
					<?php if ( function_exists( 'zox_SocialStat' ) ) { ?>
						<?php zox_SocialStat(); ?>
					<?php } ?>
				<?php } ?>
			</div><!--zox-post-soc-top-wrap-->
		</div><!--zox-post-info-wrap-->
		<div class="zox-post-img-wrap head-image-wrap">
			<div class="zox-post-width">
				<?php get_template_part( 'parts/post/post', 'img' ); ?>
			</div><!--zox-post-width-->
		</div><!--zox-post-img-wrap-->
	</div><!--zox-post-head-->
</header><!--zox-post-head-wrap-->