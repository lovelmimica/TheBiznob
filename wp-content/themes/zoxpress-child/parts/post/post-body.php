<?php 
    $layout = get_field( "single_post_layout" );
    if( !$layout ) $layout = "single-post-layout-1";
    if( $layout == 'single-post-layout-3' ): ?>
        <div class="zox-post-title-wrap zox-tit2 body-title-wrap">
        	<div class="zox-post-width">
        		<?php get_template_part( 'parts/post/post', 'head' ); ?>
        	</div><!--zox-post-width-->
        </div><!--zox-post-title-wrap-->
<?php endif; ?>
<?php 
	echo do_shortcode( "[ar_audio_player /]" );
?>

<?php
	$id = get_the_ID();
	if( in_category( 'people', $id ) ) echo do_shortcode( "[people_fields id={$id} /]" );
?>

<div class="zox-post-body-wrap left zoxrel">
	<div class="zox-post-body left zoxrel zox100" data-url="<?php echo get_permalink(); ?>" >
		<?php the_content(); ?>
		<?php wp_link_pages(); ?>
	</div><!--zox-post-body-->
	<div class="zox-post-body-bot left zoxrel zox100 comment-section-wrapper">
		<div class="zox-post-body-width" >
			<div class="zox-post-tags left zoxrel zox100">
				<span class="zox-post-tags-header"><?php esc_html_e( 'In this article:', 'zoxpress' ); ?></span><span itemprop="keywords"><?php the_tags('',', ','') ?></span>
			</div><!--zox-post-tags-->
			<?php $zox_author_box = get_option('zox_author_box'); if ($zox_author_box == "true") { ?>
				<div class="zox-author-box-wrap left zoxrel">
					<div class="zox-author-box-img zoxrel">
						<?php echo get_avatar( get_the_author_meta('email'), '150' ); ?>
					</div><!--zox-author-box-img-->
					<div class="zox-author-box-right">
						<div class="zox-author-box-head zoxrel">
							<div class="zox-author-box-name-wrap">
								<span class="zox-author-box-name-head zoxrel"><?php esc_html_e( 'Written By', 'zoxpress' ); ?></span>
								<span class="zox-author-box-name zoxrel"><?php the_author_posts_link(); ?></span>
							</div><!--zox-author-box-name-wrap-->
						</div><!--zox-author-box-head-->
						<div class="zox-author-box-text left zoxrel">
							<p><?php the_author_meta('description'); ?></p>
						</div><!--zox-author-box-text-->
					</div><!--zox-author-box-right-->
				</div><!--zox-author-box-wrap-->
			<?php } ?>
			<?php 
			    if ( is_single() && (comments_open() || get_comments_number()) ) {
			        echo "<br><h3>Comment Template</h3>";
					comments_template();
				}
			?>
		</div><!--zox-post-body-width-->
	</div><!--zox-post-body-bot-->
</div><!--zox-post-body-wrap-->