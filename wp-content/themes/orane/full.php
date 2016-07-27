<?php
/*
Template Name: Blog - Full Width
*/

get_header(); ?>


		<!--Blog section-->
		<section class="blog">
			<div class="container">
				<div class="row">
					<div class="col-md-12 post-left">
						<?php get_template_part( 'content', 'blog' ); ?>
						<?php get_template_part( 'pagination' ); ?>

					</div>
				</div>
			</div>	
		</section>
		
	
		
<?php get_footer(); ?>