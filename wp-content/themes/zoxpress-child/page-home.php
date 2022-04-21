<?php
	/* Template Name: Home */
?>
<?php get_header(); ?>
<div id="zox-home-main-wrap" class="zoxrel zox100">
		<div class="zox-body-width">
			<div id="zox-home-body-wrap" class="zoxrel zox100">
				<div id="zox-home-cont-wrap" class="zoxrel">
					<?php 
						$_SESSION["displayed-posts"] = array();
						echo do_shortcode( '[breaking_news_slider /]' );
					?>
					<section class="news-business-section">
						<div class='latest-news-wrapper'>
							<div class='latest-news-header'>
								<!--<h2 class='section-title'><a class='category-link'>Latest News <span class="fas fa-angle-right"></span></a></h2>-->
								<div class='latest-news-navigation'>
									<span class='latest-news-navigation-fill'></span>
									<button class='latest-news-toggler show-us-news active'>U.S. News</button>
									<button class='latest-news-toggler show-world-news'>World News</button>
									<span class='latest-news-navigation-fill'></span>
								</div>
							</div>
							<div class='world-news-wrapper'>
								<?php 
									$posts = get_posts( array( 'tag' => 'world-news', 'numberposts' => 13, 'exclude' => $_SESSION["displayed-posts"] ) );
									
									$i = 0;
									foreach( $posts as $post ){
										if( $i == 0 ) echo "<div class='primary-col'>";
										if( $i == 3 ) echo "</div><div class='secondary-col'>";
										echo do_shortcode( "[post_card post_id='{$post->ID}' class='world-news'/]" );
										if( $i % 2 == 1 ) echo "<span class='middle-border'></span>";

										$i++;
									}
									echo "</div>";
								?>
							</div>
							<div class='us-news-wrapper active'>
								<?php 
									$posts = get_posts( array( 'tag' => 'us-news', 'numberposts' => 13, 'exclude' => $_SESSION["displayed-posts"] ) );
									$home_url = get_home_url();
									$i = 0; 
									foreach( $posts as $post ){
										if( $i == 0 ) echo "<div class='primary-col'>";
										if( $i == 3 ) echo "</div><div class='secondary-col'>";
										echo do_shortcode( "[post_card post_id='{$post->ID}' class='us-news'/]" );
										if( $i % 2 == 1 ) echo "<span class='middle-border'></span>";

										$i++;
									}
									echo "</div>";
								?>
							</div>
							</div>
							<div class='business-wrapper'>
								<h2 class='section-title'><a href="<?php echo get_category_link(9455) ?>" class='category-link'>Business <span class="fas fa-angle-right"></span></a></h2>
								<?php
									$posts = get_posts( array( 'category' => 9455, 'numberposts' => 10, 'exclude' => $_SESSION["displayed-posts"] ) );

									$i = 0;
									$excerpt_length = null;
									foreach( $posts as $post ){
										if( $i == 0 ) echo "<div class='primary-col'>";
										if( $i == 1 ) {
											echo "<h4 class='related-posts-heading'>Related posts</h4><div class='related-posts'>";
										}
										if( $i == 4 ) {
										    $homepage_ad_4 = <<<"EOD"
                                                <ins class="adsbygoogle"
                                                    style="display:flex; justify-content: center; width: 450px; max-width: 100%"
                                                    data-ad-client="ca-pub-4790709439893469"
                                                    data-ad-slot="4427699202"
                                                    data-ad-format="vertical"
                                                    data-full-width-responsive="true"></ins>
                                                <script>
                                                    window.addEventListener("DOMContentLoaded", () => {
                                                        (adsbygoogle = window.adsbygoogle || []).push({});
                                                    });
                                                </script>
                                            EOD;
											echo "</div><div class='adsense-wrapper'>{$homepage_ad_4}</div></div><div class='secondary-col'>";
											$excerpt_length = 100;
										}
										echo do_shortcode( "[post_card post_id='{$post->ID}' class='business' excerpt_length={$excerpt_length}/]" );

										$i++;
									}
									echo "</div>";
								?>
							</div>
							<div class='sidebar-wrapper'>
								<?php get_sidebar() ?>
							</div>
					</section>
					<section class='video-section'>
						<h2 class='section-title'><a href="<?php echo get_category_link(7583) ?>" class='category-link'>Videos <span class="fas fa-angle-right"></span></a></h2>
						<div class='video-wrapper'>
								<?php 
                                    $video_ids = get_posts( array( 'fields' => 'ids', 'post_type' => 'video', 'numberposts' => 7 ) );
									
									
									$i = 0;
									foreach( $video_ids as $id ){
									        if( $i == 0 ) {
									            $video_id = get_field( 'video_id', $id );
									            echo "<div class='primary-col'>";
									            //echo "<div id='dummy-video-player' data-id={$video_id}></div>";
									            //echo do_shortcode( "[video_card id='{$id}' class='floating-video' /]" );
									            echo do_shortcode( "[video_card id='{$id}' class='main-video' /]" ); 	 	
									        }
									        if( $i == 1 ) echo "</div><span class='middle-border'></span><div class='secondary-col'>";
									        
									        if( $i > 0 )echo do_shortcode( "[video_card id='{$id}' /]" ); 	
									        
									        $i++;
									}
									echo "<a href='/videos' class='link-button'>See More Videos</a></div>";
								?>
						</div>
					</section>
					<section class="ad-section">
						<img class='main-container-ad' src="<?php echo $home_url ?>/wp-content/uploads/2021/10/dummy-content-banner.png">
						    <!--<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4790709439893469" crossorigin="anonymous"></script>-->
                            <!-- Homepage Ad 1 -->
                               <ins class="adsbygoogle"
                                 style="display:block"
                                 data-ad-client="ca-pub-4790709439893469"
                                 data-ad-slot="3882540775"
                                 data-ad-format="auto"
                                 data-full-width-responsive="true"></ins>
                            <script>
                                window.addEventListener("DOMContentLoaded", () => {
                                    (adsbygoogle = window.adsbygoogle || []).push({});
                                });
                            </script>
					</section>
					<section class="technology-politics-section">
						<div class='technology-wrapper'>
							<h2 class='section-title'><a href="<?php echo get_category_link(7592) ?>" class='category-link'>Technology <span class="fas fa-angle-right"></span></a></h2>
							<?php 
								$posts = get_posts( array( 'category' => 7592, 'numberposts' => 5, 'exclude' => $_SESSION["displayed-posts"] ) );
								$i = 0;
								foreach( $posts as $post ){
									echo do_shortcode( "[post_card post_id='{$post->ID}' class='people-profiles'/]" );
									if( $i % 2 == 1 ) echo "<span class='middle-border'></span>";
									$i++;
								}
							?>
						</div>
						<span class='middle-border'></span>
						<div class='politics-wrapper'>
							<h2 class='section-title'><a href="<?php echo get_category_link(7586) ?>" class='category-link'>Enterpreneurship <span class="fas fa-angle-right"></span></a></h2>
							<?php 
								$posts = get_posts( array( 'category' => 7586, 'numberposts' => 5, 'exclude' => $_SESSION["displayed-posts"] ) );
								$i = 0;
								foreach( $posts as $post ){
									echo do_shortcode( "[post_card post_id='{$post->ID}' class='politics'/]" );
									if( $i % 2 == 1 ) echo "<span class='middle-border'></span>";
									$i++;
								}							
							?>
						</div>
					</section>
					<section class="ad-section">
						<img class='main-container-ad' src='<?php echo $home_url ?>/wp-content/uploads/2021/10/dummy-content-banner.png'>
					</section>
					<section class="ad-section">
						<img class='main-container-ad' src='<?php echo $home_url ?>/wp-content/uploads/2021/10/dummy-content-banner.png'>
						<!--<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4790709439893469" crossorigin="anonymous"></script>-->
                        <!-- Homepage Ad #2 -->
                        <!--<ins class="adsbygoogle"-->
                        <!--     style="width: 100%; display: flex; justify-content: center";-->
                        <!--     data-ad-client="ca-pub-4790709439893469"-->
                        <!--     data-ad-slot="9154068810"-->
                        <!--     data-ad-format="horizontal"-->
                        <!--     data-full-width-responsive="false"></ins>-->
                        <ins class="adsbygoogle"
                             style="display:block"
                             data-ad-client="ca-pub-4790709439893469"
                             data-ad-slot="8953800407"
                             data-ad-format="auto"
                             data-full-width-responsive="true"></ins>
                        <script>
                            window.addEventListener("DOMContentLoaded", () => {
                                (adsbygoogle = window.adsbygoogle || []).push({});
                            });
                        </script>
					</section>
					<section class="market-economy-finance-section">
						<div class='market-wrapper'>
							<h2 class='section-title'><a class='category-link'>Finance <span class="fas fa-angle-right"></span></a></h2>
							<?php
								
								$posts = get_posts( array( 'category' => 7587, 'numberposts' => 5, 'exclude' => $_SESSION["displayed-posts"] ) );
								foreach( $posts as $post ){
									echo do_shortcode( "[post_card post_id='{$post->ID}' class='market'/]" );
								}							
							?>
						</div>
						<span class='middle-border'></span>
						<div class='economy-wrapper'>
							<h2 class='section-title'><a href="<?php echo get_category_link(7584) ?>" class='category-link'>Economy <span class="fas fa-angle-right"></span></a></h2>
							<?php 
								$posts = get_posts( array( 'category' => 7584, 'numberposts' => 5, 'exclude' => $_SESSION["displayed-posts"] ) );
								foreach( $posts as $post ){
									echo do_shortcode( "[post_card post_id='{$post->ID}' class='economy'/]" );
								}							
							?>
						</div>
						<span class='middle-border'></span>
						<div class='finance-wrapper'>
							<h2 class='section-title'><a href="<?php echo get_category_link(7591) ?>" class='category-link'>Politics <span class="fas fa-angle-right"></span></a></h2>
							<?php 
								$posts = get_posts( array( 'category' => 7591, 'numberposts' => 5, 'exclude' => $_SESSION["displayed-posts"] ) );
								foreach( $posts as $post ){
									echo do_shortcode( "[post_card post_id='{$post->ID}' class='finance'/]" );
								}							
							?>
						</div>
					</section>
					<section class="quote-of-the-day-section">
						<div class="section-title-wrapper">
							<span class="section-title-fill"></span>
							<h2 class='section-title'>Quote of the day</h2>
							<span class="section-title-fill"></span>
						</div>
						<?php
    						$day = intval( date( 'd' ) );
    						$quote = get_posts( array( 'order' => 'ASC', 'post_type' => 'quote', 'numberposts' => -1 ) )[$day - 1];
						?>
						<blockquote class='quote-of-the-day'>
							<p class='quote-text'>"<?php echo $quote->post_title; ?>"</p>
							<span class='quote-author'><?php echo get_field( 'quote_author', $quote->ID ); ?></span>
						</blockquote>
						
					</section>
					<section class="lifestyle-section">
						<h2 class='section-title'><a href="<?php echo get_category_link(7588) ?>" class='category-link'>Lifestyle <span class="fas fa-angle-right"></span></a></h2>
						<div class='lifestyle-wrapper'>
							<?php 
								$posts = get_posts( array( 'category' => 7588, 'numberposts' => 4, 'exclude' => $_SESSION["displayed-posts"] ) );
								$i = 0;
								foreach( $posts as $post ){
									echo do_shortcode( "[post_card post_id='{$post->ID}' class='lifestyle'/]" );
									if( $i % 2 == 0 ) echo "<span class='middle-border'></span>";
									$i++;
								}
							?>
						</div>
					</section>
					<section class="ad-section">
						<img class='main-container-ad' src='<?php echo $home_url ?>/wp-content/uploads/2021/10/dummy-content-banner.png'>
                            <!--<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4790709439893469" crossorigin="anonymous"></script>-->
                            <!-- Homepage Ad #3 -->
                        <ins class="adsbygoogle"
                             style="display:block"
                             data-ad-client="ca-pub-4790709439893469"
                             data-ad-slot="6963019740"
                             data-ad-format="auto"
                             data-full-width-responsive="true"></ins>
                            <script>
                                window.addEventListener("DOMContentLoaded", () => {
                                    (adsbygoogle = window.adsbygoogle || []).push({});
                                });
                            </script>
					</section>
					<!--<section class="affiliate-products-section">
						<em>Look into our offer of discounted products!</em>
						<div class='affiliate-products-slider-wrapper'>
							<span class="fas fa-angle-left control-left"></span>
							<div class="affiliate-products-slider">
							<?php 
								$products = get_posts( array( 'post_type' => 'affiliate-product', 'numberposts' => 12 ) );

								foreach( $products as $product ){
									echo do_shortcode( "[affiliate_product product_id='{$product->ID}' /]" );
								}
							?>
							</div>
							<span class="fas fa-angle-right control-right"></span>
						</div>
					</section>-->
				</div><!--zox-home-cont-wrap-->
			</div><!--zox-home-body-wrap-->
		</div><!--zox-body-width-->
</div><!--zox-home-main-wrap-->
<?php get_footer(); ?>