<?php
/*
	Template Name: Blog
*/
get_header(); ?>


		<!--Blog section-->
		<section class="blog">

			<div class="container">

				<div class="row">

					<?php  
						$sidebar = esc_attr( $redux_orane["orane-opt-layout"] );

						if($sidebar == 2){
							$layout_class = sanitize_html_class( 'col-md-8' );
						}elseif($sidebar == 1){
							//split the sanization functions, it cant handle multple classes
							$layout_class = sanitize_html_class( 'col-md-12' ) ." ". sanitize_html_class('post-left');	

						}elseif($sidebar == 3){
							//split the sanization functions, it cant handle multple classes
							$layout_class = sanitize_html_class('col-md-8') ." ". sanitize_html_class( 'post-left' );
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

					<div class="<?php echo $layout_class ; ?>">

						<?php get_template_part( 'content', 'blog' ); ?>

						<?php get_template_part( 'pagination' ); ?>

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