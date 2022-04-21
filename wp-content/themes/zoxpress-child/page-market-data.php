<?php
	/* Template Name: Market Data Archive */
?>
<?php get_header(); ?>
<div id="zox-home-main-wrap" class="zoxrel zox100">
		<div class="zox-body-width">
			<div id="zox-home-body-wrap" class="zoxrel zox100">
				<div id="zox-home-cont-wrap" class="zoxrel market-data-page-template default-page-template">
                    <?php do_shortcode( '[md_market_data_archive_content /]' ); ?>
                    <div class='sidebar-wrapper'>
                        <?php get_sidebar() ?>
                    </div>
				</div><!--zox-home-cont-wrap-->
			</div><!--zox-home-body-wrap-->
		</div><!--zox-body-width-->
</div><!--zox-home-main-wrap-->
<?php get_footer(); ?>