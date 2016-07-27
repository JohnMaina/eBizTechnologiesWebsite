<?php

/*

Template to filter categories

*/

get_header(); ?>





		<!--Blog section-->

		<section class="blog">

			<div class="container">

				<div class="row">

					<div class="col-md-8 post-left">

						<div class="page-heading-minor">

						<h3><?php printf( __( 'Search Results for: <span class="color">%s</span>', 'orane' ), get_search_query() ); ?></h3>

						</div>

						<?php get_template_part( 'content', 'search' ); ?>

						<?php get_template_part( 'pagination' ); ?>

					</div>

						<?php get_sidebar(); ?>

				</div>

			</div>	

		</section>



		

		

<?php get_footer(); ?>