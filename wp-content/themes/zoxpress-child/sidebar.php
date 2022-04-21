<?php
    $layout_type = rand(1, 4);
    if( is_page('market-data') && $layout_type % 2 == 1 ) $layout_type++;
    if( 7590 == get_query_var('cat') ) $layout_type = 3;
    $layout_class = "sidebar-layout-{$layout_type}";
?>
<div class="sidebar">
	<div class="sidebar-content <?php echo $layout_class ?>">
	    <?php echo do_shortcode( '[md_sidebar_aggregates/]' ); ?>
	    <div class='editor-picks-wrapper'>
			<h2 class='section-title'><a href="<?php echo get_category_link(7590) ?>" class='category-link'>Editor's Picks <span class="fas fa-angle-right"></span></a></h2>
			<div class='editor-picks-post-list'>
			<?php 
				$posts = get_posts( array( "tag" => 'editor-pick', 'numberposts' => 4, 'exclude' => $_SESSION["displayed-posts"] ) );
				$i = 0;
				foreach( $posts as $post ){
					echo do_shortcode( "[post_card post_id='{$post->ID}' class='editor-picks'/]" );
					if( $i % 2 == 0 ) echo "<span class='middle-border'></span>";
					$i++;
				}
				?>
			</div>
		</div>
		<div class='adsense-wrapper'>
        <!-- Sidebar Desktop Ad #1 -->
            <ins class="adsbygoogle"
             style="width: 300px; max-width: 100%; height: min-content; display: flex; align-items: center; margin: 20px auto;"
             data-ad-client="ca-pub-4790709439893469"
             data-ad-slot="3882540775"
             data-ad-format="rectangle"
             data-full-width-responsive="true"></ins>
            <script>
                window.addEventListener("DOMContentLoaded", () => {
                    console.log("WIN loaded");
                    (adsbygoogle = window.adsbygoogle || []).push({});
                });
            </script>
		</div>
		<div class='people-profiles-wrapper'>
			<h2 class='section-title'><a href="<?php echo get_category_link(7590) ?>" class='category-link'>People Profiles <span class="fas fa-angle-right"></span></a></h2>
			<div class='people-profiles-post-list'>
			<?php 
				$posts = get_posts( array( 'category' => 7590, 'numberposts' => 4, 'exclude' => $_SESSION["displayed-posts"] ) );
				$i = 0;
				foreach( $posts as $post ){
					echo do_shortcode( "[post_card post_id='{$post->ID}' class='people-profiles'/]" );
					if( $i % 2 == 0 ) echo "<span class='middle-border'></span>";
					$i++;
				}
				?>
			</div>
		</div>	
		<div class='adsense-wrapper'>
            <!-- Sidebar Ad #2 -->
            <!-- Sidebar Desktop  Ad #2 -->
            <ins class="adsbygoogle"
                 style="width: 300px; max-width: 100%; height: min-content; display: flex; align-items: center; margin: 20px auto 20px auto;"
                 data-ad-client="ca-pub-4790709439893469"
                 data-ad-slot="8953800407"
                 data-ad-format="auto"
                 data-full-width-responsive="true"></ins>
            <script>
                window.addEventListener("DOMContentLoaded", () => {
                    (adsbygoogle = window.adsbygoogle || []).push({});
                });
            </script>
		</div>

		<img class='sidebar-ad' src='<?php echo get_home_url() ?>/wp-content/uploads/2021/10/dummy-sidebar-ad-1.png'>
	</div>
</div>