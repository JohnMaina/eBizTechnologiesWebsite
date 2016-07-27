<?php

/*

*Used to display Archives Pages

*@package orane

*/

get_header(); ?>





		<!--Blog section-->

		<section class="blog blog-archive">

			<div class="container">

				<div class="row">

					<div class="col-md-8 post-left">





					<?php if ( have_posts() ) : ?>

							<h1 class="archive-title"><?php

								if ( is_day() ) :

									printf( __( 'Daily Archives: <span class="color">%s</span>', 'orane' ), get_the_date() );

								elseif ( is_month() ) :

									printf( __( 'Monthly Archives: <span class="color">%s</span>', 'orane' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'orane' ) ) );

								elseif ( is_year() ) :

									printf( __( 'Yearly Archives: <span class="color">%s</span>', 'orane' ), get_the_date( _x( 'Y', 'yearly archives date format', 'orane' ) ) );

								else :

									_e( 'Archives', 'orane' );

								endif;

						?></h1>



							

								<?php get_template_part( 'content', 'archive'); ?>

							





						<?php get_template_part( 'pagination' ); ?>



					<?php else : ?>

						<?php  get_template_part( 'content', 'none' ); ?>

					<?php endif; ?>







					</div>

						<?php get_sidebar(); ?>

				</div>

			</div>	

		</section>





		



		

<?php get_footer(); ?>