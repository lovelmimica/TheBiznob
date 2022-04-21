<?php
	/* Template Name: Video Archive */
?>
<?php get_header(); ?>
<div id="zox-home-main-wrap" class="zoxrel zox100">
		<div class="zox-body-width">
			<div id="zox-home-body-wrap" class="zoxrel zox100">
				<div id="zox-home-cont-wrap" class="zoxrel video-page-template default-page-template">
					<div class='main-content-wrapper'>
						<section class='video-posts-wrapper'>
							<?php
							    $video_posts = get_posts( array( 'post_type' => 'video', 'numberposts' => -1, 'orderby' => 'date', 'order' => 'DESC' ) );
							    
							    $i = 0;
							    foreach(  $video_posts as $video ){
							        if( $i == 0 ) { 
							            echo "<div class='primary-video'>"; 
							            echo do_shortcode( "[video_card id={$video->ID} class='main-video' /]" );
							        }
							        if( $i == 1 ) echo "</div><div class='secondary-video'>";
							        if( $i != 0 ) { 
							            echo "<div class='middle-border'></div>";
							            echo do_shortcode( "[video_card id={$video->ID} /]" );
							        }
                                    $i++;
							    }
							    echo "</div>";
							?>
							   
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