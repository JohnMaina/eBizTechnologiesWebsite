<?php



/*



	Template Name: Page - Advanced



*/







get_header(); 



$show_title = esc_attr(get_post_meta( $post->ID, '_orane_page_adv_show_title', true ));

?>











<div class="container">



	<div class="row">







		<div <?php post_class(); ?> >



		<?php if(have_posts()): while(have_posts()): the_post(); ?>



					

					<?php if($show_title == "show"){ ?>



						<div class="page-heading page-center"><h1><?php echo orane_line2SpanColor(get_the_title()); ?></h1></div>	



					<?php } ?>



					



					<?php the_content(); ?>



					



		<?php endwhile; ?>



		<?php endif; ?>



		</div>







	</div>



</div>







	







		<div class="clearfix"></div>







	























<?php get_footer(); ?>