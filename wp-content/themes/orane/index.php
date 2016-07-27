<?php



/*



	Default Template



*/



get_header(); ?>





		<!--Blog section-->



		<section class="blog">



			<div class="container">



				<div class="row">



						



						<?php  

							global $redux_orane, $post;

							$meta_sidebar = $redux_orane['orane-opt-layout'];

							$meta_sidebar = esc_attr($meta_sidebar);





							$sidebar_width = "col-md-8";



							if($meta_sidebar == '1'){



								$sidebar_width = "col-md-12";



							}







						?>







							<?php if($meta_sidebar == '2'){	?>



									<div class="sidebar-left">



										<?php get_sidebar(); ?>	



									</div>	



							<?php } ?>











					<div class="<?php echo sanitize_html_class( $sidebar_width ); ?> post-left">



						<?php get_template_part( 'content', 'latestfront' ); ?>



						<?php get_template_part( 'pagination' ); ?>



					</div>











						<?php	if($meta_sidebar == '3'){		?>







									<?php get_sidebar(); ?>



						



						<?php } ?>











				</div>	



			</div>	



		</section>









	



		



<?php get_footer(); ?>