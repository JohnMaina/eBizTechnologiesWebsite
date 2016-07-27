<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Orane
 * @since Orane 1.0
 */

	global $redux_orane; 

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


					<!-- sanitized on line 23, 26 and 30 -->
					<!-- class already been sanitized, if I sanitize here, sanitize_html_class() will remove the spaces between multiple classes -->
					<!-- added the post_class() function with extra class added for sidebar option -->
					<div <?php post_class($layout_class); ?>>



					<?php get_template_part( 'content', get_post_format() ); ?>

					<div class="tags post-tags">

						<?php the_tags(); ?>

					</div>

					<?php orane_pagination(); ?>

					<?php 


						$show_arrows = esc_attr( $redux_orane['orane-blog-prev-next'] );

					
						if($show_arrows == 1){

							orane_next_prev();

						}
					?>


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