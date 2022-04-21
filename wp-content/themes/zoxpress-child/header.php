<!DOCTYPE html>
<html <?php 
	language_attributes();
	$_SESSION["displayed-posts"] = array();
?>>
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-TJN6N315EW"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', 'G-TJN6N315EW');
    </script>
    <link rel="icon" type="image/x-icon" href="https://www.biznob.com/wp-content/uploads/2022/01/small_favicon.png">
    <meta charset="<?php bloginfo('charset'); ?>" >
    <meta name="viewport" id="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <?php wp_head(); ?>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4790709439893469" crossorigin="anonymous"></script>
</head>
<body <?php body_class(); ?>>
	<div id="zox-site" class="left zoxrel <?php $zox_dark_mode = get_option('zox_dark_mode'); if ($zox_dark_mode == '3') { echo 'zox-dark'; } ?>">
		<?php get_template_part( 'parts/fly', 'menu' ); ?>
		<div id="zox-search-wrap">
			<div class="zox-search-cont">
				<p class="zox-search-p"><?php esc_html_e( 'Hi, what are you looking for?', 'zoxpress' ); ?></p>
				<div class="zox-search-box">
					<?php get_search_form(); ?>
				</div><!--zox-search-box-->
			</div><!--zox-serach-cont-->
			<div class="zox-search-but-wrap zox-search-click">
				<span></span>
				<span></span>
			</div><!--zox-search-but-wrap-->
		</div><!--zox-search-wrap-->
		<?php if(get_option('zox_wall_ad')) { ?>
			<div id="zox-wallpaper">
				<?php if(get_option('zox_wall_url')) { ?>
					<a href="<?php echo esc_url(get_option('zox_wall_url')); ?>" class="zox-wall-link" target="_blank"></a>
				<?php } ?>
			</div><!--zox-wallpaper-->
		<?php } ?>
		<div id="zox-site-wall" class="left zoxrel">
			<div id="zox-lead-top-wrap">
				<div id="zox-lead-top-in">
					<div id="zox-lead-top">
						<?php $zox_lead_page1 = get_option('zox_lead_page1'); if (($zox_lead_page1 == "1" && is_front_page()) || ($zox_lead_page1 == "2" &&  ! is_404())) { ?>
							<?php $zox_lead_img1 = get_option('zox_lead_img1'); if ($zox_lead_img1 && ! is_404()) { ?>
								<?php $zox_lead_url1 = get_option('zox_lead_url1'); if (!empty($zox_lead_url1)) { ?>
									<a href="<?php echo esc_url($zox_lead_url1); ?>" target="_blank">
									<img src="<?php echo esc_url($zox_lead_img1); ?>" />
									</a>
								<?php } else { ?>
									<img src="<?php echo esc_url($zox_lead_img1); ?>" />
								<?php } ?>
							<?php } else { ?>
								<?php $zox_lead_ad1 = get_option('zox_lead_ad1'); if ($zox_lead_ad1 && ! is_404()) { echo do_shortcode(html_entity_decode($zox_lead_ad1)); } ?>
							<?php } ?>
						<?php } ?>
					</div><!--zox-lead-top-->
				</div><!--zox-lead-top-in-->
			</div><!--zox-lead-top-wrap-->
			<div id="zox-site-main" class="left zoxrel">
				<header id="zox-main-head-wrap" class="left zoxrel zox-trans-head">
					<?php $zox_feat_layout = get_option('zox_feat_layout'); $zox_cat_layout = get_option('zox_cat_layout'); if ((is_front_page() && $zox_feat_layout == "13" ) || (is_category() && $zox_cat_layout == "13" ) ) { ?>
						<?php get_template_part( 'parts/featured/feat', 'fash' ); ?>
					<?php } ?>
					<?php $zox_top_nav = get_option('zox_top_nav'); if ($zox_top_nav == "true") { ?>
						<?php get_template_part( 'parts/header', 'top' ); ?>
					<?php } ?>
					<?php get_template_part( 'parts/header', 'bot' ); ?>
				</header><!---zox-main-header-wrap-->
				<div id="zox-site-grid">
				    <?php //echo do_shortcode( "[md_crypto_market_data_bar/]" ); ?>
					<div id="zox-site-wall-small">
						<?php $zox_lead_page2 = get_option('zox_lead_page2'); if (($zox_lead_page2 == "1" && is_front_page()) || ($zox_lead_page2 == "2" &&  ! is_404()) || ($zox_lead_page2 == "3" && ! is_front_page() && ! is_404())) { ?>
							<?php $zox_lead_img2 = get_option('zox_lead_img2'); $zox_lead_url2 = get_option('zox_lead_url2'); if ($zox_lead_img2 && ! is_404()) { ?>
								<div id="zox-lead-bot">
									<a href="<?php echo esc_url($zox_lead_url2); ?>" target="_blank">
									<img src="<?php echo esc_url($zox_lead_img2); ?>" />
									</a>
								</div><!--zox-lead-bot-->
							<?php } else { ?>
								<?php $zox_lead_ad2 = get_option('zox_lead_ad2'); if ($zox_lead_ad2 && ! is_404()) { ?>
									<div id="zox-lead-bot">
										<?php echo do_shortcode(html_entity_decode($zox_lead_ad2)); ?>
									</div><!--zox-lead-bot-->
								<?php } ?>
							<?php } ?>
						<?php } ?>
						<div id="zox-main-body-wrap" class="left relative">
						    <section class='ad-section'>
            				    <!--<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4790709439893469" crossorigin="anonymous"></script>-->
                                <!-- Header Ad #1 -->
                                <ins class="adsbygoogle"
                                     style="display:block; width: 1400px; display: flex; justify-content: center; margin: auto;";
                                     data-ad-client="ca-pub-4790709439893469"
                                     data-ad-slot="2696471670"
                                     data-ad-format="auto"
                                     data-full-width-responsive="true"></ins>
                                <script>
                                    window.addEventListener("DOMContentLoaded", () => {
                                        (adsbygoogle = window.adsbygoogle || []).push({});
                                    });
                                </script>
				            </section>