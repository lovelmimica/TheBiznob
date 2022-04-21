
<?php get_header(); ?>
<div id="zox-home-main-wrap" class="zoxrel zox100 search-result-page-wrap">
		<div class="zox-body-width">
			<div id="zox-home-body-wrap" class="zoxrel zox100">
				<div id="zox-home-cont-wrap" class="zoxrel default-page-template search-result-page">
					<div class='main-content-wrapper'>
                        <?php 
							$query = $_GET["s"];
							if( $query != null && $query != ""){
								$posts = get_posts( array(  
									"post_type" => "post",
									"posts_per_page" => -1,
									"orderby" => "post_date",
									"s" => $query
								));
								
								if( count( $posts ) > 0 ){
									echo '<h2 class="search-results-subtitle">Search results for "' . $query . '"</h2>';
									echo "<section class='search-results-posts'>";
									$i=0;
									foreach( $posts as $post ){
										echo do_shortcode("[post_card post_id='{$post->ID}' /]" );
										if( $i % 2 == 0 ) echo "<span class='middle-border'></span>";
										$i++;
									}
									echo "</section>";
								}else{
									echo '<h2 class="search-results-subtitle">No search results found for "' . $query . '"</h2>';
								}
							}else{
								echo '<h2 class="search-results-subtitle">No search results found for "' . $query . '"</h2>';
							}
						?>
                    </div>
                    <div class='sidebar-wrapper'>
                        <?php get_sidebar() ?>
                    </div>
				</div><!--zox-home-cont-wrap-->

			</div><!--zox-home-body-wrap-->
		</div><!--zox-body-width-->
</div><!--zox-home-main-wrap-->
<?php get_footer(); ?>