<?php
	/* Template Name: Standard */
?>
<?php get_header(); ?>
<div id="zox-home-main-wrap" class="zoxrel zox100">
		<div class="zox-body-width">
			<div id="zox-home-body-wrap" class="zoxrel zox100">
				<div id="zox-home-cont-wrap" class="zoxrel default-page-template">
					<div class='main-content-wrapper'>
                        <?php the_content() ?>
                    </div>
                    <div class='sidebar-wrapper'>
                        <?php get_sidebar() ?>
                    </div>
				</div><!--zox-home-cont-wrap-->

			</div><!--zox-home-body-wrap-->
		</div><!--zox-body-width-->
</div><!--zox-home-main-wrap-->
<?php get_footer(); ?>