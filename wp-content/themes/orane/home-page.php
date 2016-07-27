<?php
/*
Template Name: Home Page
*/

get_header(); ?>

		



<div <?php post_class("orane-home"); ?> >
<?php if(have_posts()): while(have_posts()): the_post(); ?>
	
			<?php the_content(); ?>
			
<?php endwhile; ?>
<?php endif; ?>

</div>

	

		<div class="clearfix"></div>

		




<?php get_footer(); ?>