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
						<h1><?php printf( __( 'Category Archives: <span class="color">%s</span>', 'orane' ), single_cat_title( '', false ) ); ?></h1>
						<?php get_template_part( 'content', 'category' ); ?>
						<?php get_template_part( 'pagination' ); ?>
					</div>
						<?php get_sidebar(); ?>
				</div>
			</div>	
		</section>

		
		<?php 
			if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('orane_footer1') ) :
		endif; 
		?>

		
<?php get_footer(); ?>