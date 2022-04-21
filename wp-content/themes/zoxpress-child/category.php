<?php
	/* Template Name: Category Archive */
	$_SESSION["displayed-posts"] = array();
	
    $category = get_category( get_query_var( 'cat' ) );
	$cat_id = $category->cat_ID;
	
// 	$layout_dummy = get_field( "category_layout", $category );
	$layout = get_field( "category_layout", $category );
?>
<?php get_header(); ?>
<div id="zox-home-main-wrap" class="zoxrel zox100">
		<div class="zox-body-width">
			<div id="zox-home-body-wrap" class="zoxrel zox100">
				<div id="zox-home-cont-wrap" class="zoxrel default-page-template">
					<div class='main-content-wrapper'>
						<section class='category-main-posts-wrapper <?php echo $layout; ?>'>
						    <div class='first-row'>
								<div class="category-prim-column">
						        <?php
						            if( $layout == "category-layout-1" ){
    						            $post = get_posts( array( 'category' => $cat_id, 'numberposts' => 1, "tag" => "breaking-news" ) )[0];
    						            echo do_shortcode( "[post_card post_id='{$post->ID}' latest_posts_count=4 /]" );
						            }else if( $layout == "category-layout-2" ){
						                $posts = get_posts( array( 'category' => $cat_id, 'numberposts' => 3, 'exclude' => $_SESSION["displayed-posts"] ) );
						                foreach( $posts as $post ){
						                    echo do_shortcode( "[post_card post_id='{$post->ID}' /]" );
						                    echo "<span class='middle-border'></span>";
						                }
						            }else if( $layout == "category-layout-3" ){
						                $posts = get_posts( array( 'category' => $cat_id, 'numberposts' => 2, 'exclude' => $_SESSION["displayed-posts"] ) );
						                foreach( $posts as $post ){
						                    echo do_shortcode( "[post_card post_id='{$post->ID}' /]" );
						                    echo "<span class='middle-border'></span>";
						                }
						            }else if( $layout == "category-layout-4" ){
						                $post = get_posts( array( 'category' => $cat_id, 'numberposts' => 1, "tag" => "breaking-news" ) )[0];
    						            echo do_shortcode( "[post_card post_id='{$post->ID}' latest_posts_count=4 /]" );
						            }
						        ?>
						        </div>
						        <span class='middle-border'></span>
						        <div class='category-second-column'>
    						        <?php
        						        if( $layout == "category-layout-1" ){
        						       		$posts = get_posts( array( 'category' => $cat_id, 'numberposts' => 4, 'exclude' => $_SESSION["displayed-posts"] ) );
        						            foreach( $posts as $post ){
        						                echo do_shortcode( "[post_card post_id='{$post->ID}' excerpt_length='100' /]" );
        						            }     
        						        }
    						        ?>
						        </div>	        
						    </div>
						    <div class="category-post-grid">
						        <?php 
						            if( $layout == "category-layout-1" || $layout == "category-layout-3" ) $col_num = 4;
						            else if( $layout == "category-layout-2" || $layout == "category-layout-4" ) $col_num = 3;
						            else $col_num = 4;
						            
						            $posts = get_posts( array( 'category' => $cat_id, 'numberposts' => -1, 'exclude' => $_SESSION["displayed-posts"] ) );
						            $post_count = count( $posts );

						            $post_subarrays = array();
						            for( $i = 0; $i < $col_num; $i++ ){
						                $post_subarrays[$i] = array();
						            }
						            
                                    for( $i = 0; $i < $post_count; $i++ ){
                                        array_push( $post_subarrays[$i % $col_num], $posts[$i] );
                                    }

                                    foreach( $post_subarrays as $post_array ){
                                        echo "<div class='category-column'>";
                                        foreach( $post_array as $post ){
                                            echo do_shortcode( "[post_card post_id='{$post->ID}' excerpt_length='100' /]" );
                                        }
                                        echo "</div>";
                                        echo "<span class='middle-border'></span>";
                                    }
						        ?>
						    </div>
						</section>
					</div>
                    <div class='sidebar-wrapper'>
                        <?php get_sidebar() ?>
                    </div>
				</div><!--zox-home-cont-wrap-->
			</div><!--zox-home-body-wrap-->
		</div><!--zox-body-width-->
</div><!--zox-home-main-wrap-->
<?php get_footer(); ?>