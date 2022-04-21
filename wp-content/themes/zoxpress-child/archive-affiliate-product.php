<?php
	/* Template Name: Affiliate Products Archive */
?>
<?php get_header(); ?>
<div id="zox-home-main-wrap" class="zoxrel zox100">
		<?php $zox_home_layout = get_option('zox_home_layout'); ?>
			<div id="zox-home-widget-wrap" class="zoxrel left zox100">
				<h1 class="category-title">Affiliate Products</h1>
			</div><!--zox-home-widget-wrap-->
		<div class="zox-body-width">
			<div id="zox-home-body-wrap" class="zoxrel zox100">
				<div id="zox-home-cont-wrap" class="zoxrel">
				<section class='latest-posts'>
					<?php
						$products = get_posts( array( 'post_type' => 'affiliate-product' ) );
						
						foreach( $products as $product ){
							do_shortcode( "[affiliate_product product_id=" . $product->ID . "/]" );
						}
					?>
				</section>
					<?php 
						//$categories = get_categories( array( "parent" => $cat_id ) );
						//foreach( $categories as $category){
						//	echo do_shortcode( "[category_section category={$category->slug}/]" );
						//}
					?>
				</div><!--zox-home-cont-wrap-->
				<div class="zox-home-right-wrap zoxrel zox-sticky-side">
					<?php get_sidebar(); ?> 
				</div><!--zox-home-right-wrap-->
			</div><!--zox-home-body-wrap-->
		</div><!--zox-body-width-->
</div><!--zox-home-main-wrap-->
<?php get_footer(); ?>