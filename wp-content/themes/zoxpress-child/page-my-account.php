<?php
	/* Template Name: My Account */
?>
<?php get_header(); ?>
<div id="zox-home-main-wrap" class="zoxrel zox100 my-account-page">
		<div class="zox-body-width">
			<div id="zox-home-body-wrap" class="zoxrel zox100">
				<div id="zox-home-cont-wrap" class="zoxrel default-page-template">
					<div class='main-content-wrapper zox-post-body left zoxrel zox100'>
					<!-- <div class="zox-post-body left zoxrel zox100"> -->
					<h2>Welcome to the My Account page!</h2>	
					<p>Here you can update your personal data, subscription categories, and look into your read list.</p>
						<div class="my-account-navigation">
							<span class='my-account-navigation-fill'></span>
							<button class="tab-link active" data-content="user-information">Data and Subscriptions</button>
							<button class="tab-link" data-content="my-read-list">Read List</button>
							<span class='my-account-navigation-fill'></span>
						</div>
						<div class="my-account-content-wrapper">
							<div class="content-container user-information-content" data-content="user-information">
								<?php get_template_part( "parts/my-account/my-account", "user-information" ); ?>
							</div>
							<div class="content-container my-read-list-content" data-content="my-read-list">
								<?php get_template_part( "parts/my-account/my-account", "my-read-list" ); ?>
							</div>
						</div>
					</div><!--zox-post-body-->
                    
                    <div class='sidebar-wrapper'>
                        <?php get_sidebar() ?>
                    </div>
				</div><!--zox-home-cont-wrap-->
			</div><!--zox-home-body-wrap-->
		</div><!--zox-body-width-->
</div><!--zox-home-main-wrap-->
<?php get_footer(); ?>