<?php



/**



 * Index File



 *



 *



 *



 * @package RedGJ



 * @subpackage Orane



 * @since Orane 1.0



 */







get_header(); ?>



		<!--Blog section-->



		<section class="blog">



			<div class="container">



				<div class="row">



					<?php  



						$sidebar = esc_attr( $redux_orane["orane-opt-layout"] );







						if($sidebar == 2){



							$post_class = 'col-md-8';



						}elseif($sidebar == 1){



							$post_class = 'col-md-12 post-left';	



						}elseif($sidebar == 3){



							$post_class = 'col-md-8 post-left';



						}



						 



					?>







					<?php if($sidebar == 2){ ?>



							<div class="col-md-4 sidebar">



								<?php 



									if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('orane_sidebar') ) :



								endif; 



								?>



							</div>



					<?php } ?>				



















					<div class="<?php echo sanitize_html_class( $post_class ); ?>">











					<?php get_template_part( 'content', 'project' ); ?>



					



						



					<?php orane_pagination(); ?>







					<?php orane_next_prev(); ?>







					<?php comments_template(); ?>











					</div>











					<?php if($sidebar == 3){ ?>



							<div class="col-md-4 sidebar">



								<?php 



									if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('orane_sidebar') ) :



								endif; 



								?>



							</div>



					<?php } ?>







				</div>



			</div>	



		</section>



		



		







		



<?php get_footer(); ?>