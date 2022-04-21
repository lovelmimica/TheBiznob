<?php $zox_featured_img = get_option('zox_featured_img'); $zox_show_hide = get_post_meta($post->ID, "zox_featured_image", true);
	if (
		(empty($zox_show_hide) && empty($zox_featured_img)) ||
		(empty($zox_show_hide) && $zox_featured_img == "1") ||
		($zox_show_hide == "global" && empty($zox_featured_img)) ||
		($zox_show_hide == "global" && $zox_featured_img == "1") ||
		$zox_show_hide == "show" ||
		empty($zox_featured_img)
	){ ?>
	<?php if(get_post_meta($post->ID, "zox_video_embed", true)) { ?>
		<div class="zox-video-embed-wrap left zoxrel">
			<div class="zox-video-embed-cont left zoxrel">
				<span class="zox-video-close fas fa-times"></span>
				<div class="zox-video-embed left zoxrel">
					<?php echo html_entity_decode(get_post_meta($post->ID, "zox_video_embed", true)); ?>
				</div><!--zox-video-embed-->
			</div><!--zox-video-embed-cont-->
		</div><!--zox-video-embed-wrap-->
		<div class="zox-post-img-hide" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
			<?php $thumb_id = get_post_thumbnail_id(); $zox_thumb_array = wp_get_attachment_image_src($thumb_id, 'zox-post-thumb', true); $zox_thumb_url = $zox_thumb_array[0]; $zox_thumb_width = $zox_thumb_array[1]; $zox_thumb_height = $zox_thumb_array[2]; ?>
			<meta itemprop="url" content="<?php echo esc_url($zox_thumb_url) ?>">
			<meta itemprop="width" content="<?php echo esc_html($zox_thumb_width) ?>">
			<meta itemprop="height" content="<?php echo esc_html($zox_thumb_height) ?>">
		</div><!--zox-post-img-hide-->
	<?php } else { ?>
		<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
			<div class="zox-post-img left zoxrel zoxlh0" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
				<?php the_post_thumbnail('', array( 'class' => 'flipboard-image' )); ?>
				<?php $thumb_id = get_post_thumbnail_id(); $zox_thumb_array = wp_get_attachment_image_src($thumb_id, 'zox-post-thumb', true); $zox_thumb_url = $zox_thumb_array[0]; $zox_thumb_width = $zox_thumb_array[1]; $zox_thumb_height = $zox_thumb_array[2]; ?>
				<meta itemprop="url" content="<?php echo esc_url($zox_thumb_url) ?>">
				<meta itemprop="width" content="<?php echo esc_html($zox_thumb_width) ?>">
				<meta itemprop="height" content="<?php echo esc_html($zox_thumb_height) ?>">
			</div><!--zox-post-img-->
		<?php } ?>
		<?php if ( $zox_caption = get_post( get_post_thumbnail_id() )->post_excerpt ); { ?>
			<span class="zox-post-img-cap">
			    <?php
			        if( strlen(esc_html($zox_caption)) > 100 ) echo substr( esc_html($zox_caption), 0, 100 ) . "... <i class='fas fa-plus-circle expand-img-cap'></i>";
			        else echo esc_html($zox_caption); 
			    ?>
			</span>
			<span class="zox-post-img-cap zox-post-img-cap-full">
			    <?php
			        echo esc_html($zox_caption) . " <i class='fas fa-minus-circle minimize-img-cap'></i>"; 
			    ?>
			</span>
		<?php } ?>
	<?php } ?>
<?php } else { ?>
	<div class="zox-post-img-hide" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
		<?php $thumb_id = get_post_thumbnail_id(); $zox_thumb_array = wp_get_attachment_image_src($thumb_id, 'zox-post-thumb', true); $zox_thumb_url = $zox_thumb_array[0]; $zox_thumb_width = $zox_thumb_array[1]; $zox_thumb_height = $zox_thumb_array[2]; ?>
		<meta itemprop="url" content="<?php echo esc_url($zox_thumb_url) ?>">
		<meta itemprop="width" content="<?php echo esc_html($zox_thumb_width) ?>">
		<meta itemprop="height" content="<?php echo esc_html($zox_thumb_height) ?>">
	</div><!--zox-post-img-hide-->
<?php } ?>