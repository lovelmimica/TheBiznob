							</div><!--zox-main-body-wrap-->

							<footer id="zox-foot-wrap" class="left zoxrel zox100">

								<div class="zox-head-width">

									<div class="zox-foot-grid left zoxrel zox100">

										<div class="zox-foot-whole-wrap footer-navigation">

											<div class='col col-1'>

												<h3>News</h3>

												<ul>

													<li><a href="<?php echo get_term_link( get_category_by_slug( "business" ) ); ?>" class='footer-link'>Business</a></li>

													<li><a href="<?php echo get_term_link( get_category_by_slug( "entrepreneurship" ) ); ?>" class='footer-link'>Entrepreneurship</a></li>

													<li><a href="<?php echo get_term_link( get_category_by_slug( "technology" ) ); ?>" class='footer-link'>Technology</a></li>

													<li><a href="<?php echo get_term_link( get_category_by_slug( "economy" ) ); ?>" class='footer-link'>Economy</a></li>

													<li><a href="<?php echo get_term_link( get_category_by_slug( "politics" ) ); ?>" class='footer-link'>Politics</a></li>

													<li><a href="<?php echo get_term_link( get_category_by_slug( "finance" ) ); ?>" class='footer-link'>Finance</a></li>

													<li><a href="<?php echo get_term_link( get_category_by_slug( "lifestyle" ) ); ?>" class='footer-link'>Lifestyle</a></li>

													<li><a href="<?php echo get_term_link( get_category_by_slug( "people" ) ); ?>" class='footer-link'>People</a></li>

												</ul>	

											</div>

											<div class='col col-2'>

												<h3>Media Parners</h3>

												<ul>

													<li><a href="https://www.sportsvolt.com" class='footer-link'>Sports Volt</a></li>

													<li><a href="https://www.amedzekorpost.com" class='footer-link'>The Amedzekor Post</a></li>

													<li><a href="https://www.whizord.com" class='footer-link'>Whizord</a></li>

													<li><a href="https://www.styleft.com" class='footer-link'>Style FT</a></li>

													<li><a href="https://www.ifashionnetwork.com" class='footer-link'>iFashion Network</a></li>

													<li><a href="https://www.fashionmr.com" class='footer-link'>Fashion MR</a></li>

													<li><a href="https://www.nyrush.com" class='footer-link'>New York Rush</a></li>

													<li><a href="https://www.africaotr.com" class='footer-link'>Africa OTR</a></li>

												</ul>

											</div>

											<div class='col col-3'>

												<h3>Connect With Us</h3>

												<ul>

													<li><a href="<?php echo get_permalink( get_page_by_path( 'about-us' ) ); ?>" class='footer-link'>About Us</a></li>

													<li><a href="<?php echo get_permalink( get_page_by_path( 'advertise-with-us' ) ); ?>" class='footer-link'>Advertise With Us</a></li>

													<li><a href="<?php echo get_permalink( get_page_by_path( 'write-for-us' ) ); ?>" class='footer-link'>Write For Us</a></li>

													<li><a href="<?php echo get_permalink( get_page_by_path( 'contact-us' ) ); ?>" class='footer-link'>Contact Us</a></li>

													<li><a href="<?php echo get_permalink( get_page_by_path( 'newsletters' ) ); ?>" class='footer-link'>Newsletter</a></li>

													<li><a href="<?php echo get_permalink( get_page_by_path( 'privacy-policy' ) ); ?>" class='footer-link'>Privacy Policy</a></li>

													<li><a href="<?php echo get_permalink( get_page_by_path( 'terms-conditions' ) ); ?>" class='footer-link'>Terms & Conditions</a></li>

													<li><a href="<?php echo get_permalink( get_page_by_path( 'disclaimer' ) ); ?>" class='footer-link'>Disclaimer</a></li>

													<li><a href="<?php echo get_permalink( get_page_by_path( 'dmca-copyright-policy-2' ) ); ?>" class='footer-link'>DMCA Copyright Policy</a></li>

													<li><a href="<?php echo get_permalink( get_page_by_path( 'cookie-policy' ) ); ?>" class='footer-link'>Cookie Policy</a></li>

												</ul>

											</div>

											<div class='col col-4'>

												<a class='footer-logo' href="<?php echo esc_url( home_url( '/' ) ); ?>">

													<img class='standard-footer-logo' src="https://www.biznob.com/wp-content/uploads/2021/11/biznob-logo-black-e1636331037767.png" alt="<?php bloginfo( 'name' ); ?>" data-rjs="2" />

													<img class='dark-footer-logo' src="https://www.biznob.com/wp-content/uploads/2021/11/biznob-logo-e1636331077805.png" alt="<?php bloginfo( 'name' ); ?>" data-rjs="2" />

												</a>

												<ul class="zox-foot-soc-list left relative">

														<?php if(get_option('zox_facebook')) { ?>

															<li><a href="<?php echo esc_url(get_option('zox_facebook')); ?>" target="_blank" class="fab fa-facebook-f"></a></li>

														<?php } ?>

														<?php if(get_option('zox_twitter')) { ?>

															<li><a href="<?php echo esc_url(get_option('zox_twitter')); ?>" target="_blank" class="fab fa-twitter"></a></li>

														<?php } ?>

														<?php if(get_option('zox_instagram')) { ?>

															<li><a href="<?php echo esc_url(get_option('zox_instagram')); ?>" target="_blank" class="fab fa-instagram"></a></li>

														<?php } ?>

														<?php if(get_option('zox_flip')) { ?>

															<li><a href="<?php echo esc_url(get_option('zox_flip')); ?>" target="_blank" class="fab fa-flipboard"></a></li>

														<?php } ?>

														<?php if(get_option('zox_youtube')) { ?>

															<li><a href="<?php echo esc_url(get_option('zox_youtube')); ?>" target="_blank" class="fab fa-youtube"></a></li>

														<?php } ?>

														<?php if(get_option('zox_linkedin')) { ?>

															<li><a href="<?php echo esc_url(get_option('zox_linkedin')); ?>" target="_blank" class="fab fa-linkedin-in"></a></li>

														<?php } ?>

														<?php if(get_option('zox_pinterest')) { ?>

															<li><a href="<?php echo esc_url(get_option('zox_pinterest')); ?>" target="_blank" class="fab fa-pinterest-p"></a></li>

														<?php } ?>

														<?php if(get_option('zox_tumblr')) { ?>

															<li><a href="<?php echo esc_url(get_option('zox_tumblr')); ?>" target="_blank" class="fab fa-tumblr"></a></li>

														<?php } ?>

													</ul>

											</div>

										</div><!--zox-foot-left-wrap-->

									</div><!--zox-foot-grid-->

								</div><!--zox-head-width-->

								<div class="zox-foot-copy">

									<p><?php echo wp_kses_post(get_option('zox_copyright')); ?></p>

								</div><!--zox-foot-copy-->

							</footer><!--zox-foot-wrap-->

						</div><!--zox-site-wall-small-->

					</div><!--zox-site-grid-->

				</div><!--zox-site-main-->

			</div><!--zox-site-wall-->

			<div class="zox-fly-top back-to-top">

				<span class="fas fa-angle-up"></span>

			</div><!--zox-fly-top-->

			<div class='cookies-popup'>
				<div class='cookies-popup-content'>
					<p>
						<b>Notice:</b>
						The Biznob uses cookies to provide necessary website functionality, improve your experience and analyze our traffic. By using our website, you agree to 
						<a href='<?php echo get_permalink( get_page_by_path( 'privacy-policy' ) ); ?>'>our Privacy Policy</a> and <a href='<?php echo get_permalink( get_page_by_path( 'cookie-policy' ) ); ?>'>our Cookie Policy</a>.
					</p>
					<a class='link-button close-cookies-popup'>Ok</a>										
				</div>
				
			</div>

		</div><!--zox-site-->

		<div class="zox-fly-fade zox-fly-but-click">

		</div><!--zox-fly-fade-->

		<?php wp_footer(); ?>

	</body>

</html>