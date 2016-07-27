<?php

/*

Template Name: Default - Full Width

*/



get_header(); ?>



		

		<!--Blog section-->

		<section class="blog error">

				<div class="container error-page">

					<div class="col-md-3 cartoon">

						<img src="<?php echo get_template_directory_uri(); ?>/images/cartoon2.png" alt="" />

					</div>

					

					<div class="col-md-6">

						<h1><?php _e('404', 'orane'); ?></h1>

						<h2><?php _e('Page Not Found', 'orane'); ?></h2>

						<p><?php _e("We're sorry, the page you requested cannot be found.<br> You can go back to Home Page", "orane"); ?></p>

						<a href="<?php echo home_url(); ?>" class="error-back"><?php _e('Back To Home', 'orane'); ?></a>

					</div>

					

					<div class="col-md-3 cartoon">

						<img src="<?php echo get_template_directory_uri(); ?>/images/cartoon.png" alt="" />

					</div>

				</div>	

		</section>

		

		

		<?php 

			if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('orane_footer1') ) :

		endif; 

		?>





		<div class="clearfix"></div>

		

		

<?php get_footer(); ?>